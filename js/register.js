// Archivo: register.js
// En este archivo se define la logica del registro
// Creado por: David González Moreno el 23/10/2024
// Historial de cambios:
// 23/10/2024 - Creado 




//ERROR MESSAGES

function createErrorMessage(fieldId) { //le asigna la id: fieldId + "Error"
    let field = document.getElementById(fieldId);
    const errorMessageElement = document.createElement("p");
    errorMessageElement.style.color = "red";
    errorMessageElement.style.fontSize = "20px";
    errorMessageElement.style.display = "none";  // Oculto inicialmente
    errorMessageElement.id = field.id + "Error";  // Asigna la ID del campo + 'Error'

    // Insertar el mensaje de error justo después del campo
    field.parentNode.insertBefore(errorMessageElement, field.nextSibling);
}

// Función para mostrar mensajes de error
function setErrorMessage(errorMessageId, message) {
    const errorMessage = document.getElementById(errorMessageId);
    if (errorMessage) {
        errorMessage.textContent = message;  // Asigna el texto al mensaje de error
        errorMessage.style.display = "block"; // Muestra el mensaje de error
    } else {
        console.error("Error: No se encontró el elemento con ID " + errorMessageId);
    }
}

// Función para ocultar el mensaje de error
function HideErrorMessage(errorMessageId) {
    document.getElementById(errorMessageId).style.display = "none";
}



// creacion de errorMessages
createErrorMessage("email");
createErrorMessage("user");
createErrorMessage("passInput");
createErrorMessage("pass2");
createErrorMessage("birth");



// Función para comprobar si todos los mensajes de error están ocultos y se habilita el submit button
function checkFormValidity() {
    const errorMessages = document.querySelectorAll('p[id$="Error"]');
    let allErrorsHidden = true;

    errorMessages.forEach(function (errorMessage) {
        if (errorMessage.style.display === "block") {
            allErrorsHidden = false;
        }
    });

    // Habilitar el botón de submit solo si no hay errores visibles
    document.getElementById("submitLoginButton").disabled = !allErrorsHidden;
}

// FORM CHECKS-------------------------------------------------------------------------------------------------

function init() {
    checkEmail("");
    checkUser("");
    checkPass("");
    checkPass2("");
    checkBirthDate("");
}

function checkEnglish(word, slash) {
    value = true;
    for (const letter in word) {
        if (!Object.prototype.hasOwnProperty.call(word, letter)) { return; }

        const element = `${(word[letter])}`;
        if (
            ( element.charCodeAt(0) < 48 ) ||                                       // Comprobamos que no sea un numero
            (!( element.charCodeAt(0) >= 48 || element.charCodeAt(0) <= 57 )) ||    // Comprobamos que no sea un numero
            (!( element.charCodeAt(0) >= 65 || element.charCodeAt(0) <= 90 )) ||    // Comprobamos que no sea una letra
            (!( element.charCodeAt(0) >= 97 || element.charCodeAt(0) <= 122 ))      // Comprobamos que no sea un letra minuscula
        )   {
            if ( slash == true ) { // En caso de esta permitidos los guiones
                if (
                    (element.charCodeAt(0) != 95) && // Comprobamos que no es un guion bajo
                    (element.charCodeAt(0) != 45)    // Comprobamos que no es un guion
                )   { value = false; }
            } else { value = false; }
            break;
        }
    }

    return value;
}

function checkMayusNum(word) {
    mayus = 0;
    minus = 0;
    nums  = 0;

    for (const letter in word) {
        if (!Object.prototype.hasOwnProperty.call(word, letter)) { return; }

        const element = `${(word[letter])}`;
        
        if ( element.charCodeAt(0) >= 65 && element.charCodeAt(0) <= 90 ) { mayus++; }
        if ( element.charCodeAt(0) >= 97 && element.charCodeAt(0) <= 122) { minus++; }
        if ( element.charCodeAt(0) >= 48 && element.charCodeAt(0) <= 57 ) { nums++;  }

    }

    return mayus >= 1 && minus >= 1 && nums >= 1 ? true : false

}

// Email

function checkEmail(value) {
    HideErrorMessage("emailError");

    if ( value.length > 254 ) {
        setErrorMessage("emailError", "demasiado largo");

        checkFormValidity();
        return;
    }
    
    splittedEmail = value.split('@')

    if ( splittedEmail.length < 2 ) {
        setErrorMessage("emailError", "Falta un @");

        checkFormValidity();
        return;
    }

    local = splittedEmail[0]
    domain = splittedEmail[1]
    
    if ( !checkLocal(local) ) {
        setErrorMessage("emailError", "Parte local equivocada");
        
        checkFormValidity();
        return;
    }

    if ( !checkDomain(domain) ) {
        setErrorMessage("emailError", "Dominio equivocado");
        
        checkFormValidity();
        return;
    }

    console.log("Correo apropiado!");
    checkFormValidity();

}

