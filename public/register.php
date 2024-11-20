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

// Consulta para obtener los países
$sql = "SELECT IdPais, Nombre FROM Paises";
$result = mysqli_query($connectionID, $sql);

// Verificar si hay resultados
$paises = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $paises[] = $row;
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
                <input type="password" name="pass" placeholder="contrasenyaMuySegura" id="passInput">
            </section>
            <section class="inputGroup">
                <label for="pass2">Repetir contraseña</label>
                <input type="password" name="pass2" placeholder="contrasenyaMuySegura" id="pass2">
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
                <select name="country" id="country">
                    <option value="" disabled selected>Selecciona tu país</option>
                    <?php foreach ($paises as $pais): ?>
                        <option value="<?= $pais['IdPais'] ?>"><?= htmlspecialchars($pais['Nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </section>
            <section class="inputGroup">
                <label for="pfp">Foto de perfil</label>
                <input name="pfp">
            </section>
            <button class="greenButton" id="submitLoginButton">Entrar</button>
        </form>
        <a href="/public/login.php">¿Ya tienes cuenta?</a>
    </main>
    <?php include "../inc/footer.php"; ?>
</body>
</html>
