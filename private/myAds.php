<!--
    Archivo: myAds.php
    Archivo dedicado a los mensajes que recibe un usuario que es uno mismo
    Creado por: David González Moreno el 08/11/2024
    Historial de cambios:
    02/10/2024 - Creado
    08/10/2024 - CSS Aplicado
-->

<?php
    // Obtener el ID de la carta desde la URL
    if ( !isset($_SESSION['userSession']) ) {
        header('');
    }

    session_start();
    $connection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
    $query = "SELECT  A.IdAnuncio, A.Titulo, A.Precio, A.Texto, A.Ciudad, P.Nombre AS Pais, TA.NomTAnuncio AS TipoAnuncio, TV.NomTVivienda AS TipoVivienda, A.Superficie, A.Nhabitaciones, A.Nbanyos, A.Planta, A.Anyo, A.FRegistro FROM  Anuncios A JOIN  Paises P ON A.Pais = P.IdPais JOIN  TiposAnuncios TA ON A.TAnuncio = TA.IdTAnuncio JOIN  TiposViviendas TV ON A.TVivienda = TV.IdTVivienda WHERE  A.Usuario = ?";

    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $_SESSION['userSession']);
    $stmt->execute();
    $result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        rel="stylesheet"
        media="screen"
        href="../styles/<?php include '../inc/styleSelector.php' ?>/message.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/common.js" media="screen" crossorigin="anonymous"></script>
    <script src="../js/myAds.js" media="screen" crossorigin="anonymous"></script>
    <title>Mis mensajes</title>
</head>
<body>
<?php include "../inc/header.php"; ?>
    <main id="main-content">
        <h1 class="title">Mis anuncios</h1>

        <section class="content">
            <section class="inMessages">
                <section class="messages">

                <?php while ( $row = $result->fetch_assoc() ) { ?>
                    <section class="message">

                        <section class="card-photo-mini">
                            <img src="../assets/img/houses/<?php echo $row['Foto'] ?>">
                        </section>
                        <section >
                            <h2><?php echo $row['Titulo'] ?></h2>
                        </section>
                        <section class="messageContent">
                            <p><?php echo $row['Texto'] ?></p>
                        </section>
                        <hr class="solid">
                        <section class="messageInfo">
                            <span><?php echo $row['Ciudad'] ?></span> <span><?php echo $row['NombrePais'] ?></span> <span><?php echo $row['Precio'] ?>€</span><i class="fa-solid fa-circle-info"></i> <span><a href="./viewAd.php?id=<?php echo $row['IdAnuncio'] ?>"><button class="greenButton">Ver</button></a></span>
                        </section>

                    </section>
                <?php } ?>
                </section>
            </section>
            
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>
    <?php
        $stmt->close();
        $connection->close();
        session_commit();
    ?>

</body>
</html>