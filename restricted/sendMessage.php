<!--
    Archivo: sendMessage.php
    En este archivo el usuario puede enviar un mensaje al perfil del anuncio
    Creado por: David González Moreno el 26/09/2024
    Historial de cambios:
    26/09/2024 - Creado
    26/09/2024 - Layout desarrollado
    28/09/2024 - Correciones del profesor
    08/10/2024 - CSS Aplicado
-->


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/common.js" ></script>
    <link
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/sendMessage.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <title>Registro</title>
</head>
<body>
        
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <h1 class="title">Mensaje para Paco Moreno</h1>
        <form action="messageResponse.php" method="POST" >
            <section class="inputGroup">
                <label for="message">Mensaje</label>
                <textarea name="message" placeholder="Aqui puedes escribir un mensaje al arrendador" ></textarea>
            </section>
            <section class="inputGroup">
                <label for="option">Tipo de mensaje</label>
                <select name="option" id="option">
                    <option value="info" >Más información</option>
                    <option value="date" >Concretar cita</option>
                    <option value="offer">Hacer oferta</option>
                </select>
            </section>
            <button class="greenButton" type="submit">Enviar</button>
        </form>
    </main>

    <?php include "../inc/footer.php"; ?>


</body>
</html>