<?php
session_start();

// Recuperar los errores desde la sesión
$errors = isset($_SESSION['flashdata_errors']) ? $_SESSION['flashdata_errors'] : [];
// Limpiar los errores de la sesión
unset($_SESSION['flashdata_errors']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Errores en el Registro</title>
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/errorRegister.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
</head>
<body>
    <?php include "../inc/header.php"; ?>
    <main>
        <h1>Errores en el Registro</h1>
        <section class="errorList">
            <?php if (empty($errors)): ?>
                <p>No se encontraron errores. Por favor, intenta nuevamente.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li>
                            <?php
                            switch ($error) {
                                case "user":
                                    echo "El nombre de usuario es obligatorio.";
                                    break;
                                case "userInvalid":
                                    echo "El nombre de usuario debe comenzar con una letra y tener entre 3 y 15 caracteres alfanuméricos.";
                                    break;
                                case "pass":
                                    echo "La contraseña es obligatoria.";
                                    break;
                                case "passInvalid":
                                    echo "La contraseña debe tener entre 6 y 15 caracteres, incluir al menos una letra mayúscula, una minúscula y un número.";
                                    break;
                                case "passConfirm":
                                    echo "Por favor, confirma tu contraseña.";
                                    break;
                                case "passMismatch":
                                    echo "Las contraseñas no coinciden.";
                                    break;
                                case "arroba":
                                    echo "El correo electrónico debe contener un @";
                                    break;
                                case "longitudParteLocal":
                                    echo "La parte local tiene una longitud inapropiada.";
                                    break;
                                case "longitudDominio":
                                    echo "El dominio tiene una longitud inapropiada";
                                    break;
                                case "formatoParteLocal":
                                    echo "La parte local del email no tiene un formato correcto.";
                                    break;
                                case "longitudSubdominio":
                                    echo "El subdominio se encuentra en una longitud incorrecta.";
                                    break;
                                case "formatoSubdominio":
                                    echo "El subdominio se encuentra en un formato incorrecto.";
                                    break;
                                case "longitudEmail":
                                    echo "El email es demasiado largo.";
                                    break;
                                case "sex":
                                    echo "El campo de sexo es obligatorio.";
                                    break;
                                case "birthdate":
                                    echo "La fecha de nacimiento es obligatoria.";
                                    break;
                                case "birthdateInvalid":
                                    echo "El formato de la fecha de nacimiento es incorrecto. Usa AAAA-MM-DD.";
                                    break;
                                case "birthdateUnderage":
                                    echo "Debes ser mayor de 18 años para registrarte.";
                                    break;
                                default:
                                    echo "Error desconocido.";
                                    break;
                            }
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
        <a href="register.php" class="redButton">Volver al formulario</a>
    </main>
    <?php include "../inc/footer.php"; ?>
</body>
</html>
