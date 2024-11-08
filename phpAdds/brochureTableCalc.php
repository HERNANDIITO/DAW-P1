<?php

function generateTable() {
    $table = "<table id='PHPprice-table'>";

    // Primera fila: cabecera de títulos principales
    $table .= "<tr class='sticky-header'>";
    $table .= insertTH("");
    $table .= insertTH("");
    $table .= insertTH("Blanco y negro");
    $table .= insertTH("Color");
    $table .= insertTH("");
    $table .= insertTH("");
    $table .= "</tr>";

    // Segunda fila: subcabecera de resoluciones y tipos
    $table .= "<tr class='sticky-header'>";
    $table .= insertTH("Número de páginas");
    $table .= insertTH("Número de fotos");
    $table .= insertTH("150 - 300 dpi");
    $table .= insertTH("450 - 900 dpi");
    $table .= insertTH("150 - 300 dpi");
    $table .= insertTH("450 - 900 dpi");
    $table .= "</tr>";

    // Filas de datos con precios calculados
    for ($index = 0; $index <= 17; $index++) {
        $numPag = $index;
        $numFot = $index * 3;
        $table .= fillRow($numPag, $numFot);
    }

    // $table .= "</table>";
    return $table;
}

function insertTH($text) {
    return "<th>$text</th>";
}

function fillRow($numPag, $numFot) {
    $row = "<tr>";
    $row .= "<td>$numPag</td>";
    $row .= "<td>$numFot</td>";
    $row .= "<td>" . getPrecio($numPag, $numFot, false, false) . "</td>";
    $row .= "<td>" . getPrecio($numPag, $numFot, false, true) . "</td>";
    $row .= "<td>" . getPrecio($numPag, $numFot, true, false) . "</td>";
    $row .= "<td>" . getPrecio($numPag, $numFot, true, true) . "</td>";
    $row .= "</tr>";
    return $row;
}

function getPrecio($numCopias, $numFotos, $resFotos, $color) {
    $precioTotal = 0;

    $base = 10;
    $precioFotos = $resFotos <= 300 ? 0 : 0.2;
    $precioCopias = getPrecioCopias($numCopias);
    $precioColor = $color ? 0.5 : 0;

    $precioTotalFotos = $numFotos * ($precioFotos + $precioColor);
    $precioTotal = $base + $precioCopias + $precioTotalFotos;

    $precioTotal = number_format($precioTotal, 2, '.', '');
    return "$precioTotal €";
}

function getPrecioCopias($copias) {
    $precio = 0;
    $copiasLeft = $copias;
    while ($copiasLeft > 0) {
        if ($copiasLeft < 5) {
            $precio += 2;
        } elseif ($copiasLeft >= 5 && $copiasLeft <= 10) {
            $precio += 1.8;
        } else {
            $precio += 1.6;
        }
        $copiasLeft--;
    }
    return $precio;
}

// Generar y mostrar la tabla
?>
