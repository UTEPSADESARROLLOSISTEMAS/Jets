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

        $nombreUsuarioEmail = principalModelo::limpiar_cadena($_POST['nombreUsuarioEmail_iniciarSesion']);
        $contrasena_iniciarSesion = principalModelo::limpiar_cadena($_POST['contrasena_iniciarSesion']);
        verificarDatosSiEstanVacios_IniciarSesion($nombreUsuarioEmail,$contrasena_iniciarSesion);

        break;

    case "Registrar":

        $nombreCompletoUsuario = principalModelo::limpiar_cadena($_POST['nombreCompletoUsuario_reg']);
        $correoUsuario = principalModelo::limpiar_cadena($_POST['correoUsuario_reg']);
        $nroDeTelefono = principalModelo::limpiar_cadena($_POST['nroDeTelefono_reg']);
        $profesion = principalModelo::limpiar_cadena($_POST['profesion_reg']);
        $nombreDeUsuario = principalModelo::limpiar_cadena($_POST['nombreDeUsuario_reg']);
        $contrasenaUsuario = principalModelo::limpiar_cadena($_POST['contrasenaUsuario_reg']);
        $ConfirmarcontrasenaUsuario = principalModelo::limpiar_cadena($_POST['ConfirmarcontrasenaUsuario_reg']);

        if($contrasenaUsuario != $ConfirmarcontrasenaUsuario || $contrasenaUsuario == "" || $contrasenaUsuario == null){

            echo '<script>alert("Las Contraseñas no Coinciden");</script>';
            
        }else{
            $contrasenaUsuario_Encryptada = password_hash($contrasenaUsuario, PASSWORD_DEFAULT);
            verificarDatosSiEstanVacios_Registrar($nombreCompletoUsuario,$correoUsuario,$nroDeTelefono,$profesion,$nombreDeUsuario,$contrasenaUsuario_Encryptada);


        }



        break;

}

function verificarDatosSiEstanVacios_Registrar($nombreCompletoUsuario,$correoUsuario,$nroDeTelefono,$profesion,$nombreDeUsuario,$contrasenaUsuario){
    
    principalModelo::verificar_StringVacio_O_Nulo($nombreCompletoUsuario, "Nombre Completo");    
    principalModelo::verificar_StringVacio_O_Nulo($correoUsuario, "Correo");    
    principalModelo::verificar_StringVacio_O_Nulo($nroDeTelefono, "Numero de telefono");    
    principalModelo::verificar_StringVacio_O_Nulo($profesion, "Profesion");    
    principalModelo::verificar_StringVacio_O_Nulo($nombreDeUsuario, "usuario");    
    principalModelo::verificar_StringVacio_O_Nulo($contrasenaUsuario, "contrasena"); 

    $datos = [
        "nombreCompletoUsuario" => $nombreCompletoUsuario,
        "correoUsuario" => $correoUsuario,
        "nroDeTelefono" => $nroDeTelefono,
        "profesion" => $profesion,
        "nombreDeUsuario" => $nombreDeUsuario,
        "contrasenaUsuario" => $contrasenaUsuario
    ];

    $ConexionBD = principalModelo::conectarALaBaseDeDatos();
    login_Modelo::registrarUsuario($ConexionBD,$datos);
}

function verificarDatosSiEstanVacios_IniciarSesion($nombreUsuarioEmail,$contrasena_iniciarSesion){

    principalModelo::verificar_StringVacio_O_Nulo($nombreUsuarioEmail, "Nombre de Usuario o Email Esta Vacio");    
    principalModelo::verificar_StringVacio_O_Nulo($contrasena_iniciarSesion, "Contraseña");

    $datos = [
        "nombreUsuarioEmail" => $nombreUsuarioEmail,
        "contrasena_iniciarSesion" => $contrasena_iniciarSesion
    ];


    $ConexionBD = principalModelo::conectarALaBaseDeDatos();
    login_Modelo::IniciarSesion($ConexionBD,$datos);
}