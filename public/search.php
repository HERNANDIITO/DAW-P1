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
    <link rel="stylesheet" media="screen" title="Modo claro"  href="../styles/search.css">
    <!-- night mode -->
    <link rel="alternate stylesheet" media="screen" href="../styles/dark/night.css" title="Modo Noche" id="dark">
    <!-- impresion -->
    <link rel="stylesheet" media="print" href="../styles/print/index.css"/>
    <link rel="stylesheet" media="print" href="../styles/print/search.css"/>
    <!-- dislexicos -->
    <link rel="alternate stylesheet" media="screen" href="../styles/dyslexic/search.css"    title="Modo para dislexicos" id="dyslexia">
    <!-- big-font -->
    <link rel="alternate stylesheet" media="screen" href="../styles/big-font/search.css"    title="Modo de letras grandes" id="big_font">
    <!-- big-font-dyslexic -->
    <link rel="alternate stylesheet" media="screen" href="../styles/big-font-dyslexic/search.css"    title="Modo de letras grandes + dislexia" id="dyslexia_and_big_font">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/common.js"></script>
    <script src="../js/search.js" crossorigin="anonymous"></script>
    <title>Búsqueda avanzada</title>
</head>
<body>
    <header class="mainHeader">
        <nav id="navBar">
            <section class="links">
                <a class="navLink" href="/"> <i class="fa-solid fa-house"></i> Inicio</a>
                <a class="navLink" href="/public/search.php"> <i class="fa-solid fa-magnifying-glass"></i> Búsqueda</a>
            </section>
            <section class="profile">
                <a class="navLink" href="/public/login.php"> <i class="fa-solid fa-user"></i> Iniciar sesión </a>
                <a class="navLink" href="/public/register.php"> <i class="fa-solid fa-right-to-bracket"></i> Registrarse </a>
            </section>
        </nav>
    </header>
    <main id="main-content">
        <aside class="filters">
            <form action="">
                <section class="inputGroup">
                    <label for="ad-type">Tipo de anuncio</label>
                    <select name="ad-type" id="ad-type">
                        <option value="">Todos</option>
                        <option value="venta">Venta</option>
                        <option value="alquiler">Alquiler</option>
                    </select>
                </section>
                <section class="inputGroup">
                    <label for="ad-type">Tipo de obra</label>
                    <select name="ad-type" id="ad-type" aria-placeholder="aa">
                        <option value="">Cualquiera</option>
                        <option value="nueva">Obra nueva</option>
                        <option value="vivienda">Vivienda</option>
                        <option value="oficina">Oficina</option>
                        <option value="local">Local</option>
                        <option value="garaje">Garaje</option>
                    </select>
                </section>
                <section class="inputGroup">
                    <label for="city">Ciudad</label>
                    <input type="text" name="city" id="city">
                    <label for="country">País</label>
                    <input type="text" name="country" id="country">
                </section>
                <section class="inputGroup">
                    <label for="min-price">Precio mínimo</label>
                    <input type="number" name="min-price" id="min-price">
                    <label for="max-price">Precio máximo</label>
                    <input type="number" name="max-price" id="max-price">
                </section>
                <section class="inputGroup">
                    <label for="min-date">Fecha de publicación mínima</label>
                    <input type="date" name="min-date" id="min-date">
                    <label for="max-date">Fecha de publicación máxima</label>
                    <input type="date" name="max-date" id="max-date">
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

    <?php
        include "../inc/footer.php";
    ?>   

    <script>
        init()
    </script>
    
<script>
    changeStyle();
    checkCookies();
</script>