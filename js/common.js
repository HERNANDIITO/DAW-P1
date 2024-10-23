/*
    Archivo: common.js
    En este archivo se definen las funciones comunes que se usaran a lo largo de toda la web
    Creado por: Pablo Hernández el 24/09/2024
    Historial de cambios:
    24/09/2024 - Creado
    24/09/2024 - Añadidas las primeras funciones
*/

function getHeader() {
    xhr = new XMLHttpRequest();
    xhr.open('GET', "../common/header.html", false);
    xhr.onload = function() {
        const element = document.createElement('nav');
        element.innerHTML = xhr.response.trim();
        element.id = "navBar"
        document.querySelector("body").insertBefore(element, document.querySelector("body").firstChild)
    };
    xhr.send();
}

function getFooter() {
    xhr = new XMLHttpRequest();
    xhr.open('GET', "../common/footer.html", false);
    xhr.onload = function() {
        const element = document.createElement('footer');
        element.innerHTML = xhr.response.trim();
        element.id = "footer"
        document.querySelector("body").appendChild(element)
    };
    xhr.send();
}

function goToIndex() {
    location.href = "index.html";
}

function isLogged() {
    try {
        const usu = JSON.parse(sessionStorage['datosUsu'])
        return usu && `${(usu).LOGIN}:${(usu).TOKEN}` ? `${(usu).LOGIN}:${(usu).TOKEN}` : false; 
    } catch {
        return false;
    }
}

function mustLogOut() {
    if (isLogged()) {
        location.href = "index.html";
    }
}

function mustLogIn() {
    if (!isLogged()) {
        location.href = "index.html";
    }
}

function fillHouses() {
    xhr = new XMLHttpRequest();
    xhr.open('GET', "../common/card.html", false);
    xhr.onload = function() {
        document.querySelector(".houses").innerHTML = xhr.response;
    };
    xhr.send();
}

