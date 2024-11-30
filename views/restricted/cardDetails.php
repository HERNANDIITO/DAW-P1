<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" media="screen" href="views/styles/<?php include 'views/common/styleSelector.php' ?>/cardDetails.css">
    <title><?php echo $data['title'] ?></title>
</head>
<body>
    <main id="main-content">
        <section class="card-photo-big">
            <img src="../assets/img/houses/<?php echo htmlspecialchars($data['card']['Foto']); ?>" alt="Foto del anuncio">
        </section>
        <h1><?php echo htmlspecialchars($data['card']['Titulo']); ?></h1>
        <h2>Características</h2>
        <section class="info-wrapper">
            <section class="info">
                <p><i class="fa-solid fa-location-dot"></i> <?php echo htmlspecialchars($data['card']['Ciudad']); ?></p>
                <p><i class="fa-solid fa-tag"></i> <?php echo htmlspecialchars($data['card']['Precio']); ?>€</p>
                <a href="profile.php?idUsuario=<?= htmlspecialchars($data['card']['Usuario']); ?>">
                    <p><i class="fa-solid fa-user"></i> <?= htmlspecialchars($data['card']['NomUsuario']); ?></p>
                </a>
                <p><i class="fa-solid fa-calendar-days"></i> <?php echo htmlspecialchars($data['card']['FRegistro']); ?></p>
            </section>
            <section class="info">
                <p><i class="fa-solid fa-expand"></i> <?php echo htmlspecialchars($data['card']['Superficie']); ?> m²</p>
                <p><i class="fa-solid fa-toilet"></i> <?php echo htmlspecialchars($data['card']['Nbanyos']); ?></p>
                <p><i class="fa-solid fa-bed"></i> <?php echo htmlspecialchars($data['card']['Nhabitaciones']); ?></p>
            </section>
        </section>
        <section class="buttonWrapper">
            <a href="./sendMessage.php"><button class="greenButton">Solicitar cita</button></a>
            <a href="./sendMessage.php"><button class="greenButton">Hacer oferta</button></a>
        </section>
        <h2>Descripción</h2>
        <p class="desc"><?php echo htmlspecialchars($data['card']['Texto']); ?></p>

        <h2>Fotos adicionales</h2>
        <div class="miniaturas">
            <?php foreach ( $data['photos'] as $photo ) { ?>
                <img class="aditional-img" src="../assets/img/ads/<?php echo htmlspecialchars($photo['Anuncio']); ?>/<?php echo htmlspecialchars($photo['Fichero']); ?>" 
                     alt="<?php echo htmlspecialchars($photo['Alternativo']); ?>" class="miniatura">
            <?php } ?>
        </div>
    </main>
</body>
</html>
