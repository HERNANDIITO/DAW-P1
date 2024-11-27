<?php

    session_start();

    if ( isset($_SESSION['userSession']) ) {
        $userID = $_SESSION['userSession'];
        
    } elseif ( isset($_COOKIE['rememberedUser']) ) {
        $userID = $_COOKIE['rememberedUser'];
    }

    if ( isset($userID) ) {
        
        $query = "
            SELECT 
                E.Nombre AS EstiloNombre,
                E.Fichero
            FROM 
                Usuarios U
            JOIN 
                Estilos E ON U.Estilo = E.IdEstilo
            WHERE 
                U.IdUsuario = ?
        ";

        $connection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
        $sentence = $connection->prepare($query);
        $sentence->bind_param("i",$userID);
        $sentence->execute();
        $result = $sentence->get_result();
        $style = $result->fetch_assoc();

        echo $style['Fichero'];

    } else {
        echo 'default';
    }

    session_commit();


?>
