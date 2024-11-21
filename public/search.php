<!--
    Archivo: search.php
    Creado por: Pablo Hernández García el 26/09/2024
    Historial de cambios:
    26/09/2024 - Creado
    28/09/2024 - Correciones del profesor
    08/10/2024 - CSS Aplicado
    20/11/2024 - Adaptado a nueva estructura de base de datos
-->

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexión a la base de datos
$connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");

if (!$connectionID) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Obtener los datos de TiposAnuncios
$queryAnuncios = "SELECT IdTAnuncio, NomTAnuncio FROM TiposAnuncios";
$resultAnuncios = mysqli_query($connectionID, $queryAnuncios);
$anuncios = [];
if ($resultAnuncios && mysqli_num_rows($resultAnuncios) > 0) {
    while ($row = mysqli_fetch_assoc($resultAnuncios)) {
        $anuncios[] = $row;
    }
}

// Obtener los datos de TiposViviendas
$queryViviendas = "SELECT IdTVivienda, NomTVivienda FROM TiposViviendas";
$resultViviendas = mysqli_query($connectionID, $queryViviendas);
$viviendas = [];
if ($resultViviendas && mysqli_num_rows($resultViviendas) > 0) {
    while ($row = mysqli_fetch_assoc($resultViviendas)) {
        $viviendas[] = $row;
    }
}

// Obtener los datos de Países
$queryPaises = "SELECT IdPais, Nombre FROM Paises";
$resultPaises = mysqli_query($connectionID, $queryPaises);
$paises = [];
if ($resultPaises && mysqli_num_rows($resultPaises) > 0) {
    while ($row = mysqli_fetch_assoc($resultPaises)) {
        $paises[] = $row;
    }
}

$firstTime = true;

// Procesar formulario y realizar búsqueda
if (($_SERVER['REQUEST_METHOD'] === 'GET' && !empty($_GET)) || $firstTime) {
    $adType = $_GET['adType'] ?? null;
    $workType = $_GET['workType'] ?? null;
    $city = $_GET['city'] ?? null;
    $country = $_GET['country'] ?? null;
    $minPrice = $_GET['minPrice'] ?? null;
    $maxPrice = $_GET['maxPrice'] ?? null;
    $minDate = $_GET['minDate'] ?? null;
    $maxDate = $_GET['maxDate'] ?? null;

    $firstTime = false;

    // Construir consulta dinámica
    $query = "SELECT * FROM Anuncios WHERE 1=1";
    if ($adType) {
        $query .= " AND TAnuncio = " . intval($adType);
    }
    if ($workType) {
        $query .= " AND TVivienda = " . intval($workType);
    }
    if ($city) {
        $query .= " AND LOWER(Ciudad) LIKE LOWER('%" . mysqli_real_escape_string($connectionID, $city) . "%')";
    }
    if ($country) {
        $query .= " AND Pais = " . intval($country);
    }
    if ($minPrice) {
        $query .= " AND Precio >= " . floatval($minPrice);
    }
    if ($maxPrice) {
        $query .= " AND Precio <= " . floatval($maxPrice);
    }
    if ($minDate) {
        $query .= " AND FRegistro >= '" . mysqli_real_escape_string($connectionID, $minDate) . "'";
    }
    if ($maxDate) {
        $query .= " AND FRegistro <= '" . mysqli_real_escape_string($connectionID, $maxDate) . "'";
    }

    $resultQuery = mysqli_query($connectionID, $query);
    if ($resultQuery && mysqli_num_rows($resultQuery) > 0) {
        while ($row = mysqli_fetch_assoc($resultQuery)) {
            $resultados[] = $row;
        }
    }
}

// Cerrar conexión
mysqli_close($connectionID);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="../styles/<?php include '../inc/styleSelector.php' ?>/search.css" title="<?php include '../inc/styleSelector.php' ?>" id="<?php include '../inc/styleSelector.php' ?>">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/search.js" crossorigin="anonymous"></script>
    <title>Búsqueda avanzada</title>
</head>

<body>

    <?php include "../inc/header.php"; ?>
    <main id="main-content">
        <aside class="filters">
            <form action="" method="GET">
                <section class="inputGroup">
                    <label for="adType">Tipo de anuncio</label>
                    <select name="adType" id="adType">
                        <option value="">Todos</option>
                        <?php foreach ($anuncios as $anuncio): ?>
                            <option value="<?= $anuncio['IdTAnuncio'] ?>"><?= htmlspecialchars($anuncio['NomTAnuncio']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </section>
                <section class="inputGroup">
                    <label for="workType">Tipo de vivienda</label>
                    <select name="workType" id="workType">
                        <option value="">Cualquiera</option>
                        <?php foreach ($viviendas as $vivienda): ?>
                            <option value="<?= $vivienda['IdTVivienda'] ?>"><?= htmlspecialchars($vivienda['NomTVivienda']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </section>
                <section class="inputGroup">
                    <label for="city">Ciudad</label>
                    <input type="text" name="city" id="city">
                </section>
                <section class="inputGroup">
                    <label for="country">País</label>
                    <select name="country" id="country">
                        <option value="">Todos</option>
                        <?php foreach ($paises as $pais): ?>
                            <option value="<?= $pais['IdPais'] ?>"><?= htmlspecialchars($pais['Nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </section>
                <section class="inputGroup">
                    <label for="minPrice">Precio mínimo</label>
                    <input type="number" name="minPrice" id="minPrice">
                    <label for="maxPrice">Precio máximo</label>
                    <input type="number" name="maxPrice" id="maxPrice">
                </section>
                <section class="inputGroup">
                    <label for="minDate">Fecha de publicación mínima</label>
                    <input type="date" name="minDate" id="minDate">
                    <label for="maxDate">Fecha de publicación máxima</label>
                    <input type="date" name="maxDate" id="maxDate">
                </section>
                <button class="greenButton" type="submit">Buscar</button>
            </form>
        </aside>
        <section class="search-result">
            <?php if ($resultados): ?>
                <?php foreach ($resultados as $resultado): ?>
                    <a href="../restricted/cardDetails.php?id=<?= htmlspecialchars($resultado['IdAnuncio']) ?>">
                        <section class="card">
                            <img class="mainImg" src="../assets/img/houses/<?= htmlspecialchars($resultado['Foto']) ?>" alt="<?= htmlspecialchars($resultado['Alternativo']) ?>">
                            <h1 class="title"><?= htmlspecialchars($resultado['Titulo']) ?></h1>
                            <section class="info">
                                <p><i class="fa-solid fa-location-dot"></i> <?= htmlspecialchars($resultado['Ciudad']) ?>, <?= htmlspecialchars($resultado['Pais']) ?></p>
                                <p><i class="fa-solid fa-tag"></i> <?= htmlspecialchars($resultado['Precio']) ?>€</p>
                            </section>
                        </section>
                    </a>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se encontraron resultados.</p>
            <?php endif; ?>
        </section>
    </main>
    <?php include "../inc/footer.php"; ?>
    <script>
        start();
    </script>
</body>

</html>