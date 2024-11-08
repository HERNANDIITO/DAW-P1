<!--
    Archivo: myAds.php
    Archivo dedicado a los mensajes que recibe un usuario que es uno mismo
    Creado por: David González Moreno el 08/11/2024
    Historial de cambios:
    02/10/2024 - Creado
    08/10/2024 - CSS Aplicado
-->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" title="Modo claro" id="defult" href="../styles/message.css">
    <!-- night mode -->
    <link rel="alternate stylesheet" media="screen" href="../styles/dark/night.css" title="Modo Noche" id="dark">
    <!-- dislexicos -->
    <link rel="alternate stylesheet" media="screen" href="../styles/dyslexic/myMessages.css"    title="Modo para dislexicos" id="dyslexia">
    <!-- big-font -->
    <link rel="alternate stylesheet" media="screen" href="../styles/big-font/myMessages.css"    title="Modo de letras grandes" id="big_font">
    <!-- big-font-dyslexic -->
    <link rel="alternate stylesheet" media="screen" href="../styles/big-font-dyslexic/myMessages.css"    title="Modo de letras grandes + dislexia" id="dyslexia_and_big_font">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/common.js" media="screen" crossorigin="anonymous"></script>
    <script src="../js/myAds.js" media="screen" crossorigin="anonymous"></script>
    <title>Mis mensajes</title>
</head>
<body>
    <?php
        include "../inc/header.php";
    ?>
    <main id="main-content">
        <h1 class="title">Mis anuncios</h1>

        <section class="content">
            <section class="inMessages">
                <section class="messages">

                    <section class="message">
                        <section class="card-photo-mini">
                            <img src="../assets/img/houses/house1.png">
                        </section>
                        <section >
                            <h2>Piso en Madrid</h2>
                        </section>
                        <section class="messageContent">
                            <p>Este moderno y acogedor piso se encuentra en una de las zonas más exclusivas de Madrid, en el barrio de Chamartín, a solo unos minutos del centro de la ciudad. Con una superficie de 120 metros cuadrados, este piso cuenta con amplios y luminosos espacios, ideales para una vida cómoda y tranquila en la capital.</p>
                        </section>
                        <hr class="solid">
                        <section class="messageInfo">
                            <span>Madrid c/Alfonso IX</span> <span>España</span> <span>800.000€</span><i class="fa-solid fa-circle-info"></i> <span><button class="greenButton" onclick="redirigir()">Ver</button></span>
                        </section>
                    </section>


                    <section class="message">
                        <section class="card-photo-mini">
                            <img src="../assets/img/houses/house2.png">
                        </section>
                        <section >
                            <h2>Piso en Madrid</h2>
                        </section>
                        <section class="messageContent">
                            <p>Este moderno y acogedor piso se encuentra en una de las zonas más exclusivas de Madrid, en el barrio de Chamartín, a solo unos minutos del centro de la ciudad. Con una superficie de 120 metros cuadrados, este piso cuenta con amplios y luminosos espacios, ideales para una vida cómoda y tranquila en la capital.</p>
                        </section>
                        <hr class="solid">
                        <section class="messageInfo">
                            <span>Madrid c/Alfonso IX</span> <span>España</span> <span>800.000€</span><i class="fa-solid fa-circle-info"></i> <span><button class="greenButton" onclick="redirigir()">Ver</button></span>
                        </section>
                    </section>


                    <section class="message">
                        <section class="card-photo-mini">
                            <img src="../assets/img/houses/house1.png">
                        </section>
                        <section >
                            <h2>Piso en Madrid</h2>
                        </section>
                        <section class="messageContent">
                            <p>Este moderno y acogedor piso se encuentra en una de las zonas más exclusivas de Madrid, en el barrio de Chamartín, a solo unos minutos del centro de la ciudad. Con una superficie de 120 metros cuadrados, este piso cuenta con amplios y luminosos espacios, ideales para una vida cómoda y tranquila en la capital.</p>
                        </section>
                        <hr class="solid">
                        <section class="messageInfo">
                            <span>Madrid c/Alfonso IX</span> <span>España</span> <span>800.000€</span><i class="fa-solid fa-circle-info"></i> <span><button class="greenButton" onclick="redirigir()">Ver</button></span>
                        </section>
                    </section>
                </section>
            </section>
            
        </section>
    </main>

    <?php
        include "../inc/footer.php";
    ?>

<script>
    changeStyle();
    checkCookies();
</script>