<?php
//session_start();
require_once "./config/APP.php";
require_once "./controladores/vistas_Controlador.php";

$plantilla = new vistasControlador();

$plantilla->obtener_plantilla_controlador();