// Archivo: login.js
// En este archivo se define la logica del login
// Creado por: Pablo Hernández García el 23/10/2024
// Historial de cambios:
// 23/10/2024 - Creado

var modal;
var modal2;

function init() {
    document.getElementById("price").innerText = '10.00 ' + "€"
    modal = document.getElementById("details")
    modal2 = document.getElementById("detailsPHP")
    generateTable()
}

function insertTH(row, text) {
    const th = document.createElement("th");
    th.innerHTML = text;

    row.appendChild(th);
}

function fillRow( row, numPag, numFot ) {
    row.insertCell().innerText = numPag
    row.insertCell().innerText = numFot
    row.insertCell().innerText = getPrecio( numPag, numFot, false, false )
    row.insertCell().innerText = getPrecio( numPag, numFot, false, true  )
    row.insertCell().innerText = getPrecio( numPag, numFot, true , false )
    row.insertCell().innerText = getPrecio( numPag, numFot, true , true  )
}

function generateTable() {
    const table = document.getElementById("price-table")

    var row = table.insertRow(0)
    row.classList.add("sticky-header")

    insertTH(row, "")
    insertTH(row, "")
    insertTH(row, "Blanco y negro")
    insertTH(row, "Color")
    insertTH(row, "")
    insertTH(row, "")

    row = table.insertRow(1)
    row.classList.add("sticky-header")

    insertTH(row, "Número de páginas")
    insertTH(row, "Número de fotos")
    insertTH(row, "150 - 300 dpi")
    insertTH(row, "450 - 900 dpi")
    insertTH(row, "150 - 300 dpi")
    insertTH(row, "450 - 900 dpi")
    
    for (let index = 0; index <= 17; index++) {
        row = table.insertRow()
        fillRow( row, index, index * 3 )
    }
}

function showModal() {
    modal.showModal()
    modal.focus()
}

function showModal2() {
    modal2.showModal()
    modal2.focus()
}

function closeModal() {
    modal.close()
}

function closeModal2() {
    modal2.close()
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
    // esto para recuperar el numero con php
    document.getElementById("precioTotalphp").value = getPrecioNum(numCopias, numFotos, resFotos, color)
}


function getPrecioNum(numCopias, numFotos, resFotos, color) {

    var precioTotal = 0;

    const base = 10;
    const precioFotos   = resFotos <= 300 ? 0 : 0.2
    const precioCopias  = getPrecioCopias(numCopias);
    const precioColor   = color ? 0.5 : 0 

    const precioTotalFotos = numFotos * ( precioFotos + precioColor )
    
    precioTotal = base + precioCopias + precioTotalFotos
    return (Math.floor(precioTotal * 100) / 100).toFixed(2);
}
