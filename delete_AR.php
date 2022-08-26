<?php
session_start();
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

ob_end_clean();
include("database.php");
include "head.php";

if (isset($_POST['id'])) {
	$id = $_POST['id'];

	$insertqry = "DELETE FROM `areas` WHERE area_id = '$id'";
	$insertres = mysqli_query($con, $insertqry);
	if ($insertres === TRUE) {
		$_SESSION["notificacion_area"] = '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-success alert-dismissible fade show " role="alert">
				<strong>Hecho!</strong> Se ha borrado el area correctamente.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div></div>';
	} else {
		$_SESSION["notificacion_area"] = '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-danger alert-dismissible fade show " role="alert">
				<strong>Oh no!</strong> Algo inesperado ha sucedido, intenta de nuevo mas tarde.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div></div>';
	}
	$qry = "SELECT * FROM indicadores WHERE area_id = '$id'";
	$res = mysqli_query($con, $qry);

	while ($row = mysqli_fetch_assoc($res)) {
		
		$indicador_nax = $row['indicador_url'];

		$qry = "DELETE FROM acceso_areas WHERE indicador_id = '" . $row['indicador_id'] . "'";
		mysqli_query($con, $qry);

		$query = "DROP TABLE IF EXISTS `" . $row['nombre_indicador'] . "`";
		mysqli_query($con, $query);

		unlink($indicador_nax);
	}

	$qry = "DELETE FROM indicadores WHERE area_id = '$id'";
	mysqli_query($con, $qry);

	$qry = "DELETE FROM etiquetas WHERE area_id = '$id'";
	mysqli_query($con, $qry);

	$qry = "DELETE FROM etiquetasn WHERE area_id = '$id'";
	mysqli_query($con, $qry);
}
ob_end_clean();
