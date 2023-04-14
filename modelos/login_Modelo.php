<?php
session_start();

global $url;

$url = 'http://'.$_SERVER['HTTP_HOST'].'/';

class login_Modelo{

    public static function registrar_usuario($Nombre_Completo,$Nombre_De_Usuario,$contrasenaUsuario_Encryptada){
        //Variable que contiene la url del servidor
        global $url;
        //Conexion a la base de datos
        $ConexionBD = principalModelo::conectarALaBaseDeDatos();
        //Consulta que se ejecutara en la base de datos
        $Consulta = "CALL registrar_usuario('$Nombre_De_Usuario','$contrasenaUsuario_Encryptada','$Nombre_Completo',@MensajeDeRegistro);";
        //Ejecutar la consulta  
        $resultado = mysqli_query($ConexionBD, $Consulta);
        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($ConexionBD));
        }
        //Extraer el mensaje de la base de datos
        $resultado = mysqli_query($ConexionBD, "SELECT @MensajeDeRegistro AS mensaje");
        //Convertir en una fila los datos del estudiante
        $fila = mysqli_fetch_assoc($resultado);
    
        //Mostrar el mensaje
        echo "<script>alert('" . $fila['mensaje'] . "');</script>";
        //Redirigir a otra pagina
        echo "<script>window.location='../'</script>";
       
        //Cerrar la conexion
        mysqli_close($ConexionBD);

    }


    public static function IniciarSesion($ConexionBD,$datos){

        //extraer la contraseña ingresada
        $contrasena_ingresada = $datos['contrasena_iniciarSesion'];
        //Consulta que se ejecutara en la base de datos
        $resultado = "CALL ExtraerDatos_Del_Usuario('$datos[nombreUsuario]');";
        //Ejecutar la consulta
        $datos_del_usuario = mysqli_query($ConexionBD, $resultado);

        // Verificar si la consulta fue exitosa
        if (!$datos_del_usuario) {
            echo "Error en la consulta: " . mysqli_error($ConexionBD);
            echo "<script>alert('Error al guardar los datos');</script>";
            die("Error al ejecutar la consulta: " . mysqli_error($ConexionBD));
        }

        //Convertir en una fila los datos del estudiante
        $datosExtraidos = mysqli_fetch_assoc($datos_del_usuario);
        //extrayendo su contraseña
        $contrasena_extraida = $datosExtraidos["contraseña"];

        //Verificar si la contraseña ingresada es igual a la extraida de la base de datos
        if (password_verify($contrasena_ingresada, $contrasena_extraida)) {

            $estado_Usuario = $datosExtraidos["estado"];


            if($estado_Usuario != "Deshabilitado"){

                //Extraer el codigo del usuario

                $_SESSION['id_usuario'] = $datosExtraidos["id"];
                    
                //Redirigir a otra pagina
                echo "<script>window.location='../Registro'</script>";
            }else{
                echo "<script>alert('Su cuenta todavia no esta habilitada');</script>";
                echo "<script>window.location='../'</script>";

            }



        }else{
            echo "<script>alert('Contraseña incorrecta');</script>";
            echo "<script>window.location='../'</script>";
        }

        mysqli_close($ConexionBD);

    }

    
}