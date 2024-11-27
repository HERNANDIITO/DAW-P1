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

// Obtener el ID del usuario (puede venir de un GET o sesión)
$idUsuario = isset($_GET['idUsuario']) ? intval($_GET['idUsuario']) : 0;

// Validar el ID del usuario
if ($idUsuario <= 0) {
    die("Usuario no válido.");
}

// Consultar datos del usuario
$sqlUsuario = "SELECT NomUsuario, Email, Sexo, Ciudad, FNacimiento, Foto FROM Usuarios WHERE IdUsuario = ?";
$stmtUsuario = mysqli_prepare($connectionID, $sqlUsuario);
mysqli_stmt_bind_param($stmtUsuario, "i", $idUsuario);
mysqli_stmt_execute($stmtUsuario);
$resultUsuario = mysqli_stmt_get_result($stmtUsuario);
$usuario = mysqli_fetch_assoc($resultUsuario);

// Consultar anuncios del usuario
$sqlAnuncios = "SELECT Titulo, Precio, Ciudad, Foto FROM Anuncios WHERE Usuario = ?";
$stmtAnuncios = mysqli_prepare($connectionID, $sqlAnuncios);
mysqli_stmt_bind_param($stmtAnuncios, "i", $idUsuario);
mysqli_stmt_execute($stmtAnuncios);
$resultAnuncios = mysqli_stmt_get_result($stmtAnuncios);
$anuncios = [];
while ($row = mysqli_fetch_assoc($resultAnuncios)) {
    $anuncios[] = $row;
}

// Cerrar la conexión
mysqli_close($connectionID);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/profile.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <title>Perfil</title>
</head>
<body>
        
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <section class="pfp">
            <img src="<?= htmlspecialchars($usuario['Foto'] ?? '../assets/img/logo.png') ?>" class="logo" alt="Foto de perfil">
            <h1><?= htmlspecialchars($usuario['NomUsuario'] ?? 'Usuario desconocido') ?></h1>
        </section>
        <section class="info-wrapper">
            <section class="info">
                <p><i class="fa-solid fa-at"></i><?= htmlspecialchars($usuario['Email'] ?? 'No especificado') ?></p>
                <p><i class="fa-solid fa-user"></i><?= $usuario['Sexo'] == 1 ? 'Hombre' : ($usuario['Sexo'] === 0 ? 'Mujer' : 'No especificado') ?></p>
            </section>
            <section class="info">
                <p><i class="fa-solid fa-location-dot"></i><?= htmlspecialchars($usuario['Ciudad'] ?? 'No especificada') ?></p>
                <p><i class="fa-solid fa-calendar-days"></i><?= htmlspecialchars($usuario['FNacimiento'] ?? 'No especificada') ?></p>
            </section>
        </section>
        <h1>Anuncios</h1>
        <section class="houses">
            <?php if (count($anuncios) > 0): ?>
                <?php foreach ($anuncios as $anuncio): ?>
                    <!-- <a href="../restricted/cardDetails.php">  -->
                        <section class="card">
                            <img class="mainImg" src="<?= htmlspecialchars($anuncio['Foto'] ?? '../assets/img/houses/default.png') ?>" alt="Foto del anuncio">
                            <h1 class="title"><?= htmlspecialchars($anuncio['Titulo']) ?></h1>
                            <section class="info">
                                <p><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($anuncio['Ciudad']) ?></p>
                                <!-- <p><i class="fa-solid fa-tag"></i> <?= number_format($anuncio['Precio'], 2, ',', '.') ?>€</p> -->
                            </section>
                        </section>
                    <!-- </a> -->
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hay anuncios publicados por este usuario.</p>
            <?php endif; ?>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>
</body>
</html>
