<!--
    Archivo: myProfile.php
    Archivo dedicado a los detalles de perfil de un usuario que es uno mismo
    Creado por: Pablo Hernández García el 20/09/2024
    Historial de cambios:
    20/09/2024 - Creado
    01/10/2024 - Desarrollado
    08/10/2024 - CSS Aplicado
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/myProfile.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/myProfile.js"></script>
    <script src="../js/common.js"></script>

    <title>Mi perfil</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <nav id="userMenu">
            <a href="./passConfirmToModify.php">
                <i class="fa-solid fa-pencil"></i>
                <span>Modificar mi perfil</span>
            </a>
            <a href="./unsuscribe.php">
                <i class="fa-solid fa-trash"></i>
                <span>Darme de baja</span>
            </a>
            <a href="./myAds.php">
                <i class="fa-solid fa-house"></i>
                <span>Mis anuncios</span>
            </a>
            <a href="./createAd.php">
                <i class="fa-solid fa-plus"></i>
                <span>Anuncio nuevo</span>
            </a>
            <a href="./myMessages.php">
                <i class="fa-solid fa-message"></i>
                <span>Mis mensajes</span>
            </a>
            <a href="../restricted/brochureRequest.php">
                <i class="fa-solid fa-file-lines"></i>
                <span>Solicitar folleto</span>
            </a>
            <a href="./addPhoto.php">
                <i class="fa-solid fa-camera"></i>
                <span>Añadir foto a anuncio</span>
            </a>
            <a onclick="logout()" id="logOut">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span>Cerrar sesión</span>
            </a>
        </nav>
    </main>

    <?php include "../inc/footer.php"; ?>
</body>
</html>
