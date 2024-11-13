<!-- 
    Archivo: addPhoto.php
    Formulario para añadir una foto a un anuncio
    Creado el: 08/11/2024
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/brochureRequest.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <title>Añadir Foto a Anuncio</title>
</head>
<body>

    <?php include "../inc/header.php"; ?>

    <main>
        <section class="formContainer">
            <h1>Añadir Foto a Anuncio</h1>
            
            <!-- Formulario de subida de foto -->
            <form action="#" method="POST" enctype="multipart/form-data">
                
                <!-- Campo de foto -->
                <section class="inputGroup">
                    <label for="photo">Foto:</label>
                    <input type="file" name="photo" id="photo" accept="image/*" required>
                </section>

                <!-- Campo de texto alternativo -->
                <section class="inputGroup">
                    <label for="altText">Texto alternativo:</label>
                    <input type="text" name="altText" id="altText" placeholder="Descripción de la foto" required>
                </section>

                <!-- Campo de título -->
                <section class="inputGroup">
                    <label for="title">Título:</label>
                    <input type="text" name="title" id="title" placeholder="Título de la foto" required>
                </section>

                <!-- Lista desplegable para seleccionar anuncio -->
                <section class="inputGroup">
                    <label for="adSelect">Anuncio:</label>
                    <select name="adSelect" id="adSelect" <?php echo (basename($_SERVER['HTTP_REFERER']) != 'myProfile.php') ? 'disabled' : ''; ?>>
                        <?php
                        // Ejemplo de opciones. En una implementación real, las opciones se extraerían de una base de datos.
                        $ads = ['Anuncio 1', 'Anuncio 2', 'Anuncio 3'];
                        $selectedAd = isset($_GET['ad']) ? $_GET['ad'] : null;

                        // Genera las opciones de la lista desplegable.
                        echo '<option value="">Selecciona un anuncio</option>';
                        foreach ($ads as $ad) {
                            $isSelected = ($ad === $selectedAd) ? 'selected' : '';
                            echo "<option value='$ad' $isSelected>$ad</option>";
                        }
                        ?>
                    </select>
                </section>

                <!-- Botón de envío -->
                <button class="greenButton" type="submit">Añadir Foto</button>
            </form>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>

    <script src="../js/common.js"></script>


</body>
</html>
