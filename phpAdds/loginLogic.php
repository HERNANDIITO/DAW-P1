
<!-- Página para controlar cuando un usuario se logea, 
 si ese login es correcto o si el usuario no está registrado, y se 
 hacen las operaciones pertinentes con ello -->

<?php
    // Definir la clase Usuario
    class Usuario {
        public $nombre;
        public $contrasena;

        public function __construct($nombre, $contrasena) {
            $this->nombre = $nombre;
            $this->contrasena = $contrasena;
        }
    }

    // Crear instancias de la clase Usuario para los usuarios permitidos
    $usuario1 = new Usuario("david", "12345678");
    $usuario2 = new Usuario("pablo", "12345678");
    $usuario3 = new Usuario("usuario3", "contrasena3");
    $usuario4 = new Usuario("usuario4", "contrasena4");

    // Arreglo de usuarios autorizados
    $authorizedUsers = [$usuario1, $usuario2, $usuario3, $usuario4];

    // Obtener datos del formulario
    $username = isset($_POST['user']) ? $_POST['user'] : '';
    $password = isset($_POST['pass']) ? $_POST['pass'] : '';
    // cea variable que almacena la fecha en la que se intenta acceder a la cookie de recordado
    $date = 0;

    // Función para verificar si el usuario está autorizado
    function isAuthorized($username, $password, $authorizedUsers) {
        foreach ($authorizedUsers as $user) {
            if ($user->nombre === $username && $user->contrasena === $password) {
                return true;
            }
        }
        return false;
    }

    // funcion para recordar al usuario (guardarlo en las cookies)
    if (isset($_POST['remember'])) {
        // Comprobar si el usuario está autorizado
        if (isAuthorized($username, $password, $authorizedUsers)) {
            // Usuario autorizado, redirigir a la página privada
            session_start();
            $_SESSION['userSession'] = $username;
            // Guardar el nombre de usuario y la contraseña en cookies por 90 días
            setcookie('rememberedUser', $username, $date, time() + (90 * 24 * 60 * 60), '/');
            
            header("Location: ../private/myProfile.php");
            exit();
        } else {
            // Borrar las cookies si no está seleccionada la casilla
            setcookie('rememberedUser', '', time() - 3600, '/');
            // Usuario no autorizado, redirigir a la página principal con mensaje de error
            header("Location: ../index.php?error=1");
            exit();
        }
        
    }
    
    // esto para enviar el usuario a su perfil si no marca la casilla de de recordarle
    header("Location: ../private/myProfile.php");

    

?>
