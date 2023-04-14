<?php

require_once '../modelos/Registro_Modelo.php';
require_once '../modelos/principal_Modelo.php';

$principalModelo = new principalModelo();
$Registro_Modelo = new Registro_Modelo();

$accion = $_POST['accion_del_form'];

switch ($accion) {
    case "Registrar_De_Manera_Automatica":

    $nro_registro = principalModelo::limpiar_cadena($_POST['nro_registro_reg']);
    $resultado_de_verificar_NroRegistro = Registro_Modelo::verificar_NroRegistro($nro_registro);

    if($resultado_de_verificar_NroRegistro == "Existe"){


    //$Registro_Modelo->Verificar_si_el_estudiante_ya_se_inscribio($nro_registro);
    $nro_celular        = principalModelo::limpiar_cadena($_POST['nro_celular_reg']);
    $talla_polera       = principalModelo::limpiar_cadena($_POST['talla_polera_reg']);
    $ci                 = principalModelo::limpiar_cadena($_POST['ci_reg']);
    $correo             = principalModelo::limpiar_cadena($_POST['correo_reg']);
    $carrera            = principalModelo::limpiar_cadena($_POST['carrera_reg']);

    //Verificar de que facultad es el estudiante
    $facultad = Registro_Modelo::extraer_Facultad($carrera);
    
    $file = $_FILES['foto_reg']['tmp_name'];

    // Directorio donde se guardará la imagen
    $directory = "../imagenes/";

    // Nombre del archivo de la imagen
    $filename = basename($_FILES['foto_reg']['name']);

    // Ruta completa del archivo de la imagen
    $RutaDeLaFoto = $directory.$nro_registro;

    // Guardar la imagen en el servidor
    if(move_uploaded_file($file, $RutaDeLaFoto)) {

      echo "La imagen ha sido guardada correctamente";  
      $datos = array(
        "nro_registro" => $nro_registro,
        "nombreCompleto" => "",
        "carrera" => "",
        "facultad" => $facultad,
        "ci" => $ci,
        "nro_celular" => $nro_celular,
        "talla_polera" => $talla_polera,
        "RutaDeLaFoto" => $RutaDeLaFoto,
        "correo" => $correo
      );
      
      $Registro_Modelo->Inscribir_Estudiante($datos);


    } else {
      echo "<script> alert('Error al guardar la imagen'); </script>";
      echo "<script> window.location='/Jets/Registro'; </script>";

    }

    }else{

      echo "<script> alert('La persona con número de registro $nro_registro no existe en la base de datos. Ingresar de manera manual'); </script>";
      echo "<script> window.location='/Jets/Registro'; </script>";
    }
    
    break;

    case "Registrar_De_Manera_Manual":

      $nro_registro     = principalModelo::limpiar_cadena($_POST['nro_registro_reg1']);
      $nombre_completo  = principalModelo::limpiar_cadena($_POST['nombre_completo_reg1']);
      $carrera          = principalModelo::limpiar_cadena($_POST['carrera_reg1']);
      $nro_celular      = principalModelo::limpiar_cadena($_POST['nro_celular_reg1']);
      $talla_polera     = principalModelo::limpiar_cadena($_POST['talla_polera_reg1']);
      $ci               = principalModelo::limpiar_cadena($_POST['ci_reg1']);
      $correo_reg       = principalModelo::limpiar_cadena($_POST['correo_reg1']);

      //Extraer la facultad a la que pertenece la carrera
      $facultad = Registro_Modelo::extraer_Facultad($carrera);

      //Comprobar si el estudiante no se inscribio previamente
     // $Registro_Modelo->Verificar_si_el_estudiante_ya_se_inscribio($nro_registro);

      //Extraer la imagen del input
      $file = $_FILES['foto_reg1']['tmp_name'];

      // Directorio donde se guardará la imagen
      $directory = "../imagenes/";

      // Nombre del archivo de la imagen
      $filename = basename($_FILES['foto_reg1']['name']);

      // Ruta completa del archivo de la imagen
      $RutaDeLaFoto = $directory . $nro_registro;


      

      // Guardar la imagen en el servidor
      if(move_uploaded_file($file, $RutaDeLaFoto)) {
        echo "La imagen ha sido guardada correctamente";

        //Crear Funcion que extraiga la facultad De la carrera

        $datos = array(
          "nro_registro" => $nro_registro,
          "nombreCompleto" => $nombre_completo,
          "carrera" => $carrera,
          "facultad" => $facultad,
          "ci" => $ci,
          "nro_celular" => $nro_celular,
          "talla_polera" => $talla_polera,
          "RutaDeLaFoto" => $RutaDeLaFoto,
          "correo" => $correo_reg
        );
        
        $Registro_Modelo->Inscribir_Estudiante($datos);


      } else {

        echo "<script> alert('Error al guardar la imagen'); </script>";

      }

      break;

    case "Ver_Inscripcion":

    $nro_registro_reg = principalModelo::limpiar_cadena($_POST['nro_registro_reg2']);

    break;

    case "Editar_Inscripcion":

    $nro_registro_reg = principalModelo::limpiar_cadena($_POST['nro_registro_reg2']);
    $nombre_completo_reg = principalModelo::limpiar_cadena($_POST['nombre_completo_reg2']);
    $carrera_reg = principalModelo::limpiar_cadena($_POST['carrera_reg2']);
    $nro_celular_reg = principalModelo::limpiar_cadena($_POST['estado-inscripcion_reg2']);


    break;
}
