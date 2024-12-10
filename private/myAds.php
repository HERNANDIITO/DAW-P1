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

    if ( isset($_COOKIE["rememberedUser"]) ) {
        $userID = $_COOKIE["rememberedUser"];
    } else if( isset($_SESSION['userSession']) ) {
        $userID = $_SESSION["userSession"];
    } else {
        header("");
    }

    $query = "
        SELECT 
            A.IdAnuncio, 
            A.Titulo, 
            A.Precio, 
            A.Ciudad, 
            A.Superficie, 
            A.Nhabitaciones, 
            A.Texto,
            A.Nbanyos, 
            A.Planta, 
            A.Anyo, 
            A.Foto,
            A.FRegistro,
            P.Nombre as NomPais
        FROM 
            Anuncios A
        JOIN 
            Paises P ON A.Pais = P.IdPais
        WHERE 
            A.Usuario = ?
    ";

    $connection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
    $sentence = $connection->prepare($query);
    $sentence->bind_param("i",$userID);
    $sentence->execute();
    $result = $sentence->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    $msg = isset($_GET['msg']) ? $_GET['msg'] : null;

    if ( $msg == 1 ) {
        echo "<script>alert('Anuncio eliminado con éxito');</script>";
    } else if ($msg == 2) {
        echo "<script>alert('Un error ha ocurrido');</script>";
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
        href="../styles/<?php include '../inc/styleSelector.php' ?>/message.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/common.js" media="screen" crossorigin="anonymous"></script>
    <script src="../js/myAds.js" media="screen" crossorigin="anonymous"></script>
    <title>Mis anuncios</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>
    <main id="main-content">
        <h1 class="title">Mis anuncios</h1>

        <section class="content">
            <section class="inMessages">
                <section class="messages">
                
                    <?php foreach ($rows as $row) { ?>
                        <section class="ad message">
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
                                <span><?php echo $row['Ciudad'] ?></span>
                                <span><?php echo $row['NomPais'] ?></span>
                                <span><?php echo $row['Precio'] ?>€</span>
                                <i class="fa-solid fa-circle-info"></i>
                                <span>
                                    <a href="./viewAd.php?id=<?php echo $row['IdAnuncio'] ?>">
                                        <button class="greenButton">Ver</button>
                                    </a>
                                    <a href="./delete-ad.php?id=<?php echo $row['IdAnuncio'] ?>">
                                        <button class="redButton">Eliminar</button>
                                    </a>
                                </span>
                            </section>
                        </section>
                    <?php } ?>
                </section>
            </section>
            
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>
    <?php
        session_commit();
        $sentence->close();
        $connection->close();
    ?>

</body>
</html>