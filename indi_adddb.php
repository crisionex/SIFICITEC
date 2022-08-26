<?php
include 'database.php';
include "head.php";
$submi = $_GET['indicador_id'];
$mename = $_GET['nombre_indicador'];

$qry = "SELECT * FROM indicadores WHERE nombre_indicador = '".$_GET['nombre_indicador']."' ";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);
$indicador_url = $row['indicador_url'];
$indicador_name = ucwords($mename);
$indicador_nax = str_replace(' ', '', $indicador_name);

if (isset($_POST['area_submit'])) {
	$dataxr = array();
	$cntn = 0;
	$nombresc = "";
	$valoresc = "";


	$sql = "SHOW COLUMNS FROM `$mename`";
	$result = mysqli_query($con, $sql);
	while ($row = mysqli_fetch_array($result)) {
		if ($cntn != 0) {
			array_push($dataxr, $row['Field']);
		}
		$cntn += 1;
	}
	$nelem = sizeof($dataxr);
	for ($i = 0; $i < $nelem; $i++) {
		if ($i == ($nelem - 1)) {
			$nombresc .= "`" . $dataxr[$i] . "`";
			$valoresc .= "'" . $_POST['z' . $i . ''] . "'";
		} else {
			$nombresc .= "`" . $dataxr[$i] . "`,";
			$valoresc .= "'" . $_POST['z' . $i . ''] . "',";
		}
	}

	$insertqry = "INSERT INTO `$mename`(" . $nombresc . ") VALUES (" . $valoresc . ")";
	$insertres = mysqli_query($con, $insertqry);
}
echo "<script> window.location = '$indicador_url'; </script>";

