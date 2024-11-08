<!--
    Archivo: cardDetails.php
    En este archivo se mostraran los detalles del anuncio que quiera ver el usuario
    Creado por: David González Moreno el 26/09/2024
    Historial de cambios:
    26/09/2024 - Creado
    26/09/2024 - Layout desarrollado
    28/09/2024 - Correciones del profesor
    08/10/2024 - CSS Aplicado
-->

<?php
    class Card {
        public $img;
        public $title;
        public $characteristics; //array con las caracteristicas
        public $description;

        public function __construct($img, $title, $characteristics, $description) {
            $this->img = $img;
            $this->title = $title;
            $this->characteristics = $characteristics;
            $this->description = $description;
        }
    }

    $card1 = new Card("house1.png", "Piso en Madrid", ["Madrid c/Alfonso XI", "800.000€", "Paco Moreno", "29/03/2025", "90m²", 2, 4, "venta"], "Este moderno y acogedor piso se encuentra en una de las zonas más exclusivas de Madrid, en el barrio de Chamartín, a solo unos minutos del centro de la ciudad. Con una superficie de 120 metros cuadrados, este piso cuenta con amplios y luminosos espacios, ideales para una vida cómoda y tranquila en la capital.");
    $card2 = new Card("house2.png", "Piso en Valencia", ["Valencia c/Paiporta III", "330.000€", "Raul Clyde", "12/02/2025", "40m²", 1, 2, "venta"], "Nos encontramos en un momento crítico tras la devastadora DANA que ha afectado gravemente a diversas localidades de Valencia. Muchas familias han sufrido grandes pérdidas materiales, y las infraestructuras de la ciudad y sus alrededores han quedado seriamente dañadas. Hoy, más que nunca, necesitamos unirnos como comunidad para brindar apoyo a quienes más lo necesitan. Si puedes, te pedimos que contribuyas con cualquier ayuda, ya sea en forma de donativos, ropa, alimentos o incluso tiempo voluntario. Cada pequeño gesto cuenta para que nuestros vecinos puedan superar esta difícil situación.");


    // Obtener el ID de la carta desde la URL
        $cardId = isset($_GET['id']) ? $_GET['id'] : 0;

    // Seleccionar la carta basada en el ID (par o impar)
    if ($cardId % 2 == 0) {
        $card = $card2;  // Si es par, mostrar la carta 2
    } else {
        $card = $card1;  // Si es impar, mostrar la carta 1
    }

?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="screen" title="Modo claro"  href="../styles/cardDetails.css">
    <!-- night mode -->
    <link rel="alternate stylesheet" media="screen" href="../styles/dark/night.css" title="Modo Noche" id="dark">
    <!-- impresion -->
    <link rel="stylesheet" media="print" href="../styles/print/index.css"/>
    <link rel="stylesheet" media="print" href="../styles/print/cardDetails.css"/>
    <!-- dislexicos -->
    <link rel="alternate stylesheet" media="screen" href="../styles/dyslexic/cardDetails.css"    title="Modo para dislexicos" id="dyslexia">
    <!-- big-font -->
    <link rel="alternate stylesheet" media="screen" href="../styles/big-font/cardDetails.css"    title="Modo de letras grandes" id="big_font">
    <!-- big-font-dyslexic -->
    <link rel="alternate stylesheet" media="screen" href="../styles/big-font-dyslexic/cardDetails.css"    title="Modo de letras grandes + dislexia" id="dyslexia_and_big_font">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/common.js"></script>
    <title>Detalles de anuncio</title>
</head>

<body>
        
    <?php
        include "../inc/header.php";
    ?>

    <main id="main-content">
        <section class="card-photo-big">
            <img src="../assets/img/houses/<?php echo $card->img; ?>">
        </section>

        <h1><?php echo $card->title; ?></h1>

        <h2>Características</h2>

        <section class="info-wrapper">
            <section class="info">
                <p><i class="fa-solid fa-location-dot"></i><?php echo $card->characteristics[0]; ?></p>
                <p><i class="fa-solid fa-tag"></i><?php echo $card->characteristics[1]; ?></p>
                <a href="profile.php">
                    <p><i class="fa-solid fa-user"></i><?php echo $card->characteristics[2]; ?></p>
                </a>
                <p><i class="fa-solid fa-calendar-days"></i><?php echo $card->characteristics[3]; ?></p>
            </section>

            <section class="info">
                <p><i class="fa-solid fa-expand"></i><?php echo $card->characteristics[4]; ?></p>
                <p><i class="fa-solid fa-toilet"></i><?php echo $card->characteristics[5]; ?></p>
                <p><i class="fa-solid fa-bed"></i><?php echo $card->characteristics[6]; ?></p>
                <p><i class="fa-solid fa-suitcase"></i><?php echo $card->characteristics[7]; ?></p>
            </section>
        </section>

        <section class="buttonWrapper">
            <button class="greenButton">Mas información</button>
            <a href="sendMessage.php"><button class="greenButton" type="button">Solicitar cita</button></a>   
            <a href="sendMessage.php"><button class="greenButton" type="button">Hacer oferta</button></a>               
        </section>

        <h2>Descripción</h2>

        <p class="desc">
            <?php echo $card->description; ?>
        </p>

        <section class="houses"></section>
    </main>

    <?php
        include "../inc/footer.php";
    ?>

</body>

<script>
    changeStyle()
</script>
</html>