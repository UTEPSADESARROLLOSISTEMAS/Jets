<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/dashboard-style.css">
  <link rel="icon" type="image/svg+xml" href="<?php echo SERVERURL; ?>vistas/Recursos/vectores/Icono.svg">
</head>

<body>
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
        <form action="<?php echo SERVERURL; ?>controladores/Agregar_Registro_Controlador.php" method="POST">
          <label for="nro_registro">Nro de registro:</label>
          <div id="cargar-nro">
            <input type="text" id="nro_registro" name="nro_registro_reg">
            <button type="button" onclick="enviarPeticionAJAX()">Cargar datos</button>
          </div>

          <div id="datos-cargados">
            <label for="nombre_completo">Nombre completo:</label>
            <input type="text" readonly class="readonly-input" id="nombre_completo" name="nombre_completo_reg">
            <label for="carrera">Carrera:</label>
            <input type="text" readonly class="readonly-input" id="carrera" name="carrera_reg">
          </div>

          <label for="nro_celular">Nro de celular:</label>
          <input type="tel" pattern="[67]\d{7}" maxlength="8" id="nro_celular" name="nro_celular_reg"><br>

          <label for="talla_polera">Talla de polera:</label>
          <select id="talla_polera" name="talla_polera_reg">
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
          </select><br>

          <label for="ci">C.I.:</label>
          <input type="text" id="ci" name="ci_reg"><br>

          <label for="foto">Foto:</label>
          <input type="file" accept="image/*" capture="camera" id="foto" name="foto_reg"><br>

          <input type="submit" value="Enviar">
        </form>
      </div>

      <input type="radio" name="radio" id="radio2">
      <div id="form2" class="form">
        <h2>Inscripción manual</h2>
        <form action="<?php echo SERVERURL; ?>controladores/Agregar_Registro_Controlador.php" method="POST">
          <label for="nombre_completo">Nombre completo:</label>
          <input type="text" id="nombre_completo" name="nombre_completo_reg1"><br>

          <label for="nro_registro">Nro de registro:</label>
          <input type="text" id="nro_registro" name="nro_registro_reg1"><br>

          <label for="carrera">Carrera:</label>
          <select id="carrera" name="carrera_reg1">
            <option value="Ingenieria de sistemas">Ingenieria de sistemas</option>
            <option value="Ingenieria Comercial">Ingenieria Comercial</option>
            <option value="Psicologia">Psicologia</option>
          </select><br>

          <label for="nro_celular">Nro de celular:</label>
          <input type="tel" pattern="[67]\d{7}" maxlength="8" id="nro_celular" name="nro_celular_reg1"><br>

          <label for="talla_polera">Talla de polera:</label>
          <select id="talla_polera" name="talla_polera_reg1">
            <option value="S">S</option>
            <option value="M">M</option>
            <option value="L">L</option>
            <option value="XL">XL</option>
          </select><br>

          <label for="ci">C.I.:</label>
          <input type="text" id="ci" name="ci_reg1"><br>

          <label for="foto">Foto:</label>
          <input type="file" accept="image/*" capture="camera" id="foto" name="foto_reg1"><br>

          <input type="submit" value="Enviar">
        </form>
      </div>

      <input type="radio" name="radio" id="radio3">
      <div id="form3" class="form">
        <h2>Ver inscripción</h2>
        <form action="<?php echo SERVERURL; ?>controladores/Agregar_Registro_Controlador.php" method="POST">
          <label for="nro_registro">Nro de registro:</label>
          <div id="cargar-nro">
            <input type="text" id="nro_registro" name="nro_registro_reg2">
            <button onclick="cargar_nro_registro()">Cargar datos</button>
          </div>

          <div id="datos-cargados">
            <label for="nombre_completo">Nombre completo:</label>
            <input type="text" readonly class="readonly-input" id="nombre_completo" name="nombre_completo_reg2">
            <label for="carrera">Carrera:</label>
            <input type="text" readonly class="readonly-input" id="carrera" name="carrera_reg2">
          </div>
          <div>
            <label for="estado-inscripcion">Estado:</label>
            <select id="estado-inscripcion" name="estado-inscripcion_reg2">
              <option value="inscrito">Inscrito</option>
              <option value="no-inscrito">No inscrito</option>
            </select>
          </div>
          <input type="submit" value="Actualizar">
        </form>
      </div>
    </div>
  </div>

  <script>
  </script>

</body>

</html>