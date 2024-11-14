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

    <main id="main-content">
        <h1 class="mainTitle">FOTOCASA 2</h1>
        <section class="search">
            <label for="search">Búsqueda rápida</label>
            <input name="search" type="text">
        </section>
        <section class="houses">
            <a class="cardLink" href="../restricted/cardDetails.php?id=11"> 
                <section class="card">
                    <img class="mainImg" src="../assets/img/houses/house1.png" alt="">
                    <h1 class="title">Piso en Madrid</h1>
                    <section class="info">
                        <p><i class="fa-solid fa-location-dot"></i> Madrid</p>
                        <p><i class="fa-solid fa-tag"></i> 200.000€</p>
                    </section>
                </section>
            </a>
            <a class="cardLink" href="../restricted/cardDetails.php?id=12"> 
                <section class="card">
                    <img class="mainImg" src="../assets/img/houses/house2.png" alt="">
                    <h1 class="title">Piso en Madrid</h1>
                    <section class="info">
                        <p><i class="fa-solid fa-location-dot"></i> Madrid</p>
                        <p><i class="fa-solid fa-tag"></i> 200.000€</p>
                    </section>
                </section>
            </a>
            <a class="cardLink" href="../restricted/cardDetails.php?id=13"> 
                <section class="card">
                    <img class="mainImg" src="../assets/img/houses/house1.png" alt="">
                    <h1 class="title">Piso en Madrid</h1>
                    <section class="info">
                        <p><i class="fa-solid fa-location-dot"></i> Madrid</p>
                        <p><i class="fa-solid fa-tag"></i> 200.000€</p>
                    </section>
                </section>
            </a>               
            <a class="cardLink" href="../restricted/cardDetails.php?id=14"> 
                <section class="card">
                    <img class="mainImg" src="../assets/img/houses/house1.png" alt="">
                    <h1 class="title">Piso en Madrid</h1>
                    <section class="info">
                        <p><i class="fa-solid fa-location-dot"></i> Madrid</p>
                        <p><i class="fa-solid fa-tag"></i> 200.000€</p>
                    </section>
                </section>
            </a>
            <a class="cardLink" href="../restricted/cardDetails.php?id=15"> 
                <section class="card">
                    <img class="mainImg" src="../assets/img/houses/house2.png" alt="">
                    <h1 class="title">Piso en Madrid</h1>
                    <section class="info">
                        <p><i class="fa-solid fa-location-dot"></i> Madrid</p>
                        <p><i class="fa-solid fa-tag"></i> 200.000€</p>
                    </section>
                </section>
            </a>
            <a class="cardLink" href="../restricted/cardDetails.php?id=16"> 
                <section class="card">
                    <img class="mainImg" src="../assets/img/houses/house1.png" alt="">
                    <h1 class="title">Piso en Madrid</h1>
                    <section class="info">
                        <p><i class="fa-solid fa-location-dot"></i> Madrid</p>
                        <p><i class="fa-solid fa-tag"></i> 200.000€</p>
                    </section>
                </section>
            </a>               
        </section>
    </main>
    <?php include "inc/footer.php"; ?>
</body>
</html>