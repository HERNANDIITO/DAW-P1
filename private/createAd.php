<?php
// Conexión a la base de datos
$connectionID = mysqli_connect("localhost:3306", "admin", "admin", "fotocasa2");

// Verificar si la conexión fue exitosa
if (!$connectionID) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Consultas para obtener los datos
$tiposAnuncios = [];
$tiposViviendas = [];
$paises = [];

$sqlTiposAnuncios = "SELECT IdTAnuncio, NomTAnuncio FROM TiposAnuncios";
$sqlTiposViviendas = "SELECT IdTVivienda, NomTVivienda FROM TiposViviendas";
$sqlPaises = "SELECT IdPais, Nombre FROM Paises";

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

$msg = isset($_GET['msg']) ? $_GET['msg'] : null;

if ( $msg == 1 ) {
    echo "<script>alert('Valores inválidos');</script>";
} else if ($msg == 2) {
    echo "<script>alert('Todos los campos son obligatorios');</script>";
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
    <title>Crear Anuncio</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main>
        <section class="formResult">
            <h1>Crear Anuncio</h1>
            <form action="../phpAdds/createAd-response.php" method="post">
                <!-- Tipo de Anuncio -->
                <section class="inputGroup">
                    <label for="tipoAnuncio">Tipo de Anuncio:</label>
                    <select name="tipoAnuncio" id="tipoAnuncio">
                        <?php foreach ($tiposAnuncios as $tipo): ?>
                            <option value="<?= $tipo['IdTAnuncio'] ?>"><?= htmlspecialchars($tipo['NomTAnuncio']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </section>

                <!-- Tipo de Vivienda -->
                <section class="inputGroup">
                    <label for="tipoVivienda">Tipo de Vivienda:</label>
                    <select name="tipoVivienda" id="tipoVivienda">
                        <?php foreach ($tiposViviendas as $tipo): ?>
                            <option value="<?= $tipo['IdTVivienda'] ?>"><?= htmlspecialchars($tipo['NomTVivienda']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </section>

                <!-- País -->
                <section class="inputGroup">
                    <label for="pais">País:</label>
                    <select name="pais" id="pais">
                        <?php foreach ($paises as $pais): ?>
                            <option value="<?= $pais['IdPais'] ?>"><?= htmlspecialchars($pais['Nombre']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </section>

                <!-- Otros campos -->
                <section class="inputGroup">
                    <label for="titulo">Título:</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Título del anuncio" required>
                </section>

                <section class="inputGroup">
                    <label for="titulo">Precio:</label>
                    <input type="number" name="precio" id="precio" placeholder="Precio" required>
                </section>

                <section class="inputGroup">
                    <label for="titulo">Ciudad:</label>
                    <input type="text" name="ciudad" id="ciudad" placeholder="Ciudad" required>
                </section>

                <section class="inputGroup">
                    <label for="titulo">Superficie:</label>
                    <input type="number" name="superficie" id="superficie" placeholder="90" required>
                </section>

                <section class="inputGroup">
                    <label for="titulo">Habitaciones:</label>
                    <input type="number" name="habitaciones" id="habitaciones" placeholder="2" required>
                </section>

                <section class="inputGroup">
                    <label for="titulo">Baños:</label>
                    <input type="number" name="banyos" id="banyos" placeholder="1" required>
                </section>

                <section class="inputGroup">
                    <label for="titulo">Planta:</label>
                    <input type="number" name="planta" id="planta" placeholder="6" required>
                </section>

                <section class="inputGroup">
                    <label for="titulo">Año:</label>
                    <input type="number" name="anyo" id="anyo" placeholder="1990" required>
                </section>

                <section class="inputGroup">
                    <label for="descripcion">Descripción:</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripción detallada del anuncio" required></textarea>
                </section>

                <!-- Continuar con el resto del formulario -->

                <button class="greenButton" type="submit">Crear Anuncio</button>
            </form>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>
</body>
</html>
