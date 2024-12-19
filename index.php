<!--
    Archivo: index.php
    En este archivo se define la página principal del sitio web
    Creado por: Pablo Hernández García el 20/09/2024
    Historial de cambios:
    20/09/2024 - Creado
    24/09/2024 - Añadido navbar y footer mediante peticiones
    26/09/2024 - Añadido titulo y barra de busqueda
    28/09/2024 - Correciones del profesor
    05/10/2024 - Añadidos los estilos css
    08/10/2024 - Terminados los estilos css
-->

<?php  session_start(); ?>
<?php if (isset($_SESSION['flashdata_error'])): ?>
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <span class="error-message"><?php echo $_SESSION['flashdata_error']; ?></span>
            <button onclick="closeErrorModal()" id="closeModalButton" class="close-button">Cerrar</button>
        </div>
    </div>

    <?php
        // Eliminar el mensaje de error después de mostrarlo
        unset($_SESSION['flashdata_error']);
    ?>
<?php endif; ?>
<?php  session_commit(); ?>



<!-- ficherada -->
<?php
$ficheroAnuncios = 'data/anuncios_escogidos.txt';

// Leer y procesar el archivo de anuncios escogidos
$anunciosEscogidos = [];
if (file_exists($ficheroAnuncios)) {
    $lineas = file($ficheroAnuncios, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        parse_str(str_replace([';', ':'], ['&', '='], $linea), $anuncio);
        $anunciosEscogidos[] = $anuncio;
    }
}

// Seleccionar un anuncio al azar
$anuncioSeleccionado = $anunciosEscogidos[array_rand($anunciosEscogidos)];

// Obtener información del anuncio de la base de datos
$connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");
$idAnuncio = $anuncioSeleccionado['IdAnuncio'];
$queryAnuncio = "
    SELECT 
        Anuncios.*, 
        Paises.Nombre AS PaisNombre
    FROM 
        Anuncios
    JOIN 
        Paises ON Anuncios.Pais = Paises.IdPais
    WHERE 
        Anuncios.IdAnuncio = $idAnuncio;
";
$resultAnuncio = mysqli_query($connectionID, $queryAnuncio);
$anuncioBD = mysqli_fetch_assoc($resultAnuncio);
mysqli_close($connectionID);

?>

<!-- consejismo -->
<?php
// Leer el fichero JSON de consejos
$consejosFile = 'data/consejos.json';
if (file_exists($consejosFile)) {
    $consejos = json_decode(file_get_contents($consejosFile), true);
    
    if (is_array($consejos) && count($consejos) > 0) {
        // Seleccionar un consejo aleatorio
        $consejoAleatorio = $consejos[array_rand($consejos)];
        
        // Obtener las propiedades del consejo
        $categoria = htmlspecialchars($consejoAleatorio['categoria']);
        $importancia = htmlspecialchars($consejoAleatorio['importancia']);
        $descripcion = htmlspecialchars($consejoAleatorio['descripcion']);
    } else {
        $categoria = "N/A";
        $importancia = "N/A";
        $descripcion = "No hay consejos disponibles en este momento.";
    }
} else {
    $categoria = "N/A";
    $importancia = "N/A";
    $descripcion = "El archivo de consejos no existe.";
}
?>





<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="print" href="./styles/print/index.css"/>
    <!-- Diselxia -->
    <link
        rel="stylesheet"
        media="screen"
        href="styles/<?php include './inc/styleSelector.php' ?>/index.css"   
        title="<?php include './inc/styleSelector.php' ?>"
        id="<?php include './inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" media="screen" crossorigin="anonymous"></script>
    <script src="./js/common.js" media="screen" crossorigin="anonymous"></script>
    <script src="./js/index.js" media="screen" crossorigin="anonymous"></script>
    <title>FOTOCASA 2</title>
