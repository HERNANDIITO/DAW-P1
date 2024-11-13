<!--
    Archivo: navbar.php
    En este archivo se define el formulario de busqueda avanzada
    Creado por: Pablo Hernández García el 26/09/2024
    Historial de cambios:
    26/09/2024 - Creado
    28/09/2024 - Correciones del profesor
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
        href="../styles/<?php include '../inc/styleSelector.php' ?>/search.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/common.js"></script>
    <script src="../js/search.js" crossorigin="anonymous"></script>
    <title>Búsqueda avanzada</title>
</head>
<body>

    <?php include "../inc/header.php"; ?> 
    <main id="main-content">
        <aside class="filters">
            <form action="">
                <section class="inputGroup">
                    <label for="adType">Tipo de anuncio</label>
                    <select name="adType" id="adType">
                        <option value="">Todos</option>
                        <option value="0">Venta</option>
                        <option value="1">Alquiler</option>
                    </select>
                </section>
                <section class="inputGroup">
                    <label for="workType">Tipo de obra</label>
                    <select name="workType" id="workType" aria-placeholder="aa">
                        <option value="">Cualquiera</option>
                        <option value="0">Obra nueva</option>
                        <option value="1">Vivienda</option>
                        <option value="2">Oficina</option>
                        <option value="3">Local</option>
                        <option value="4">Garaje</option>
                    </select>
                </section>
                <section class="inputGroup">
                    <label for="city">Ciudad</label>
                    <input type="text" name="city" id="city">
                    <label for="country">País</label>
                    <input type="text" name="country" id="country">
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
        <section class="search-result" >
            <section id="order" class="inputGroup">

                <section onchange="sortHouses(this)" class="radioGroup">
                    <label>Ordenar por:</label>
                    <section class="radio"><label for="title"  >Título          </label><input checked onclick="changeField(this.value)" name="order_by" id="title"   type="radio" value="title"                  ></input></section>
                    <section class="radio"><label for="date"   >Fecha           </label><input onclick="changeField(this.value)" name="order_by" id="date"    type="radio" value="date"                   ></input></section>
                    <section class="radio"><label for="city"   >Ciudad          </label><input onclick="changeField(this.value)" name="order_by" id="city"    type="radio" value="city"                   ></input></section>
                    <section class="radio"><label for="order-country">País      </label><input onclick="changeField(this.value)" name="order_by" id="order-country" type="radio" value="order-country"    ></input></section>
                    <section class="radio"><label for="order-price"  >Precio    </label><input onclick="changeField(this.value)" name="order_by" id="order-price"   type="radio" value="order-price"      ></input></section>
                </section>
                <section onchange="sortHouses(this)" class="radioGroup">
                    <label>Tipo de orden:</label>
                    <section class="radio"><label for="asc"  >Ascendente  </label><input onclick="changeSortType(1)" checked name="order_type" id="asc"   type="radio" value="asc"      ></input></section>
                    <section class="radio"><label for="desc" >Descendente </label><input onclick="changeSortType(-1)" name="order_type" id="desc"  type="radio" value="desc"     ></input></section>
                </section>
            </section>
            <section id="houses" class="houses"></section>
        </section>
    </main>
    <?php include "../inc/footer.php"; ?>     
<script>
    start();
</script>
</body>
</html>