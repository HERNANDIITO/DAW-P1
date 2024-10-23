// Archivo: login.js
// En este archivo se define la logica del login
// Creado por: Pablo Hernández García el 23/10/2024
// Historial de cambios:
// 23/10/2024 - Creado

function init() {
    document.getElementById("price").innerText = 10 + "€"
}

function getPrecioCopias(copias) {
    if ( copias < 5 ) {
        return 2;
    } else if ( copias >= 5 && copias <= 10 ) {
        return 1.8;
    } else {
        return 1.6
    }
}

function updatePrice() {

    var precioTotal = 0;
    const base = 10;
    const numCopias = document.getElementById("numCopias").value;
    const numFotos  = document.getElementById("numFotos").value;
    const resFotos  = document.getElementById("resFotos").value;
    const color     = document.getElementById("color").checked;
    
    const precioFotos   = resFotos <= 300 ? 0 : 0.2
    const precioCopias  = getPrecioCopias(numCopias);
    const precioColor   = color ? 0.5 : 0

    console.log("numCopias",numCopias);
    console.log("numFotos ",numFotos );
    console.log("resFotos ",resFotos );
    console.log("color    ",color    );
    console.log("precioFotos ",precioFotos );
    console.log("precioCopias",precioCopias);
    console.log("precioColor ",precioColor );
    

    const precioTotalPaginas = numCopias * precioCopias
    const precioTotalFotos = numFotos * ( precioFotos + precioColor )
    
    precioTotal = base + precioTotalPaginas + precioTotalFotos 

    document.getElementById("price").innerText = precioTotal + "€"
    
}
