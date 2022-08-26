<!DOCTYPE html>
<html>
<?php
include 'head.php';
if ($datosUsuario['departamento_usuario'] == 'Admin' || $datosUsuario['departamento_usuario'] == 'JA') {
	if (isset($_POST['permission_update'])) {
		include 'database.php';
		$id_usuario = $_POST['id_usuario'];
		$req = "SELECT * from usuarios where id_usuario= '$id_usuario'";
		$res1 = mysqli_query($con, $req);
		$data1 =  mysqli_fetch_assoc($res1);
?>

		<body>
			<?php include 'menu.php';
			?>

			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<br><br>
						<h4>Permisos de usuario</h4>

						<form method="post" action="Permisos_db.php">
							<input type="hidden" name="id_usuario" value="<?php echo $id_usuario; ?>">
							<table class="table">
								<thead>
									<tr>
										<th>Área</th>
										<th>Indicador</th>
										<th>Permiso</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if ($data1['departamento_usuario'] == 'Admin') {
										$areaqry = "SELECT * from indicadores 
	inner join areas on areas.area_id=indicadores.area_id 
	where estado_indicador='Activo' ";
									} else {
										$areaqry = "SELECT * from indicadores 
	inner join areas on areas.area_id=indicadores.area_id
	inner join usuarios on usuarios.area_id= indicadores.area_id
	where estado_indicador='Activo' AND id_usuario='$id_usuario'";
									}

									$areares = mysqli_query($con, $areaqry);
									while ($areadata = mysqli_fetch_assoc($areares)) {
									?>
										<input type="hidden" name="area_id[]" value="<?php echo $areadata['area_id']; ?>">
										<input type="hidden" name="indicador_id[]" value="<?php echo $indicador_id = $areadata['indicador_id']; ?>">
										<tr>
											<td><?php echo $areadata['nombre_area']; ?></td>
											<td><?php echo $areadata['nombre_indicador']; ?></td>
											<td>
												<?php
												$permissionqry = "SELECT permiso_usuario from acceso_areas where indicador_id='$indicador_id' AND id_usuario='$id_usuario'";
												$permissionres = mysqli_query($con, $permissionqry);
												$permissiondata = mysqli_fetch_assoc($permissionres);
												$permiso_usuario = $permissiondata['permiso_usuario'];
												?>
												<select name="permiso_usuario[]" class="form-control">
													<option value="False">Falso</option>
													<option value="True">Verdadero</option>
												</select>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
							<input type="submit" name="permissionsubmit" class="btn btn-primary" value="Actualizar Permisos">
						</form>
					</div>
				</div>
			</div>
	<?php
	} else {
		echo '<script> window.location="index.php"; </script>';
	}
} else {
	include 'Sin_acceso.php';
}

	?>
		</body>
		<?php include 'footer.php'; ?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</html>