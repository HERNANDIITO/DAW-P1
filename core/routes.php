<?php
    
    // obtiene el controlador (public, restricted o private)
    function getController($controller): object {
        $controllerName = ucwords($controller)."Controller";
        $controllerFile = "controllers/".ucwords($controller).".php";

        if ( !is_file($controllerFile) ) {
            $controllerFile = "controllers/".MAIN_CONTROLLER.".php";
        }

        require_once $controllerFile;

        $controller = new $controllerName();

        return $controller;
    }

    // obtiene de momento la pagina del controlador, por ejemplo, controlador: public.php, action: index.php (obtiene la logica del index)
    function getAction($controller, $action) {
        if ( isset($action) && method_exists($controller, $action) ) {
            $controller->$action();
        } else {
            $controller->{MAIN_ACTION}();
        }
    }