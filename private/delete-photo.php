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
    $photoId = isset($_GET['id']) ? $_GET['id'] : 0;
    $adId = isset($_GET['adId']) ? $_GET['adId'] : 0;
    $error = isset($_GET['error']) ? $_GET['error'] : null;

    if ( $error == 1 ) {
        echo "<script>alert('¡Contraseña equivocada!');</script>";
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        rel="stylesheet"
        media="screen"
        href="../styles/<?php include '../inc/styleSelector.php' ?>/login.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <title>Eliminar anuncio</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <form action="../phpAdds/delete-photo-response.php" method="POST">
            <section class="inputGroup">
                <label for="user">Introduzca su contraseña</label>
                <input type="text" name="pass" placeholder="contrasenyaSecreta" id="user">
                <input type="hidden" name="id" value="<?php echo $photoId ?>">
                <input type="hidden" name="adId" value="<?php echo $adId ?>">
            </section>
            
            <span>
                <input type="submit" value="Eliminar" class="greenButton"></input>
                <a href="./viewAd.php?id=<?php echo $photoId ?>">
                    <button type="button" class="redButton">Cancelar</button>
                </a>
            </span>
        </form>
    </main>
    <?php include "../inc/footer.php"; ?>
</body>
</html>
