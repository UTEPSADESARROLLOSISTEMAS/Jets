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

        $contrasena = $datos['contrasena_iniciarSesion'];
        $Consulta = "SELECT verificar_inicio_sesion('$datos[nombreUsuarioEmail]') AS contrasena;";



        $ejecutar = mysqli_query($ConexionBD, $Consulta);



        if (!$ejecutar) {
            echo "Error en la consulta: " . mysqli_error($ConexionBD);
            echo "<script>alert('Error al guardar los datos');</script>";

        }
        $datosExtraidos = mysqli_fetch_assoc($ejecutar);
        $contrasena_encriptada_bd = $datosExtraidos["contrasena"];

        if (password_verify($contrasena, $contrasena_encriptada_bd)) {

            global $url;

            $Consulta_extraerDatosDelUsuario = "CALL tabla_conLosDatosDelUsuarioParaIniciarSesion('$datos[nombreUsuarioEmail]');";
            $resultado = mysqli_query($ConexionBD, $Consulta_extraerDatosDelUsuario);

            if (mysqli_num_rows($resultado) > 0) {
                $row = mysqli_fetch_assoc($resultado);

                $_SESSION['CodigoDeUsuario'] = $row["CodigoDeUsuario"];
                $_SESSION['privilegio_del_usuario'] = $row["privilegio_del_usuario"];
                $_SESSION['nombreDeUsuario'] = $row["nombreDeUsuario"];

            }


            
            if($row["privilegio_del_usuario"] != "6" || $row["privilegio_del_usuario"] != "0"){

                header('Location: '.$url.'SistemaLabUtepsa/UsoDeLaboratorio');


            }else{

                echo "<script>alert('Aun no han Confirmado Su Usuario');
                window.location='/SistemaLabUtepsa/'</script>";

            }

        } else {

            echo "<script>alert('Usuario o contraseña Incorrectos');
            window.location='/SistemaLabUtepsa/'</script>";
        }
        
        mysqli_close($ConexionBD);

    }
}