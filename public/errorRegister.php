<!--
    Archivo: errorRegister.php
    Página de error que muestra los errores en el formulario de registro.
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error de Registro</title>
    <link rel="stylesheet" href="../styles/errorRegister.css">
</head>
<body>
    <main>
        <h1>Error en el Registro</h1>
        <p>Por favor, corrige los siguientes errores antes de continuar:</p>
        <ul>
            <?php
                $errors = isset($_GET['error']) ? $_GET['error'] : [];

                if (in_array("user", $errors)) {
                    echo "<li>El nombre de usuario no puede estar vacío.</li>";
                }
                if (in_array("pass", $errors)) {
                    echo "<li>La contraseña y su confirmación son obligatorias.</li>";
                }
                if (in_array("passMismatch", $errors)) {
                    echo "<li>Las contraseñas no coinciden.</li>";
                }
            ?>
        </ul>
        <a href="register.php" class="greenButton">Volver al Registro</a>
    </main>
</body>
</html>
