<?php
    function getMessage(): string {
        $returnValue = "";
        session_start();

        date_default_timezone_set('Europe/Madrid');
        $hora = date('H:i');

        $user = $_SESSION["userSession"];

        if ( isset($_COOKIE["rememberedUser"]) ) {
            $user = $_COOKIE["rememberedUser"];
        }

        if ($hora >= "06:00" && $hora <= "11:59") { $returnValue = "Buenos días " . $user; }
        elseif ($hora >= "12:00" && $hora <= "15:59") { $returnValue = "Hola " . $user; }
        elseif ($hora >= "16:00" && $hora <= "19:59") { $returnValue = "Buenas tardes " . $user; }
        else { $returnValue = "Buenas noches " . $user; }

        return $returnValue;
    }

?>

<?php  
    if ( !isset($_SESSION["userSession"]) && !isset($_COOKIE["rememberedUser"]) ) {
?>
    <script src="../js/common.js"></script>
    <header class="mainHeader">
        <nav id="navBar">
            <section class="links">
                <a class="navLink" href="/"> <i class="fa-solid fa-house"></i> <span>Inicio</span></a>
                <a class="navLink" href="/public/search.php"> <i class="fa-solid fa-magnifying-glass"></i> <span>Búsqueda</span></a>
                <a class="navLink" href="/public/latest.php"> <i class="fa-solid fa-clock"></i> <span>Últimos visitados</span></a>
                <a class="navLink" href="/public/styles.php"> <i class="fa-solid fa-pencil"></i> <span>Estilos</span></a>
            </section>
            
            <section class="profile">
                <a class="navLink" href="/public/login.php"> <i class="fa-solid fa-user"></i> <span>Iniciar sesión</span> </a>
                <a class="navLink" href="/public/register.php"> <i class="fa-solid fa-right-to-bracket"></i> <span>Registrarse</span> </a>
            </section>
        </nav>
    </header>
    
    <?php } else { ?>

        <header class="mainHeader">
            <nav id="navBar">
                <section class="links">
                    <a class="navLink" href="/"> <i class="fa-solid fa-house"></i> <span>Inicio</span></a>
                    <a class="navLink" href="/public/search.php"> <i class="fa-solid fa-magnifying-glass"></i> <span>Búsqueda</span></a>
                    <a class="navLink" href="/public/latest.php"> <i class="fa-solid fa-clock"></i> <span>Últimos visitados</span></a>
                    <a class="navLink" href="/public/styles.php"> <i class="fa-solid fa-pencil"></i> <span>Estilos</span></a>
            </section>
            <section class="profile">
                <a class="navLink" href="/private/myProfile.php"> <i class="fa-solid fa-user"></i> <span>Perfil</span> </a>
                <a class="navLink" onclick="logout()"> <i class="fa-solid fa-right-to-bracket"></i> <span>Cerrar sesión</span> </a>
            </section>            
        </nav>
        <section class="welcomeMessage">
            <p><?php echo getMessage() ?></p>
        </section>
    </header>
    
<?php } ?>

<?php
    if ( !isset($_SESSION[""]) ) {
        if (file_exists("../common/cookie-modal.php") ) { include "../common/cookie-modal.php"; }
        else { include "./common/cookie-modal.php"; }
    }
    
    session_commit();
    
    if ( file_exists("../phpAdds/authController.php") ) { include "../phpAdds/authController.php"; }
    else { include "./phpAdds/authController.php"; }
?>