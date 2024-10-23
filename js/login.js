// Archivo: login.js
// En este archivo se define la logica del login
// Creado por: David González Moreno el 23/10/2024
// Historial de cambios:
// 23/10/2024 - Creado




// ERROR MESSAGE

function createErrorMessage(fieldId) {
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



document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.getElementById("submitLoginButton");
    const usernameInput = document.getElementById("user");
    const passwordInput = document.getElementById("pass");

    // creacion de errorMessages
    createErrorMessage("user");
    createErrorMessage("pass");


    // APARTADO DE COMPROBACIONES DE FORMULARIO
    usernameInput.addEventListener("blur", function () {
        // reset
        HideErrorMessage("userError");

        // comprobacion espacios
        if (document.getElementById("user").value.includes(" ") || document.getElementById("user").value.includes("\t")) {
            setErrorMessage("userError", "Este campo no puede incluir espacios")
        }

        // comprobacion campo vacio
        const username = usernameInput.value.trim();
        if (!username) {
            setErrorMessage("userError", "Por favor, rellene este campo")
        }

        checkFormValidity();
    });


    passwordInput.addEventListener("blur", function () {
        // reset
        HideErrorMessage("passError");

        // comprobacion espacios
        if (document.getElementById("pass").value.includes(" ") || document.getElementById("pass").value.includes("\t")) {
            setErrorMessage("passError", "Este campo no puede incluir espacios");
        }


        // comprobacion campo vacio
        const password = passwordInput.value.trim();
        if (!password) {
            setErrorMessage("passError", "Por favor, rellene este campo");
        }

        checkFormValidity();
    });


    // Función para comprobar si todos los mensajes de error están ocultos y se puede enviar el form
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

});
