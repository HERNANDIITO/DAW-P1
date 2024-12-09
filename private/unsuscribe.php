<!--
    Archivo: myProfile.php
    Archivo dedicado a los detalles de perfil de un usuario que es uno mismo
    Creado por: Pablo Hernández García el 20/09/2024
    Historial de cambios:
    20/09/2024 - Creado
    01/10/2024 - Desarrollado
    08/10/2024 - CSS Aplicado
-->

<?php

    $conn = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
    // Resultado final

    $resultados = [
        'nombreUsuario' => null,
        'cantidadAnuncios' => 0,
        'anunciosConFotos' => [],
        'cantidadTotalFotos' => 0,
    ];

    session_start();

    $userID = $_SESSION["userSession"];

    if ( isset($_COOKIE["rememberedUser"]) ) {
        $userID = $_COOKIE["rememberedUser"];
    }

    session_commit();

    $stmt = $conn->prepare("SELECT NomUsuario FROM usuarios WHERE IdUsuario = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resultados['nombreUsuario'] = $result->fetch_assoc()['NomUsuario'];
    }

    $stmt->close();

    $stmt = $conn->prepare("SELECT COUNT(*) AS CantidadAnuncios FROM anuncios WHERE Usuario = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resultados['cantidadAnuncios'] = $result->fetch_assoc()['CantidadAnuncios'];
    }

    $stmt->close();

    $stmt = $conn->prepare("
        SELECT 
            a.Titulo AS NombreAnuncio, 
            COUNT(f.IdFoto) AS CantidadFotos
        FROM 
            anuncios a
        LEFT JOIN 
            fotos f ON a.IdAnuncio = f.Anuncio
        WHERE 
            a.Usuario = ?
        GROUP BY 
            a.IdAnuncio
    ");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $resultados['anunciosConFotos'][] = [
            'nombreAnuncio' => $row['NombreAnuncio'],
            'cantidadFotos' => $row['CantidadFotos'],
        ];
    }

    $stmt->close();

    $stmt = $conn->prepare("
        SELECT COUNT(f.IdFoto) AS CantidadFotosTotales
        FROM anuncios a
        JOIN fotos f ON a.IdAnuncio = f.Anuncio
        WHERE a.Usuario = ?
    ");

    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $resultados['cantidadTotalFotos'] = $result->fetch_assoc()['CantidadFotosTotales'];
    }

    $stmt->close();

    $conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/unsuscribe.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/myProfile.js"></script>
    <script src="../js/common.js"></script>
    <title>Darse de baja</title>

</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <h2> ¿Seguro que quiere darse de baja? </span> </h2>
        <section class="wrapper">
            <span> Todo lo relacionado con esta cuenta será eliminado: </span>
            <span class="total">
                <p>Total de anuncios: <?php echo $resultados['cantidadAnuncios'] ?>   </p>
                <p>Total de fotos:    <?php echo $resultados['cantidadTotalFotos'] ?> </p>
            </span>
    
            <hr>
    
            <section class="ads">
                <?php foreach ($resultados['anunciosConFotos'] as $anuncio) { ?>
                    <span><?php echo "  - " . $anuncio['nombreAnuncio'] . ": " . $anuncio['cantidadFotos'] . " fotos\n"; ?></span>
                <?php } ?>
            </section>

            <hr>

            <section class="buttons" >
                
                <a href="../phpAdds/unsuscribe-response.php">
                    <button class="greenButton">
                        Aceptar
                    </button>
                </a>

                <a href="./myProfile.php">
                    <button class="redButton">
                        Rechazar
                    </button>
                </a>

            </section>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>
</body>
</html>
