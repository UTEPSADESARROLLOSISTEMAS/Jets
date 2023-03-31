<?php


class principalModelo
{
    //Abrir conexion a la base de datos
    public static function conectarALaBaseDeDatos()
    {

        $conectar = mysqli_connect("localhost", "root", "", "sistemalabutepsa");
        if (!$conectar) {

            die("Conexión fallida: " . mysqli_connect_error());
        }
        return $conectar;
    }

    //Cerrar conexion a la base de datos
    public static function cerrarLaConexionALaBD($conectar)
    {
        mysqli_close($conectar);
    }

    

    public static function limpiar_cadena($cadena)
    {

        if ($cadena == "" || $cadena == null) {

            return $cadena;

        } else {
            $cadena = trim($cadena);
            $cadena = stripslashes($cadena);
            $cadena = str_ireplace("<script>", "", $cadena);
            $cadena = str_ireplace("</script>", "", $cadena);
            $cadena = str_ireplace("<script> src", "", $cadena);
            $cadena = str_ireplace("<script> type =", "", $cadena);
            $cadena = str_ireplace("SELECT * FROM", "", $cadena);
            $cadena = str_ireplace("DELETE FROM", "", $cadena);
            $cadena = str_ireplace("INSERT INTO", "", $cadena);
            $cadena = str_ireplace("DROP TABLE", "", $cadena);
            $cadena = str_ireplace("DROP DATABASE", "", $cadena);
            $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
            $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
            $cadena = str_ireplace("<?php", "", $cadena);
            $cadena = str_ireplace("?>", "", $cadena);
            $cadena = stripslashes($cadena);
            $cadena = trim($cadena);
            return $cadena;
        }
    }

     static function encrypt_decrypt($accion, $cadena) {

        $clave = "Ut3p$@-L@b0r@t0r10$"; // Cambia esto por tu propia clave secreta
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $opciones = 0;
        $encriptado = openssl_encrypt($cadena, 'aes-256-cbc', $clave, $opciones, $iv);
      
        if ($accion == 'encrypt') {
          return base64_encode($encriptado . '::' . $iv);
        } else {
          list($encriptado, $iv) = explode('::', base64_decode($cadena), 2);
          return openssl_decrypt($encriptado, 'aes-256-cbc', $clave, $opciones, $iv);
        }
      }
      

    public static function verificar_StringVacio_O_Nulo($cadena, $ReferenciaDeDato)
    {

        if ($cadena == "" || $cadena == null) {
            echo '<script>alert("El dato ' . $ReferenciaDeDato . ' Está Vacio");
            window.history.back();
            </script>';
            die();
        }

    }

}