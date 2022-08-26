<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>
<?php
if ($datosUsuario['departamento_usuario'] == 'Admin' || $datosUsuario['departamento_usuario'] == 'JA') {
?>

	<body>
		<?php include 'menu.php'; ?>

		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<br><br>
					<h4>Permisos de usuario</h4>

					<form method="post" action="Lista_permisos.php">
						<div class="form-group">
							<label>Seleccione usuario</label>
							<select class="form-control" name="id_usuario" required>
								<option value="" selected disabled>Seleccione Usuario</option>
								<?php
								include 'database.php';
								if ($datosUsuario['departamento_usuario'] == 'Admin') {
									$usuariolistqry = "SELECT * from usuarios where estado_usuario='Activo'";
								} else if ($datosUsuario['departamento_usuario'] == 'JA') {
									$usuariolistqry = "SELECT * from usuarios where estado_usuario='Activo' AND area_id = '".$datosUsuario['area_id']."'";
								}
								$usuariolistres = mysqli_query($con, $usuariolistqry);
								while ($usuariodata = mysqli_fetch_assoc($usuariolistres)) {
								?>
									<option value="<?php echo $usuariodata['id_usuario']; ?>"><?php echo $usuariodata['nombre_usuario']; ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="form-group">
							<input type="submit" name="permission_update" class="btn btn-primary">
						</div>
					</form>
				</div>
			</div>
		</div>
	<?php
} else {
	include 'Sin_acceso.php';
}

	?>
	<?php include 'footer.php'; ?>

	</body>

</html>