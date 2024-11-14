<!-- Archivo: anuncioDetalle.html -->
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
        <section class="anuncioDetalle">
            <!-- Tipo de anuncio -->
            <section class="inputGroup">
                <label>Tipo de anuncio:</label>
                <span>Venta</span>
            </section>

            <!-- Tipo de vivienda -->
            <section class="inputGroup">
                <label>Tipo de vivienda:</label>
                <span>Piso</span>
            </section>

            <!-- Foto principal -->
            <section class="inputGroup">
                <label>Foto principal:</label>
                <img src="../assets/img/houses/house1.png" alt="Foto principal del anuncio">
            </section>

            <!-- Título del anuncio -->
            <section class="inputGroup">
                <label>Título:</label>
                <span>Amplio y luminoso piso en el centro</span>
            </section>

            <!-- Precio -->
            <section class="inputGroup">
                <label>Precio:</label>
                <span>200,000 €</span>
            </section>

            <!-- Descripción del anuncio -->
            <section class="inputGroup">
                <label>Descripción:</label>
                <span>Piso reformado, cerca de servicios, ideal para familias o inversión.</span>
            </section>

            <!-- Fecha de publicación -->
            <section class="inputGroup">
                <label>Fecha de publicación:</label>
                <span>01/11/2024</span>
            </section>

            <!-- Ubicación: Ciudad y País -->
            <section class="inputGroup">
                <label>Ciudad:</label>
                <span>Madrid</span>
            </section>
            <section class="inputGroup">
                <label>País:</label>
                <span>España</span>
            </section>

            <!-- Características del inmueble -->
            <fieldset>
                <legend>Características:</legend>
                <section class="inputGroup">
                    <label>Superficie:</label>
                    <span>120 m²</span>
                </section>

                <section class="inputGroup">
                    <label>Habitaciones:</label>
                    <span>3</span>
                </section>

                <section class="inputGroup">
                    <label>Baños:</label>
                    <span>2</span>
                </section>

                <section class="inputGroup">
                    <label>Garaje:</label>
                    <span>Sí</span>
                </section>

                <section class="inputGroup">
                    <label>Piscina:</label>
                    <span>No</span>
                </section>
            </fieldset>

            <!-- Miniaturas de fotos adicionales -->
            <section class="inputGroup">
                <label>Fotos adicionales:</label>
                <div class="miniaturas">
                    <img class= "aditional-img" src="../assets/img/houses/house1.png" alt="Foto adicional 1" class="miniatura">
                    <img class= "aditional-img"  src="../assets/img/houses/house2.png" alt="Foto adicional 2" class="miniatura">
                    <img class= "aditional-img"  src="../assets/img/houses/house1.png" alt="Foto adicional 2" class="miniatura">
                    <img class= "aditional-img"  src="../assets/img/houses/house1.png" alt="Foto adicional 2" class="miniatura">
                    <img class= "aditional-img"  src="../assets/img/houses/house2.png" alt="Foto adicional 2" class="miniatura">
                </div>
            </section>

            <!-- Enlace para añadir una foto -->
            <a href="addPhoto.php?anuncio_id=1">
                <button class="greenButton" type="button">Añadir foto al anuncio</button>
            </a>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>


</body>
</html>
