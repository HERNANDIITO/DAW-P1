<?php
    $cardId = isset($_GET['id']) ? $_GET['id'] : 0;

    // Conexiones
    $generalConnection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
    $photosConnection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
    $messageConnection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");

    // Consulta general
    $generalQuery = "
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
            A.Alternativo,
            A.FRegistro, 
            TA.NomTAnuncio, 
            TV.NomTVivienda, 
            U.NomUsuario,
            P.Nombre as NomPais
        FROM
            Anuncios A
        JOIN
            TiposAnuncios TA ON A.TAnuncio = TA.IdTAnuncio
        JOIN
            Paises P ON A.Pais = P.IdPais
        JOIN 
            TiposViviendas TV ON A.TVivienda = TV.IdTVivienda 
        JOIN 
            Usuarios U ON A.Usuario = U.IdUsuario WHERE A.IdAnuncio = ?
    ";

    // Consulta fotos
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

    // Consulta mensajes
    $messageQuery = "
        SELECT 
            M.IdMensaje, 
            M.Texto, 
            M.FRegistro, 
            TM.NomTMensaje, 
            U.NomUsuario AS UsuarioOrigen
        FROM 
            Mensajes M
        JOIN 
            TiposMensajes TM ON M.TMensaje = TM.IdTMensaje
        JOIN 
            Usuarios U ON M.UsuarioOrigen = U.IdUsuario
        WHERE 
            M.Anuncio = ?
    ";

    // Ejecutar consulta general
    $generalSentence = $generalConnection->prepare($generalQuery);
    $generalSentence->bind_param("i", $cardId);
    $generalSentence->execute();
    $generalResult = $generalSentence->get_result();
    $card = $generalResult->fetch_assoc();

    // Ejecutar consulta fotos
    $photosSentence = $photosConnection->prepare($photosQuery);
    $photosSentence->bind_param("i", $cardId);
    $photosSentence->execute();
    $photosResult = $photosSentence->get_result();

    // Ejecutar consulta mensajes
    $messageSentence = $messageConnection->prepare($messageQuery);
    $messageSentence->bind_param("i", $cardId);
    $messageSentence->execute();
    $messageResult = $messageSentence->get_result();

    // Cerrar conexiones
    $generalConnection->close();
    $photosConnection->close();
    $messageConnection->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/brochureResponse.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <title>Detalle del Anuncio</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main>
        <form action="../private/modifyResponse.php" method="POST">

            <section class="anuncioDetalle">
                <!-- Información general del anuncio -->
                <section class="inputGroup">
                    <label>Tipo de anuncio:</label>
                    <span><?php echo $card['NomTAnuncio']; ?></span>
                </section>
                <section class="inputGroup">
                    <label>Tipo de vivienda:</label>
                    <span><?php echo $card['NomTVivienda']; ?></span>
                </section>
                <section class="inputGroup">
                    <label>Foto principal:</label>
                    <img src="../assets/img/houses/<?php echo $card['Foto']; ?>" alt="<?php echo $card['Alternativo']; ?>">
                </section>
                <section class="inputGroup">
                    <label>Título:</label>
                    <span><?php echo $card['Titulo']; ?></span>
                </section>
                <section class="inputGroup">
                    <label>Precio:</label>
                    <span><?php echo $card['Precio']; ?> €</span>
                </section>
                <section class="inputGroup">
                    <label>Descripción:</label>
                    <span><?php echo $card['Texto']; ?></span>
                </section>
                <section class="inputGroup">
                    <label>Fecha de publicación:</label>
                    <span><?php echo $card['FRegistro']; ?></span>
                </section>
                <section class="inputGroup">
                    <label>Ciudad:</label>
                    <span><?php echo $card['Ciudad']; ?></span>
                </section>
                <section class="inputGroup">
                    <label>País:</label>
                    <span><?php echo $card['NomPais']; ?></span>
                </section>

                <!-- Miniaturas de fotos adicionales -->
                <section class="inputGroup">
                    <label>Fotos adicionales:</label>
                    <div class="miniaturas">
                        <?php while ($photo = $photosResult->fetch_assoc()) { ?>
                            <img class="aditional-img" src="../assets/img/ads/<?php echo $photo['Anuncio'] ?>/<?php echo $photo['Fichero'] ?>" alt="<?php echo $photo['Alternativo']; ?>" class="miniatura">
                        <?php } ?>
                    </div>
                </section>

                <!-- Mensajes del anuncio -->
                <fieldset>
                    <legend>Mensajes:</legend>
                    <?php if ($messageResult->num_rows > 0): ?>
                        <?php while ($message = $messageResult->fetch_assoc()): ?>
                            <section class="inputGroup">
                                <label><?php echo $message['NomTMensaje']; ?> de <?php echo $message['UsuarioOrigen']; ?>:</label>
                                <span><?php echo $message['Texto']; ?></span>
                                <span>Fecha: <?php echo $message['FRegistro']; ?></span>
                            </section>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p>No hay mensajes disponibles para este anuncio.</p>
                    <?php endif; ?>
                </fieldset>
                <button class="greenButton" id="submitAdButton">Confirmar</button>
            </section>
        </form>
    </main>

    <?php include "../inc/footer.php"; ?>
</body>
</html>