function checkLocal(local) {
    value = true;

    if (local.length <= 0) { return false; }

    for (const letter in local) {
        if (!Object.prototype.hasOwnProperty.call(local, letter)) { return; }
        const element = `${(local[letter])}`;
        if (
            !(( element.charCodeAt(0) >= 65 && element.charCodeAt(0) <= 90 ) || // Comprobamos mayuculas
            ( element.charCodeAt(0) >= 97 && element.charCodeAt(0) <= 122) ||   // Comprobamos minusculas
            ( element.charCodeAt(0) >= 48 && element.charCodeAt(0) <= 57 ) ||   // Comprobamos digitos
            ( element.charCodeAt(0) == 239 ) ||
            ( element === '!' ) ||
            ( element === '#' ) ||
            ( element === '$' ) ||
            ( element === '%' ) ||
            ( element === '&' ) ||
            ( element === '*' ) ||
            ( element === '+' ) ||
            ( element === '-' ) ||
            ( element === '/' ) ||
            ( element === '=' ) ||
            ( element === '?' ) ||
            ( element === '^' ) ||
            ( element === '_' ) ||
            ( element === '{' ) ||
            ( element === '|' ) ||
            ( element === '}' ) ||
            ( element === '~' ) ||
            ( element === '.' ))
        )   {
            value = false;
        }
    }

    if ( !value ) { return value } // Interrumpimos para ahorrar antes de seguir comprobando

    if ( local[0] == '.' || local[ local.length - 1 ] == '.' ) { value = false; return value; } // Comprobamos que el punto no este ni al principio ni al final


    cont = 0;
    for (const letter in local) {
        if (!Object.prototype.hasOwnProperty.call(local, letter)) { return; }
        const element = `${(local[letter])}`;

        if ( element == '.' ) { cont++; }   // Si hay un punto en la letra, incrementamos el contador
        else { cont == 0 }                  // Si no, lo reiniciamos

        if ( cont >= 2 ) { value = false; break; } // En caso de que el contador haya llegado hasta 2, salimos del bucle y terminamos comprobaciones
    }

    return value;
}

function checkDomain(domain) {
    console.log(domain);
    
    if ( domain.length > 255 ) { console.log("Muy largo"); return false; } // Demasiado largo

    domains = domain.split('.')

    if ( domains.length < 2 ) { console.log("No hay subdominios"); return false; } // No hay subdominios

    for ( subdomain_pos in domains ) {
        
        subdomain = domains[subdomain_pos]
        
        if ( subdomain.length > 63 || subdomain.length < 1 ) { console.log("Longitud inapropiada"); return false; } // Subdominio demasiado largo

        if ( subdomain[0] == "-" || subdomain[ subdomain.length - 1 ] == "-" ) { console.log("El guion no puede ser primero ni ultimo"); return false; } // El guion no puede ser primero ni ultimo

        for (const letter in subdomain) {
            const element = `${(subdomain[letter])}`;

            if (   !(   ( element.charCodeAt(0) >= 65 && element.charCodeAt(0) <= 90 ) ||       // Comprobamos mayuculas
                        ( element.charCodeAt(0) >= 97 && element.charCodeAt(0) <= 122) ||       // Comprobamos minusculas
                        ( element.charCodeAt(0) >= 48 && element.charCodeAt(0) <= 57 ) ||       // Comprobamos digitos
                        ( element == '-' )  )   )
            {
                console.log("Caracter inapropiado"); return false; // Caracter inapropiado
            }
        }
    }

    return true;
}

// User

function checkUser(value) {
    HideErrorMessage("userError");

    if ( value.length < 3 ) {
        setErrorMessage("userError", "Demasiado corto");

        checkFormValidity();
        return;
    }
    
    if ( value.length > 15 ) {
        setErrorMessage("userError", "Demasiado largo");

        checkFormValidity();
        return;
    }

    if ( !checkEnglish(value, false) ) {
        setErrorMessage("userError", "Carácteres inapropiados");

        checkFormValidity();
        return;
    }

    console.log("Buen usuario!");
    checkFormValidity();

}

// Pass

function checkPass(value) {
    HideErrorMessage("passInputError");

    if ( value.length < 6 ) {
        setErrorMessage("passInputError", "Demasiado corto");

        checkFormValidity();
        return;
    }
    
    if ( value.length > 15 ) {
        setErrorMessage("passInputError", "Demasiado largo");

        checkFormValidity();
        return;
    }
    
    if ( !checkEnglish(value, true) ) {
        setErrorMessage("passInputError", "Carácteres inapropiados");

        checkFormValidity();
        return;
    }

    if ( !checkMayusNum(value) ) {
        setErrorMessage("passInputError", "Minimo una mayuscula, una minuscula y un número");


        checkFormValidity();
        return;
    }

    console.log("Buen password!");
    checkFormValidity();
}

function checkPass2(value) {
    HideErrorMessage("pass2Error");
    pass1 = document.getElementById("passInput").value

    if (!(pass1 === value)) {
        setErrorMessage("pass2Error", "Contraseñas no coinciden");

        checkFormValidity();
        return;
    }

    if ( (value.length == 0) ) {
        setErrorMessage("pass2Error", "Demasiado corto");
    }

    console.log("Contraseñas coinciden!");
    checkFormValidity();
}

// Birthday

function checkBirthDate(value) {
    HideErrorMessage("birthError");

    if ( value.length <= 0 ) {
        setErrorMessage("birthError", "Tienes que ser mayor de edad");
        return;
    }
    

    const now = new Date()
    const birth = new Date(value)

    if ( now.getFullYear() - birth.getFullYear() < 18 ) {
        setErrorMessage("birthError", "Tienes que ser mayor de edad");
        return;
    }
    
    checkFormValidity();
}

document.addEventListener("DOMContentLoaded", function () {
    // creacion de errorMessages
    init()

});