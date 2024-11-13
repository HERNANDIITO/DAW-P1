<!--
    Archivo: acces_info.php
    En este archivo se recopila la información sobre las modificaciones que se han hecho en el codigo para mejorar la accesibilidad
    Creado por: David González Moreno el 17/10/2024
    Historial de cambios:
    17/10/2024 - Creado
-->


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/message.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/common.js"></script>
    <script src="../js/cookieInfo.js"></script>
    <title>Registro</title>
</head>
<body>
    <?php include "../inc/header.php";?>


    <main id="main-content">
        <h1 class="title">Información sobre cookies</h1>
        
        <section class="message">
            <section class="messageContent">
                <h2>Cookies</h2>
                <p>Nuestra página utiliza las cookies única y exclusivamente para almacenar el tema seleccionado.</p>
                <p>Dicha cookie caduca a los 45 días de forma automática.</p>
            </section>
            <hr class="solid">
            <section id="selection"></section>

        </section>
    </main>
    
    <?php include "../inc/footer.php"?>

<script>
    setup();
</script>
</body>
</html>