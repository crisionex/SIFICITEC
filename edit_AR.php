<!DOCTYPE html>
<html>
<?php
include("database.php");
include("head.php");

$name = '';
$status = '';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $insertqry = "SELECT * FROM areas WHERE area_id=$id";
  $insertres = mysqli_query($con, $insertqry);
  if (mysqli_num_rows($insertres) == 1) {
    $areadata = mysqli_fetch_array($insertres);
    $name = $areadata['nombre_area'];
    $status = $areadata['estado_area'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $name = $_POST['nombre_area'];
  $status = $_POST['estado_area'];

  $query = "UPDATE areas set nombre_area = '$name', estado_area = '$status' WHERE area_id=$id";
  mysqli_query($con, $query);
  $_SESSION['message'] = 'area actualizada correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: Areas.php');
}
if ($datosUsuario['departamento_usuario'] == 'Admin') {
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<?php include "menu.php"; ?>
<body>
  <div class="container p-4">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <div class="card card-body">
          <form action="edit_AR.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="form-group">
              <input autocomplete="off" autofill="off" name="nombre_area" type="text" class="form-control" value="<?php echo $name; ?>" placeholder="Actualizar Nombre" required>
            </div>
            <div class="form-group">
              <select class="form-control" name="estado_area" value="<?php echo $status; ?>">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Inactivo</option>
              </select>
            </div>

            <button class=" btn btn-success" name="update">
              Actualizar
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
<?php
} else {
  header('Location: Sin_acceso.php');
}

?>
</body>
<?php include('footer.php'); ?>
</html>