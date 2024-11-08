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
    <script src="../js/common.js"></script>

    <link rel="stylesheet" media="screen" title="Modo claro"  href="../styles/login.css">
    <!-- night mode -->
    <link rel="alternate stylesheet" media="screen" href="../styles/dark/night.css" title="Modo Noche" id="dark">
    <!-- dislexicos -->
    <link rel="alternate stylesheet" media="screen" href="../styles/dyslexic/login.css"    title="Modo para dislexicos" id="dyslexia">
    <!-- big-font -->
    <link rel="alternate stylesheet" media="screen" href="../styles/big-font/login.css"    title="Modo de letras grandes" id="big_font">
    <!-- big-font-dyslexic -->
    <link rel="alternate stylesheet" media="screen" href="../styles/big-font-dyslexic/login.css"    title="Modo de letras grandes + dislexia" id="dyslexia_and_big_font">
    <title>Inicio de sesión</title>
</head>
<body>
    <header class="mainHeader">
        <nav id="navBar">
            <section class="links">
                <a class="navLink" href="/"> <i class="fa-solid fa-house"></i> Inicio</a>
                <a class="navLink" href="/public/search.php"> <i class="fa-solid fa-magnifying-glass"></i> Búsqueda</a>
            </section>
            <section class="profile">
                <a class="navLink" href="/public/login.php"> <i class="fa-solid fa-user"></i> Iniciar sesión </a>
                <a class="navLink" href="/public/register.php"> <i class="fa-solid fa-right-to-bracket"></i> Registrarse </a>
            </section>
        </nav>
    </header>
    <main id="main-content">
        <h1 class="title">Inicio de sesión</h1>
        <form action="../phpAdds/accessControl.php" method="POST" id="loginForm">
            <section class="inputGroup">
                <label for="user">Nombre de usuario</label>
                <input onblur="checkUser(this.value)" type="text" name="user" placeholder="nombreUsuario" id="user">
            </section>
            <section class="inputGroup">
                <label for="pass">Contraseña</label>
                <input onblur="checkPassword(this.value)" type="text" name="pass" placeholder="contrasenyaMuySegura" id="pass">
            </section>
            <button class="greenButton" type="submit" id="submitLoginButton">Entrar</button>
        </form>
        <a href="/public/register.php">¿Todavía no tienes cuenta?</a>

    </main>
    
    <?php
        include "../inc/footer.php";
    ?>


    <script src="../js/login.js"></script>
<script>
    changeStyle();
    checkCookies();
</script>