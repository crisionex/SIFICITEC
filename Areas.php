<!DOCTYPE html>
<html>

<?php include 'head.php'; ?>
<script lang="javascript" src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
<script>
	$(document).ready(function() {
		$(".borrar").click(function() {
			document.getElementById('borrar-area').value = $(this).val();
		});
	});

	$(document).ready(function() {
		$("#borrar-area").click(function() {
			id = $(this).val();
			$.ajax({
				url: "delete_AR.php",
				method: "POST",
				data: {
					id: $(this).val()
				},
				success: function(data) {
					window.location = 'Areas.php';
				}
			})
		});
	});

	function HTMLEXCEL(type) {
		var data = document.getElementById('tabla-generada');
		var nombre = 'informe';

		var file = XLSX.utils.table_to_book(data, {
			sheet: "sheet1"
		});
		XLSX.write(file, {
			bookType: type,
			bookSST: true,
			type: 'base64'
		});
		XLSX.writeFile(file, nombre + '.' + type);
	}
	$(document).ready(function() {
		$("#descargar").click(function() {
			$.ajax({
				url: "query/informes.php",
				success: function(data) {
					console.log(data);
					$('#tabla-1').html(data);
					HTMLEXCEL('xlsx');
				}
			})
		});
	});
</script>

<body>

	<?php
	if ($datosUsuario['departamento_usuario'] == 'Admin') {
	?>
		<?php include 'menu.php'; ?>
		<div class="container">
			<div id="tabla-1" style="display: none;">
			</div>
			<div class="row">
				<div class="col-md-8">
					<br>
					<div style="display: flex; justify-content:space-between;">
						<h4>Lista de áreas</h4> <button class="btn btn-secondary" id="descargar">Generar informe</button>
					</div>

					<hr>

					<!-- Modal -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Cuidado!</h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									Esta a punto de borrar un area, esta accion es <b>Irreversible</b>, desea continuar?
								</div>
								<div class="modal-footer">
									<button id="borrar-area" type="button" class="btn btn-danger" data-bs-dismiss="modal">Entiendo y quiero continuar</button>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Nombre del área</th>
								<th>Estatus</th>
								<th>Opciones</th>
							</tr>
						</thead>
						<tbody>
							<?php
							include 'database.php';
							$arealistqry = "SELECT * from areas";
							$arealistres = mysqli_query($con, $arealistqry);
							while ($areadata = mysqli_fetch_assoc($arealistres)) {
							?>
								<tr>
									<td><?php echo $areadata['nombre_area']; ?></td>
									<td>
										<center><?php
												if ($areadata['estado_area'] == 'Pendiente') {
													echo "<span class=\"badge bg-warning rounded-pill\">" . $areadata['estado_area'] . "</span>";
												} elseif ($areadata['estado_area'] == 'Activo') {
													echo "<span class=\"badge bg-success rounded-pill\">" . $areadata['estado_area'] . "</span>";
												} elseif ($areadata['estado_area'] == 'Inactivo') {
													echo "<span class=\"badge bg-danger rounded-pill\">" . $areadata['estado_area'] . "</span>";
												} ?>
										</center>
									</td>
									<td>
										<a href="edit_AR.php?id=<?php echo $areadata['area_id'] ?>" class="btn btn-dark">
											Editar
										</a>
										<button type="button" class="btn btn-danger borrar" data-bs-toggle="modal" data-bs-target="#exampleModal" value="<?php echo $areadata['area_id'] ?>">
											Borrar
										</button>
									</td>
								</tr>
							<?php
							}
							?>

						</tbody>
					</table>
				</div>

				<div class="col-md-4">
					<br>
					<h4>Añadir área</h4>
					<hr>
					<form method="post" action="Areas_db.php">
						<div class="form-group">
							<label for="nom-area"><b>Nombre del área</b></label>
							<input id="nom-area" autocomplete="off" autofill="off" autofill="off" type="text" name="nombre_area" placeholder="Nombre del area" class="form-control" required>
						</div>
						<div class="form-group">
							<label for="area-sts"><b>Estatus del área</b></label>
							<select id="area-sts" class="form-control" name="estado_area">
								<option value="Activo">Activo</option>
								<option value="Inactivo">Inactivo</option>
							</select>
						</div>
						<div class="form-group" style="display: grid;">
						</div>
						<div class="form-group">
							<center><input name="area_submit" class="btn btn-primary" type="submit" value="Añadir área"></center>
						</div>
						<?php
						if (isset($_SESSION["notificacion_area"])) {
							echo $_SESSION["notificacion_area"];
							$_SESSION["notificacion_area"] = '';
						}
						?>
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