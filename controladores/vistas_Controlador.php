<?php

require_once "./modelos/vistasModelo.php";


class vistasControlador extends vistasModelo{


        /*---------Controlador para obtener la plantilla-----------------*/

        public function obtener_plantilla_controlador(){

            return require_once "./vistas/plantilla.php";
        }

        /*---------Controlador para obtener la Vistas-----------------*/

        public function obtener_vistas_controlador(){
            
            $url_extraida = $_SERVER["REQUEST_URI"];
            $ruta = explode("/",$url_extraida);

            if($ruta[2] != ""){

                
                $respuesta = vistasModelo::obtener_vistas_model($ruta[2]);
                return $respuesta;


            }else{

                $respuesta ="login";
                return $respuesta;

            }


        }



}