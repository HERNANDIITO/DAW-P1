
<!-- Página para controlar cuando un usuario se logea, 
 si ese login es correcto o si el usuario no está registrado, y se 
 hacen las operaciones pertinentes con ello -->

<?php
    // Función para verificar si el usuario está autorizado

    // Obtener datos del formulario
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    // cea variable que almacena la fecha en la que se intenta acceder a la cookie de recordado
    $date = 0;

    session_start();
    setcookie('rememberedUser', '', time() - 3600, '/');

    $publicModel = new PublicModel();

    if ($user = $publicModel->isAuthorized($username, $password)) {
        if (isset($_POST['remember']) && isset($_COOKIE["canStoreCookies"])) {
            // Guardar el nombre de usuario y la contraseña en cookies por 90 días
            $expireDate = time() + (90 * 24 * 60 * 60);
            setcookie('rememberedUser', $user['IdUsuario'],  $expireDate, '/', '');
            setcookie('dateCookie',     $date,      $expireDate, '/', '');
        }

        // Usuario autorizado, redirigir a la página privada
        $_SESSION['userSession'] = $user['IdUsuario'];
        header("Location:".urlPRIVATE.urlACTION."myProfile");
        
    } else {
        // Borrar las cookies si no está seleccionada la casilla
        // Usuario no autorizado, redirigir a la página principal con mensaje de error
        $_SESSION['flashdata_error'] = "No se ha podido realizar el login, usuario o contraseña incorrectos";
        header("Location:".urlPUBLIC.urlACTION."index");
    }

    session_commit();
?>
