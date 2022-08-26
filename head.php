<?php
require 'database.php';
if (!isset($_SESSION)) {
	session_start();
}
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {

	$email = $_SESSION['email'];

	$get_datos_usuario = mysqli_query($con, "SELECT * FROM `usuarios` WHERE email = '$email'");
	$datosUsuario =  mysqli_fetch_assoc($get_datos_usuario);
} else {
	header('Location: salir.php');
	exit;
}
?>

<head>
	<title>SIFCITEC</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="icon-fonts/elusive-icons-2.0.0/css/elusive-icons.min.css" />
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<script src="https://kit.fontawesome.com/45688d4144.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />
	<link rel="stylesheet" href="icon-fonts/map-icons-2.1.0/css/map-icons.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/octicons/4.4.0/font/octicons.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/typicons/2.0.9/typicons.min.css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css" />
	<link rel="stylesheet" href="dist/css/bootstrap-iconpicker.min.css" />

	<link rel="stylesheet" href="dist/css/genstyle.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="icon" href="dist/img/Logo.png" type="image/x-icon">
	<style>
		::-moz-selection {
			/* Code for Firefox */
			color: whitesmoke;
			background: #555;
		}

		::selection {
			color: whitesmoke;
			background: #555;
		}

		.loaderx {
			width: 100%;
			height: 100%;
			position: absolute;
			top: 0;
			left: 0;
			background-color: #f7f7f7;
			display: flex;
			justify-content: center;
			align-items: center;
			z-index: 2;
		}
	</style>
	<script>
		$(window).on("load", function() {
			$(".loaderx").fadeOut("fast");
		});
	</script>
</head>
<div class="loaderx">
	<div class="spinner-border text-secondary" role="status">
		<span class="visually-hidden">Cargando...</span>
	</div>
</div>