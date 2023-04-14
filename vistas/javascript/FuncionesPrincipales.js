var dominio = window.location.hostname;
const urlDelSitio = "http://"+dominio+"/Jets/";


function recargarPagina(){
    location.reload();
}


function enviarPeticionAJAX() {
    var nroDeRegistro = document.getElementById("nro_registro").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var valores = JSON.parse(this.responseText);

            console.log(valores);

            document.getElementById('nombre_completo').value    = valores[0].nombreCompleto;
            document.getElementById('nro_celular').value        = valores[0].nro_celular;
            document.getElementById('carrera').value            = valores[0].carrera;
            document.getElementById('ci').value                 = valores[0].carnet_identidad;
            document.getElementById('email').value              = valores[0].correo;

        }
    };
    xhr.open('GET', urlDelSitio+'controladores/SolicitarDatosDelEstudiante.php?valor='+ nroDeRegistro, true);
    xhr.send();

  }
  
  
function enviarPeticionAJAX_VER() {
    var nroDeRegistro = document.getElementById("nro_registro").value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            var valores = JSON.parse(this.responseText);

            console.log(valores);

            document.getElementById('nombre_completo_VER').value                = valores[0].nombreCompleto;
            document.getElementById('carrera_VER').value                        = valores[0].carrera;
            document.getElementById('estado_inscripcion_VER').value             = "inscrito";

        }
    };
    xhr.open('GET', urlDelSitio+'controladores/SolicitarDatosDelEstudiante.php?valor='+ nroDeRegistro, true);
    xhr.send();

  }