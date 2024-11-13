<!--
    Archivo: register.php
    En este archivo se define el formulario de búsqueda avanzada
    Creado por: Pablo Hernández García el 26/09/2024
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

    <link rel="stylesheet" href="../styles/login.css">
    <!-- night mode -->
    <link rel="alternate stylesheet" media="screen" href="../styles/dark/night.css" title="Modo Noche" id="dark">
    <!-- dislexicos -->
    <link rel="alternate stylesheet" media="screen" href="../styles/dyslexic/login.css" title="Modo para disléxicos" id="dyslexia">
    <!-- big-font -->
    <link rel="alternate stylesheet" media="screen" href="../styles/big-font/login.css" title="Modo de letras grandes" id="big_font">
    <!-- big-font-dyslexic -->
    <link rel="alternate stylesheet" media="screen" href="../styles/big-font-dyslexic/login.css" title="Modo de letras grandes + dislexia" id="dyslexia_and_big_font">
    <title>Registro</title>
</head>
<body>
    <?php include "../inc/header.php" ?>
    <main id="main-content">
        <h1 class="title">Registro</h1>
        <form action="./registerResponse.php" method="POST">
            <section class="inputGroup">
                <label for="email">Email</label>
                <input name="email" placeholder="usu@email.com" id="email">
            </section>
            <section class="inputGroup">
                <label for="user">Nombre de usuario</label>
                <input name="user" placeholder="nombreUsuario" id="user">
            </section>
            <section class="inputGroup">
                <label for="pass">Contraseña</label>
                <input name="pass" placeholder="contrasenyaMuySegura" id="passInput">
            </section>
            <section class="inputGroup">
                <label for="pass">Repetir contraseña</label>
                <input name="pass2" placeholder="contrasenyaMuySegura" id="pass2">
            </section>
            <section class="inputGroup">
                <label for="sex">Sexo</label>
                <select name="sex" id="sex">
                    <option selected value="hombre">Hombre</option>
                    <option value="mujer">Mujer</option>
                </select>
            </section>
            <section class="inputGroup">
                <label for="birthdate">Fecha de nacimiento</label>
                <input type="date" name="birthdate" id="birth">
            </section>
            <section class="inputGroup">
                <label for="city">Ciudad</label>
                <input name="city" placeholder="Sant Vicent del Raspeig">
            </section>
            <section class="inputGroup">
                <label for="country">País de residencia</label>
                <input name="country" placeholder="España">
            </section>
            <section class="inputGroup">
                <label for="pfp">Foto de perfil</label>
                <input name="pfp">
            </section>
            <button class="greenButton" id="submitLoginButton">Entrar</button>
        </form>
        <a href="/public/login.php">¿Ya tienes cuenta?</a>
    </main>

    <?php include "../inc/footer.php";?>

</body>
</html>