</head>
<body></body>

    <?php include "./inc/header.php" ?>

    <?php  session_start(); ?>
    <?php if (isset($_SESSION['welcomeMessage']) && !isset( $_SESSION['alreadyShown'])): ?>
        <?php $_SESSION['alreadyShown'] = true ?>
        <div id="welcomeModal" class="modal">
            <div class="modal-content">
                <span><?php echo $_SESSION['welcomeMessage']; ?></span>
                <button onclick="closeWelcomeModal()" id="closeModalButton" class="close-button">Cerrar</button>
            </div>
        </div>

        <?php
            // Eliminar el mensaje de error después de mostrarlo
            unset($_SESSION['welcomeMessage']);
        ?>
    <?php endif; ?>
    <?php  session_commit(); ?>

    <main id="main-content">
        <h1 class="mainTitle">FOTOCASA 2</h1>
        <!-- <div class="dailyAd">
            <h2>wowww</h2>
        </div> -->
        <section class="search">
            <label for="search">Búsqueda rápida</label>
            <input name="search" type="text">
        </section>
        <!-- Apartado de anuncios del dia  -->
        <section class="dailyAd">
            <a href="../restricted/cardDetails.php?id=<?php echo $anuncioBD['IdAnuncio']?>">
                <section class="featuredCard">
                    <h2>Anuncio del dia</h2>
                    <img class="mainImg" src="assets/img/houses/<?php echo $anuncioBD['Foto']; ?>" alt="<?php echo $anuncioBD['Alternativo']; ?>">
                    <h1 class="title"><?php echo $anuncioBD['Titulo']; ?></h1>
                    <section class="info">
                        <p><i class="fa-solid fa-location-dot"></i> <?php echo $anuncioBD['PaisNombre'] . ', ' . $anuncioBD['Ciudad']; ?></p>
                        <p><i class="fa-solid fa-tag"></i> <?php echo $anuncioBD['Precio']; ?>€</p>
                        <p><strong>Seleccionado por:</strong> <?php echo $anuncioSeleccionado['Persona']; ?></p>
                        <p><strong>Comentario:</strong> <?php echo $anuncioSeleccionado['Comentario']; ?></p>
                    </section>
                </section>
            </a>
        </section>
        <!-- Apartado de Consejo de Compra/Venta -->
        <section class="consejo">
            <h2>Consejo de Compra/Venta</h2>
            <p><strong>Categoría:</strong> <?= $categoria ?></p>
            <p><strong>Importancia:</strong> <?= $importancia ?></p>
            <p><strong>Descripción:</strong> <?= $descripcion ?></p>
        </section>
                
        <section class="houses">
            <?php 
                $connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");

                $query = "
                    SELECT 
                        Anuncios.*, 
                        Paises.Nombre AS PaisNombre
                    FROM 
                        Anuncios
                    JOIN 
                        Paises ON Anuncios.Pais = Paises.IdPais
                    ORDER BY 
                        Anuncios.FRegistro DESC
                    LIMIT 5;
                ";
                $result = mysqli_query($connectionID, $query);

                while($row = mysqli_fetch_assoc($result)) { ?>
                    <a href="../restricted/cardDetails.php?id=<?php echo $row['IdAnuncio']?>"> 
                        <section class="card">
                            <img class="mainImg" src="assets/img/houses/<?php echo $row['Foto'] ?>" alt="<?php echo $row['Alternativo'] ?>">
                            <h1 class="title"><?php echo $row['Titulo']?></h1>
                            <section class="info">
                                <p><i class="fa-solid fa-location-dot"></i> <?php echo $row['PaisNombre'] . ', ' . $row['Ciudad']?></p>
                                <p><i class="fa-solid fa-tag"></i> <?php echo $row['Precio']?>€</p>
                            </section>
                        </section>
                    </a>
                <?php
                }
                mysqli_close($connectionID);
            ?>
        </section>
    </main>

    <?php include "inc/footer.php"; ?>
</body>
</html>