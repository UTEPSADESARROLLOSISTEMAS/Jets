<?php
session_start();

global $url;

$url = 'http://'.$_SERVER['HTTP_HOST'].'/';

class login_Modelo{

    public static function registrarUsuario($ConexionBD,$datos){

        
        $Consulta = "CALL agregar_Usuario
        ('$datos[nombreCompletoUsuario]',
        '$datos[correoUsuario]',
        '$datos[nroDeTelefono]',
        '$datos[profesion]',
        '$datos[nombreDeUsuario]',
        '$datos[contrasenaUsuario]');";



        $ejecutar = mysqli_query($ConexionBD, $Consulta);

       

        
        if (!$ejecutar) {
            echo "Error en la consulta: " . mysqli_error($ConexionBD);
            echo "<script>alert('Error al guardar los datos');</script>";

        }

        $valorRetorno = mysqli_fetch_array($ejecutar)[0];

        if ($valorRetorno == "El Usuario ya existe") {

            echo "<script>alert('El Usuario ya existe');
            window.location='/SistemaLabUtepsa/'</script>";


        } elseif ($valorRetorno == "El Correo ya existe") {

            echo "<script>alert('El Correo ya existe');
            window.location='/SistemaLabUtepsa/'</script>";


        }else{

            echo "<script>alert('Se ha registrado con éxito el Usuario');
            window.location='/SistemaLabUtepsa/'</script>";

        }
        
        mysqli_close($ConexionBD);

    }


    public static function IniciarSesion($ConexionBD,$datos){

        $contrasena_ingresada = $datos['contrasena_iniciarSesion'];
        $Consulta = "SELECT verificar_inicio_sesion('$datos[nombreUsuarioEmail]') AS contrasena;";



        $ejecutar = mysqli_query($ConexionBD, $Consulta);



        if (!$ejecutar) {
            echo "Error en la consulta: " . mysqli_error($ConexionBD);
            echo "<script>alert('Error al guardar los datos');</script>";

        }
        $datosExtraidos = mysqli_fetch_assoc($ejecutar);
        $contrasena_extraida = $datosExtraidos["contrasena"];



        if ($contrasena_ingresada == $contrasena_extraida) {

            global $url;

            $Consulta_extraerDatosDelUsuario = "CALL INGRESAR-EL-PROCEDIMIENTO('$datos[nombreUsuarioEmail]');";
            $resultado = mysqli_query($ConexionBD, $Consulta_extraerDatosDelUsuario);

            if (mysqli_num_rows($resultado) > 0) {
                $row = mysqli_fetch_assoc($resultado);

                $_SESSION['nombreDeUsuario'] = $row["nombreDeUsuario"];
                header('Location: '.$url.'Jets/Registro');


            }



        } else {

            echo "<script>alert('Usuario o contraseña Incorrectos');
            window.location='/SistemaLabUtepsa/'</script>";
        }
        
        mysqli_close($ConexionBD);

    }
}