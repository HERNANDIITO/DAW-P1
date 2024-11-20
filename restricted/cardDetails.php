<!--
    Archivo: cardDetails.php
    En este archivo se mostraran los detalles del anuncio que quiera ver el usuario
    Creado por: David González Moreno el 26/09/2024
    Historial de cambios:
    26/09/2024 - Creado
    26/09/2024 - Layout desarrollado
    28/09/2024 - Correciones del profesor
    08/10/2024 - CSS Aplicado
-->

<?php
    // Obtener el ID de la carta desde la URL
    $cardId = isset($_GET['id']) ? $_GET['id'] : 0;

    $connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");

    $query = "SELECT  A.IdAnuncio, A.Titulo, A.Foto, A.Precio, A.Texto, A.Ciudad, A.Pais, A.Superficie, A.Nhabitaciones, A.Nbanyos, A.Planta, A.Anyo, A.FRegistro, TA.NomTAnuncio, TV.NomTVivienda, U.NomUsuario FROM Anuncios A JOIN TiposAnuncios TA ON A.TAnuncio = TA.IdTAnuncio JOIN TiposViviendas TV ON A.TVivienda = TV.IdTVivienda JOIN Usuarios U ON A.Usuario = U.IdUsuario WHERE A.IdAnuncio = $cardId";

    $result = mysqli_query($connectionID, $query);
    $card = $result->fetch_assoc();

    mysqli_close($connectionID);

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/cardDetails.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
        <title>Detalles de anuncio</title>
</head>

<body>
        
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <section class="card-photo-big">
            <img src="../assets/img/houses/<?php echo $card['Foto']; ?>">
        </section>

        <h1><?php echo $card['Titulo']; ?></h1>

        <h2>Características</h2>

        <section class="info-wrapper">
            <section class="info">
                <p><i class="fa-solid fa-location-dot"></i> <?php echo $card['Ciudad']; ?></p>
                <p><i class="fa-solid fa-tag"></i> <?php echo $card['Precio']; ?>€</p>
                <a href="profile.php">
                    <p><i class="fa-solid fa-user"></i> <?php echo $card['NomUsuario']; ?></p>
                </a>
                <p><i class="fa-solid fa-calendar-days"></i> <?php echo $card['FRegistro']; ?></p>
            </section>

            <section class="info">
                <p><i class="fa-solid fa-expand"></i> <?php echo $card['Superficie']; ?></p>
                <p><i class="fa-solid fa-toilet"></i> <?php echo $card['Nbanyos']; ?></p>
                <p><i class="fa-solid fa-bed"></i> <?php echo $card['Nhabitaciones']; ?></p>
                <p><i class="fa-solid fa-suitcase"></i> <?php echo $card['Precio']; ?></p>
            </section>
        </section>

        <section class="buttonWrapper">
            <button class="greenButton">Mas información</button>
            <a href="sendMessage.php"><button class="greenButton" type="button">Solicitar cita</button></a>   
            <a href="sendMessage.php"><button class="greenButton" type="button">Hacer oferta</button></a>               
        </section>

        <h2>Descripción</h2>

        <p class="desc">
            <?php echo $card['Texto']; ?>
        </p>

        <section class="houses"></section>
    </main>

    <?php include "../inc/footer.php"; ?>

</body>

<script>
    changeStyle()
</script>
</html>