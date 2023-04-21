function agregarFila() {
    let tabla = document.getElementById("tablaProducto");

    let numFila = tabla.rows.length;
    tabla.insertRow(numFila).innerHTML= "<td>"+ numFila + "</td><td>botana</td><td>25.00</td><td><button class='boton tres' onclick='eliminarFila(this)'>eliminar</button></td>";
    
}

function eliminarFila(celda){

    let row =celda.parentNode.parentNode;
    row.parentNode.removeChild(row)
}