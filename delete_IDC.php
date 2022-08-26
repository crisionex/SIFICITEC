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

	$qry = "SELECT * FROM indicadores WHERE indicador_id = '$id'";
	$res = mysqli_query($con, $qry);
	if ($res) {
		$_SESSION['alerta1'] = '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-success alert-dismissible fade show " role="alert">
		<strong>Hecho!</strong> Se ha borrado el indicador correctamente.
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div></div>';
	} else {
		$_SESSION['alerta1'] = '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-danger alert-dismissible fade show " role="alert">
		<strong>Oh no!</strong> Algo salio mal, intenta mas tarde.
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div></div>';
	}

	$row = mysqli_fetch_assoc($res);

	$insertqry = "DELETE FROM `indicadores` WHERE indicador_id = $id";
	$insertres = mysqli_query($con, $insertqry);
	$indicador_nax = $row['indicador_url'];

	$query = "DROP TABLE IF EXISTS `" . $row['nombre_indicador'] . "`";
	mysqli_query($con, $query);

	unlink($indicador_nax);
} else {
	$_SESSION['alerta1'] = '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-danger alert-dismissible fade show " role="alert">
	<strong>Oh no!</strong> Faltan datos en el indicador, procura llenar todos los campos.
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
	</div></div>';
}
ob_end_clean();
