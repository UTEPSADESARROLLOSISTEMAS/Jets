<?php

 require_once "../modelos/Registro_Modelo.php";
 require_once "../modelos/principal_Modelo.php";

$principalModelo = new principalModelo();
$Registro_Modelo = new Registro_Modelo();

$accion = $_POST['accion_del_form'];

switch ($accion) {
    case "Registrar_De_Manera_Automatica":

    $nro_registro_reg = principalModelo::limpiar_cadena($_POST['nro_registro_reg']);
    $resultado_de_verificar_NroRegistro = Registro_Modelo::verificar_NroRegistro($nro_registro_reg);

    if($resultado_de_verificar_NroRegistro == "Existe"){

    $nro_celular_reg        = principalModelo::limpiar_cadena($_POST['nro_celular_reg']);
    $talla_polera_reg       = principalModelo::limpiar_cadena($_POST['talla_polera_reg']);
    $ci_reg                 = principalModelo::limpiar_cadena($_POST['ci_reg']);

    $file = $_FILES['foto_reg']['tmp_name'];

    // Directorio donde se guardará la imagen
    $directory = "../imagenes/";

    // Nombre del archivo de la imagen
    $filename = basename($_FILES['foto_reg']['name']);

    // Ruta completa del archivo de la imagen
    $RutaDeLaFoto = $directory.$nro_registro_reg;

    // Guardar la imagen en el servidor
    if(move_uploaded_file($file, $RutaDeLaFoto)) {
      echo "La imagen ha sido guardada correctamente";
        
      $datos = array(
        "nro_registro" => $nro_registro_reg,
        "nombreCompleto" => "",
        "carrera" => "",
        "facultad" => "",
        "ci" => $ci_reg,
        "nro_celular" => $nro_celular_reg,
        "talla_polera" => $talla_polera_reg,
        "RutaDeLaFoto" => $RutaDeLaFoto
      );
      
      $Registro_Modelo->Inscribir_Estudiante($datos);


    } else {
      echo "<script> alert('Error al guardar la imagen'); </script>";
      echo "<script> window.location='/Jets/Registro'; </script>";

    }

    }else{

      echo "<script> alert('La persona con número de registro $nro_registro_reg no existe en la base de datos. Ingresar de manera manual'); </script>";
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
          "nro_registro" => $nro_registro_reg,
          "nombreCompleto" => $nombre_completo,
          "carrera" => $carrera,
          "facultad" => "",
          "ci" => $ci_reg,
          "nro_celular" => $nro_celular_reg,
          "talla_polera" => $talla_polera_reg,
          "RutaDeLaFoto" => $RutaDeLaFoto
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
