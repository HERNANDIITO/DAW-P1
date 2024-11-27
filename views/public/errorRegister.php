<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $data['title']?></title>
    <link 
        rel="stylesheet" 
        media="screen" 
        href="views/styles/<?php include 'views/common/styleSelector.php' ?>/errorRegister.css"
        title="<?php include 'views/common/styleSelector.php' ?>"
        id="<?php include 'views/common/styleSelector.php' ?>"
    >
</head>
<body>
    <main>
        <h1>Error en el Registro</h1>
        <p>Por favor, corrige los siguientes errores antes de continuar:</p>
        <ul>
            <?php
                // Recuperar errores de la sesión y eliminarlos
                $errors = isset($_SESSION['flashdata_errors']) ? $_SESSION['flashdata_errors'] : [];

                if (!empty($errors)) {
                    foreach ($errors as $error) {
                        if ($error === "user") {
                            echo "<li>El nombre de usuario no puede estar vacío.</li>";
                        } elseif ($error === "pass") {
                            echo "<li>La contraseña y su confirmación son obligatorias.</li>";
                        } elseif ($error === "passMismatch") {
                            echo "<li>Las contraseñas no coinciden.</li>";
                        }
                    }
                    // Borrar los errores de la sesión después de mostrarlos
                    unset($_SESSION['flashdata_errors']);
                }
            ?>
        </ul>
        <a href="register.php" class="greenButton">Volver al Registro</a>
    </main>
</body>
</html>
