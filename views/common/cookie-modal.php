<!--
    Archivo: cookie-modal.html
    En este archivo se define la barra de cookies
    Creado por: Pablo Hernández García el 02/11/2024
    Historial de cambios:
    02/11/2024 - Creado
-->
<?php if (!isset($_COOKIE["canStoreCookies"])) { ?>
<section id="cookies">
    <section class="wrapper">
        <h2>Cookies</h2>
        <p>Este sitio utiliza cookies para almacenar cierta información como:</p>
        <ul>
            <li>Tema seleccionado</li>
            <li>Sesión iniciada (si se desea)</li>
            <li>Últimas páginas visitadas</li>
        </ul>
        <section class="buttons">
            <button onclick="cookieModalResponse(true) " class="greenButton">Aceptar</button>
            <button onclick="cookieModalResponse(false)" class="redButton">Rechazar</button>
        </section>
    </section>
</section>

<dialog id="accepted">
    <header>
        <h2>Detalles de las cookies</h2>
        <button onclick="closeCookieModal(1)"><i class="fa-solid fa-x"></i></button>
    </header>
    <main>
        <p>Has aceptado las cookies, ahora puedes guardar tu tema seleccionado.</p>
        <p>Siempre puedes cambiar de opinión desde la página de Cookies en el footer</p>
    </main>
    <footer></footer>
</dialog>

<dialog id="denied" >
    <header>
        <h2>Detalles de las cookies</h2>
        <button onclick="closeCookieModal(2)"><i class="fa-solid fa-x"></i></button>
    </header>
    <main>
        <p>Has rechazado las cookies, ahora tu tema seleccionado no se guardará.</p>
        <p>Siempre puedes cambiar de opinión desde la página de Cookies en el footer</p>
    </main>
    <footer></footer>
</dialog>
<?php } ?>