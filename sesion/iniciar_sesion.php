<?php
session_start();
require '../database.php';
require 'login.php';

if (isset($_SESSION['email'])) {
  header('Location: ../index.php');
  exit;
}


?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Iniciar sesion</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../dist/css/genstyle.css">
  <link rel="icon" href="../dist/img/Logo.png" type="image/x-icon">
</head>

<body>
  <div class="banner" style="display: flex; width:100%; background: url(../dist/img/texture.png); box-shadow: 1px 1px 5px #ccc;">
    <div class="logo"> <img src="../dist/img/Logo.png" alt="LOGO" style="padding-left: 10%; height: 225px; width: auto;"></div>
    <center>
      <div class="descripcion-logo" style="padding-left: 15vw;">
        <br><br><br>
        <h1 style="font-weight: normal; color: #057445;">UNIVERSIDAD AUTÓNOMA DE BAJA CALIFORNIA</h1>
        <h3 style="font-weight: normal; color: #3b3b3b;">SISTEMA DE INDICADORES</h3>
      </div>
    </center>
  </div>
  <form action="" method="POST">
    <br><br><br>
    <div class="d-flex justify-content-center">
      <div class="col-md-4" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px; padding: 45px; border-radius:25px;">
        <form>
          <br>
          <h2>Iniciar Sesión</H2>
          <br>
          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="form_email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="form_password" required>
          </div>
          <center><button type="submit" class="btn btn-primary">Iniciar sesión</button></center>
        </form>
      </div>
    </div>
    <?php
    if (isset($success_message)) {
      echo '<br><div class="row justify-content-md-center"><div class="alert alert-success" role="alert">' . $success_message . '</div></div>';
    }
    if (isset($error_message)) {
      echo '<br><div class="row justify-content-md-center"><div class="alert alert-danger" role="alert">' . $error_message . '</div></div>';
    }
    ?>

  </form>
  <br><br>
  <center>
    <footer id="footer">
      <br>
      <br>
      <p>
        <a style="color: rgba(55,0,151,1);" href="http://www.uabc.mx/">D.R.© Universidad Autónoma de Baja California</a>
        <br>
        México 2022
        <br>
        <small>Actualización: 29 de Abril de 2022</small>
      </p>

    </footer>
  </center>
</body>

</html>