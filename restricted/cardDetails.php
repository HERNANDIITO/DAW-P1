<?php
// Obtener el ID de la carta desde la URL
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$cardId = isset($_GET['id']) ? intval($_GET['id']) : 0;
session_start();
    $_SESSION['AdId'] = $cardId;
session_commit();

$connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");

if (!$connectionID) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Consulta SQL para obtener datos generales del anuncio
$query = "
    SELECT 
        A.IdAnuncio, 
        A.Titulo, 
        A.Foto, 
        A.Precio, 
        A.Texto, 
        A.Ciudad, 
        A.Pais, 
        A.Superficie, 
        A.Nhabitaciones, 
        A.Nbanyos, 
        A.Planta, 
        A.Anyo, 
        A.FRegistro, 
        A.Usuario, 
        TA.NomTAnuncio, 
        TV.NomTVivienda, 
        U.NomUsuario
    FROM 
        Anuncios A
    JOIN 
        TiposAnuncios TA ON A.TAnuncio = TA.IdTAnuncio
    JOIN 
        TiposViviendas TV ON A.TVivienda = TV.IdTVivienda
    JOIN 
        Usuarios U ON A.Usuario = U.IdUsuario
    WHERE 
        A.IdAnuncio = ?
";

$stmt = $connectionID->prepare($query);
$stmt->bind_param("i", $cardId);
$stmt->execute();
$result = $stmt->get_result();
$card = $result->fetch_assoc();
$stmt->close();

if (!$card) {
    echo "<p>No se encontró el anuncio solicitado.</p>";
    mysqli_close($connectionID);
    exit;
}

// Consulta SQL para obtener fotos adicionales del anuncio
$photosQuery = "
    SELECT 
        F.IdFoto, 
        F.Titulo, 
        F.Fichero, 
        F.Alternativo, 
        F.Anuncio
    FROM 
        Fotos F
    WHERE 
        F.Anuncio = ?
";

$photosStmt = $connectionID->prepare($photosQuery);
$photosStmt->bind_param("i", $cardId);
$photosStmt->execute();
$photosResult = $photosStmt->get_result();
$photosStmt->close();

mysqli_close($connectionID);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" media="screen" href="../styles/<?php include '../inc/styleSelector.php' ?>/cardDetails.css">
    <title>Detalles de anuncio</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>
    <main id="main-content">
        <section class="card-photo-big">
            <img src="../assets/img/houses/<?php echo htmlspecialchars($card['Foto']); ?>" alt="Foto del anuncio">
        </section>
        <h1><?php echo htmlspecialchars($card['Titulo']); ?></h1>
        <h2>Características</h2>
        <section class="info-wrapper">
            <section class="info">
                <p><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($card['Ciudad']); ?></p>
                <p><i class="fa-solid fa-tag"></i> <?php echo htmlspecialchars($card['Precio']); ?>€</p>
                <a href="profile.php?idUsuario=<?= htmlspecialchars($card['Usuario']); ?>">
                    <p><i class="fa-solid fa-user"></i> <?= htmlspecialchars($card['NomUsuario']); ?></p>
                </a>
                <p><i class="fa-solid fa-calendar-days"></i> <?php echo htmlspecialchars($card['FRegistro']); ?></p>
            </section>
            <section class="info">
                <p><i class="fa-solid fa-expand"></i> <?php echo htmlspecialchars($card['Superficie']); ?> m²</p>
                <p><i class="fa-solid fa-toilet"></i> <?php echo htmlspecialchars($card['Nbanyos']); ?></p>
                <p><i class="fa-solid fa-bed"></i> <?php echo htmlspecialchars($card['Nhabitaciones']); ?></p>
            </section>
        </section>
        <section class="buttonWrapper">
            <a href="./sendMessage.php"><button class="greenButton">Solicitar cita</button></a>
            <a href="./sendMessage.php"><button class="greenButton">Hacer oferta</button></a>
        </section>
        <h2>Descripción</h2>
        <p class="desc"><?php echo htmlspecialchars($card['Texto']); ?></p>

        <h2>Fotos adicionales</h2>
        <div class="miniaturas">
            <?php while ($photo = $photosResult->fetch_assoc()) { ?>
                <img class="aditional-img" src="../assets/img/ads/<?php echo htmlspecialchars($photo['Anuncio']); ?>/<?php echo htmlspecialchars($photo['Fichero']); ?>" 
                     alt="<?php echo htmlspecialchars($photo['Alternativo']); ?>" class="miniatura">
            <?php } ?>
        </div>
    </main>
    <?php include "../inc/footer.php"; ?>
</body>
</html>
