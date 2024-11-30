
<?php  session_start(); ?>
    <?php if (isset($_SESSION['welcomeMessage']) && !isset( $_SESSION['alreadyShown'])): ?>
        <?php $_SESSION['alreadyShown'] = true ?>
        <div id="welcomeModal" class="modal">
            <div class="modal-content">
                <span><?php echo $_SESSION['welcomeMessage']; ?></span>
                <button onclick="closeWelcomeModal()" id="closeModalButton" class="close-button">Cerrar</button>
            </div>
        </div>

        <?php
            // Eliminar el mensaje de error después de mostrarlo
            unset($_SESSION['welcomeMessage']);
        ?>
    <?php endif; ?>
<?php  session_commit(); ?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" media="print" href="./styles/print/index.css"/>
    <!-- Diselxia -->
    <link
        rel="stylesheet"
        media="screen"
        href="views/styles/<?php include 'views/common/styleSelector.php' ?>/index.css"   
        title="<?php include 'views/common/styleSelector.php' ?>"
        id="<?php include 'views/common/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" media="screen" crossorigin="anonymous"></script>
    <script src="views/js/common.js" media="screen" crossorigin="anonymous"></script>
    <script src="views/js/index.js" media="screen" crossorigin="anonymous"></script>
    <title><?php echo $data['title']?></title>
</head>
<body>
    <main id="main-content">
        <h1 class="mainTitle">FOTOCASA 2</h1>
        <section class="search">
            <label for="search">Búsqueda rápida</label>
            <input name="search" type="text">
        </section>
        <section class="houses">
            <?php foreach ($data['newest'] as $row) { ?>
                    <a href="<?php echo urlRESTRICTED . urlACTION . 'cardDetails' . '&id=' . $row['IdAnuncio'] ?>">
                        <section class="card">
                            <img class="mainImg" src="assets/img/houses/<?php echo $row['Foto'] ?>" alt="<?php echo $row['Alternativo'] ?>">
                            <h1 class="title"><?php echo $row['Titulo']?></h1>
                            <section class="info">
                                <p><i class="fa-solid fa-location-dot"></i> <?php echo $row['IdAnuncio']?></p>
                                <p><i class="fa-solid fa-tag"></i> <?php echo $row['Precio']?>€</p>
                            </section>
                        </section>
                    </a>
                <?php
                }
            ?>
        </section>
    </main>
</body>
</html>