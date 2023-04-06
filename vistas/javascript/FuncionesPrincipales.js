var dominio = window.location.hostname;
const urlDelSitio = "http://"+dominio+"/Jets/";


function recargarPagina(){
    location.reload();
}


function enviarPeticionAJAX() {
    var nroDeRegistro = document.getElementById("nro_registro").value;
    console.log("HOLAMUNDO");
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var valores = JSON.parse(this.responseText);
            console.log("HOLAMUNDO_2");

            console.log(valores);

            document.getElementById('nombre_completo').value    = valores[0].nombreCompleto;
            document.getElementById('nro_celular').value        = valores[0].nro_celular;
            document.getElementById('carrera').value            = valores[0].carrera;
        }
    };
    xhr.open('GET', urlDelSitio+'controladores/SolicitarDatosDelEstudiante.php?valor='+ nroDeRegistro, true);
    xhr.send();

  }
  