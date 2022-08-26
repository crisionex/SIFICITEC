<?php
require_once '../database.php';
$nombre = $_POST['nombre'];
$netqs = $_POST['etiquetas'];

if (!empty($nombre) && !empty($netqs)) {
    $query = "UPDATE etiquetas set etqs = '$netqs' WHERE id= '$nombre'";
    if (mysqli_query($con, $query)) {
        $n = '
    <div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-success alert-dismissible fade show " role="alert">
        <strong>Hecho!</strong> Etiqueta actualizada correctamente.
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
        <strong>Oh no!</strong> Verifica la informacion.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      </div>';
}

echo $n;
