// Archivo: login.js
// En este archivo se define la logica del login
// Creado por: Pablo Hernández García el 23/10/2024
// Historial de cambios:
// 23/10/2024 - Creado

var modal;

function init() {
    document.getElementById("price").innerText = '10.00 ' + "€"
    modal = document.getElementById("details")
    generateTable()
}

function generateTable() {
    const table = document.getElementById("price-table")
    table.insertRow()

    table.insertCell()
    table.insertCell()

    table.insertCell().innerText = "Blanco y negro"
    table.insertCell().innerText = "Color"

    table.insertRow()

    table.insertCell().innerText = "Número de páginas"
    table.insertCell().innerText = "Número de fotos"
    table.insertCell().innerText = "150 - 300 dpi"
    table.insertCell().innerText = "450 - 900 dpi"
    table.insertCell().innerText = "150 - 300 dpi"
    table.insertCell().innerText = "450 - 900 dpi"

    for (let index = 0; index <= 15; index++) {
        table.insertRow(index)
    }
    
    table.appendChild()
}

function showModal() {
    modal.showModal()
}

function closeModal() {
    modal.close()
}

function getPrecioCopias(copias) {
    precio = 0;
    for (let copiasLeft = copias; copiasLeft > 0; copiasLeft--) {
        if ( copiasLeft < 5 ) { precio += 2 }
        else if ( copiasLeft >= 5 && copiasLeft <= 10 ) { precio += 1.8 }
        else if ( copiasLeft > 10 ) { precio += 1.6 }
        console.log("copiasLeft", copiasLeft);
        console.log("precio", precio);
        
    }

    return precio;
}

function getPrecio(numCopias, numFotos, resFotos, color) {

    var precioTotal = 0;

    const base = 10;
    const precioFotos   = resFotos <= 300 ? 0 : 0.2
    const precioCopias  = getPrecioCopias(numCopias);
    const precioColor   = color ? 0.5 : 0 

    const precioTotalFotos = numFotos * ( precioFotos + precioColor )
    
    precioTotal = base + precioCopias + precioTotalFotos

    precioTotal = precioTotal.toString().split(".")
    var entero = precioTotal[0]
    var decimal = precioTotal[1]

    if ( !decimal ) { decimal = "00" }
    else {
        if ( decimal.length == 1 ) { decimal += '0' }
        if ( decimal.length > 2 ) { decimal = decimal.substring(0, 2) }
    }

    return `${entero}.${decimal} €`;
}

function updatePrice() {

    const numCopias = document.getElementById("numCopias").value;
    const numFotos  = document.getElementById("numFotos").value;
    const resFotos  = document.getElementById("resFotos").value;
    const color     = document.getElementById("color").checked;

    document.getElementById("price").innerText = getPrecio(numCopias, numFotos, resFotos, color)
    
}
