<?php
require_once "database.php";
require 'head.php';
if (isset($_POST['indicador_submit'])&&isset($_POST['area_id'])&&isset($_POST['nombre_indicador'])&&isset($_POST['tbli'])) {
	$area_id = $_POST['area_id'];
	$nombre_indicador = $_POST['nombre_indicador'];
	$data_tbl_mtrx= $_POST['tbli'];
	$nombre_indicador = ucwords($nombre_indicador);

    $indicador_url = "" . substr(md5(uniqid(mt_rand(), true)), 0, 10) . ".php";
	
	$data_tbl = implode("\n",$data_tbl_mtrx);

	//generando datos de validacion
	if ($nombre_indicador != '' && $area_id != '') {
		$insertqry = "INSERT INTO `indicadores`( `area_id`, `nombre_indicador`, `indicador_url`, `indicador_visible`, estado_indicador, responsable, tbli) VALUES ('$area_id','$nombre_indicador','$indicador_url','Yes','Pendiente', '".$datosUsuario['nombre_usuario']."', '$data_tbl')";
		$insertres = mysqli_query($con, $insertqry);

		//si se ha admitido en espera
		if ($insertres === TRUE) {
			$_SESSION['alerta1'] = '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-warning alert-dismissible fade show " role="alert">
			<strong>Hecho!</strong> En espera de validacion.
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div></div>';
		}
		$insertqry = "SELECT * FROM indicadores where nombre_indicador='$nombre_indicador'";
		$insertres = mysqli_query($con, $insertqry);
		$datax2 = mysqli_fetch_assoc($insertres);
		$datax2 = $datax2['indicador_id'];

		$insertqry = "SELECT * FROM usuarios";
		$insertres = mysqli_query($con, $insertqry);
	}

}else{
//alerta en caso de que algun dato no exista
$_SESSION['alerta1'] = '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-danger alert-dismissible fade show " role="alert">
<strong>Oh no!</strong> Faltan datos en el indicador, procura llenar todos los campos.
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div></div>';
}
echo '<script>window.location="Indicadores.php";</script>';