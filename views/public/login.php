<!--
    Archivo: login.php
    En este archivo se define el formulario de busqueda avanzada
    Creado por: David González Moreno el 26/09/2024
    Historial de cambios:
    26/09/2024 - Creado
    28/09/2024 - Correciones del profesor
    08/10/2024 - CSS Aplicado
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
        href="views/styles/<?php include 'views/common/styleSelector.php' ?>/login.css"
        title="<?php include 'views/common/styleSelector.php' ?>"
        id="<?php include 'views/common/styleSelector.php' ?>"
    >
    <title><?php echo $data['title']?></title>
</head>
<body>
    <main id="main-content">
        <h1 class="title">Inicio de sesión</h1>
        <form action="<?php echo urlPUBLIC . urlACTION . 'loginLogic'  ?>" method="POST" id="loginForm">
            <section class="inputGroup">
                <label for="user">Nombre de usuario</label>
                <input onblur="checkUser(this.value)" type="text" name="user" placeholder="nombreUsuario" id="user">
            </section>
            <section class="inputGroup">
                <label for="pass">Contraseña</label>
                <input onblur="checkPassword(this.value)" type="text" name="pass" placeholder="contrasenyaMuySegura" id="pass">
            </section>
            <section class="inputGroup">
                <label for="remember">Recordarme en este equipo</label>
                <input type="checkbox" name="remember" id="remember">
            </section>
            <button class="greenButton" type="submit" id="submitLoginButton">Entrar</button>
        </form>
        <a href="<?php echo urlPUBLIC . urlACTION . 'register'  ?>">¿Todavía no tienes cuenta?</a>

    </main>
</body>
    <script src="../js/login.js"></script>
