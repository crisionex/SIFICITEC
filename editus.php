<!DOCTYPE html>
<html>
<?php
include("database.php");
include "head.php";
$name = '';
$email = '';
$pas = '';


if (isset($datosUsuario['id_usuario'])) {
  $id = $datosUsuario['id_usuario'];
  $insertqry = "SELECT * FROM usuarios WHERE id_usuario=$id";
  $insertres = mysqli_query($con, $insertqry);
  if (mysqli_num_rows($insertres) == 1) {
    $usuariodata = mysqli_fetch_array($insertres);
    $name = $usuariodata['nombre_usuario'];
    $email = $usuariodata['email'];
  }
}

if (isset($_POST['update'])) {
  $id = $datosUsuario['id_usuario'];
  $name = $_POST['nombre_usuario'];
  $email = $_POST['email'];
  $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);;

  $query = "UPDATE usuarios set nombre_usuario = '$name', email = '$email', password = '$pass' WHERE id_usuario='$id'";
  mysqli_query($con, $query);
  header('Location: salir.php');
}
?>

<body>
  <?php include "menu.php"; ?>
  <div class="d-flex justify-content-center">
    <div class="col-md-4">
      <form action="editus.php?id=<?php echo $datosUsuario['id_usuario']; ?>" method="POST">
        <br>
        <br>
        <h2> Configuración de mi cuenta </H2>
        <br>
        <div class="mb-3">
          <label for="username" class="form-label"><b>Usuario</b></label>
          <input autocomplete="off" autofill="off" type="text" class="form-control" placeholder="Ingrese nombre de usuario" id="username" name="nombre_usuario" value="<?php echo $name; ?>" required>
        </div>
        <div class="mb-3">
          <label for="emailz" class="form-label"><b>Email</b></label>
          <input autocomplete="off" autofill="off" type="email" class="form-control" placeholder="Ingrese email" id="emailz" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div class="mb-3">
          <label for="passwordz"><b>Constraseña</b></label>
          <input type="password" class="form-control" placeholder="Ingrese contraseña" id="passwordz" name="password" required>
        </div>
        <button class=" btn btn-success" name="update">
          Actualizar
        </button>
      </form>
    </div>
  </div>
</body>

<?php include 'footer.php'; ?>
</html>