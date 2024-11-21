<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $value = $_POST['style'];

    session_start();
    if ( isset($_SESSION['userSession']) ) {
        $userID = $_SESSION['userSession'];
        
    } elseif ( isset($_COOKIE['rememberedUser']) ) {
        $userID = $_COOKIE['rememberedUser'];
    }
    
    if ( isset($userID) ) {
        $connection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
        $query = "UPDATE Usuarios SET Estilo = ? WHERE IdUsuario = ?";
        $sentence = $connection->prepare($query);
        $sentence->bind_param("ii", $value, $userID);
        if ($sentence->execute()) {
            echo "El estilo del usuario se ha actualizado correctamente.";
        } else {
            echo "Error al actualizar el estilo: " . $sentence->error;
        }
        $sentence->close();
        $connection->close();
    }
    session_commit();
    
    header("Location: ../public/styles.php");

?>