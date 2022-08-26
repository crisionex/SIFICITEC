<?php
require "../database.php";
session_start();
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

ob_end_clean();

$nombre = $_POST['nombre'];
$ctn = $_POST['ctn'];
$td = $_POST['td'];

if ($td != '' && $nombre != '') {
    $qry = "INSERT INTO columnas (nombre,ctn,td) VALUES ('$nombre','$ctn','$td')";
    $res = mysqli_query($con, $qry);
}
ob_end_clean();

$datao = '';
$qry = "SELECT * FROM columnas";
$res = mysqli_query($con, $qry);

$datao .= '<div class="list-group" >';
while ($row = mysqli_fetch_assoc($res)) {
    $datao .= ' <label class="list-group-item border">
    <a><input class="form-check-input me-1" type="checkbox" name="tbli[]" value="' . $row['nombre'] . '">
    ' . $row['nombre'] . '</a>
    <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" onclick="dicol(this.value, 1)" class="btn btn-dark" value="' . $row['id'] . '" id="infcol" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-circle-info"></i></button>
        <button type="button" onclick="dicol(this.value, 2)" class="btn btn-secondary" value="' . $row['id'] . '" id="infcol"><i class="fa-solid fa-trash"></i></button>
    </div>
    </label>
    ';
}
$datao .= '</div>';
echo $datao;

if ($td == '' && $nombre == '') {
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>No valido!</strong> Compruebe que los datos ingresados sean correctos.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
