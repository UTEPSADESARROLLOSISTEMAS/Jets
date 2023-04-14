<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/svg+xml" href="<?php echo SERVERURL; ?>vistas/Recursos/vectores/Icono.svg">
    <link rel="stylesheet" href="<?php echo SERVERURL; ?>vistas/css/login-style.css">

    </head>
  
<body>
  <div class="login-container">
    <div class="login-box">
      <img src="<?php echo SERVERURL; ?>vistas/Recursos/vectores/login_user.svg" alt="Avatar">

      <form class="login-form" action="<?php echo SERVERURL;?>controladores/login_Controlador.php" class="form_input_login" method="POST">
        <h1>INICIO DE SESION</h1>
        <label>
          <span id="username-icon"><i class="fa fa-user"></i></span>
          <input type="text" placeholder="Usuario" name="username_Login" required
            onfocus="document.getElementById('username-icon').style.color='#EB002E';"
            onblur="document.getElementById('username-icon').style.color='#999';">
        </label>
        <label>
          <span id="password-icon"><i class="fa fa-lock"></i></span>
          <input type="password" placeholder="Contraseña" name="password_Login" required
            onfocus="document.getElementById('password-icon').style.color='#EB002E';"
            onblur="document.getElementById('password-icon').style.color='#999';">
        </label>
        <input type="hidden" name="accionDeBotonLogin" value="IniciarSesion" id="">
        <input type="submit" value="Iniciar sesión">
        <p class="message">¿No estas registrado? <a href="#" id="inactive">Crea una cuenta</a></p>
      </form>

      <form class="register-form"  action="<?php echo SERVERURL;?>controladores/login_Controlador.php" class="form_input_login" method="POST">
        <h1>REGISTRAR</h1>
        <label>
          <span id="name-icon"><i class="fa fa-laptop"></i></span>
          <input type="text" placeholder="Nombre completo" name="name_vna_Registrar_reg" required
            onfocus="document.getElementById('name-icon').style.color='#EB002E';"
            onblur="document.getElementById('name-icon').style.color='#999';">
        </label>
        <label>
          <span id="user-icon"><i class="fa fa-user"></i></span>
          <input type="text" placeholder="Usuario" name="user_vna_Registrar_reg" required
            onfocus="document.getElementById('user-icon').style.color='#EB002E';"
            onblur="document.getElementById('user-icon').style.color='#999';">
        </label>
        <label>
          <span id="pass-icon"><i class="fa fa-lock"></i></span>
          <input type="password" placeholder="Contraseña" name="pass_vna_Registrar_reg" required
            onfocus="document.getElementById('pass-icon').style.color='#EB002E';"
            onblur="document.getElementById('pass-icon').style.color='#999';">
        </label>
        <input type="hidden" name="accionDeBotonLogin" value="Registrar" id="">
        <input type="submit" value="Registrarse">
        <p class="message">¿Ya estas registrado? <a href="#" id="active">Iniciar sesion</a></p>
      </form>

    </div>
  </div>
  <footer>
    <img src="<?php echo SERVERURL; ?>vistas/Recursos/vectores/Powered_by.svg" alt="Powered_by">
  </footer>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $('.message a').click(function () {
      $('form').animate({ height: "toggle", opacity: "toggle" }, "slow");
    });
  </script>
</body>

</html>