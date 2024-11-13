<?php

    function checkCookies() {
        // Comprobamos si el usuario quiere que guardemos cookies
        if ( !isset($_COOKIE['canStoreCookies'])) {
            include "../common/cookie-modal.html";
            return;
        }

        if ($_COOKIE['canStoreCookies'] == "false") {
            return;
        }

        // Comprobamos si el usuario tiene alguna cuenta guardada
        if ( !isset($_COOKIE["user"]) ) {

        }

        // Comprobamos si el usuario tiene algun estilo guardado
        if ( !isset($_COOKIE["style"]) ) {
        
        }
    }
?>