<?php



class principal_controlador{

    

    public static function ValidarUsuario(){

        $url = 'http://'.$_SERVER['HTTP_HOST'].'/';
        error_reporting(0);
        $varsesion = $_SESSION['privilegio_del_usuario'];

        if($varsesion == null || $varsesion = ''){

            echo "<script>alert('SIN AUTORIZACION')</script>";
            header('Location: '.$url.'SistemaLabUtepsa/');
            die();
        }
    }

    public static function ExtraerNombreDeUsuario(){

        $nombreUsuario = $_SESSION['nombreDeUsuario'];

        echo "<p>$nombreUsuario</p>";
    }
    
}