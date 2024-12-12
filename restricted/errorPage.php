<?php
session_start();

// Recuperar los errores desde la sesión
$errors = isset($_SESSION['flashdata_errors']) ? $_SESSION['flashdata_errors'] : [];
// Limpiar los errores de la sesión
unset($_SESSION['flashdata_errors']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error al Enviar Mensaje</title>
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/errorMessage.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
</head>
<body>
    <?php include "../inc/header.php"; ?>
    <main>
        <h1>Errores en el Envío del Mensaje</h1>
        <section class="errorList">
            <?php if (empty($errors)): ?>
                <p>No se encontraron errores. Por favor, intenta nuevamente.</p>
            <?php else: ?>
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>
        <a href="sendMessage.php" class="redButton">Volver al formulario</a>
    </main>
    <?php include "../inc/footer.php"; ?>
</body>
</html>
