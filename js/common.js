/*
    Archivo: common.js
    En este archivo se definen las funciones comunes que se usaran a lo largo de toda la web
    Creado por: Pablo Hernández el 24/09/2024
    Historial de cambios:
    24/09/2024 - Creado
    24/09/2024 - Añadidas las primeras funciones
*/

// Funciones relacionadas con las cookies

function checkCookies() {
    const canStoreCookies = localStorage.getItem("canStoreCookies")
    
    if ( canStoreCookies == undefined ) {
        getCookieModal();
        return;
    }

    if ( canStoreCookies == false ) { return; }
}

// Añade el menú de selección de cookies a cualquier pagina
function getCookieModal() {
    xhr = new XMLHttpRequest();
    xhr.open('GET', "../common/cookie-modal.html", false);
    xhr.onload = function() {
        const element = document.createElement('cookies');
        element.innerHTML = xhr.response.trim();
        element.id = "cookies"
        document.querySelector("body").appendChild(element)
    };
    xhr.send();
}

// Obtiene la cookie indicada por parametro
function getCookie(c_name) {
    if( document.cookie.length > 0 ) {
        c_start = document.cookie.indexOf(c_name + "=");
        if(c_start != -1) {
            c_start = c_start + c_name.length + 1;
            c_end = document.cookie.indexOf(";", c_start);
            if(c_end == -1)
                c_end = document.cookie.length;
                return unescape(document.cookie.substring(c_start, c_end));
        }
    }
    return false;
}

// Inicializa una cookie
function setCookie(c_name, value, expiredays) {
    const date = new Date()
    date.setDate( date.getDate() + expiredays );

    var cookie = `${c_name}=${value}; expires=${date.toUTCString()}; path=/; SameSite=Lax`
    document.cookie = cookie
}

// Controles del modal de las cookies

// Obtiene el HTMLEelement del modal pasado por parametro
function getSelectedModal(modalToClose) {
    var modal;
    switch (modalToClose) {
        case 1:
            modal = document.getElementById("accepted")
            break;
            
        case 2:
            modal = document.getElementById("denied")
            break;
    
        default:
            break;
    }

    return modal;
}

// Onclick de los botones
// Segun la decisión del suaurio invocamos un modal u otro y añadimos al localstorage su decision
function cookieModalResponse(response) {
    var modal;

    if ( response ) {
        modal = getSelectedModal(1);
        setCookie("style", "default", 45)
        localStorage.setItem("canStoreCookies", true) 
    } else {
        modal = getSelectedModal(2);
        localStorage.setItem("canStoreCookies", false) 
    }

    modal.showModal()
    modal.focus()
}

// Cerramos el modal indicado por parametro
function closeCookieModal( modalToClose ) {
    var modal = getSelectedModal(modalToClose);
    modal.close()
    document.getElementById("cookies").remove()

}

// Style selection

function selectStyle(style) {
    if ( localStorage.getItem("canStoreCookies") == "true" ) {
        setCookie("style", style, 45);
    }

    sessionStorage.setItem("style", style)
    window.location.reload();
}
