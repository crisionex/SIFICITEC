<?php
include 'database.php';
include "head.php";
if (isset($_POST['permissionsubmit'])) {
	$id_usuario = $_POST['id_usuario'];
	if ($id_usuario != '') {
		$deleteqry = "DELETE FROM acceso_areas where id_usuario='$id_usuario'";
		$delteres = mysqli_query($con, $deleteqry);

		foreach ($_POST['permiso_usuario'] as $key => $value) {
			$permiso_usuario = $_POST['permiso_usuario'][$key];
			$area_id = $_POST['area_id'][$key];
			$indicador_id = $_POST['indicador_id'][$key];
			$area_id =$_POST['area_id'][$key];

			$qry = "INSERT INTO acceso_areas (permiso_usuario, indicador_id, id_usuario, area_id) VALUES ('$permiso_usuario','$indicador_id','$id_usuario', '$area_id')";
			$res=mysqli_query($con,$qry);
		}
	}
}
echo '<script>window.location="index.php";</script>';
