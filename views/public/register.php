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
        href="views/styles/<?php include 'views/common/styleSelector.php' ?>/login.css"
        title="<?php include 'views/common/styleSelector.php' ?>"
        id="<?php include 'views/common/styleSelector.php' ?>"
    >
    <title><?php echo $data['title']?></title>
</head>
<body>
    <main id="main-content">
        <h1 class="title">Registro</h1>
        <?php include "views/common/registerForm.php" ?>
        <a href="<?php echo urlPUBLIC . urlACTION . 'login'  ?>">¿Ya tienes cuenta?</a>
    </main>
</body>
</html>
