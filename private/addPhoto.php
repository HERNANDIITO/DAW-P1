<!-- 
    Archivo: addPhoto.php
    Formulario para añadir una foto a un anuncio
    Creado el: 08/11/2024
-->

<?php    
        session_start();
    
        $userID = $_SESSION["userSession"];
    
        if ( isset($_COOKIE["rememberedUser"]) ) {
            $userID = $_COOKIE["rememberedUser"];
        }
    
        session_commit();
    
        $query = "
            SELECT 
                IdAnuncio, 
                Titulo
            FROM 
                Anuncios
            WHERE 
                Usuario = ?
        ";
    
        $connection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
        $sentence = $connection->prepare($query);
        $sentence->bind_param("i",$userID);
        $sentence->execute();
        $result = $sentence->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        $selectedAd = isset($_GET['ad']) ? $_GET['ad'] : null;

        $anuncioEncontrado = null;

        if ( $selectedAd != null ) {
            foreach ($rows as $anuncio) {
                if ($anuncio['IdAnuncio'] == $selectedAd) {
                    $anuncioEncontrado = $anuncio;
                    break; 
                }
            }
        }

            
    $msg = isset($_GET['msg']) ? $_GET['msg'] : null;

    switch( $msg ) {
        case 3:
            echo "<script>alert('Faltan datos por rellenar');</script>";
            break;
            
        case 4:
            echo "<script>alert('Error seleccionando el anuncio');</script>";
            break;
            
        case 5:
            echo "<script>alert('Error subiendo el anuncio');</script>";
            break;
            
        case 6:
            echo "<script>alert('Ese tipo de archivo no está permitido');</script>";
            break;
            
        case 7:
            echo "<script>alert('Texto alternativo demasiado corto o redunante');</script>";
            break;
            
        case 8:
            echo "<script>alert('Foto subida con éxito');</script>";
            break;
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
        href="../styles/<?php include '../inc/styleSelector.php' ?>/brochureRequest.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" media="screen" crossorigin="anonymous"></script>
    <title>Añadir Foto a Anuncio</title>
</head>
<body>

    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <section class="formContainer">
            <h1>Añadir Foto a Anuncio</h1>
            
            <!-- Formulario de subida de foto -->
            <form action="../phpAdds/addPhoto-response.php" method="POST" enctype="multipart/form-data">
                
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
                    <select name="adSelect" id="adSelect">
                    <option <?php echo isset($selectedAd) ? '' : 'selected'; ?> value="">Selecciona un anuncio</option>
                        <?php  foreach ($rows as $ad) { ?>
                            <option  value="<?php echo $ad['IdAnuncio'] ?>" <?php echo ($ad['IdAnuncio'] == $selectedAd) ? 'selected' : ''; ?>>
                                <?php echo $ad['Titulo'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </section>

                <!-- Botón de envío -->
                <button class="greenButton" type="submit">Añadir Foto</button>
            </form>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>

    

</body>
</html>
