<!--
    Archivo: createAd.php
    En este archivo se define el formulario para crear un nuevo anuncio
    Creado por: [Tu Nombre] el [Fecha de Creación]
    Historial de cambios:
    [Fecha] - Creado
-->

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
    <script src="../js/common.js"></script>
    <title>Crear Anuncio</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main>
        <section class="formResult">
            <h1>Crear Anuncio</h1>
            <form action="submitAd.php" method="post">
                <!-- Tipo de Anuncio -->
                <section class="inputGroup">
                    <label for="tipoAnuncio">Tipo de Anuncio:</label>
                    <select name="tipoAnuncio" id="tipoAnuncio">
                        <option value="venta">Venta</option>
                        <option value="alquiler">Alquiler</option>
                    </select>
                </section>

                <!-- Tipo de Vivienda -->
                <section class="inputGroup">
                    <label for="tipoVivienda">Tipo de Vivienda:</label>
                    <select name="tipoVivienda" id="tipoVivienda">
                        <option value="apartamento">Apartamento</option>
                        <option value="casa">Casa</option>
                        <option value="piso">Piso</option>
                        <option value="chalet">Chalet</option>
                    </select>
                </section>

                <!-- Título -->
                <section class="inputGroup">
                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Título del anuncio" required>
                </section>

                <!-- Descripción -->
                <section class="inputGroup">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripción detallada del anuncio" required></textarea>
                </section>

                <!-- Ciudad -->
                <section class="inputGroup">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" required>
                </section>

                <!-- País -->
                <section class="inputGroup">
                    <label for="pais">País:</label>
                    <input type="text" name="pais" id="pais" placeholder="País" required>
                </section>

                <!-- Características -->
                <fieldset>
                    <legend>Características</legend>

                    <section class="inputGroup">
                        <label for="ubicacion">Ubicación:</label>
                        <input type="text" name="ubicacion" id="ubicacion" placeholder="Ubicación exacta">
                    </section>

                    <section class="inputGroup">
                        <label for="precio">Precio (€):</label>
                        <input type="number" name="precio" id="precio" placeholder="Precio" required>
                    </section>

                    <section class="inputGroup">
                        <label for="propietario">Propietario:</label>
                        <input type="text" name="propietario" id="propietario" placeholder="Nombre del propietario">
                    </section>

                    <section class="inputGroup">
                        <label for="fechaPublicacion">Fecha de Publicación:</label>
                        <input type="date" name="fechaPublicacion" id="fechaPublicacion">
                    </section>

                    <section class="inputGroup">
                        <label for="metros">Metros Cuadrados:</label>
                        <input type="number" name="metros" id="metros" placeholder="Metros cuadrados" required>
                    </section>

                    <section class="inputGroup">
                        <label for="banos">Baños:</label>
                        <input type="number" name="banos" id="banos" placeholder="Número de baños" required>
                    </section>

                    <section class="inputGroup">
                        <label for="habitaciones">Habitaciones:</label>
                        <input type="number" name="habitaciones" id="habitaciones" placeholder="Número de habitaciones" required>
                    </section>
                </fieldset>

                <button class="greenButton" type="submit">Crear Anuncio</button>
            </form>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>


</body>
</html>
