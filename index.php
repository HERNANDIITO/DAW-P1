<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once "config/database.php";
    require_once "config/config.php";

    require_once "core/routes.php";

    require_once "views/common/header.php";

    $controllerName = $_GET["c"] ?? "public";
    $actionName     = $_GET["a"] ?? "index";

    $controller = getController( $controllerName );
    getAction($controller, $actionName);
    
    require_once "views/common/footer.php";
    
?>