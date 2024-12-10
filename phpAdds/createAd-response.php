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
    
    $tipoAnuncio = $_POST['tipoAnuncio']; // TAnuncio
    $tipoVivienda = $_POST['tipoVivienda']; // TVivienda
    $pais = $_POST['pais']; // Pais
    $titulo = $_POST['titulo']; // Titulo
    $descripcion = $_POST['descripcion']; // Texto
    $foto = ""; // Foto
    $alternativo = ""; // Alternativo
    $precio = $_POST['precio']; // Precio
    $ciudad = $_POST['ciudad']; // Ciudad
    $superficie = $_POST['superficie']; // Superficie
    $habitaciones = $_POST['habitaciones']; // Nhabitaciones
    $banyos = $_POST['banyos']; // Nbanyos
    $planta = $_POST['planta']; // Planta
    $anyo = $_POST['anyo']; // Anyo

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
    }

    if ( $anyo < 0 || $planta < 0 || $banyos < 0 || $habitaciones < 0 || $superficie < 0 || $precio < 0  ) {
        header('Location: ../index.php?msg=1');
    }
    
    session_start();
    
    $userID = $_SESSION["userSession"];

    if ( isset($_COOKIE["rememberedUser"]) ) {
        $userID = $_COOKIE["rememberedUser"];
    }

    session_commit();

    $query = "
        INSERT INTO Anuncios
        (TAnuncio, TVivienda, Pais, Titulo, Texto, Usuario, Alternativo)
        VALUES (?, ?, ?, ?, ?, ?, ?)
    ";

    $stmt = $conn->prepare("
        INSERT INTO Anuncios
        (TAnuncio, TVivienda, Foto, Alternativo, Titulo, Precio, Texto, Ciudad, Pais, Superficie, Nhabitaciones, Nbanyos, Planta, Anyo, Usuario) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    if ($stmt === false) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("iiissdssiiiiiii", 
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
        $userID
    );

    if ($stmt->execute()) {
        $anuncioID = $mysqli->insert_id;
        header('Location: ../index.php');
    } else {
        echo "Error al insertar el anuncio: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
?>