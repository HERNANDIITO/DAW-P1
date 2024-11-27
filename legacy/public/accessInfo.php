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
        <title>Registro</title>
</head>
<body>
    <?php include "../inc/header.php";?>

    <main id="main-content">
        <h1 class="title">Información sobre accesibilidad</h1>
        
        <section class="message">
            <section class="messageContent">
                <h2>Modo noche</h2>
                <p>Se ha añadido un modo noche al que se puede acceder desde el apartado "ver" del navegador.</p>
                <p>Para ello se ha empleado un alternate stylesheet en la cebeza del archivo, el cual, en caso de activarse, abre un archivo .css con una paleta de colores modificada de la página para aportar ese modo oscuro</p>
            </section>
            <hr class="solid">

            <section class="messageContent">
                <h2>Versión impresa</h2>
                <p>Se ha añadido una disfribución concreta para que el modo de impresion se vea adecuadamente.</p>
                <p>Esto se ha hecho mediante un stylesheet media print, que al ser activado otorga un estilo .css mas óptimo para la página</p>
            </section>
            <hr class="solid">

            <section class="messageContent">
                <h2>Modo para disléxicos</h2>
                <p>Se ha añadido un modo para facilitar la visión de la página a disléxicos</p>
                <p>Para ello se ha empleado un alternate stylesheet en la cabeza del archivo, el cual, en caso de activarse, abre un archivo .css que adapta la página para disléxicos</p>
            </section>
            <hr class="solid">

            <section class="messageContent">
                <h2>Letra grande</h2>
                <p>Exactamente igual que los otros modos pero para poner letras grandes</p>
            </section>
            <hr class="solid">

            <section class="messageContent">
                <h2>Letra grande + dislexia</h2>
                <p>Combina ambos css para faciltiar aun más la accesibilidad</p>
            </section>
            <hr class="solid">

            <section class="messageInfo">
                <span>17/10/2024</span> <span>David González y Pablo Hernández</span>
            </section>

            <hr class="solid">
        </section>
    </main>
    
    <?php include "../inc/footer.php"; ?>



</body>
</html>
