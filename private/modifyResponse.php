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
$deletePhoto = $_POST['deletePhoto'];
$currentPfp = $_POST['currentPfp'];

// Convertir sexo a un valor numérico
if ($sex === "hombre") {
    $sex = 1;
} elseif ($sex === "mujer") {
    $sex = 2;
} else {
    $sex = null; // Sexo no especificado
}

// Validaciones de PHP
$errors = [];

// Validación del nombre de usuario
if (!empty($username) && !preg_match('/^[a-zA-Z][a-zA-Z0-9]{2,14}$/', $username)) {
    $errors[] = "userInvalid";
}

// Validación de la contraseña
if (!empty($password) && !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d_-]{6,15}$/', $password)) {
    $errors[] = "passInvalid";
}

// Validación de repetir contraseña
if (!empty($password) && $password !== $confirmPassword) {
    $errors[] = "passMismatch";
}

// Validación del email (solo si se proporcionó uno nuevo)
if (!empty($email)) {
    if (strlen($email) > 254) {
        $errors[] = "longitudEmail";
    } else {
        $parts = explode('@', $email);
        if (count($parts) !== 2) {
            $errors[] = "arroba";
        } else {
            list($parteLocal, $dominio) = $parts;
            if (strlen($parteLocal) < 1 || strlen($parteLocal) > 64 || strpos($parteLocal, '..') !== false) {
                $errors[] = "formatoParteLocal";
            }
            if (!preg_match('/^[a-zA-Z0-9.-]+$/', $dominio)) {
                $errors[] = "formatoDominio";
            }
        }
    }
}

// Validación de la fecha de nacimiento
if (!empty($birthdate) && !DateTime::createFromFormat('Y-m-d', $birthdate)) {
    $errors[] = "birthdateInvalid";
}

// Verificar si hay errores (excepto para country vacío)
if (!empty($errors)) {
    $_SESSION['flashdata_errors'] = $errors;
    header("Location: errorModifying.php");
    exit();
}

// Conectar a la base de datos
$connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");

if (!$connectionID) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Obtener el ID del usuario desde la sesión
$userId = $_SESSION['userSession'];

// Construir consulta dinámica para actualizar solo los campos proporcionados
$updates = [];
$params = [];
$types = "";

if (!empty($username)) {
    $updates[] = "NomUsuario = ?";
    $params[] = $username;
    $types .= "s";
}
if (!empty($password)) {
    $updates[] = "Clave = ?";
    $params[] = $password;
    $types .= "s";
}
if (!empty($email)) {
    $updates[] = "Email = ?";
    $params[] = $email;
    $types .= "s";
}
if (!empty($sex)) {
    $updates[] = "Sexo = ?";
    $params[] = $sex;
    $types .= "i";
}
if (!empty($birthdate)) {
    $updates[] = "FNacimiento = ?";
    $params[] = $birthdate;
    $types .= "s";
}
if (!empty($city)) {
    $updates[] = "Ciudad = ?";
    $params[] = $city;
    $types .= "s";
}

if (!empty($country) && $country !== "Selecciona tu país") {
    $updates[] = "Pais = ?";
    $params[] = $country;
    $types .= "s";
}

$subida = "../assets/img/pfps/";

if ( isset($_FILES["pfp"]) ) {
    $subida .= $_FILES["pfp"]["name"] . time();

    move_uploaded_file(
        $_FILES["pfp"]["tmp_name"],                 // en vez de "pfp" deberia de ir el nombre del input en la subida
        $subida   // ruta en la que se sube
    );

    $updates[] = "Foto = ?";
    $params[] = $subida;
    $types .= "s";

    if (!empty($currentPfp) && file_exists($currentPfp)) {
        unlink($currentPfp);
    }
}

if ( isset($deletePhoto) ) {
    $subida = "../assets/img/pfps/default.png";

    $updates[] = "Foto = ?";
    $params[] = $subida;
    $types .= "s";

    if (!empty($currentPfp) && file_exists($currentPfp)) {
        unlink($currentPfp);
    }
}

if (empty($updates)) {
    $_SESSION['flashdata_errors'] = ["No se proporcionaron datos para actualizar"];
    header("Location: errorModifying.php");
    exit();
}

$query = "UPDATE Usuarios SET " . implode(", ", $updates) . " WHERE IdUsuario = ?";
$params[] = $userId;
$types .= "i";

$stmt = mysqli_prepare($connectionID, $query);

if ($stmt) {
    mysqli_stmt_bind_param($stmt, $types, ...$params);
    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['success_message'] = "Usuario actualizado exitosamente.";
    } else {
        $_SESSION['flashdata_errors'] = ["Error al actualizar el usuario: " . mysqli_error($connectionID)];
        header("Location: errorModifying.php");
        exit();
    }
    mysqli_stmt_close($stmt);
} else {
    $_SESSION['flashdata_errors'] = ["Error al preparar la consulta: " . mysqli_error($connectionID)];
    header("Location: errorModifying.php");
    exit();
}

mysqli_close($connectionID);
header("Location: myProfile.php");
exit();
?>
