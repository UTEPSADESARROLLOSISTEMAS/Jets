<?php


require_once "../modelos/login_Modelo.php";
require_once "../modelos/principal_Modelo.php";


/*--------------------------------------------------------------------------------------------------------*/
/*------------------------------------ PUBLICACION O EDICION DE DATOS ------------------------------------*/

// determinar la acción según el valor del campo de entrada "accion"
$accion = $_POST['accionDeBotonLogin'];

// determinar la acción según el valor del campo de entrada "accion"
switch ($accion) {
    case "IniciarSesion":

        $nombreUsuarioEmail         = principalModelo::limpiar_cadena($_POST['username_Login']);
        $contrasena   = principalModelo::limpiar_cadena($_POST['password_Login']);


        principalModelo::verificar_StringVacio_O_Nulo($nombreUsuarioEmail, "Nombre de Usuario o Email Esta Vacio");    
        principalModelo::verificar_StringVacio_O_Nulo($contrasena, "Contraseña");

        
        $datos = [
            "nombreUsuarioEmail" => $nombreUsuarioEmail,
            "contrasena_iniciarSesion" => $contrasena
        ];


        $ConexionBD = principalModelo::conectarALaBaseDeDatos();
        login_Modelo::IniciarSesion($ConexionBD,$datos);

        
        break;

    case "Registrar":


        break;

}


function verificarDatosSiEstanVacios_IniciarSesion($nombreUsuarioEmail,$contrasena){


}