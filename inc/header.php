<?php

    function getMessage(): string {
        $returnValue = "";

        date_default_timezone_set('Europe/Madrid');
        $hora = date('H:i');

        if ($hora >= "06:00" && $hora <= "11:59") {
            $returnValue = "Buenos días Pepito";
        } elseif ($hora >= "12:00" && $hora <= "15:59") {
            $returnValue = "Hola Pepito";
        } elseif ($hora >= "16:00" && $hora <= "19:59") {
            $returnValue = "Buenas tardes Pepito";
        } else {
            $returnValue = "Buenas noches Pepito";
        }

        return $returnValue;
    }

?>

<?php  if ( false )  { ?>

    <header class="mainHeader">
        <nav id="navBar">
            <section class="links">
                <a class="navLink" href="/"> <i class="fa-solid fa-house"></i> <span>Inicio</span></a>
                <a class="navLink" href="/public/search.php"> <i class="fa-solid fa-magnifying-glass"></i> <span>Búsqueda</span></a>
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
                <a class="navLink" href="/public/styles.php"> <i class="fa-solid fa-pencil"></i> <span>Estilos</span></a>
            </section>
            <section class="profile">
                <a class="navLink" href="/private/myProfile.php"> <i class="fa-solid fa-user"></i> <span>Perfil</span> </a>
                <a class="navLink" href="/index.php"> <i class="fa-solid fa-right-to-bracket"></i> <span>Cerrar sesión</span> </a>
            </section>            
        </nav>
        <section class="welcomeMessage">
            <p><?php echo getMessage() ?></p>
        </section>
    </header>
    
<?php } ?>