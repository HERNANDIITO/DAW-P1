/*
    Archivo: common.js
    En este archivo se definen las funciones comunes que se usaran a lo largo de toda la web
    Creado por: Pablo Hernández el 24/09/2024
    Historial de cambios:
    24/09/2024 - Creado
    24/09/2024 - Añadidas las primeras funciones
*/

// Inicializa una cookie
function  setCookie(c_name, value, expiredays) {
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
        setCookie("canStoreCookies", "true", 45)
    } else {
        modal = getSelectedModal(2);
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

function removeCookie(cookieName) {
    const cookieValue = "";
    const cookieLifetime = -1;
    const date = new Date();

    date.setTime(date.getTime()+(cookieLifetime*24*60*60*1000));

    const expires = "; expires="+date.toGMTString();

    document.cookie = cookieName + "=" + JSON.stringify(cookieValue) + expires + "; path=/";

}

// Style selection

function selectStyle(style) {
    if ( localStorage.getItem("canStoreCookies") == "true" ) {
        setCookie("style", style, 45);
    }

    sessionStorage.setItem("style", style)
    window.location.reload();
}


// Cerrar sesion
function logout() {
    removeCookie("PHPSESSID");
    removeCookie("rememberedUser");
    window.location.replace("/");
}