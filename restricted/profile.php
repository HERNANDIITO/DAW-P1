<!--
    Archivo: profile.php
    En este archivo se mostrara el perfil de un usuario diferente del usuario
    Creado por: Pablo Hernández García el 20/09/2024
    Historial de cambios:
    20/09/2024 - Creado
    26/09/2024 - Layout desarrollado
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
        href="../styles/<?php include '../inc/styleSelector.php' ?>/profile.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
        <title>Perfil</title>
</head>
<body>
        
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <section class="pfp">
            <img src="../assets/img/logo.png" class="logo">
            <h1>Paco Moreno</h1>
        </section>
        <section class="info-wrapper">
            <section class="info">
                <p><i class="fa-solid fa-at"></i>paco@moreno.com</p>
                <p><i class="fa-solid fa-user"></i>Hombre</p>
            </section>
            <section class="info">
                <p><i class="fa-solid fa-location-dot"></i> Madrid</p>
                <p><i class="fa-solid fa-calendar-days"></i>paco@moreno.com</p>
            </section>
        </section>
        <h1>Anuncios</h1>
        <section class="houses">
            <a href="../restricted/cardDetails.php"> 
                <section class="card">
                    <img class="mainImg" src="../assets/img/houses/house1.png" alt="">
                    <h1 class="title">Piso en Madrid</h1>
                    <section class="info">
                        <p><i class="fa-solid fa-location-dot"></i> Madrid</p>
                        <p><i class="fa-solid fa-tag"></i> 200.000€</p>
                    </section>
                </section>
            </a>
            <a href="../restricted/cardDetails.php"> 
                <section class="card">
                    <img class="mainImg" src="../assets/img/houses/house2.png" alt="">
                    <h1 class="title">Piso en Madrid</h1>
                    <section class="info">
                        <p><i class="fa-solid fa-location-dot"></i> Madrid</p>
                        <p><i class="fa-solid fa-tag"></i> 200.000€</p>
                    </section>
                </section>
            </a>
            <a href="../restricted/cardDetails.php"> 
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

    <?php include "../inc/footer.php"; ?>


</body>
</html>
