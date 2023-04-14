<?php


require_once "../Jets/modelos/Registro_Modelo.php";


class Registro_Controlador{

    public static function Extraer_Datos_Para_Un_Select($Dato_Solicitado){

    switch ($Dato_Solicitado) {
        case "Tallas de Poleras":


            Registro_Modelo::Extraer_Tallas_de_Poleras();
            break;

        default:
            echo "<option value='SIN DATOS'>SIN DATOS</option>";
        }
    }
}