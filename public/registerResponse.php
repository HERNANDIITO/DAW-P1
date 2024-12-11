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

// Convertir sexo a un valor numérico
if ($sex === "hombre") {
    $sex = 1;
} elseif ($sex === "mujer")
    $sex = 2;
else {
    $sex = 1;
}

// Validaciones de PHP
$errors = [];

// Validación del nombre de usuario
if (empty($username)) {
    $errors[] = "user";
} elseif (!preg_match('/^[a-zA-Z][a-zA-Z0-9]{2,14}$/', $username)) {
    $errors[] = "userInvalid";
}

// Validación de la contraseña
if (empty($password)) {
    $errors[] = "pass";
} elseif (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d_-]{6,15}$/', $password)) {
    $errors[] = "passInvalid";
}

// Validación de repetir contraseña
if (empty($confirmPassword)) {
    $errors[] = "passConfirm";
} elseif ($password !== $confirmPassword) {
    $errors[] = "passMismatch";
}

// validacion email

// Verificar longitud máxima
if (strlen($email) > 254) {
    $errors[] = "longitudEmail";
}

// Separar parte-local y dominio
$parts = explode('@', $email);
if (count($parts) !== 2) {
    $errors[] = "arroba";
} else {
    list($parteLocal, $dominio) = $parts;

    // Verificar longitud de parte-local
    if (strlen($parteLocal) < 1 || strlen($parteLocal) > 64) {
        $errors[] = "longitudParteLocal";
    }

    // Verificar longitud de dominio
    if (strlen($dominio) < 1 || strlen($dominio) > 255) {
        $errors[] = "longitudDominio";
    }

    // Validar formato de parte-local
    $regexParteLocal = '/^[a-zA-Z0-9!#$%&\'*+\-\/=?^_`{|}~](?:\.?[a-zA-Z0-9!#$%&\'*+\-\/=?^_`{|}~])*$/';
    if (!preg_match($regexParteLocal, $parteLocal) || strpos($parteLocal, '..') !== false) {
        $errors[] = "formatoParteLocal";
    }

    // Validar formato de dominio
    $subdominios = explode('.', $dominio);
    foreach ($subdominios as $subdominio) {
        if (strlen($subdominio) < 1 || strlen($subdominio) > 63) {
            $errors[] = "longitudSubdominio";
        }

        if (!preg_match('/^[a-zA-Z0-9]([-a-zA-Z0-9]*[a-zA-Z0-9])?$/', $subdominio)) {
            $errors[] = "formatoSubdominio";
        }
    }
}



// Validación del sexo
if (empty($sex)) {
    $errors[] = "sex";
}

// Validación de la fecha de nacimiento
if (empty($birthdate)) {
    $errors[] = "birthdate";
} elseif (!DateTime::createFromFormat('Y-m-d', $birthdate)) {
    $errors[] = "birthdateInvalid";
} else {
    $birthDate = new DateTime($birthdate);
    $currentDate = new DateTime();
    $age = $currentDate->diff($birthDate)->y;
    if ($age < 18) {
        $errors[] = "birthdateUnderage";
    }
}

// Verificar si hay errores
if (!empty($errors)) {
    // Almacenar errores en la sesión como "flashdata"
    $_SESSION['flashdata_errors'] = $errors;
    header("Location: errorRegister.php");
    exit();
}
else {
    // Guardar la contraseña en la sesión
    $_SESSION['user_password'] = $password;
}


// Conectar a la base de datos
$connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");

if (!$connectionID) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Preparar consulta para insertar usuario
$connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");

if (!$connectionID) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Preparar consulta para insertar usuario
$query = "INSERT INTO Usuarios (NomUsuario, Clave, Email, Sexo, FNacimiento, Ciudad, Pais) 
          VALUES (?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($connectionID, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, "sssissi", $username, $password, $email, $sex, $birthdate, $city, $country);

    if (mysqli_stmt_execute($stmt)) {
        $userId = mysqli_insert_id($connectionID); // Obtener el ID del usuario creado
        $_SESSION['success_message'] = "Usuario registrado exitosamente. ID: $userId";
    } else {
        $_SESSION['flashdata_errors'] = ["Error al registrar el usuario: " . mysqli_error($connectionID)];
        header("Location: errorRegister.php");
        exit();
    }
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['flashdata_errors'] = ["Error al preparar la consulta: " . mysqli_error($connectionID)];
    header("Location: errorRegister.php");
    exit();
}

mysqli_close($connectionID);
$_SESSION['userSession'] = $username;

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
