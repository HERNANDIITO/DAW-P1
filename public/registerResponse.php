<?php
session_start();

// Recuperar datos del formulario
$email = $_POST['email'];
$username = $_POST['user'];
$password = $_POST['pass'];
$confirmPassword = $_POST['pass2'];
$sex = $_POST['sex'];
$birthdate = $_POST['birthdate'];
$city = $_POST['city'];
$country = $_POST['country'];

// Validaciones de PHP
$errors = [];

if (empty($username)) {
    $errors[] = "user";
}

if (empty($password) || empty($confirmPassword)) {
    $errors[] = "pass";
} elseif ($password !== $confirmPassword) {
    $errors[] = "passMismatch";
}

if (!empty($errors)) {
    // Almacenar errores en la sesión como "flashdata"
    $_SESSION['flashdata_errors'] = $errors;
    header("Location: errorRegister.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/registerResponse.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
</head>
<body>
    <?php include "../inc/header.php" ?>
    <main>
        <h1>Confirmación de Registro</h1>
        <section class="formResult">
            <section class="inputGroup">
                <label>Email:</label>
                <span><?php echo htmlspecialchars($email); ?></span>
            </section>
            <section class="inputGroup">
                <label>Nombre de usuario:</label>
                <span><?php echo htmlspecialchars($username); ?></span>
            </section>
            <section class="inputGroup">
                <label>Sexo:</label>
                <span><?php echo htmlspecialchars($sex); ?></span>
            </section>
            <section class="inputGroup">
                <label>Fecha de nacimiento:</label>
                <span><?php echo htmlspecialchars($birthdate); ?></span>
            </section>
            <section class="inputGroup">
                <label>Ciudad:</label>
                <span><?php echo htmlspecialchars($city); ?></span>
            </section>
            <section class="inputGroup">
                <label>País de residencia:</label>
                <span><?php echo htmlspecialchars($country); ?></span>
            </section>
        </section>

        <a href="../private/myProfile.php" class="greenButton">Ir a Mi Perfil</a>
    </main>
    <?php include "../inc/footer.php" ?>
</body>
</html>
