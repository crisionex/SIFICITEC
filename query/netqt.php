<?php
require_once "../database.php";

$qry = "SELECT * FROM etiquetas WHERE id = '".$_POST['id']."'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

$qry = "SELECT * FROM indicadores WHERE indicador_id = '".$row['indicador_id']."'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

$cat = $row['nombre_indicador'];
echo $cat;