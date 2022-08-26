<?php
include "head.php";
if (isset($_POST['form_usuario']) && isset($_POST['form_email']) && isset($_POST['form_password'])) {

	if (!empty(trim($_POST['form_usuario'])) && !empty(trim($_POST['form_email'])) && !empty($_POST['form_password'])) {

		$form_usuario = mysqli_real_escape_string($con, htmlspecialchars($_POST['form_usuario']));
		$form_email = mysqli_real_escape_string($con, htmlspecialchars($_POST['form_email']));
		$form_rol = mysqli_real_escape_string($con, htmlspecialchars($_POST['form_rol']));
		$mid = mysqli_real_escape_string($con, htmlspecialchars($_POST['area_id']));

		if (filter_var($form_email, FILTER_VALIDATE_EMAIL)) {
			$verifico_email = mysqli_query($con, "SELECT `email` FROM `usuarios` WHERE email = '$form_email'");

			if (mysqli_num_rows($verifico_email) > 0) {
				$error_message = "El email ingresado ya se encuentra utilizado, utilice otro correo para registrarse.";
			} else {
				$usuario_hash_password = password_hash($_POST['form_password'], PASSWORD_DEFAULT);

				$inserto_usuario = mysqli_query($con, "INSERT INTO `usuarios` (nombre_usuario, email, password, departamento_usuario, area_id) VALUES ('$form_usuario', '$form_email', '$usuario_hash_password', '$form_rol', '$mid')");

				$usuqry = "SELECT * from usuarios where nombre_usuario='$form_usuario'";
				$usudt = mysqli_query($con, $usuqry);
				$udt = mysqli_fetch_assoc($usudt);

				$menuqry = "SELECT * from indicadores where estado_indicador='Activo'";
				$inserto_permisos = mysqli_query($con, $menuqry);

				while ($subs = mysqli_fetch_assoc($inserto_permisos)) {
					if ($mid != $subs['area_id'] || $_POST['form_rol'] == 'EG') {
						$menuqry = "INSERT INTO acceso_areas(area_id, indicador_id, id_usuario, permiso_usuario) VALUES('" . $subs['area_id'] . "','" . $subs['indicador_id'] . "','" . $udt['id_usuario'] . "','False')";
						$menures = mysqli_query($con, $menuqry);
					} else {
						$menuqry = "INSERT INTO acceso_areas(area_id, indicador_id, id_usuario, permiso_usuario) VALUES('" . $subs['area_id'] . "','" . $subs['indicador_id'] . "','" . $udt['id_usuario'] . "','True')";
						$menures = mysqli_query($con, $menuqry);
					}
				}
				if ($inserto_usuario === TRUE) {
					$success_message = "Registro exitoso";
				} else {
					$error_message = "Algo no salió como esperabamos, error.";
				}
			}
		} else {
			$error_message = "La dirección de email ingresada no es válida.";
		}
	} else {
		$error_message = "Por favor complete los campos vacios.";
	}
}
