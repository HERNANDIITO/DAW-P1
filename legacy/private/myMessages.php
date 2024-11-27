<!--
    Archivo: myMessages.php
    Archivo dedicado a los mensajes que recibe un usuario que es uno mismo
    Creado por: David González Moreno el 02/10/2024
    Historial de cambios:
    02/10/2024 - Creado
    08/10/2024 - CSS Aplicado
-->


<?php

    session_start();
    $recievedConnection = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");
    $sentConnection     = new mysqli("localhost:3306", "admin", "admin", "fotocasa2");

    $getRecievedMessages = "
        SELECT 
            M.IdMensaje, 
            M.TMensaje, 
            TM.Icono AS TipoMensaje, 
            M.Texto, 
            M.Anuncio, 
            M.UsuarioDestino, 
            A.Titulo AS TituloAnuncio,
            U.NomUsuario AS NombreDestino, 
            M.FRegistro 
        FROM 
            Mensajes M
        JOIN 
            TiposMensajes TM ON M.TMensaje = TM.IdTMensaje
        JOIN 
            Usuarios U ON M.UsuarioDestino = U.IdUsuario
        JOIN 
            Anuncios A ON M.Anuncio = A.IdAnuncio  
        WHERE 
            M.UsuarioOrigen = ?
    ";

    $getSentMessages = "
        SELECT 
            M.IdMensaje, 
            M.TMensaje, 
            TM.Icono AS TipoMensaje, 
            M.Texto, 
            M.Anuncio, 
            M.UsuarioOrigen,
            A.Titulo AS TituloAnuncio,
            U.NomUsuario AS NombreOrigen, 
            M.FRegistro
        FROM 
            Mensajes M
        JOIN 
            TiposMensajes TM ON M.TMensaje = TM.IdTMensaje
        JOIN 
            Usuarios U ON M.UsuarioOrigen = U.IdUsuario
        JOIN 
            Anuncios A ON M.Anuncio = A.IdAnuncio  
        WHERE 
            M.UsuarioDestino = ?;
    ";


    if ( isset($_COOKIE["rememberedUser"]) ) {
        $userID = $_COOKIE["rememberedUser"];
    } else if( isset($_SESSION['userSession']) ) {
        $userID = $_SESSION["userSession"];
    } else {
        header("");
    }

    $recievedMessagesSentence   = $recievedConnection->prepare($getRecievedMessages);
    $sentMessagesSentence       = $sentConnection    ->prepare($getSentMessages);

    $recievedMessagesSentence->bind_param("i",$userID);
    $sentMessagesSentence    ->bind_param("i",$userID);
    
    $recievedMessagesSentence->execute();
    $sentMessagesSentence    ->execute();

    $recievedMessagesResult = $recievedMessagesSentence->get_result();
    $sentMessagesResult     = $sentMessagesSentence    ->get_result();
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
        href="../styles/<?php include '../inc/styleSelector.php' ?>/message.css"
        title="<?php include '../inc/styleSelector.php' ?>"
        id="<?php include '../inc/styleSelector.php' ?>"
    >
    <script src="https://kit.fontawesome.com/fb64e90a7d.js" crossorigin="anonymous"></script>
    <script src="../js/common.js" media="screen" crossorigin="anonymous"></script>
    <title>Mis mensajes</title>
</head>
<body>
<?php include "../inc/header.php"; ?>
    <main id="main-content">
        <h1 class="title">Mis mensajes</h1>

        <section class="content">
            <section class="inMessages">
                <h2 class="title">Recibidos (<?php echo $recievedMessagesResult->num_rows ?>)</h2>
                <section class="messages">
                    <?php while ( $recievedMessage = $recievedMessagesResult->fetch_assoc() ) { ?>
                        <section class="message">
                            <section class="messageContent">
                                <p><?php echo $recievedMessage['Texto'] ?></p>
                            </section>
                            <hr class="solid">
                            <section class="messageInfo">
                                <span><?php echo $recievedMessage['FRegistro'] ?></span>

                                <a href="../restricted/profile.php?idUsuario=<?php echo $recievedMessage['UsuarioDestino'] ?>">
                                    <span><?php echo $recievedMessage['NombreDestino'] ?></span>
                                </a>

                                <a href="./viewAd.php?id=<?php echo $recievedMessage['Anuncio'] ?>">
                                    <span><?php echo $recievedMessage['TituloAnuncio'] ?></span>
                                </a>

                                <i class="fa-solid <?php echo $recievedMessage['TipoMensaje'] ?>"></i> 
                            </section>
                        </section>
                    <?php } ?>
                </section>
            </section>
            <section class="outMessages">
                <h2 class="title">Enviados (<?php echo $sentMessagesResult->num_rows ?>)</h2>
                <section class="messages">   
                    <?php while ( $sentMessage = $sentMessagesResult->fetch_assoc() ) { ?>
                        <section class="message">
                            <section class="messageContent">
                            <p><?php echo $sentMessage['Texto'] ?></p>
                            </section>
                            <hr class="solid">
                            <section class="messageInfo">
                                <span><?php echo $sentMessage['FRegistro'] ?></span>
                                
                                <a href="../restricted/profile.php?id=<?php echo $sentMessage['UsuarioOrigen'] ?>">
                                    <span><?php echo $sentMessage['NombreOrigen'] ?></span>
                                </a>

                                <a href="../restricted/cardDetails.php?id=<?php echo $sentMessage['Anuncio'] ?>">
                                    <span><?php echo $sentMessage['TituloAnuncio'] ?></span>
                                </a>

                                <i class="fa-solid <?php echo $sentMessage['TipoMensaje'] ?>"></i> 
                            </section>
                        </section>
                    <?php } ?>
                </section>
            </section>
        </section>
    </main>

    <?php include "../inc/footer.php"; ?>
    <?php
        $recievedMessagesSentence->close();
        $sentMessagesSentence    ->close();

        $recievedConnection->close();
        $sentConnection    ->close();
    ?>

</body>
</html>