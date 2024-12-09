<?php

    session_start();

    // Estamos en el index
    if ($_SERVER['REQUEST_URI'] == "/" || $_SERVER['REQUEST_URI'] == "/index.php") {
        if (isset($_COOKIE['rememberedUser']) && isset($_COOKIE['dateCookie'])) {
            // Recuperar los valores de las cookies
            $username = $_COOKIE['rememberedUser'];
            $date = $_COOKIE['dateCookie'];
    
            // Mostrar el mensaje con los valores de las cookies
            $_SESSION["welcomeMessage"] = "Bienvenido de nuevo, $username. Su última visita registrada fue: " . date('m/d/Y, h:i', timestamp: 1299446702);;

            // Resetea la cookie cambiando la fecha (despues de mostrarla) con la fecha actual para que, la proxima vez que inicies sesion, se vea cuando fue la ultima vez que entraste
            $date = time();
            $expireDate = time() + (90 * 24 * 60 * 60);
            setcookie('dateCookie', $date, $expireDate, '/', '');
        }
    }

    if ( str_contains($_SERVER['REQUEST_URI'], "restricted") || str_contains($_SERVER['REQUEST_URI'], "private") ) {
        if ( !isset($_COOKIE['rememberedUser']) && !isset($_SESSION["userSession"]) ) {
            header("Location: ../index.php");
        }
    }

    if ( str_contains($_SERVER['REQUEST_URI'], "cardDetails") ) {
        $id = $_GET['id'];
        $currentHistory = isset($_SESSION["history"]) ? $_SESSION["history"] : [];

        if ( !in_array( $id, $currentHistory ) ) {

            if ( count( $currentHistory ) >= 4) { array_shift($currentHistory); }

            array_push($currentHistory, $id);
            $_SESSION['history'] = $currentHistory;
        }
    }

    session_commit();
    
?>