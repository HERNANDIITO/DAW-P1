<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" media="screen" crossorigin="anonymous"></script>
    <link 
        rel="stylesheet" 
        media="screen" 
        href="views/styles/<?php include 'views/common/styleSelector.php' ?>/latest.css"
        title="<?php include 'views/common/styleSelector.php' ?>"
        id="<?php include 'views/common/styleSelector.php' ?>"
    >
    <title><?php echo $data['title']?></title>
</head>
<body>
    <main id="main-content">
        <h1>Historial</h1>
        <section class="houses">
            <?php if ( isset($houses) ) {?> 
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
            <?php } ?>
        </section>
    </main>
</body>
</html>