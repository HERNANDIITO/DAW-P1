<?php
// Conexión a la base de datos
$conn = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error al conectar con la base de datos: " . $conn->connect_error);
}

// Obtener el ID del anuncio desde la sesión
session_start();
$adId = $_SESSION['AdId'];

// Obtener los datos del formulario
$tipoAnuncio = $_POST['tipoAnuncio']; // TAnuncio
$tipoVivienda = $_POST['tipoVivienda']; // TVivienda
$pais = $_POST['pais']; // Pais
$titulo = $_POST['titulo']; // Titulo
$descripcion = $_POST['descripcion']; // Texto
$foto = ""; // Foto (de ejemplo que todavia no esta implementado)
$alternativo = ""; // Alternativo
$precio = $_POST['precio']; // Precio
$ciudad = $_POST['ciudad']; // Ciudad
$superficie = $_POST['superficie']; // Superficie
$habitaciones = $_POST['habitaciones']; // Nhabitaciones
$banyos = $_POST['banyos']; // Nbanyos
$planta = $_POST['planta']; // Planta
$anyo = $_POST['anyo']; // Anyo

// Validar los datos del formulario
if (
    !isset($tipoAnuncio) ||
    !isset($tipoVivienda) ||
    !isset($pais) ||
    !isset($titulo) ||
    !isset($descripcion) ||
    !isset($foto) ||
    !isset($alternativo) ||
    !isset($precio) ||
    !isset($ciudad) ||
    !isset($superficie) ||
    !isset($habitaciones) ||
    !isset($banyos) ||
    !isset($planta) ||
    !isset($anyo)
) {
    header('Location: ../index.php?msg=2');
    exit();
}

if ($anyo < 0 || $planta < 0 || $banyos < 0 || $habitaciones < 0 || $superficie < 0 || $precio < 0) {
    header('Location: ../index.php?msg=1');
    exit();
}

// Obtener el ID del usuario desde la sesión o la cookie
$userID = $_SESSION["userSession"];
if (isset($_COOKIE["rememberedUser"])) {
    $userID = $_COOKIE["rememberedUser"];
}
session_commit();

// Preparar la consulta SQL para actualizar el anuncio
$stmt = $conn->prepare("
    UPDATE Anuncios
    SET TAnuncio = ?, TVivienda = ?, Foto = ?, Alternativo = ?, Titulo = ?, Precio = ?, Texto = ?, Ciudad = ?, Pais = ?, Superficie = ?, Nhabitaciones = ?, Nbanyos = ?, Planta = ?, Anyo = ?, Usuario = ?
    WHERE IdAnuncio = ?
");

if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}

// Vincular los parámetros
$stmt->bind_param("iiissdssiiiiiiii", 
    $tipoAnuncio, 
    $tipoVivienda, 
    $foto, 
    $alternativo, 
    $titulo, 
    $precio, 
    $descripcion, 
    $ciudad, 
    $pais, 
    $superficie, 
    $habitaciones, 
    $banyos, 
    $planta, 
    $anyo, 
    $userID,
    $adId
);

// Ejecutar la consulta
if ($stmt->execute()) {
    header('Location: ../index.php');
} else {
    echo "Error al actualizar el anuncio: " . $stmt->error;
}

// Cerrar la declaración y la conexión
$stmt->close();
$conn->close();
?>