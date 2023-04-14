<?php

require_once 'principal_Modelo.php';



class Registro_Modelo {


    static function extraer_Facultad($carrera){


        if($carrera == "ADMINISTRACION DE TURISMO" or 
        $carrera == "ADMINISTRACION FINANCIERA" or
        $carrera == "ADMINISTRACION GENERAL" or
        $carrera == "AUDITORIA FINANCIERA" or
        $carrera == "COMERCIO INTERNACIONAL" or
        $carrera == "COMUNICACIÓN ESTRATÉGICA Y DIGITAL" or
        $carrera == "CONTADURÍA PUBLICA" or
        $carrera == "INGENIERIA COMERCIAL" or
        $carrera == "INGENIERIA EN ADMINISTRACION PETROLERA" or
        $carrera == "INGENIERIA EN MARKETING Y PUBLICIDAD" or
        $carrera == "INGENIERIA FINANCIERA"){

        return "CIENCIAS EMPRESARIALES";

        }else if(
        $carrera == "INGENIERIA DE SISTEMAS" or
        $carrera == "INGENIERIA ELECTRICA" or
        $carrera == "INGENIERIA ELECTRONICA Y SISTEMAS" or
        $carrera == "INGENIERIA EN ADMINISTRACION PETROLERA" or
        $carrera == "INGENIERIA EN REDES Y TELECOMUNICACIONES" or
        $carrera == "INGENIERIA INDUSTRIAL Y COMERCIAL" or
        $carrera == "INGENIERIA MECANICA AUTOMOTRIZ  Y AGROINDUSTRIAL"){
            

        return "CIENCIAS Y TECNOLOGIA";


        }else if(
        $carrera == "DERECHO" or
        $carrera == "PSICOLOGIA" or
        $carrera == "RELACIONES INTERNACIONALES"){
            

        return "CIENCIAS JURIDICAS, SOCIALES Y HUMANISTICAS";

        }else{

            return "NO REGISTRADO";
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
    static function Verificar_si_el_estudiante_ya_se_inscribio($NroDeRegistro) {

        $ConexionBD = principalModelo::conectarALaBaseDeDatos();
        $consultaSQL = "CALL verificar_Inscripcion('$NroDeRegistro',@mensaje);";

        $resultado = mysqli_query($ConexionBD, $consultaSQL);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            
            die("Error al ejecutar la consulta: " . mysqli_error($ConexionBD));
            
        }
        
        $resultado = mysqli_query($ConexionBD, "SELECT @mensaje AS mensaje");
        $fila = mysqli_fetch_assoc($resultado);

        echo "<script>alert('" . $fila['mensaje'] . "');</script>";
        echo "<script>window.location='../Registro/'</script>";

        $ConexionBD->close();   

    }
    public static function Inscribir_Estudiante($datos) {

        $codigoUsuarioAdmin = $_SESSION['id_usuario'];
        
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
            '$datos[correo]',
            '$codigoUsuarioAdmin'
        );";

        $resultado = mysqli_query($ConexionBD, $consultaSQL);

        // Verificar si la consulta fue exitosa
        if (!$resultado) {
            die("Error al ejecutar la consulta: " . mysqli_error($ConexionBD));
        }else{
                
            //Mostrar el mensaje
            echo '<script>alert("Se Registro Exitosamente la Inscripcion");</script>';
            //Enviar a otra pagina
            echo "<script>window.location='../Registro'</script>";
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
                'correo' => "INSCRIBIR DE FORMA MANUAL",
                'carnet_identidad' => "INSCRIBIR DE FORMA MANUAL",
                'carrera' => "INSCRIBIR DE FORMA MANUAL");

            $ConexionBD->close();

        }else{

        $valores = array();
        while ($row = $result->fetch_assoc()) {
            $valores[] = array(
                'nombreCompleto'    => $row['nombreCompleto'],
                'nro_celular'       => $row['nro_celular'],
                'correo'            => $row['correo'],
                'carnet_identidad'  => $row['carnet_identidad'],
                'carrera'           => $row['carrera']);
            }

            $ConexionBD->close();
            return $valores;
        }
    }

    static function Extraer_Tallas_de_Poleras(){

        $ConexionBD = principalModelo::conectarALaBaseDeDatos();
        $consultaSQL = "SELECT * FROM cant_por_tallas_polera_inscritas;";
        $resultado = $ConexionBD->query($consultaSQL);
        
        if(mysqli_num_rows($resultado) == 0){
        
            echo "<option>Sin Datos</option>";
            
        }else if(!$resultado) {
                $Error = mysqli_error($ConexionBD);
                echo "<script>alert('Error en la consulta: $Error ');</script>";
                echo "<option>Sin Datos</option>";

            }else{
                    while ($fila = mysqli_fetch_assoc($resultado)){

                        if($fila["TallaPolera"] == "XXL" AND $fila["CantDeTallasIncritas"] >= 100){


                        }else if($fila["TallaPolera"] == "XXXL" AND $fila["CantDeTallasIncritas"] >= 100){


                        }else{

                            echo "<option value=" . $fila["idTallaPolera"] . ">" . $fila["TallaPolera"] . "</option>";
                            
                        }

                      
                    }
                }
        $ConexionBD->close();
 
    }
}