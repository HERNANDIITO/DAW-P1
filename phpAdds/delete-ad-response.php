<!--
    Archivo: myProfile.php
    Archivo dedicado a los detalles de perfil de un usuario que es uno mismo
    Creado por: Pablo Hernández García el 20/09/2024
    Historial de cambios:
    20/09/2024 - Creado
    01/10/2024 - Desarrollado
    08/10/2024 - CSS Aplicado
-->
<?php
    session_start();

    $cardId     = isset($_POST['id']) ? $_POST['id'] : 0;
    $password   = isset($_POST['pass']) ? $_POST['pass'] : null;
    $userID = $_SESSION["userSession"];


    if ( isset($_COOKIE["rememberedUser"]) ) {
        $userID = $_COOKIE["rememberedUser"];
    }

    $conn = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");

    $query = "SELECT IdUsuario FROM Usuarios WHERE Clave = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows <= 0) {
        header("Location: ../private/delete-Ad.php?error=1&id=".$cardId);
    }

    $usuario = $result->fetch_assoc();

    if ( $usuario['IdUsuario'] == $userID ) {
        $query = "DELETE FROM Anuncios WHERE IdAnuncio = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $cardId);
        $stmt->execute();
        if ( $stmt->affected_rows  > 0 ) {
            header("Location: ../private/myAds.php?msg=1");
        } else {
            header("Location: ../private/myAds.php?msg=2");
        }
    }

    session_commit();

    // Cerrar la sentencia
    $stmt->close();


?>