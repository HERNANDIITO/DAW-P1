<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");

// Verificar si la conexión fue exitosa
if (!$connectionID) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Consulta para obtener los tipos de mensajes
$sql = "SELECT IdTMensaje, NomTMensaje FROM TiposMensajes";
$result = mysqli_query($connectionID, $sql);

// Verificar si hay resultados
$tiposMensajes = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $tiposMensajes[] = $row;
    }
}

// Cerrar la conexión
mysqli_close($connectionID);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/common.js"></script>
    <link
        rel="stylesheet" 
        media="screen" 
        href="views/styles/<?php include 'views/common/styleSelector.php' ?>/sendMessage.css"
        title="<?php include 'views/common/styleSelector.php' ?>"
        id="<?php include 'views/common/styleSelector.php' ?>"
    >
    <title>Enviar mensaje</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <h1 class="title">Mensaje para Paco Moreno</h1>
        <form action="messageResponse.php" method="POST">
            <section class="inputGroup">
                <label for="message">Mensaje</label>
                <textarea name="message" placeholder="Aquí puedes escribir un mensaje al arrendador"></textarea>
            </section>
            <section class="inputGroup">
                <label for="option">Tipo de mensaje</label>
                <select name="option" id="option">
                    <option value="" disabled selected>Selecciona el tipo de mensaje</option>
                    <?php foreach ($tiposMensajes as $tipo): ?>
                        <option value="<?= htmlspecialchars($tipo['IdTMensaje']) ?>">
                            <?= htmlspecialchars($tipo['NomTMensaje']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </section>
            <button class="greenButton" type="submit">Enviar</button>
        </form>
    </main>

    <?php include "../inc/footer.php"; ?>
</body>
</html>
