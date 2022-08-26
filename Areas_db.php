<?php
include 'database.php';
session_start();

if (isset($_POST['area_submit'])) {
	$nombre_area = $_POST['nombre_area'];
	$icono_area = "";

	//si existe nombre del area
	if ($nombre_area != '') {
		$nombre_val = mysqli_query($con, "SELECT nombre_area FROM areas WHERE nombre_area = '$nombre_area'");

		//verificamos que no haya nombres duplicados
		if (mysqli_num_rows($nombre_val) > 0) {
			//notificacion de duplicado
			$_SESSION["notificacion_area"] = '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-warning alert-dismissible fade show " role="alert">
			<strong>No valido!</strong> El area ya existe en el sistema!
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div></div>';
		} else {
			$insertqry = "INSERT INTO `areas`( `nombre_area`) VALUES ('$nombre_area')";
			$insertres = mysqli_query($con, $insertqry);
			//verificamos que el query
			if ($insertres) {
				//velidacion correcta
				$_SESSION["notificacion_area"] = '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-success alert-dismissible fade show " role="alert">
				<strong>Hecho!</strong> El area ha sido creada correctamente.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div></div>';
			} else {
				//validacion incorrecta
				$_SESSION["notificacion_area"] = '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-danger alert-dismissible fade show " role="alert">
				<strong>Oh no!</strong> Algo inesperado ha sucedido, intenta de nuevo mas tarde.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div></div>';
			}
		}
	} else {
		//no existe nombre de area
		$_SESSION["notificacion_area"] = '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-warning alert-dismissible fade show " role="alert">
		<strong>Vaya!</strong> Faltan datos en el area, procura llenar todos los campos.
		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div></div>';
	}
}
echo '<script>window.location="Areas.php";</script>';
