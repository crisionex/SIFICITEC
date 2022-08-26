<?php
require_once '../database.php';
$nombre = $_POST['nombre'];
$area_id = $_POST['area_id'];
$indicador_id = $_POST['indicador_id'];

if (!empty($nombre) && !empty($area_id)) {
$qry = "INSERT INTO etiquetas (nombre, area_id, indicador_id) VALUES ('$nombre', '$area_id', '$indicador_id')";
$res=mysqli_query($con,$qry);
if ($res === TRUE) {
  $n = '
  <div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-success alert-dismissible fade show " role="alert">
      <strong>Hecho!</strong> Etiqueta creada correctamente.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
  </div>
  ';
  } else {
      $n = '
    <div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-danger alert-dismissible fade show " role="alert">
      <strong>Oh no!</strong> Algo inesperado ha sucedido, intenta de nuevo mas tarde.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>
  ';
  }
} else {
  $n = '
    <div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-danger alert-dismissible fade show " role="alert">
      <strong>Oh no!</strong> Ingresa todos los campos.
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    </div>';
}

echo $n;
?>