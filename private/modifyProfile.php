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
        href="../styles/<?php include '../inc/styleSelector.php' ?>/login.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/myProfile.js"></script>
    <script src="../js/common.js"></script>

    <title>Modificar Perfil</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <?php include "../phpAdds/modifyForm.php"?>
    </main>

    <?php include "../inc/footer.php"; ?>
</body>
</html>
