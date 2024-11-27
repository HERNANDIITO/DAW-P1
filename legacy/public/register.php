<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/login.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <title>Registro</title>
</head>
<body>
    <?php include "../inc/header.php" ?>
    <main id="main-content">
        <h1 class="title">Registro</h1>
        <?php include "../phpAdds/registerForm.php" ?>
        <a href="/public/login.php">¿Ya tienes cuenta?</a>
    </main>
    <?php include "../inc/footer.php"; ?>
</body>
</html>
