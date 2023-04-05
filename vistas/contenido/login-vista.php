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
    <style>
      body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        background: url("<?php echo SERVERURL;?>vistas/Recursos/Imagenes/Utepsa_fondo.png");
        background-position: 50% 50%;
        background-repeat: no-repeat;
        background-size: cover;
      }
      .login-container {
        width: 100%;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
      }
      .login-box {
        width: 300px;
        background-color: #fff;
        padding: 40px;
        text-align: center;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      }
      .login-box img {
        position: absolute;
        left: 50%;
        transform: translateX(-50%) translateY(-80%);
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 50%;
        margin-bottom: 20px;
        border: 3px solid #ffffff;
      }
      .login-box h1 {
        font-weight: 500;
        margin-top: 60px;
        margin-bottom: 40px;
        color: #EB002E;
      }
      .login-box input[type="text"],
      .login-box input[type="password"] {
        width: 70%;
        padding: 12px 40px 12px 40px;
        border: none;
        border-bottom: 1px solid #ddd;
        margin-bottom: 20px;
        font-size: 16px;
        color: #555;
        outline: none;
      }

      .login-box input[type="text"]:focus,
      .login-box input[type="password"]:focus {
        transition: all 0.5s ease-out;
        border-bottom: 1px solid #EB002E;
        outline: none;
      }

      .login-box input[type="text"]::placeholder,
      .login-box input[type="password"]::placeholder {
        color: #bbb;
      }

      .login-box label {
        display: block;
        margin-bottom: 10px;
        position: relative;
      }
      .login-box label span {
        position: absolute;
        left: 10px;
        top: 30%;
        transform: translateY(-50%);
        font-size: 20px;
        color: #999;
      }
      .login-box input[type="submit"] {
        margin: 20px 0px 0px 0px;
        width: 100%;
        background-color: #EB002E;
        color: #fff;
        border: 1px solid #EB002E;
        border-radius: 30px;
        padding: 12px 20px;
        font-size: 16px;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.3s ease-in-out;
      }
      .login-box input[type="submit"]:hover {
        background-color: transparent;
        color: #EB002E;
        border: 1px solid #EB002E;
      }
    </style>
  </head>
  <body>
    <div class="login-container">
      <div class="login-box">
        <img src="<?php echo SERVERURL; ?>vistas/Recursos/vectores/login_user.svg" alt="Avatar">
        <h1>INICIO DE SESION</h1>
        <form action="<?php echo SERVERURL; ?>controladores/login_Controlador.php">
          <label>
            <span id="username-icon"><i class="fa fa-user"></i></span>
            <input type="text" placeholder="Usuario" name="username_Login" required onfocus="document.getElementById('username-icon').style.color='#EB002E';" onblur="document.getElementById('username-icon').style.color='#999';">
          </label>
          </label>
          <label>
            <span id="password-icon"><i class="fa fa-lock"></i></span>
            <input type="password" placeholder="Contraseña" name="password_Login" required onfocus="document.getElementById('password-icon').style.color='#EB002E';" onblur="document.getElementById('password-icon').style.color='#999';">
        </label>
        <input type="submit" value="Iniciar sesión">
      </form>
    </div>
  </div>
</body>
</html>