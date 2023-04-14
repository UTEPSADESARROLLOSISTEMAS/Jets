<?php


require_once '../modelos/Registro_Modelo.php';
require_once '../modelos/principal_Modelo.php';

//Funcion que solicita los datos del estudiante
function SolicitarDatosDelEstudiante($NroDeRegistro) {

    $nro_registro= principalModelo::limpiar_cadena($NroDeRegistro);
    $valores = Registro_Modelo::SolicitarDatosDelEstudiante_Modelo($nro_registro);
    return $valores;
}


//Rebibe el valor del Nro de Registro
$valor = $_GET['valor'];


//Se envia los datos del estudiante
$valores = SolicitarDatosDelEstudiante($valor);

//Se convierte en un objeto JSON el resultado
echo json_encode($valores);
?>