<!DOCTYPE html>
<html>
<?php
session_start();
require 'database.php';
require 'sesion/alta_usuario.php';

if (isset($_SESSION['user_email'])) {
	header('Location: index.php');
	exit;
}

?>


<?php include 'head.php';

if ($datosUsuario['departamento_usuario'] == 'Admin' || $datosUsuario['departamento_usuario'] == 'JA') {

?>

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Registro de usuario</title>
	</head>

	<body>
		<?php include 'menu.php'; ?>
		<form action="" method="POST">

			<div class="container">
				<div class="row">
					<?php
					if ($datosUsuario['departamento_usuario'] == 'Admin') {
					?>
						<div class="col-md-6">
						<?php
					}
					if ($datosUsuario['departamento_usuario'] == 'JA') {
						?>
							<div class="col">
							<?php
						}
							?>
							<br>
							<br>
							<h2>Usuarios</h2>
							<hr>
							<table class="table table-bordered rounded table-striped">
								<thead>
									<tr>
										<th>Nombre del usuario</th>
										<th>Correo</th>
										<th>Estatus</th>
										<th>Opciones</th>
									</tr>
								</thead>
								<tbody>
									<?php
									include 'database.php';
									if ($datosUsuario['departamento_usuario'] == 'Admin') {
										$usuariolistqry = "SELECT * from usuarios";
										$usuariolistres = mysqli_query($con, $usuariolistqry);
									} else if ($datosUsuario['departamento_usuario'] == 'JA' && !empty($datosUsuario['area_id'])) {
										$usuariolistqry = "SELECT * from usuarios WHERE area_id = '".$datosUsuario['area_id']."' OR area_id = '' AND departamento_usuario = 'EG'";
										$usuariolistres = mysqli_query($con, $usuariolistqry);
									}
									while ($usuariodata = mysqli_fetch_assoc($usuariolistres)) {
										if ($usuariodata['id_usuario'] != $datosUsuario['id_usuario']) {
									?>
											<tr>
												<td><?php echo $usuariodata['nombre_usuario']; ?></td>
												<td><?php echo $usuariodata['email']; ?></td>
												<td><?php echo $usuariodata['estado_usuario']; ?></td>
												<td>
													<a href="edit_usuario.php?id=<?php echo $usuariodata['id_usuario'] ?>" class="btn btn-dark">
														Editar
													</a>
												</td>
											</tr>
									<?php
										}
									}
									?>

								</tbody>
							</table>
							</div>

							<?php
							if ($datosUsuario['departamento_usuario'] == 'Admin') {
							?>
								<div class="col-md-4">
									<form>
										<br>
										<br>
										<h2> Registro de cuenta </h2>
										<hr>
										<br>
										<div class="mb-3">
											<label for="username" class="form-label"><b>Usuario</b></label>
											<input autocomplete="off" autofill="off" type="text" class="form-control" placeholder="Ingrese nombre de usuario" id="username" name="form_usuario" required>
										</div>
										<div class="mb-3">
											<label for="email" class="form-label"><b>Email</b></label>
											<input autocomplete="off" autofill="off" type="email" class="form-control" placeholder="Ingrese email" id="email" name="form_email" required>
										</div>
										<div class="mb-3">
											<label for="password"><b>Constraseña</b></label>
											<input type="password" class="form-control" placeholder="Ingrese contraseña" id="password" name="form_password" required>
										</div>
										<div class="form-group" id="dhide">
											<label for="form-control"><b>Rol asignado</b></label>
											<select class="form-control" name="form_rol">
												<option value="" selected disabled>Seleccione un rol</option>
												<option value="Admin">Administrador</option>
												<option value="JA">Jefe de área</option>
												<option value="EG">Encargado de gestión</option>
											</select>
										</div>

										<script>
											document.getElementById('dhide').addEventListener('change', function() {
												var style = this.value != "Admin" ? 'block' : 'none';
												document.getElementById('hide').style.display = style;
											});
										</script>


										<div class="form-group" id="hide" style="display: none;">
											<?php
											?>
											<label for="lbl1"><b>Seleccionar área perteneciente</b></label>
											<select class="form-control" name="area_id" id="lbl1">
												<option value="">No Aplica</option>
												<?php
												$arealistqry = "SELECT * from areas where estado_area='Activo'";

												$arealistres = mysqli_query($con, $arealistqry);
												while ($areadata = mysqli_fetch_assoc($arealistres)) {
												?>
													<option value="<?php echo $areadata['area_id']; ?>"><?php echo $areadata['nombre_area']; ?></option>
												<?php } ?>
											</select>
										</div>
										<button type="submit" class="btn btn-primary">Registrar</button>

									</form>
								</div>
							<?php } ?>
						</div>
						<?php

						if (isset($success_message)) {
							echo '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-success alert-dismissible fade show " role="alert">
					<strong>Hecho!</strong> ' . $success_message . '
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				  </div></div>';
						}
						if (isset($error_message)) {
							echo '<div class="position-fixed bottom-0 end-0 p-3"><div class="alert alert-danger alert-dismissible fade show " role="alert">
					<strong>Oh no!</strong> ' . $error_message . '
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				  </div></div>';
						}
						?>
		</form>
		</div>
		</div>
	<?php
} else {
	include 'Sin_acceso.php';
}
	?>
	</body>
	<?php include 'footer.php'; ?>

</html>