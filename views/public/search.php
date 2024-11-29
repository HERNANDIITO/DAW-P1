<!--
    Archivo: search.php
    Creado por: Pablo Hernández García el 26/09/2024
    Historial de cambios:
    26/09/2024 - Creado
    28/09/2024 - Correciones del profesor
    08/10/2024 - CSS Aplicado
    20/11/2024 - Adaptado a nueva estructura de base de datos
-->

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" href="views/styles/<?php include 'views/common/styleSelector.php' ?>/search.css" title="<?php include 'views/common/styleSelector.php' ?>" id="<?php include 'views/common/styleSelector.php' ?>">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/search.js" crossorigin="anonymous"></script>
    <title><?php echo $data['title']?></title>
</head>

<body>
    <main id="main-content">
        <aside class="filters">
            <form action="<?php echo urlPUBLIC . urlACTION . 'search'?>" method="GET">
                
                <input type="hidden" name="c" value="public">
                <input type="hidden" name="a" value="search">

                <section class="inputGroup">
                    <label for="adType">Tipo de anuncio</label>
                    <select name="adType" id="adType">
                        <option value="">Todos</option>
                        <?php foreach ($data["adTypes"] as $anuncio): ?>
                            <option value="<?= $anuncio['IdTAnuncio'] ?>"><?= htmlspecialchars($anuncio['NomTAnuncio']) ?></option>
                        <?php endforeach; ?>
                    </select>
                </section>
                <section class="inputGroup">
                    <label for="workType">Tipo de vivienda</label>
                    <select name="workType" id="workType">
                        <option value="">Cualquiera</option>
                        <?php foreach ($data["buildingTypes"] as $vivienda): ?>
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
                        <?php foreach ($data["countries"] as $pais): ?>
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
            <?php if ($data["filteredSearch"]): ?>
                <?php foreach ($data["filteredSearch"] as $resultado): ?>
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
    <script>
        start();
    </script>
</body>

</html>