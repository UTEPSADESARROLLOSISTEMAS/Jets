<?php

session_start();

require_once "../modelos/principal_Modelo.php";

class Registro_Modelo {


    static function verificar_NroRegistro($NroDeRegistro) {

        $ConexionBD = principal_Modelo::conectarALaBaseDeDatos();
        $consultaSQL = "CALL VerificarExistenciaPersona('$NroDeRegistro', @existe);";        
        $resultado = mysqli_query($ConexionBD, $consultaSQL);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($ConexionBD));
        }

        $sql = "SELECT @existe AS existe";
        $resultado = mysqli_query($ConexionBD, $sql);
        $fila = mysqli_fetch_assoc($resultado);
        $existe = (bool)$fila['existe'];
        
        // Imprimir el resultado
        if ($existe) {
            $ConexionBD->close();   
            return "Existe";
            
            
        } else {
            $ConexionBD->close();   
            return "No Existe";
        } 


    }

    public static function Inscribir_Estudiante($datos) {

        $codigoUsuarioAdmin = $_SESSION['CodigoDeUsuario'];

        $ConexionBD = principal_Modelo::conectarALaBaseDeDatos();
        $consultaSQL = "CALL RegistrarInscripcion(
            '$datos[nombres]',
            '$datos[apellidos]',
            '$datos[nro_registro]',
            '$datos[nro_celular]',
            '$datos[talla_polera]',
            '$datos[ci]',
            '$datos[RutaDeLaFoto]',
            '$codigoUsuarioAdmin'
        );";
        $resultado = mysqli_query($ConexionBD, $consultaSQL);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($ConexionBD));
        }else{

            echo "<script>alert('Se ha registrado con éxito')";
            echo "<script> window.location='/Jets/Registro'; </script>";

        }
        

        $ConexionBD->close();
    }

}