<?php
// Conexión a la base de datos
$connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");

// Verificar si la conexión fue exitosa
if (!$connectionID) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Obtener el ID del anuncio desde la sesión
session_start();
$adId = $_SESSION['AdId'];

// Consultas para obtener los datos
$tiposAnuncios = [];
$tiposViviendas = [];
$paises = [];
$anuncio = [];

// Consultas para llenar los select
$sqlTiposAnuncios = "SELECT IdTAnuncio, NomTAnuncio FROM TiposAnuncios";
$sqlTiposViviendas = "SELECT IdTVivienda, NomTVivienda FROM TiposViviendas";
$sqlPaises = "SELECT IdPais, Nombre FROM Paises";

// Consulta para obtener los datos del anuncio a modificar
$sqlAnuncio = "SELECT * FROM Anuncios WHERE IdAnuncio = $adId";

$resultTiposAnuncios = mysqli_query($connectionID, $sqlTiposAnuncios);
if ($resultTiposAnuncios && mysqli_num_rows($resultTiposAnuncios) > 0) {
    while ($row = mysqli_fetch_assoc($resultTiposAnuncios)) {
        $tiposAnuncios[] = $row;
    }
}

$resultTiposViviendas = mysqli_query($connectionID, $sqlTiposViviendas);
if ($resultTiposViviendas && mysqli_num_rows($resultTiposViviendas) > 0) {
    while ($row = mysqli_fetch_assoc($resultTiposViviendas)) {
        $tiposViviendas[] = $row;
    }
}

$resultPaises = mysqli_query($connectionID, $sqlPaises);
if ($resultPaises && mysqli_num_rows($resultPaises) > 0) {
    while ($row = mysqli_fetch_assoc($resultPaises)) {
        $paises[] = $row;
    }
}

$resultAnuncio = mysqli_query($connectionID, $sqlAnuncio);
if ($resultAnuncio && mysqli_num_rows($resultAnuncio) > 0) {
    $anuncio = mysqli_fetch_assoc($resultAnuncio);
}

// Cerrar la conexión
mysqli_close($connectionID);
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
    <title>Modificar Anuncio</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main>
        <section class="formResult">
            <h1>Modificar Anuncio</h1>
            <form action="../phpAdds/updateAd-response.php" method="post">
                <!-- Tipo de Anuncio -->
                <section class="inputGroup">
                    <label for="tipoAnuncio">Tipo de Anuncio:</label>
                    <select name="tipoAnuncio" id="tipoAnuncio">
                        <?php foreach ($tiposAnuncios as $tipo): ?>
                            <option value="<?= $tipo['IdTAnuncio'] ?>" <?= $anuncio['TAnuncio'] == $tipo['IdTAnuncio'] ? 'selected' : '' ?>><?= htmlspecialchars($tipo['NomTAnuncio']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </section>

                <!-- Tipo de Vivienda -->
                <section class="inputGroup">
                    <label for="tipoVivienda">Tipo de Vivienda:</label>
                    <select name="tipoVivienda" id="tipoVivienda">
                        <?php foreach ($tiposViviendas as $tipo): ?>
                            <option value="<?= $tipo['IdTVivienda'] ?>" <?= $anuncio['TVivienda'] == $tipo['IdTVivienda'] ? 'selected' : '' ?>><?= htmlspecialchars($tipo['NomTVivienda']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </section>

                <!-- País -->
                <section class="inputGroup">
                    <label for="pais">País:</label>
                    <select name="pais" id="pais">
                        <?php foreach ($paises as $pais): ?>
                            <option value="<?= $pais['IdPais'] ?>" <?= $anuncio['Pais'] == $pais['IdPais'] ? 'selected' : '' ?>><?= htmlspecialchars($pais['Nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </section>

                <!-- Otros campos -->
                <section class="inputGroup">
                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" id="titulo" value="<?= htmlspecialchars($anuncio['Titulo']) ?>" required>
                </section>

                <section class="inputGroup">
                    <label for="precio">Precio:</label>
                    <input type="number" name="precio" id="precio" value="<?= htmlspecialchars($anuncio['Precio']) ?>" required>
                </section>

                <section class="inputGroup">
                    <label for="ciudad">Ciudad:</label>
                    <input type="text" name="ciudad" id="ciudad" value="<?= htmlspecialchars($anuncio['Ciudad']) ?>" required>
                </section>

                <section class="inputGroup">
                    <label for="superficie">Superficie:</label>
                    <input type="number" name="superficie" id="superficie" value="<?= htmlspecialchars($anuncio['Superficie']) ?>" required>
                </section>

                <section class="inputGroup">
                    <label for="habitaciones">Habitaciones:</label>
                    <input type="number" name="habitaciones" id="habitaciones" value="<?= htmlspecialchars($anuncio['Nhabitaciones']) ?>" required>
                </section>

                <section class="inputGroup">
                    <label for="banyos">Baños:</label>
                    <input type="number" name="banyos" id="banyos" value="<?= htmlspecialchars($anuncio['Nbanyos']) ?>" required>
                </section>

                <section class="inputGroup">
                    <label for="planta">Planta:</label>
                    <input type="number" name="planta" id="planta" value="<?= htmlspecialchars($anuncio['Planta']) ?>" required>
                </section>

                <section class="inputGroup">
                    <label for="anyo">Año:</label>
                    <input type="number" name="anyo" id="anyo" value="<?= htmlspecialchars($anuncio['Anyo']) ?>" required>
                </section>

                <section class="inputGroup">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" required><?= htmlspecialchars($anuncio['Texto']) ?></textarea>
                </section>

                <button class="greenButton" type="submit">Modificar Anuncio</button>
            </form>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>
</body>
</html>