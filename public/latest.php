
<?php

    class Card {
        public $img;
        public $title;
        public $characteristics; //array con las caracteristicas
        public $description;
        public $id;

        public function __construct($id, $img, $title, $characteristics, $description) {
            $this->img = $img;
            $this->title = $title;
            $this->characteristics = $characteristics;
            $this->description = $description;
            $this->id = $id;
        }
    }

    $card1 = new Card(11, "house1.png", "Piso en Madrid",       ["Madrid c/Alfonso XI", "800.000€", "Paco Moreno", "29/03/2025", "90m²", 2, 4, "venta"],        "Este moderno y acogedor piso se encuentra en una de las zonas más exclusivas de Madrid, en el barrio de Chamartín, a solo unos minutos del centro de la ciudad. Con una superficie de 120 metros cuadrados, este piso cuenta con amplios y luminosos espacios, ideales para una vida cómoda y tranquila en la capital.");
    $card2 = new Card(12, "house2.png", "Piso en Valencia",     ["Valencia c/Paiporta III", "330.000€", "Raul Clyde", "12/02/2025", "40m²", 1, 2, "venta"],     "Nos encontramos en un momento crítico tras la devastadora DANA que ha afectado gravemente a diversas localidades de Valencia. Muchas familias han sufrido grandes pérdidas materiales, y las infraestructuras de la ciudad y sus alrededores han quedado seriamente dañadas. Hoy, más que nunca, necesitamos unirnos como comunidad para brindar apoyo a quienes más lo necesitan. Si puedes, te pedimos que contribuyas con cualquier ayuda, ya sea en forma de donativos, ropa, alimentos o incluso tiempo voluntario. Cada pequeño gesto cuenta para que nuestros vecinos puedan superar esta difícil situación.");
    $card3 = new Card(13, "house1.png", "Piso en Bilbao",       ["Bilbao c/Paiporta III", "330.000€", "Raul Clyde", "12/02/2025", "40m²", 1, 2, "venta"],       "Nos encontramos en un momento crítico tras la devastadora DANA que ha afectado gravemente a diversas localidades de Valencia. Muchas familias han sufrido grandes pérdidas materiales, y las infraestructuras de la ciudad y sus alrededores han quedado seriamente dañadas. Hoy, más que nunca, necesitamos unirnos como comunidad para brindar apoyo a quienes más lo necesitan. Si puedes, te pedimos que contribuyas con cualquier ayuda, ya sea en forma de donativos, ropa, alimentos o incluso tiempo voluntario. Cada pequeño gesto cuenta para que nuestros vecinos puedan superar esta difícil situación.");
    $card4 = new Card(14, "house2.png", "Piso en Alicante",     ["Alicante c/Paiporta III", "113.000€", "Raul Clyde", "12/02/2025", "40m²", 1, 2, "venta"],     "Nos encontramos en un momento crítico tras la devastadora DANA que ha afectado gravemente a diversas localidades de Valencia. Muchas familias han sufrido grandes pérdidas materiales, y las infraestructuras de la ciudad y sus alrededores han quedado seriamente dañadas. Hoy, más que nunca, necesitamos unirnos como comunidad para brindar apoyo a quienes más lo necesitan. Si puedes, te pedimos que contribuyas con cualquier ayuda, ya sea en forma de donativos, ropa, alimentos o incluso tiempo voluntario. Cada pequeño gesto cuenta para que nuestros vecinos puedan superar esta difícil situación.");
    $card5 = new Card(15, "house1.png", "Piso en Cartagena",    ["Cartagena c/Paiporta III", "330.000€", "Raul Clyde", "12/02/2025", "40m²", 1, 2, "venta"],    "Nos encontramos en un momento crítico tras la devastadora DANA que ha afectado gravemente a diversas localidades de Valencia. Muchas familias han sufrido grandes pérdidas materiales, y las infraestructuras de la ciudad y sus alrededores han quedado seriamente dañadas. Hoy, más que nunca, necesitamos unirnos como comunidad para brindar apoyo a quienes más lo necesitan. Si puedes, te pedimos que contribuyas con cualquier ayuda, ya sea en forma de donativos, ropa, alimentos o incluso tiempo voluntario. Cada pequeño gesto cuenta para que nuestros vecinos puedan superar esta difícil situación.");
    $card6 = new Card(16, "house2.png", "Piso en Jerez",        ["Jerez c/Paiporta III", "33.000€", "Raul Clyde", "12/02/2025", "40m²", 1, 2, "venta"],        "Nos encontramos en un momento crítico tras la devastadora DANA que ha afectado gravemente a diversas localidades de Valencia. Muchas familias han sufrido grandes pérdidas materiales, y las infraestructuras de la ciudad y sus alrededores han quedado seriamente dañadas. Hoy, más que nunca, necesitamos unirnos como comunidad para brindar apoyo a quienes más lo necesitan. Si puedes, te pedimos que contribuyas con cualquier ayuda, ya sea en forma de donativos, ropa, alimentos o incluso tiempo voluntario. Cada pequeño gesto cuenta para que nuestros vecinos puedan superar esta difícil situación.");
    $card7 = new Card(17, "house1.png", "Piso en Madrid 2",     ["Madrid c/Paiporta III", "330.000€", "Raul Clyde", "12/02/2025", "40m²", 1, 2, "venta"],       "Nos encontramos en un momento crítico tras la devastadora DANA que ha afectado gravemente a diversas localidades de Valencia. Muchas familias han sufrido grandes pérdidas materiales, y las infraestructuras de la ciudad y sus alrededores han quedado seriamente dañadas. Hoy, más que nunca, necesitamos unirnos como comunidad para brindar apoyo a quienes más lo necesitan. Si puedes, te pedimos que contribuyas con cualquier ayuda, ya sea en forma de donativos, ropa, alimentos o incluso tiempo voluntario. Cada pequeño gesto cuenta para que nuestros vecinos puedan superar esta difícil situación.");
    $card8 = new Card(18, "house2.png", "Piso en Hellin",       ["Hellin c/Paiporta III", "55.000€", "Raul Clyde", "12/02/2025", "40m²", 1, 2, "venta"],       "Nos encontramos en un momento crítico tras la devastadora DANA que ha afectado gravemente a diversas localidades de Valencia. Muchas familias han sufrido grandes pérdidas materiales, y las infraestructuras de la ciudad y sus alrededores han quedado seriamente dañadas. Hoy, más que nunca, necesitamos unirnos como comunidad para brindar apoyo a quienes más lo necesitan. Si puedes, te pedimos que contribuyas con cualquier ayuda, ya sea en forma de donativos, ropa, alimentos o incluso tiempo voluntario. Cada pequeño gesto cuenta para que nuestros vecinos puedan superar esta difícil situación.");
    $card9 = new Card(19, "house1.png", "Piso en Tordesillas",  ["Tordesillas c/Paiporta III", "330.000€", "Raul Clyde", "12/02/2025", "40m²", 1, 2, "venta"],  "Nos encontramos en un momento crítico tras la devastadora DANA que ha afectado gravemente a diversas localidades de Valencia. Muchas familias han sufrido grandes pérdidas materiales, y las infraestructuras de la ciudad y sus alrededores han quedado seriamente dañadas. Hoy, más que nunca, necesitamos unirnos como comunidad para brindar apoyo a quienes más lo necesitan. Si puedes, te pedimos que contribuyas con cualquier ayuda, ya sea en forma de donativos, ropa, alimentos o incluso tiempo voluntario. Cada pequeño gesto cuenta para que nuestros vecinos puedan superar esta difícil situación.");
    $card0 = new Card(20, "house2.png", "Mansion Joestar",      ["Joestar c/Paiporta III", "100.000.000€", "Raul Clyde", "12/02/2025", "40m²", 1, 2, "venta"],      "Nos encontramos en un momento crítico tras la devastadora DANA que ha afectado gravemente a diversas localidades de Valencia. Muchas familias han sufrido grandes pérdidas materiales, y las infraestructuras de la ciudad y sus alrededores han quedado seriamente dañadas. Hoy, más que nunca, necesitamos unirnos como comunidad para brindar apoyo a quienes más lo necesitan. Si puedes, te pedimos que contribuyas con cualquier ayuda, ya sea en forma de donativos, ropa, alimentos o incluso tiempo voluntario. Cada pequeño gesto cuenta para que nuestros vecinos puedan superar esta difícil situación.");

    $houses = [ $card1, $card2, $card3, $card4, $card5, $card6, $card7, $card8, $card9, $card0 ];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" media="screen" crossorigin="anonymous"></script>
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/latest.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <title>Últimas visitas</title>
</head>
<body>
    <?php include "../inc/header.php" ?>
    <main id="main-content">
        <h1>Historial</h1>
        <section class="houses">
            <?php foreach( $houses as $house ) { ?>
                <?php if ( in_array( $house->id, $_SESSION["history"] ) ) { ?>
                    <a href="../restricted/cardDetails.php?id=<?php echo $house->id; ?>"> 
                        <section class="card">
                            <img class="mainImg" src="../assets/img/houses/<?php echo $house->img; ?>" alt="">
                            <h1 class="title"><?php echo $house->title; ?></h1>
                            <section class="info">
                                <p><i class="fa-solid fa-location-dot"></i> <?php echo $house->characteristics[0]; ?> </p>
                                <p><i class="fa-solid fa-tag"></i> <?php echo $house->characteristics[1]; ?> </p>
                            </section>
                        </section>
                    </a>
                <?php }; ?>
            <?php }; ?>
        </section>
    </main>
    <?php include "../inc/footer.php" ?>
</body>
</html>