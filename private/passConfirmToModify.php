<?php 
session_start();
include "../inc/header.php"; 

// Verificar si el formulario fue enviado
$errorMessage = "";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $userPassword = $_POST['pass'];

    // Asume que la contraseña del usuario loggeado está almacenada en $_SESSION['user_password']
    if (isset($_SESSION['user_password'])) {
        if ($userPassword === $_SESSION['user_password']) {
            // Contraseña correcta, redirigir al usuario
            header("Location: ./modifyProfile.php");
            exit();
        } else {
            // Contraseña incorrecta, mostrar mensaje de error
            $errorMessage = "La contraseña introducida no es correcta.";
        }
    } else {
        // Si no hay una contraseña en sesión, redirigir al login
        header("Location: ./login.php");
        exit();
    }
}
?>

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
    <main id="main-content">
        <h2>Por favor, verifica que eres tú mediante tu contraseña</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
            <section class="inputGroup">
                <label for="pass">Contraseña</label>
                <input type="password" name="pass" placeholder="contrasenyaMuySegura" id="passInput" required>
            </section>
            <button class="greenButton" id="submitLoginButton">Confirmar</button>
        </form>
        <?php if (!empty($errorMessage)): ?>
            <h3 style="color: red;"><?php echo htmlspecialchars($errorMessage); ?></h3>
        <?php endif; ?>
    </main>
    <?php include "../inc/footer.php"; ?>
</body>
</html>
