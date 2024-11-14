<!--
    Archivo: login.php
    En este archivo se define el formulario de busqueda avanzada
    Creado por: Pablo Hernández García el 02/11/2024
    Historial de cambios:
    02/11/2024 - Creado
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
        <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/myProfile.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <title>Inicio de sesión</title>
</head>
<body>
    <?php include "../inc/header.php" ?>
    <main id="main-content">
        <h2>Selección de estilo</h2>
        <nav id="userMenu">
            <button onclick="selectStyle('dyslexic')">
                <i class="fa-solid fa-question"></i>
                <span>Dislexia</span>
            </button>
            <button onclick="selectStyle('big-font')">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>Fuente grande</span>
            </button>
            <button onclick="selectStyle('big-font-dyslexic')">
                <i class="fa-solid fa-plus"></i>
                <span>Dislexia + Fuente Grande</span>
            </button>
            <button onclick="selectStyle('default')">
                <i class="fa-solid fa-sun"></i>
                <span>Modo claro</span>
            </button>
            <button onclick="selectStyle('dark')">
                <i class="fa-solid fa-moon"></i>
                <span>Modo oscuro</span>
            </button>
        </nav>
    </main>

    <?php include "../inc/footer.php"; ?>

</body>
</html>