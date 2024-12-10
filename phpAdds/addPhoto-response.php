<?php

$altText = $_POST['altText'];
$title = $_POST['title'];
$adSelect = $_POST['adSelect'];
$file = $_FILES['photo'];

session_start();
    
$userID = $_SESSION["userSession"];

if ( isset($_COOKIE["rememberedUser"]) ) {
    $userID = $_COOKIE["rememberedUser"];
}

session_commit();

if (!isset($altText, $title, $adSelect) || !isset($file)) {
    header("Location: ./addPhoto.php?msg=3&id=".$adSelect);
    exit;
}

if (empty($adSelect)) {
    header("Location: ./addPhoto.php?msg=4&id=".$adSelect);
    exit;
}

if ($file['error'] !== UPLOAD_ERR_OK) {
    header("Location: ./addPhoto.php?msg=5&id=".$adSelect);
    exit;
}

$allowedTypes = ['image/jpeg', 'image/png'];
if (!in_array($file['type'], $allowedTypes)) {
    header("Location: ./addPhoto.php?msg=6&id=".$adSelect);
    exit;
}

if ( strlen($altText) < 10 ) {
    header("Location: ./addPhoto.php?msg=7&id=".$adSelect);
    exit;
}

if (  str_starts_with($altText, "Foto") || str_starts_with($altText, "Imagen") ) {
    header("Location: ./addPhoto.php?msg=7&id=".$adSelect);
    exit;
}

// Conectar a la base de datos
$conn = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Insertar la foto en la base de datos
$query = "
    INSERT INTO Fotos (Titulo, Fichero, Alternativo, Anuncio)
    VALUES (?, ?, ?, ?)
";

$stmt = $conn->prepare($query);

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

$stmt->bind_param("sssi", $title, $photoDBPath, $altText, $adSelect);

if ($stmt->execute()) {
    header("Location: ../private/viewAd.php?msg=8&id=".$adSelect);

} else {
    echo "Error al insertar la foto: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
