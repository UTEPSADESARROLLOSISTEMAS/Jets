<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registro</title>
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/dashboard-style.css">
</head>

<body>
  <div class="header">
    <img src="<?php echo SERVERURL; ?>vistas/Recursos/vectores/UTEPSA-Rojo.svg" alt="UTEPSA">
  </div>
  <div class="container">
    <div class="tabs">
      <label for="radio1">Automático</label>
      <label for="radio2">Manual</label>
      <label for="radio3">Ver</label>
    </div>

    <div class="content">

      <input type="radio" name="radio" id="radio1">
      <div id="form1" class="form">
        <h2>Inscripción automatica</h2>
        <form action="<?php echo SERVERURL; ?>controladores/Agregar_Registro_Controlador.php" method="POST" enctype="multipart/form-data">          
          <div class="form_container">

              <div class="form_group" id="cargar-nro">
                <input type="text" id="nro_registro" class="form_input" name="nro_registro_reg" placeholder=" ">
                <label for="nro_registro" class="form_label">Nro de registro:</label>
                <span class="form_line"></span> 
                <button type="button" onclick="enviarPeticionAJAX()">Cargar datos</button>
              </div>

              <div class="form_group" id="datos-cargados">
                <input type="text" id="nombre_completo" class="readonly_input" name="nombre_completo_reg" placeholder="  Nombre completo" readonly>
                <span class="form_line"></span>
              </div>

              <div class="form_group" id="datos-cargados">
                <input type="text" id="carrera" class="readonly_input" name="carrera_reg" placeholder="  Carrera" readonly>
                <span class="form_line"></span>
              </div>

              <div class="form_group">
                <input type="tel" pattern="[67]\d{7}" maxlength="8" id="nro_celular" class="form_input"
                  name="nro_celular_reg" placeholder=" ">
                <label for="nro_celular" class="form_label">Nro de celular:</label>
                <span class="form_line"></span>
              </div>

              <div class="form_group">
                <label for="talla_polera" class="select_label">Talla de polera:</label>
                <select id="talla_polera" class="select_input" name="talla_polera_reg">
                  <option value="S">S</option>
                  <option value="M">M</option>
                  <option value="L">L</option>
                  <option value="XL">XL</option>
                </select>
              </div>

              <div class="form_group">
                <input type="number" id="ci" class="form_input" name="ci_reg" placeholder="(Solo numeros)">
                <label for="ci" class="form_label">C.I.:</label>
                <span class="form_line"></span>
              </div>

              <div class="form_group">
                <input type="file" accept="image/*" capture="camera" class="cam_input" id="foto" name="foto_reg">
                <label for="foto" class="cam_label">Seleccionar Foto:</label>
                <img id="image_c" src="<?php echo SERVERURL; ?>vistas/Recursos/vectores/default-user.svg" alt="Usuario">
              </div>
              <input type="hidden" value="Registrar_De_Manera_Automatica" name="accion_del_form">
              <input type="submit" value="Enviar">
            </div>
        </form>
      </div>

      <input type="radio" name="radio" id="radio2">
      <div id="form2" class="form">
        <h2>Inscripción manual</h2>
        <form action="<?php echo SERVERURL; ?>controladores/Agregar_Registro_Controlador.php" method="POST" enctype="multipart/form-data">          
          <div class="form_container">

            <div class="form_group">
              <input type="text" id="nombre_completo" class="form_input" name="nombre_completo_reg1" placeholder=" ">
              <label for="nombre_completo" class="form_label">Nombre completo:</label>
              <span class="form_line"></span>
            </div>

            <div class="form_group">
              <input type="text" id="nro_registro" class="form_input" name="nro_registro_reg1" placeholder=" ">
              <label for="nro_registro" class="form_label">Nro de registro:</label>
              <span class="form_line"></span>
            </div>

            <div class="form_group">
              <label for="carrera" class="select_label">Carrera:</label>
              <select id="carrera" class="select_input" name="carrera_reg1">
                <option value="Ingenieria de sistemas">Ingenieria de sistemas</option>
                <option value="Ingenieria Comercial">Ingenieria Comercial</option>
                <option value="Psicologia">Psicologia</option>
              </select>
            </div>

            <div class="form_group">
              <input type="tel" pattern="[67]\d{7}" maxlength="8" id="nro_celular" class="form_input"
                name="nro_celular_reg1" placeholder=" ">
              <label for="nro_celular" class="form_label">Nro de celular:</label>
              <span class="form_line"></span>
            </div>

            <div class="form_group">
              <label for="talla_polera" class="select_label">Talla de polera:</label>
              <select id="talla_polera" class="select_input" name="talla_polera_reg1">
                <option value="S">S</option>
                <option value="M">M</option>
                <option value="L">L</option>
                <option value="XL">XL</option>
              </select>
            </div>

            <div class="form_group">
              <input type="text" id="ci" class="form_input" name="ci_reg1" placeholder=" ">
              <label for="ci" class="form_label">C.I.:</label>
              <span class="form_line"></span>
            </div>

            <div class="form_group">
              <input type="file" accept="image/*" capture="camera" class="cam_input" id="foto1" name="foto_reg1">
              <label for="foto1" class="cam_label">Seleccionar Foto:</label>
              <img id="image_c1" src="<?php echo SERVERURL; ?>vistas/Recursos/vectores/default-user.svg" alt="Usuario">
            </div>
            <input type="hidden" value="Registrar_De_Manera_Manual" name="accion_del_form">

            <input type="submit" value="Enviar">
          </div>
        </form>
      </div>

      <input type="radio" name="radio" id="radio3">
      <div id="form3" class="form">
        <h2>Ver inscripción</h2>
        <form action="<?php echo SERVERURL; ?>controladores/Agregar_Registro_Controlador.php" method="POST">          
          <div class="form_container">

            <div class="form_group" id="cargar-nro">
              <input type="text" id="nro_registro" class="form_input" name="nro_registro_reg2" placeholder=" ">
              <label for="nro_registro" class="form_label">Nro de registro:</label>
              <span class="form_line"></span>
              <button>Cargar datos</button>
            </div>

            <div class="form_group" id="datos-cargados">
              <input type="text" id="nombre_completo" class="readonly_input" name="nombre_completo_reg2" placeholder="  Nombre completo" readonly>
              <span class="form_line"></span>
            </div>

            <div class="form_group" id="datos-cargados">
              <input type="text" id="carrera" class="readonly_input" name="carrera_reg2" placeholder="  Carrera" readonly>
              <span class="form_line"></span>
            </div>

            <div class="form_group">
              <label for="estado_inscripcion" class="select_label">Estado:</label>
              <select id="estado_inscripcion" class="select_input" name="estado_inscripcion_reg">
                <option value="inscrito">Inscrito</option>
                <option value="no-inscrito">No inscrito</option>
              </select>
            </div>
            <input type="hidden" value="Editar_Inscripcion" name="accion_del_form">
            <input type="submit" value="Actualizar">
          </div>
        </form>
      </div>
    </div>
  </div>
  <footer>
    <img src="<?php echo SERVERURL; ?>vistas/Recursos/vectores/Powered_by.svg" alt="Powered_by">
  </footer>
  <script src="<?php echo SERVERURL; ?>vistas/javascript/dashboard-js.js"></script>
</body>

</html>