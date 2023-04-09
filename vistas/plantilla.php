<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>JETS</title>
    <link rel="icon" type="image/svg+xml" href="<?php echo SERVERURL; ?>vistas/Recursos/vectores/Icono.svg">
</head>

<body>
    <?php
    require_once "./controladores/vistas_Controlador.php";
    $IV = new vistasControlador();

    $vistas = $IV->obtener_vistas_controlador();
    if ($vistas == "404" || $vistas == "login") {
        
        require_once "./vistas/contenido/" . $vistas . "-vista.php";
        
    } else {
        ?>
        <!--------------------------------- Contenedor General ----------------------->
        <main>
            <!------------------Inicio----------------------- Barra de Navegacion lateral -------------Inicio----------------------->
            <?php
                
                include "./vistas/inclusiones/Links_DeLibrerias.php";
                require_once "./controladores/principal_controlador.php";
                //principal_controlador::ValidarUsuario(); 


            
            ?>
            <!-----------------FIN---------------------------------- Barra de Navegacion lateral -------------FIN----------------------->
            <!-------------------------Inicio----------------------- Contenido de la Pagina ---------Inicio--------------------------------------->
            <section class="full-box page-content">
                <?php
                require_once "./vistas/contenido/" . $vistas . "-vista.php";
                ?>
            </section>
            <!-------------------------FIN----------------------- Contenido de la Pagina ---------FIN--------------------------------------->
        </main>
        <?php
        include "./vistas/inclusiones/Links_DeJavascript.php";
    }
    ?>
</body>

</html>