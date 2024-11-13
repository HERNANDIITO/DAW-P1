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
    </header>
    
<?php } ?>