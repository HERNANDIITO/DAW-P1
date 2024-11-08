<!--
    Archivo: registerResponse.php
    Página de respuesta de registro que confirma los datos ingresados o redirige a una página de error.
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Registro</title>
    <link rel="stylesheet" href="../styles/registerResponse.css">
</head>
<body>
    <?php
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
            // Redirigir a página de error con parámetros en la URL
            $errorParams = http_build_query(["error" => $errors]);
            header("Location: errorRegister.php?$errorParams");
            exit();
        }
    ?>

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
</body>
</html>
