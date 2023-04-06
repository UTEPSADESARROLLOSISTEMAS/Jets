<?php
require_once "../modelos/Registro_Modelo.php";

function SolicitarDatosDelEstudiante($NroDeRegistro) {

    $nro_registro= principalModelo::limpiar_cadena($NroDeRegistro);
    $valores = Registro_Modelo::SolicitarDatosDelEstudiante_Modelo($nro_registro);
    return $valores;
}

$valor = $_GET['valor'];

$valores = SolicitarDatosDelEstudiante($valor);
echo json_encode($valores);
?>
