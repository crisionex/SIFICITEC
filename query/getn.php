<?php
require_once "../database.php";
$periodo = $_POST['per'];

if (sizeof($periodo) == 1) {
    $qry = "SELECT * FROM etiquetas WHERE id = '" . $_POST['id'] . "'";
    $res = mysqli_query($con, $qry);
    $row = mysqli_fetch_assoc($res);
    $datao = $row['etqs'];
} else if(sizeof($periodo) > 1) {
    $qry = "SELECT * FROM etiquetasn WHERE id = '".$_POST['idn']."'";
    $res = mysqli_query($con, $qry);
    $row = mysqli_fetch_assoc($res);
    $datao = $row['idfc'];
}
echo $datao;