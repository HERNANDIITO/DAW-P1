<!--
    Archivo: myProfile.php
    Archivo dedicado a la confirmación de una solicitud de folletos
    Creado por: Pablo Hernández García el 03/10/2024
    Historial de cambios:
    20/09/2024 - Creado
    08/10/2024 - CSS Aplicado
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
        <title>Folleto</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main>
        <section class="formResult">
            <!-- Nombre -->
            <section class="inputGroup">
                <label>Nombre:</label>
                <span><?php echo htmlspecialchars($_POST['nombre']); ?></span>
            </section>

            <!-- Correo electrónico -->
            <section class="inputGroup">
                <label>Correo electrónico:</label>
                <span><?php echo htmlspecialchars($_POST['email']); ?></span>
            </section>

            <!-- Texto adicional -->
            <section class="inputGroup">
                <label>Texto adicional:</label>
                <span><?php echo htmlspecialchars($_POST['textoAdicional']); ?></span>
            </section>

            <!-- Dirección -->
            <fieldset>
                <legend>Dirección:</legend>
                <section class="inputGroup">
                    <label>Calle:</label>
                    <span><?php echo htmlspecialchars($_POST['calle']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Número:</label>
                    <span><?php echo htmlspecialchars($_POST['numero']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Piso:</label>
                    <span><?php echo htmlspecialchars($_POST['piso']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Puerta:</label>
                    <span><?php echo htmlspecialchars($_POST['puerta']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Código Postal:</label>
                    <span><?php echo htmlspecialchars($_POST['codigoPostal']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Localidad:</label>
                    <span><?php echo htmlspecialchars($_POST['localidad']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Provincia:</label>
                    <span><?php echo htmlspecialchars($_POST['provincia']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>País:</label>
                    <span><?php echo htmlspecialchars($_POST['pais']); ?></span>
                </section>
            </fieldset>

            <!-- Teléfono -->
            <section class="inputGroup">
                <label>Teléfono:</label>
                <span><?php echo htmlspecialchars($_POST['telefono']); ?></span>
            </section>

            <!-- Color de la portada -->
            <section class="inputGroup">
                <label>Color de la portada:</label>
                <span><?php echo htmlspecialchars($_POST['colorPortada']); ?></span>
            </section>

            <!-- Número de copias -->
            <section class="inputGroup">
                <label>Número de copias:</label>
                <span><?php echo htmlspecialchars($_POST['numCopias']); ?></span>
            </section>

            <!-- Resolución de las fotos -->
            <section class="inputGroup">
                <label>Resolución de las fotos:</label>
                <span><?php echo htmlspecialchars($_POST['resFotos']); ?></span>
            </section>

            <!-- Anuncio del usuario -->
            <section class="inputGroup">
                <label>Anuncio del usuario:</label>
                <span><?php echo htmlspecialchars($_POST['anuncioUsuario']); ?></span>
            </section>

            <!-- Fecha de recepción -->
            <section class="inputGroup">
                <label>Fecha de recepción:</label>
                <span><?php echo htmlspecialchars($_POST['fechaRecepcion']); ?></span>
            </section>

            <!-- Impresión a color -->
            <section class="inputGroup">
                <label>Impresión a color:</label>
                <span><?php echo htmlspecialchars($_POST['impresionColor']); ?></span>
            </section>

            <!-- Impresión del precio -->
            <section class="inputGroup">
                <label>Impresión del precio:</label>
                <span><?php echo htmlspecialchars($_POST['impresionPrecio']); ?></span>
            </section>

            <!-- Precio -->
            <section class="inputGroup">
                <label>Coste:</label>
                <span><?php echo htmlspecialchars($_POST['precioTotalphp']); ?></span>
            </section>

            <a href="cardDetails.php">
                <button class="greenButton" type="submit">Confirmar solicitud</button> 
            </a>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>


</body>
</html>