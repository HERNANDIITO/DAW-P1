<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Verificar si AdId está disponible en la sesión
if (!isset($_SESSION['AdId']) || !isset($_SESSION['userSession'])) {
    echo "<h1>Error</h1><p>No se encontró el ID del anuncio o la sesión del usuario. Por favor, intenta nuevamente.</p>";
    exit;
}

// Obtener el ID del anuncio y el usuario de origen desde la sesión
$adId = $_SESSION['AdId'];
$usuarioOrigen = $_SESSION['userSession'];

session_commit();

// Conexión a la base de datos
$connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");
if (!$connectionID) {
    echo "<h1>Error</h1><p>Error al conectar con la base de datos: " . mysqli_connect_error() . "</p>";
    exit;
}

// Obtener el usuario de destino a partir del anuncio
$queryUsuarioDestino = "SELECT Usuario FROM Anuncios WHERE IdAnuncio = ?";
$stmtDestino = mysqli_prepare($connectionID, $queryUsuarioDestino);

if ($stmtDestino) {
    mysqli_stmt_bind_param($stmtDestino, "i", $adId);
    mysqli_stmt_execute($stmtDestino);
    mysqli_stmt_bind_result($stmtDestino, $usuarioDestino);
    mysqli_stmt_fetch($stmtDestino);
    mysqli_stmt_close($stmtDestino);

    // Verificar si se obtuvo un usuario
    if (!$usuarioDestino) {
        echo "<h1>Error</h1><p>No se encontró el usuario del anuncio especificado.</p>";
        exit;
    }
} else {
    echo "<h1>Error</h1><p>Error al preparar la consulta para obtener el usuario de destino: " . mysqli_error($connectionID) . "</p>";
    exit;
}

// Verificar si se recibieron los datos del formulario
if (empty($_POST['message'])) {
    echo "<h1>Error</h1><p>El mensaje es obligatorio.</p>";
    exit;
}

// Limpiar y procesar los datos del formulario
$message = mysqli_real_escape_string($connectionID, $_POST['message']);
$option = isset($_POST['option']) ? (int)$_POST['option'] : 0;

// Asociar el tipo de mensaje con un texto
$typeMap = [
    1 => "Más información",
    2 => "Cita",
    3 => "Oferta",
];
$typeTitle = isset($typeMap[$option]) ? $typeMap[$option] : "Tipo no especificado";

// Insertar el mensaje en la base de datos
$sql = "INSERT INTO Mensajes (TMensaje, Texto, Anuncio, UsuarioOrigen, UsuarioDestino)
        VALUES (?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($connectionID, $sql);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "isiii", $option, $message, $adId, $usuarioOrigen, $usuarioDestino);
    $execution = mysqli_stmt_execute($stmt);

    if (!$execution) {
        echo "<h1>Error</h1><p>Error al enviar el mensaje: " . mysqli_error($connectionID) . "</p>";
        exit;
    }

    mysqli_stmt_close($stmt);
} else {
    echo "<h1>Error</h1><p>Error al preparar la consulta: " . mysqli_error($connectionID) . "</p>";
    exit;
}

$sql = "
    SELECT NomUsuario, IdUsuario
    FROM Usuarios 
    WHERE IdUsuario IN (?, ?);
";

$stmt = mysqli_prepare($connectionID, $sql);
$stmt->bind_param("ii", $usuarioOrigen, $usuarioDestino);
$stmt->execute();
$result = $stmt->get_result();
$usuarios = $result->fetch_all(MYSQLI_ASSOC);

foreach ($usuarios as $usuario) {
    if ($usuario['IdUsuario'] == $usuarioOrigen) {
        $usuarioOrigen = $usuario['NomUsuario'];
    } 

    if ($usuario['IdUsuario'] == $usuarioDestino) {
        $usuarioDestino = $usuario['NomUsuario'];
    } 
}

// Cerrar conexión
mysqli_close($connectionID);

// Mostrar los datos del formulario en HTML
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/message.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>

    <title>Mensaje enviado</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <h1 class="title">Mensaje enviado</h1>
        <span class="type">
            <h2 class="title"><?php echo htmlspecialchars($typeTitle); ?></h2>
            <i class="fa-solid fa-paper-plane"></i>
        </span>
        <section class="message">
            <section class="messageContent">
                <p><?php echo htmlspecialchars($message); ?></p>
            </section>
            <hr class="solid">
            <section class="messageInfo">
                <span><?php echo date("d/m/Y"); ?></span>
                <span>De: <?php echo $usuarioOrigen; ?></span>
                <span>Para: <?php echo $usuarioDestino; ?></span>
            </section>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>
</body>
</html>
