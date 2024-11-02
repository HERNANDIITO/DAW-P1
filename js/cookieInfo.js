// Archivo: cookieinfo.js
// En este archivo se define la logica del cambio de opinion en cookies
// Creado por: Pablo Hernández García el 02/11/2024
// Historial de cambios:
// 02/11/2024 - Creado

function setup() {
    const section = document.getElementById("selection")

    const p = document.createElement("p");
    const button = document.createElement("button")

    const canStoreCookies = localStorage.getItem("canStoreCookies")

    console.log(canStoreCookies);
    

    if (canStoreCookies == "true") {
        p.textContent = "Usted ha decidido almacenar cookies"

        button.classList.add("redButton")
        button.textContent = "No almacenar cookies"
        button.onclick = function () {update(false)}

    } else {
        p.textContent = "Usted ha decidido no almacenar cookies"

        button.classList.add("greenButton")
        button.textContent = "Almacenar cookies"
        button.onclick = function () {update(true)}
    }

    console.log("setup");
    
    section.appendChild(p)
    section.appendChild(button)
}

function update(result) {
    const section = document.getElementById("selection")
    localStorage.setItem("canStoreCookies", result)

    if ( !result ) { deleteAllCookies() }

    section.lastChild.remove()
    section.lastChild.remove()

    setup()
}

function deleteAllCookies() {
    setCookie("style", "prueba", -1)
}
