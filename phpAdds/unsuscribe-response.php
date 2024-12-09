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
        // Eliminar las fotos asociadas a los anuncios del usuario
        $stmt = $conn->prepare("
            DELETE f FROM fotos f
            JOIN anuncios a ON f.Anuncio = a.IdAnuncio
            WHERE a.Usuario = ?
        ");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        echo "Fotos eliminadas: " . $stmt->affected_rows . "\n";

        // Eliminar los mensajes del usuario
        $stmt = $conn->prepare("DELETE FROM mensajes WHERE UsuarioOrigen = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        echo "Mensajes enviados eliminadas: " . $stmt->affected_rows . "\n";

        $stmt = $conn->prepare("DELETE FROM mensajes WHERE UsuarioDestino = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        echo "Mensajes recibidos eliminadas: " . $stmt->affected_rows . "\n";
        
        // Eliminar los anuncios del usuario
        $stmt = $conn->prepare("DELETE FROM anuncios WHERE Usuario = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        echo "Anuncios eliminados: " . $stmt->affected_rows . "\n";

        // Eliminar el usuario
        $stmt = $conn->prepare("DELETE FROM usuarios WHERE IdUsuario = ?");
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        echo "Fotos eliminadas: " . $stmt->affected_rows . "\n";
        
        // Confirmar la transacción
        $conn->commit();

        setcookie("rememberedUser", "", time() - 3600, "/");
        unset($_SESSION['userSession']);

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