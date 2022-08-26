<?php
require_once "../database.php";
$qry = "SELECT * FROM etiquetas WHERE id = '" . $_POST['id'] . "'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

$array2 = preg_split('/[\,]+/', $row['etqs']);

$qry = "SELECT * FROM indicadores WHERE indicador_id = '" . $row['indicador_id'] . "'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);
$datao = '';
$contador1 = $_POST['longitud'];

$array = preg_split('/[\n]+/', $row['tbli']);

if (!empty($array2)) {
    $qry = "SELECT * FROM columnas";
    $res = mysqli_query($con, $qry);
    while ($row = mysqli_fetch_assoc($res)) {
        if (!in_array($row['nombre'], $array2) && $row['td'] == 'num') {
            if (in_array($row['nombre'], $array)) {
                $datao .= '<p class="draggable bg-primary text-center text-light" draggable="true" data-id="' . str_replace(array("\n", "\r"), '', $row['nombre']) . '">' . $row['nombre'] . '</p>';
            }
        }
    }
} else {
    $qry = "SELECT * FROM columnas";
    $res = mysqli_query($con, $qry);
    while ($row = mysqli_fetch_assoc($res)) {
        if (in_array($row['nombre'], $array) && $row['td'] == 'num') {
            $datao .= '<p class="draggable bg-primary text-center text-light" draggable="true" data-id="' . str_replace(array("\n", "\r"), '', $row['nombre']) . '">' . $row['nombre'] . '</p>';
        }
    }
}
echo $datao;
