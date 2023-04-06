<?php

session_start();

require_once "../modelos/principal_Modelo.php";

class Registro_Modelo {


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

        $codigoUsuarioAdmin = $_SESSION['CodigoDeUsuario'];

        $ConexionBD = principalModelo::conectarALaBaseDeDatos();

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

            //Hacer una consulta que extraiga todos los datos de la inscripcion recien registrada
            $consultaSQL = "CALL ExtraerDatosDeLaInscripcion('$datos[nro_registro]');";
            $resultado = mysqli_query($ConexionBD, $consultaSQL);
            


            // Cargar la biblioteca TCPDF
            require_once('../vendor/autoload.php');

            // Crear un nuevo documento PDF
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

            // Configurar información del documento PDF
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Tu Nombre');
            $pdf->SetTitle('Reporte de Usuarios');
            $pdf->SetSubject('Reporte de Usuarios');
            $pdf->SetKeywords('PDF, usuarios, reporte');

            // Configurar fuente
            $pdf->SetFont('helvetica', '', 12);

            // Agregar una página
            $pdf->AddPage();

            // Contenido del PDF (tabla HTML)
            $html = '<h1>Reporte de Usuarios</h1>
            <table border="1" cellspacing="3" cellpadding="4">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                </tr>';

            // Rellenar la tabla con los datos de la consulta
            if ($result->$num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $html .= '<tr>
                        <td>' . $row['id'] . '</td>
                        <td>' . $row['nombre'] . '</td>
                        <td>' . $row['apellido'] . '</td>
                        <td>' . $row['email'] . '</td>
                    </tr>';
                }
            } else {
                $html .= '<tr>
                    <td colspan="4">No se encontraron registros.</td>
                </tr>';
            }

            $html .= '</table>';

            // Imprimir la tabla HTML en el PDF
            $pdf->writeHTML($html, true, false, true, false, '');

            // Cerrar y generar el archivo PDF
            $pdf->Output('reporte_usuarios.pdf', 'I');



            echo "<script>alert('Se ha registrado con éxito')";
            echo "<script> window.location='/Jets/Registro'; </script>";



        }
        

        $ConexionBD->close();
    }

    static function SolicitarDatosDelEstudiante_Modelo($NroDeRegistro) {

        $ConexionBD = principalModelo::conectarALaBaseDeDatos();
        $consultaSQL = "CALL MostrarDatosPersona('$NroDeRegistro');";        
        $result  = mysqli_query($ConexionBD, $consultaSQL);

        if (mysqli_num_rows($result) == 0) {

            $valores[] = array(
                'nombreCompleto' => "N/A",
                'nro_celular' => "N/A",
                'carrera' => "N/A");

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