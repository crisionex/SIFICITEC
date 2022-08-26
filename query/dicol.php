<?php
require "../database.php";

$accion  = $_POST['accion'];
$id = $_POST['ID'];
$datao = '';
$alert = '';

if ($accion == 1) {
    $qry = "SELECT * FROM columnas WHERE id = '$id'";
    $res = mysqli_query($con, $qry);
    $row = mysqli_fetch_assoc($res);

    $datao = '
    <form>
    <fieldset disabled>
        <div class="mb-3">
            <label for="n-col" class="col-form-label">Nombre de la columna:</label>
            <input autocomplete="off" autofill="off" type="text" class="form-control" value="' . $row['nombre'] . '" required>
        </div>
        ';
    if ($row['td'] == "txt") {
        $datao .= '
        <div class="mb-3">
            <label for="n-col" class="col-form-label">Tipo de dato:</label>
            <input autocomplete="off" autofill="off" type="text" class="form-control" value="Texto" required>
        </div>
        <div class="mb-3">
            <label for="identificadores" class="col-form-label">Identificadores:</label>
            <textarea class="form-control" rows="3" required>' . $row['ctn'] . '</textarea>
        </div>
    ';
    } else {
        $datao .= '
        <div class="mb-3">
            <label for="n-col" class="col-form-label">Tipo de dato:</label>
            <input autocomplete="off" autofill="off" type="text" class="form-control" value="Numerico" required>
        </div>  
        ';
    }
    $datao .= '
    </fieldset>
    </form>';
    echo $datao;
} elseif ($accion == 2) {
    $qry = "DELETE FROM columnas WHERE id = '$id'";
    if (mysqli_query($con, $qry)) {
        $alert =  '
        <div class="alert alert-success alert-dismissible fade show " role="alert">
    <strong>Hecho!</strong> Se ha borrado la columna correctamente.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
    } else {
        $alert = '
        <div class="alert alert-danger alert-dismissible fade show " role="alert">
                <strong>Oh no!</strong> Error al tratar de borrar la columna, intente de nuevo mas tarde.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>';
    }
    $qry = "SELECT * FROM columnas";
    $res = mysqli_query($con, $qry);

    $datao .= '<div class="list-group" >';
    while ($row = mysqli_fetch_assoc($res)) {
        $datao .= ' <label class="list-group-item border">
<a><input class="form-check-input me-1" type="checkbox" name="tbli[]" value="' . $row['nombre'] . '">
' . $row['nombre'] . '</a>
<div class="btn-group" role="group" aria-label="Basic example">
    <button type="button" onclick="dicol(this.value, 1)" class="btn btn-dark" value="' . $row['id'] . '" id="infcol" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-info"></i></button>
    <button type="button" onclick="dicol(this.value, 2)" class="btn btn-secondary" value="' . $row['id'] . '" id="infcol"><i class="fa-solid fa-trash"></i></button>
</div>
</label>
';
    }
    $datao .= '</div>';
    echo $datao.$alert;
}
