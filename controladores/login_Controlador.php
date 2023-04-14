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

        $nombreUsuario      = principalModelo::limpiar_cadena($_POST['username_Login']);
        $contrasena         = principalModelo::limpiar_cadena($_POST['password_Login']);


        principalModelo::verificar_StringVacio_O_Nulo($nombreUsuario, "Nombre");    
        principalModelo::verificar_StringVacio_O_Nulo($contrasena, "Contraseña");

        
        $datos = [
            "nombreUsuario" => $nombreUsuario,
            "contrasena_iniciarSesion" => $contrasena
        ];


        $ConexionBD = principalModelo::conectarALaBaseDeDatos();
        login_Modelo::IniciarSesion($ConexionBD,$datos);

        
        break;

    case "Registrar":


        $Nombre_Completo    = principalModelo::limpiar_cadena($_POST['name_vna_Registrar_reg']);
        $Nombre_De_Usuario  = principalModelo::limpiar_cadena($_POST['user_vna_Registrar_reg']);
        $contrasena         = principalModelo::limpiar_cadena($_POST['pass_vna_Registrar_reg']);

        $contrasenaUsuario_Encryptada = password_hash($contrasena, PASSWORD_DEFAULT);
        login_Modelo::Registrar_Usuario($Nombre_Completo,$Nombre_De_Usuario,$contrasenaUsuario_Encryptada);

        break;

}


function verificarDatosSiEstanVacios_IniciarSesion($nombreUsuarioEmail,$contrasena){


}