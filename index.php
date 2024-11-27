<?php

    require_once "config/database.php";
    require_once "config/config.php";
    require_once "core/routes.php";
    require_once "controllers/public.php";

    require_once "views/common/header.php";

    $controllerName = $_GET["c"] ?? "public";
    $actionName     = $_GET["a"] ?? "index";

    $controller = getController( $controllerName );
    getAction($controller, $actionName);

    require_once "views/common/footer.php";

?>