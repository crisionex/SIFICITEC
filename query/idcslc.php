<?php
require "../database.php";

session_start();
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

ob_end_clean();

$nombre = $_POST['etiqueta'];
$indicador_id = $_POST['smid'];
$area_id = $_POST['area_id'];
$periodo = $_POST['per'];
sort($periodo);
$sct = 0;
$suma = 0;

$qry = "SELECT * FROM etiquetas WHERE id = '$nombre' AND indicador_id = '$indicador_id'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

$etiquetas = preg_split('/[\,]+/', $row['etqs']);

$qry = "SELECT * FROM etiquetasn WHERE id = '" . $_POST['desgregar'] . "'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

$idfc = preg_split('/[\n]+/', $row['idfc']);
$ca = preg_split('/[\n]+/', $row['ca']);

$qry = "SELECT * FROM indicadores WHERE indicador_id = '$indicador_id'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

$nombretbl = $row['nombre_indicador'];

if (sizeof($periodo) == 1) {
    $data = '{';
    foreach ($idfc as $key => $val) {
        $data .= '"' . str_replace(array("\n", "\r"), '', $val) . '":[';
        $qry = "SELECT * FROM `$nombretbl` WHERE periodo = '" . $periodo[0] . "'";
        $res = mysqli_query($con, $qry);
        while ($row = mysqli_fetch_array($res)) {
            foreach ($ca as $key => $value) {
                if ($row[str_replace(array("\n", "\r"), '', $value)] == str_replace(array("\n", "\r"), '', $val)) {
                    $data .= '{';
                    for ($i = 0; $i < sizeof($etiquetas); $i++) {
                        $data .= '"n' . $i . '":' . $row[$etiquetas[$i]] . ',';
                        $sct = 1;
                    }
                    $data = substr_replace($data, "", -1);
                    $data .= '},';
                }
            }
        }
        $data = substr_replace($data, "", -1);
        $data .= '],';
        $data = str_replace('"' . str_replace(array("\n", "\r"), '', $val) . '":],', "", $data);
        $sct = 0;
    }
    $data = substr_replace($data, "", -1);
    $data .= '}';
} else {
    $data = '{';
    foreach ($periodo as $key => $val) {
        $data .= '"' . str_replace(array("\n", "\r"), '', $val) . '":[';
        $data .= '{';
        foreach ($idfc as $key1 => $value) {
            $qry = "SELECT * FROM `$nombretbl` WHERE periodo = '" . $val . "'";
            $res = mysqli_query($con, $qry);
            $data .= '"n' . $key1 . '":0,';
            while ($row = mysqli_fetch_array($res)) {
                foreach ($ca as $key2 => $value1) {
                    if ($row[str_replace(array("\n", "\r"), '', $value1)] == str_replace(array("\n", "\r"), '', $value)) {
                        for ($i = 0; $i < sizeof($etiquetas); $i++) {
                            $suma += $row[$etiquetas[$i]];
                            $sct = 1;
                        }
                        $data .= '"n' . $key1 . '":' . $suma . ',';
                        $suma = 0;
                    }
                }
            }
        }
        $data = substr_replace($data, "", -1);
        $data .= '},';
        $data = substr_replace($data, "", -1);
        $data .= '],';
        $data = str_replace('"' . str_replace(array("\n", "\r"), '', $val) . '":],', "", $data);
        $sct = 0;
    }
    $data = substr_replace($data, "", -1);
    $data .= '}';
}
ob_end_clean();
$data = json_decode($data);
echo json_encode($data);
