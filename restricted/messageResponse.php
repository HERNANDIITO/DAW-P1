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
    <!-- Otros estilos y scripts -->
    <title>Mensaje enviado</title>
</head>
<body>
        
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <?php
            // Definir opciones válidas y obtener datos del formulario
            $validOptions = ["info", "date", "offer"];
            $message = isset($_POST['message']) ? trim($_POST['message']) : '';
            $option = isset($_POST['option']) ? $_POST['option'] : '';

            // Verificar que se haya enviado el mensaje y que la opción sea válida
            if (empty($message)) {
                echo "<h1 class='title'>Error</h1>";
                echo "<p>No se ha escrito ningún mensaje.</p>";
                exit;
            } 
            // (comprobacion que se hace mal, selecciones lo que selecciones da error)
            // elseif (!in_array($option, $validOptions)) {
            //     echo "<h1 class='title'>Error</h1>";
            //     echo "<p>El tipo de mensaje no es válido.</p>";
            //     exit;
            // }

            // Asignar título e ícono según la opción seleccionada
            $typeTitle = "";
            $iconClass = "";

            if ($option == "info") {
                $typeTitle = "Más información solicitada";
                $iconClass = "fa-circle-info";
            } elseif ($option == "date") {
                $typeTitle = "Cita solicitada";
                $iconClass = "fa-calendar-check";
            } elseif ($option == "offer") {
                $typeTitle = "Oferta enviada";
                $iconClass = "fa-handshake";
            }
        ?>

        <h1 class="title">Mensaje enviado</h1>
        <span class="type">
            <h2 class="title"><?php echo $typeTitle; ?></h2>
            <i class="fa-solid <?php echo $iconClass; ?>"></i>
        </span>
        <section class="message">
            <section class="messageContent">
                <p><?php echo htmlspecialchars($message); ?></p>
            </section>
            <hr class="solid">
            <section class="messageInfo">
                <span><?php echo date("d/m/Y"); ?></span>
                <span>Louis Amoeba</span>
            </section>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>


</body>
</html>
