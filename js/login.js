// Archivo: login.js
// En este archivo se define la logica del login
// Creado por: David González Moreno el 23/10/2024
// Historial de cambios:
// 23/10/2024 - Creado


// Crear un contenedor para el mensaje de error
const errorMessageElement = document.createElement("p");
errorMessageElement.style.color = "red";
errorMessageElement.style.fontSize = "20px";
errorMessageElement.style.display = "none";  // Oculto inicialmente
loginForm.insertBefore(errorMessageElement, submitButton);


// Función para mostrar mensajes de error
function errorMessage(text) {
    errorMessageElement.textContent = text;
    errorMessageElement.style.display = "block";  // Muestra el mensaje
}

// Función para ocultar el mensaje de error
function clearErrorMessage() {
    errorMessageElement.style.display = "none";  // Oculta el mensaje
}


document.addEventListener("DOMContentLoaded", function () {
    const loginForm = document.getElementById("loginForm");
    const usernameInput = document.getElementById("user");
    const passwordInput = document.getElementById("pass");

    // Verifica que los campos no estén vacíos antes de enviar el formulario
    loginForm.addEventListener("submit", function (event) {
        const username = usernameInput.value.trim();
        const password = passwordInput.value.trim();

        if (!username || !password) {
            event.preventDefault(); // Evita el envío del formulario
            alert("Por favor, completa ambos campos.");
        }
    });
});
