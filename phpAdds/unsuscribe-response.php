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

    $conn = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");

    
    session_start();
    
    $userID = $_SESSION["userSession"];

    if ( isset($_COOKIE["rememberedUser"]) ) {
        $userID = $_COOKIE["rememberedUser"];
    }

    session_commit();

    // Iniciar transacción
    $conn->begin_transaction();

    try {
        // Eliminar el usuario
        $stmt = $conn->prepare("SELECT Foto FROM usuarios WHERE IdUsuario = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        $usuario = $result->fetch_assoc();

        $stmt = $conn->prepare("DELETE FROM usuarios WHERE IdUsuario = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        echo "Fotos eliminadas: " . $stmt->affected_rows . "\n";
        
        if (file_exists($usuario["Foto"])) {
            if ( $usuario["Foto"] != "../assets/img/pfps/default.png" ) {
                unlink($usuario["Foto"]);
            } 
        }
        
        // Confirmar la transacción
        $conn->commit();

        setcookie("rememberedUser", "", time() - 3600, "/");
        unset($_SESSION['userSession']);
        unset($_COOKIE["rememberedUser"]);
        
        session_start();
        session_unset();
        session_destroy();

        echo "El usuario y todos sus anuncios y fotos han sido eliminados.";
    } catch (Exception $e) {
        // En caso de error, hacer rollback
        $conn->rollback();
        echo "Error al eliminar el usuario: " . $e->getMessage();
    }

    // Cerrar la conexión
    $conn->close();
    header('Location: ../index.php')

?>