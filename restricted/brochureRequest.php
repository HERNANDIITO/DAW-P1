<!--
    Archivo: profile.php
    En este archivo se la solicitud de folleto
    Creado por: David González Moreno el 03/10/2024
    Historial de cambios:
    03/10/2024 - Creado
    08/10/2024 - CSS Aplicado
-->

<?php
    // Obtener el ID de la carta desde la URL
    if ( !isset($_SESSION['userSession']) ) {
        header('');
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    session_start();
    $connection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");

    $query = "SELECT IdAnuncio, Titulo FROM Anuncios WHERE Usuario = ?";

    if ( isset($_COOKIE["rememberedUser"]) ) {
        $userID = $_COOKIE["rememberedUser"];
    } else {
        $userID = $_SESSION["userSession"];
    }

    $stmt = $connection->prepare($query);
    $stmt->bind_param("i",$userID);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_all(MYSQLI_ASSOC);

    session_commit();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link 
        rel="stylesheet" 
        media="screen" 
        href="../styles/<?php include '../inc/styleSelector.php' ?>/brochureRequest.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="../js/brochureRequest.js" ></script>
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
        <title>Registro</title>
</head>
<body>
    <?php include "../inc/header.php"; ?>

    <main id="main-content">
        <h1>Solicitar folleto</h1>

        <h2>Tarifas</h2>
        <section class="payTable">
            <table>
                <tr>
                    <th>Concepto</th>
                    <th>Tarifa</th>
                </tr>
                <tr>
                    <td>Coste procesamiento y envio</td>
                    <td>10€</td>
                </tr>
                <tr>
                    <td>&lt; 5 paginas</td>
                    <td>2€ por pagina</td>
                </tr>
                <tr>
                    <td>Entre 5 y 10 paginas</td>
                    <td>1.8€ por pagina</td>
                </tr>
                <tr>
                    <td>&gt; 10 paginas</td>
                    <td>1.6€ por pagina</td>
                </tr>
                <tr>
                    <td>Blanco y negro</td>
                    <td>0€ </td>
                </tr>
                <tr>
                    <td>Color</td>
                    <td>0.5€ por foto</td>
                </tr>
                <tr>
                    <td>Resolución &lt;= de 300dpi</td>
                    <td>0€ por foto</td>
                </tr>
                <tr>
                    <td>Resolución &gt; de 300dpi</td>
                    <td>0.2€ por foto</td>
                </tr>
            </table>

            <button onclick="showModal()" class="greenButton">Ver precios</button>
            <button onclick="showModal2()" class="greenButton">Ver precios (PHP)</button>
        </section>

        <h2>Fomulario solicitud</h2>
        <p>Rellena el siguiente formulario aportando todos los detalles para confeccionar tu folleto publicitario</p>
        <p>Los campos marcados con un asterisco (*) son obligatorios</p>

        <form action="brochureResponse.php" method="post">
            <!-- Nombre -->
            <section class="inputGroup">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" maxlength="200" required>
            </section>
            
            <!-- Correo electrónico -->
            <section class="inputGroup">
                <label for="email">Correo electrónico</label>
                <input type="email" id="email" name="email" maxlength="200" required>
            </section>
            
    
            <!-- Texto adicional -->
            <section class="inputGroup">
                <label for="textoAdicional">Texto adicional</label>
                <textarea id="textoAdicional" name="textoAdicional" maxlength="4000" rows="6"></textarea>
            </section>
            
    
            <!-- Dirección -->

            <fieldset>

                <legend id="direccion">Dirección:</legend>
                <section class="inputGroup">
                    <label for="calle">Calle:</label>
                    <input type="text" id="calle" name="calle" required>
                </section>
                
                <section class="inputGroup">
                    <label for="numero">Número:</label>
                    <input type="number" id="numero" name="numero" required>
                </section>
                
                <section class="inputGroup">
                    <label for="piso">Piso:</label>
                    <input type="number" id="piso" name="piso">
                </section>
                
                <section class="inputGroup">
                <label for="puerta">Puerta:</label>
                <input type="text" id="puerta" name="puerta">
                </section>
                
                <section class="inputGroup">
                    <label for="codigoPostal">Código Postal:</label>
                    <input type="number" id="codigoPostal" name="codigoPostal" required>
                </section>
                
                <section class="inputGroup">
                    <label for="localidad">Localidad:</label>
                    <input type="text" id="localidad" name="localidad" required>
                </section>
                
                <section class="inputGroup">
                    <label for="provincia">Provincia:</label>
                    <input type="text" id="provincia" name="provincia" required>
                </section>
                
                <section class="inputGroup">
                    <label for="pais">País:</label>
                    <input type="text" id="pais" name="pais" required>
                </section>
            </fieldset>
            
            
            <!-- Teléfono -->
            <section class="inputGroup">
                <label for="telefono">Teléfono</label>
                <input type="number" id="telefono" name="telefono">
            </section>
            
            
            <!-- Color de la portada -->
            <section class="inputGroup">
                <label for="colorPortada">Color de la portada</label>
                <input type="color" id="colorPortada" name="colorPortada" value="#000000">
            </section>
            
    
            <!-- Número de copias -->
            <section class="inputGroup">
                <label for="numCopias">Número de copias</label>
                <input onchange="updatePrice()" type="number" id="numCopias" name="numCopias" min="1" max="99" value="1">
            </section>

            <!-- Número de fotos -->
            <section class="inputGroup">
                <label for="numFotos">Número de fotos</label>
                <input onchange="updatePrice()" type="number" id="numFotos" name="numFotos" min="1" max="99" value="1">
            </section>
            
    
            <!-- Resolución de las fotos -->
            <section class="inputGroup">
                <label for="resFotos">Resolución de las fotos</label>
                <select onchange="updatePrice()" id="resFotos" name="resFotos" required>
                    <option value="150">150</option>
                    <option value="300">300</option>
                    <option value="450">450</option>
                    <option value="600">600</option>
                    <option value="750">750</option>
                    <option value="900">900</option>
                    <!-- Aquí se añadirán dinámicamente los anuncios del usuario -->
                </select>
            </section>
            
            <!-- Anuncio del usuario -->
            <section class="inputGroup">
                <label for="anuncioUsuario">Anuncio del usuario</label>
                <select id="anuncioUsuario" name="anuncioUsuario" required>
                    <?php foreach ($rows as $row) { ?>
                        <option value="<?php echo $row['IdAnuncio'] ?>"><?php echo $row['Titulo'] ?></option>
                    <?php } ?>
                </select>
            </section>
    
            <!-- Fecha de recepción -->
            <section class="inputGroup">
                <label for="fechaRecepcion">Fecha de recepción</label>
                <input type="date" id="fechaRecepcion" name="fechaRecepcion">
            </section>
            
    
            <!-- Impresión a color -->
            <section class="inputGroup">    
                <label>Impresión a color:</label>
                <section class="radioGroup">

                    <section class="radio">
                        <label for="blancoNegro">Blanco y negro</label>
                        <input onchange="updatePrice()" type="radio" id="blancoNegro" name="impresionColor" value="blancoNegro" checked>
                    </section>
                    <section class="radio">
                        <label for="color">A todo color</label>
                        <input onchange="updatePrice()" type="radio" id="color" name="impresionColor" value="color">
                    </section>
                </section>
            </section>
            
    
            <!-- Impresión del precio -->
            <section class="inputGroup">
                <label>Impresión del precio:</label>
                <section class="radioGroup">
                    <section class="radio">
                        <label for="conPrecio">Con precio</label>
                        <input type="radio" id="conPrecio" name="impresionPrecio" value="conPrecio" checked>
                    </section>
                    <section class="radio">
                        <label for="sinPrecio">Sin precio</label>
                        <input type="radio" id="sinPrecio" name="impresionPrecio" value="sinPrecio">
                    </section>
                </section>
            </section>

            <section class="price">
                <section class="label" >Precio</section>
                <section id="price" >Calculando...</section>
            </section>
            <!-- precio hidden para recogerlo con php -->
            <input type="hidden" id="precioTotalphp" name="precioTotalphp">
            
            <button class="greenButton" type="submit">Enviar solicitud</button> 
        </form>
    </main>
    
    <?php include "../inc/footer.php"; ?>

    <dialog id="details">

        <header>
            <h2>Detalles de los precios</h2>
            <button onclick="closeModal()"><i class="fa-solid fa-x"></i></button>
        </header>
        <main>
            <table id="price-table"></table>
        </main>
        <footer></footer>
    </dialog>


    <dialog id="detailsPHP">
        <header>
            <h2>Detalles de los precios</h2>
            <button onclick="closeModal2()"><i class="fa-solid fa-x"></i></button>
        </header>
        <main>
            <?php
                include '../phpAdds/brochureTableCalc.php';
                echo generateTable();
            ?>
        </main>
        <footer></footer>
    </dialog>



    <script>
        init()
    </script>

</body>
</html>

<?php
    $stmt->close();
    $connection->close();
?>