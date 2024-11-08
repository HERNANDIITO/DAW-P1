
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

    // Función para verificar si el usuario está autorizado
    function isAuthorized($username, $password, $authorizedUsers) {
        foreach ($authorizedUsers as $user) {
            if ($user->nombre === $username && $user->contrasena === $password) {
                return true;
            }
        }
        return false;
    }

    // Comprobar si el usuario está autorizado
    if (isAuthorized($username, $password, $authorizedUsers)) {
        // Usuario autorizado, redirigir a la página privada
        header("Location: ../restricted/logged.php");
        exit();
    } else {
        // Usuario no autorizado, redirigir a la página principal con mensaje de error
        header("Location: ../index.php?error=1");
        exit();
    }
?>
