<?php

session_start();

require_once "../modelos/principal_Modelo.php";

class Registro_Modelo {

    static function extraer_Facultad($carrera){


        if($carrera == "Ingeniería en Sistemas" or 
        $carrera == "Ingeniería en Informática" or
        $carrera == "Ingeniería en Electrónica" or
        $carrera == "Ingeniería en Mecatrónica" or
        $carrera == "Ingeniería en Mecánica" or
        $carrera == "Ingeniería en Mecánica Automotriz" or
        $carrera == "Ingeniería en Mecánica Industrial" or
        $carrera == "Ingeniería en Mecánica Mecatrónica" or
        $carrera == "Ingeniería en Mecánica Mecatrónica Industrial"){

            return "Ingeniería";

        }

    }


    static function verificar_NroRegistro($NroDeRegistro) {

        $ConexionBD = principalModelo::conectarALaBaseDeDatos();
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

        $codigoUsuarioAdmin = 1;
        

        $ConexionBD = principalModelo::conectarALaBaseDeDatos();

        $consultaSQL = "CALL RegistrarInscripcion(
            '$datos[nombreCompleto]',
            '$datos[nro_registro]',
            '$datos[carrera]',
            '$datos[facultad]',
            '$datos[ci]',
            '$datos[nro_celular]',
            '$datos[talla_polera]',
            '$datos[RutaDeLaFoto]',
            '$codigoUsuarioAdmin'
        );";

        $resultado = mysqli_query($ConexionBD, $consultaSQL);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($ConexionBD));
        }else{
            //Enviar a otra pagina
            header("location: ../Registro");
        }






        $ConexionBD->close();
    }

    static function SolicitarDatosDelEstudiante_Modelo($NroDeRegistro) {

        $ConexionBD = principalModelo::conectarALaBaseDeDatos();
        $consultaSQL = "CALL MostrarDatosPersona('$NroDeRegistro');";        
        $result  = mysqli_query($ConexionBD, $consultaSQL);

        if (mysqli_num_rows($result) == 0) {

            $valores[] = array(
                'nombreCompleto' => "INSCRIBIR DE FORMA MANUAL",
                'nro_celular' => "INSCRIBIR DE FORMA MANUAL",
                'carrera' => "INSCRIBIR DE FORMA MANUAL");

            return $valores;

        }else{

        $valores = array();
        while ($row = $result->fetch_assoc()) {
            $valores[] = array(
                'nombreCompleto' => $row['nombreCompleto'],
                'nro_celular' => $row['nro_celular'],
                'carrera' => $row['carrera']);
            }
            
            return $valores;

        }
    }

}