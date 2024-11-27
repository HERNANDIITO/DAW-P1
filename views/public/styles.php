<!--
    Archivo: login.php
    En este archivo se define el formulario de busqueda avanzada
    Creado por: Pablo Hernández García el 02/11/2024
    Historial de cambios:
    02/11/2024 - Creado
-->

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    $query = "
        SELECT
            E.Nombre,
            E.IdEstilo,
            E.Icono    
        FROM
            estilos as E
    ";

    $connection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
    $sentence = $connection->prepare($query);
    $sentence->execute();
    $result = $sentence->get_result();

    $sentence->close();
    $connection->close();

    $styles = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <link 
        rel="stylesheet"
        media="screen" 
        href="views/styles/<?php include 'views/common/styleSelector.php' ?>/myProfile.css"
        title="<?php include 'views/common/styleSelector.php' ?>"
        id="<?php include 'views/common/styleSelector.php' ?>"
    >
    <script src="views/js/common.js"></script>
    <title><?php echo $data['title']?></title>
</head>
<body>
    <main id="main-content">
        <h2>Selección de estilo</h2>
        <form method="POST" action="../phpAdds/submitStyle.php" id="userMenu">
            <?php foreach ($styles as $style) { ?>
                <button name="style" type="submit" value="<?php echo $style['IdEstilo'] ?>">
                    <i class="fa-solid <?php echo $style['Icono'] ?>"></i>
                    <span><?php echo $style['Nombre'] ?></span>
                </button>
            <?php } ?>
        </form>
    </main>
</body>
</html>