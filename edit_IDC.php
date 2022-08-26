<?php
include("database.php");
include("head.php");

$nombre = '';
$orden = '';
$status = '';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $insertqry = "SELECT * FROM indicadores WHERE indicador_id=$id";
  $insertres = mysqli_query($con, $insertqry);
  if (mysqli_num_rows($insertres) == 1) {
    $areadata = mysqli_fetch_array($insertres);
    $nombre = $areadata['nombre_indicador'];
    $orden = $areadata['orden_indicador'];
    $status = $areadata['estado_indicador'];
  }
}

if (isset($_POST['update'])) {
  $id = $_GET['id'];
  $nombre = $areadata['nombre_indicador'];
  $orden = $areadata['orden_indicador'];
  $status = $areadata['estado_indicador'];

  $query = "UPDATE indicadores set nombre_indicador = '$nombre', orden_indicador='$orden', estado_indicador = '$status' WHERE indicador_id='$id'";
  mysqli_query($con, $query);
  $_SESSION['message'] = 'Indicador actualizado correctamente';
  $_SESSION['message_type'] = 'warning';
  header('Location: Indicadores.php');
}
if ($datosUsuario['departamento_usuario'] == 'Admin' || $datosUsuario['departamento_usuario'] == 'JA') {
?>
  <div class="container p-4">
    <div class="row">
      <div class="col-md-4 mx-auto">
        <div class="card card-body">
          <form action="edit_IDC.php?id=<?php echo $_GET['id']; ?>" method="POST">
            <div class="form-group">
              <input autocomplete="off" autofill="off" name="nombre_indicador" type="text" class="form-control" value="<?php echo $nombre; ?>" placeholder="Actualizar Nombre" required>
            </div>
            <div class="form-group">
              <select class="form-control" name="orden_indicador">
                <?php
                for ($i = 1; $i < 10; $i++) {
                ?>
                  <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="form-group">
              <select class="form-control" name="estado_indicador" value="<?php echo $status; ?>">
                <option value="Activo">Activo</option>
                <option value="Inactivo">Desactivo</option>
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
<?php include('footer.php'); ?>