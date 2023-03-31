
function recargarPagina(){
    location.reload();
}

function redirigir(ventana) {
    // Obtenemos el dominio actual
    const dominioActual = window.location.origin;
    
    // Concatenamos el dominio actual con la ruta a la que queremos redirigir
    const nuevaVentana = dominioActual +'/SistemaLabUtepsa/' + ventana;
    
    //Redirigimos
    location.replace(nuevaVentana);
}
  