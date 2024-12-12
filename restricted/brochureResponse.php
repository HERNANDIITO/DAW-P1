<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Validate that the form is submitted via POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Acceso no autorizado');
}

// Database connection
$connection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");

// Check connection
if ($connection->connect_error) {
    die("Error de conexión: " . $connection->connect_error);
}

// Prepare the SQL statement
$query = "INSERT INTO Solicitudes (
    Anuncio, 
    Texto, 
    Nombre, 
    Email, 
    Direccion, 
    Telefono, 
    Color, 
    Copias, 
    Resolucion, 
    Fecha, 
    IColor, 
    IPrecio, 
    Coste
) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare the statement
$stmt = $connection->prepare($query);

// Construct full address
$direccion = implode(', ', [
    $_POST['calle'] . ' ' . $_POST['numero'],
    !empty($_POST['piso']) ? 'Piso: ' . $_POST['piso'] : '',
    !empty($_POST['puerta']) ? 'Puerta: ' . $_POST['puerta'] : '',
    $_POST['codigoPostal'] . ' ' . $_POST['localidad'],
    $_POST['provincia'] . ', ' . $_POST['pais']
]);

// Prepare input data
$anuncio = $_POST['anuncioUsuario'];
$texto = $_POST['textoAdicional'] ?? '';
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'] ?? null;
$color = $_POST['colorPortada'];
$copias = $_POST['numCopias'];
$resolucion = $_POST['resFotos'];
$fecha = !empty($_POST['fechaRecepcion']) ? $_POST['fechaRecepcion'] : null;

// Convert color printing to boolean
$iColor = $_POST['impresionColor'] === 'color' ? 1 : 0;
$iPrecio = $_POST['impresionPrecio'] === 'conPrecio' ? 1 : 0;

// Coste (price) from hidden input
$coste = $_POST['precioTotalphp'];

// Bind parameters
$stmt->bind_param(
    "issssssiissdd", 
    $anuncio, 
    $texto, 
    $nombre, 
    $email, 
    $direccion, 
    $telefono, 
    $color, 
    $copias, 
    $resolucion, 
    $fecha, 
    $iColor, 
    $iPrecio, 
    $coste
);

// Execute the statement
try {
    $result = $stmt->execute();
    
    if (!$result) {
        // If insertion fails, throw an exception
        throw new Exception($stmt->error);
    }
} catch (Exception $e) {
    // Store error in session to display on the page
    $_SESSION['insert_error'] = $e->getMessage();
}

// Close statement and connection
$stmt->close();
$connection->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/brochureResponse.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >

    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <title>Folleto</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main>
        <?php if (isset($_SESSION['insert_error'])): ?>
            <section class="error-message">
                <h2>Error al guardar la solicitud</h2>
                <p><?php echo htmlspecialchars($_SESSION['insert_error']); ?></p>
                <?php unset($_SESSION['insert_error']); ?>
            </section>
        <?php endif; ?>

        <section class="formResult">
            <!-- Nombre -->
            <section class="inputGroup">
                <label>Nombre:</label>
                <span><?php echo htmlspecialchars($_POST['nombre']); ?></span>
            </section>

            <!-- Correo electrónico -->
            <section class="inputGroup">
                <label>Correo electrónico:</label>
                <span><?php echo htmlspecialchars($_POST['email']); ?></span>
            </section>

            <!-- Texto adicional -->
            <section class="inputGroup">
                <label>Texto adicional:</label>
                <span><?php echo htmlspecialchars($_POST['textoAdicional']); ?></span>
            </section>

            <!-- Dirección -->
            <fieldset>
                <legend>Dirección:</legend>
                <section class="inputGroup">
                    <label>Calle:</label>
                    <span><?php echo htmlspecialchars($_POST['calle']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Número:</label>
                    <span><?php echo htmlspecialchars($_POST['numero']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Piso:</label>
                    <span><?php echo htmlspecialchars($_POST['piso']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Puerta:</label>
                    <span><?php echo htmlspecialchars($_POST['puerta']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Código Postal:</label>
                    <span><?php echo htmlspecialchars($_POST['codigoPostal']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Localidad:</label>
                    <span><?php echo htmlspecialchars($_POST['localidad']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>Provincia:</label>
                    <span><?php echo htmlspecialchars($_POST['provincia']); ?></span>
                </section>

                <section class="inputGroup">
                    <label>País:</label>
                    <span><?php echo htmlspecialchars($_POST['pais']); ?></span>
                </section>
            </fieldset>

            <!-- Teléfono -->
            <section class="inputGroup">
                <label>Teléfono:</label>
                <span><?php echo htmlspecialchars($_POST['telefono']); ?></span>
            </section>

            <!-- Color de la portada -->
            <section class="inputGroup">
                <label>Color de la portada:</label>
                <span><?php echo htmlspecialchars($_POST['colorPortada']); ?></span>
            </section>

            <!-- Número de copias -->
            <section class="inputGroup">
                <label>Número de copias:</label>
                <span><?php echo htmlspecialchars($_POST['numCopias']); ?></span>
            </section>

            <!-- Resolución de las fotos -->
            <section class="inputGroup">
                <label>Resolución de las fotos:</label>
                <span><?php echo htmlspecialchars($_POST['resFotos']); ?></span>
            </section>

            <!-- Anuncio del usuario -->
            <section class="inputGroup">
                <label>Anuncio del usuario:</label>
                <span><?php echo htmlspecialchars($_POST['anuncioUsuario']); ?></span>
            </section>

            <!-- Fecha de recepción -->
            <section class="inputGroup">
                <label>Fecha de recepción:</label>
                <span><?php echo htmlspecialchars($_POST['fechaRecepcion']); ?></span>
            </section>

            <!-- Impresión a color -->
            <section class="inputGroup">
                <label>Impresión a color:</label>
                <span><?php echo htmlspecialchars($_POST['impresionColor']); ?></span>
            </section>

            <!-- Impresión del precio -->
            <section class="inputGroup">
                <label>Impresión del precio:</label>
                <span><?php echo htmlspecialchars($_POST['impresionPrecio']); ?></span>
            </section>

            <!-- Precio -->
            <section class="inputGroup">
                <label>Coste:</label>
                <span><?php echo htmlspecialchars($_POST['precioTotalphp']); ?></span>
            </section>

            <a href="cardDetails.php">
                <button class="greenButton" type="submit">Confirmar solicitud</button> 
            </a>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>
</body>
</html>