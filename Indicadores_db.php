<?php

include 'database.php';
include "head.php";
if (!empty($_GET['area_id'])) {

	//variables
	$area_id = $_GET['area_id'];
	$nombre_indicador = $_GET['nombre_indicador'];
	$sbmn = $nombre_indicador;
	$data_tbl;
	$arr1 = "";
	$columnas = "";
	$filas = "";
	$forma = "";
	array($arr1);

	//creando la url  de datos
	$nombre_indicador = ucwords($nombre_indicador);
	$indicador_nax = str_replace(' ', '', $nombre_indicador);

	$qry = "SELECT * FROM indicadores WHERE nombre_indicador = '" . $nombre_indicador . "'";
	$res = mysqli_query($con, $qry);
	$row = mysqli_fetch_assoc($res);
	$indicador_url = $row['indicador_url'];

	//revalidando en caso de que haya sido autorizado por el administrador
	if ($nombre_indicador != '' && $area_id != '') {
		$insertqry = "SELECT * FROM indicadores where nombre_indicador='$nombre_indicador'";
		$insertres = mysqli_query($con, $insertqry);
		$datax2 = mysqli_fetch_assoc($insertres);
		$datax2 = $datax2['indicador_id'];

		$qry = "SELECT * FROM indicadores WHERE nombre_indicador ='$nombre_indicador'";
		$res = mysqli_query($con, $qry);
		$row = mysqli_fetch_assoc($res);
		$data_tbl = $row['tbli'];

		$query = "UPDATE indicadores set estado_indicador = 'Activo' WHERE nombre_indicador= '$sbmn'";
		mysqli_query($con, $query);
	}

	//creando matriz a partir de los datos de columna
	if ($data_tbl != '') {
		$arr1 = preg_split('/[\n]+/', $data_tbl);
	}

	//reacomodando valores asginados y creando form inputs
	$arrxi = $arr1;
	$contadorx = 1;
	for ($k = 0; $k < 2; $k++) {
		$qry = "SELECT * FROM columnas";
		$res = mysqli_query($con, $qry);
		while ($row = mysqli_fetch_assoc($res)) {
			if (in_array($row['nombre'], $arrxi) && $row['td'] == 'txt' && $k == 0) {
				$arr1[$contadorx-1] = $row['nombre'];
				$tblidd = preg_split('/[\n]+/', $row['ctn']);
				$forma .= "<div class='form-group'>
				<label for=x" . $contadorx . "><b>Ingrese " . str_replace(array("\n", "\r"), '', $row['nombre']) . "</b></label>
				<select class=\"form-control\" name='z" . $contadorx . "'>
				<option value=\"\"  disabled selected>Selecciona</option>";
				foreach ($tblidd as $key => $value) {
					$forma .= "<option value=\"" . str_replace(array("\n", "\r"), '', $value) . "\">" . str_replace(array("\n", "\r"), '', $value) . "</option>";
					echo "<script> console.log('$value'); </script>";
				}
				$forma .= "</select>
			</div>";
				$contadorx++;
			} elseif (in_array($row['nombre'], $arrxi) && $row['td'] == 'num' && $k == 1) {
				$arr1[$contadorx-1] = $row['nombre'];
				$forma .= "<div class='form-group'>
				<label for=x" . $contadorx . "><b>Ingrese " . str_replace(array("\n", "\r"), '', $row['nombre']) . "</b></label>
				<input autocomplete='off' autofill='off' type='text' name='z" . $contadorx . "' placeholder='Datos respectivos a " . str_replace(array("\n", "\r"), '', $row['nombre']) . "' class='form-control' id='x" . $contadorx . "' required/>
			</div>";
				$contadorx++;
			}
		}
	}

	//Creacion de la base de datos
	$insertqry = "CREATE TABLE `" . $nombre_indicador . "`(ID int(6)NOT NULL AUTO_INCREMENT, PRIMARY KEY(ID),
			UNIQUE KEY ID (ID), periodo varchar(50)NOT NULL, ";

	for ($i = 0; $i < count($arr1); $i++) {
		if ($i == (count($arr1) - 1) && $arr1[$i] != '') {
			$insertqry .= "`" . str_replace(array("\n", "\r"), '', $arr1[$i]) . "` varchar(50)NOT NULL)";
		} else if ($arr1[$i] != '') {
			$insertqry .= "`" . str_replace(array("\n", "\r"), '', $arr1[$i]) . "` varchar(50)NOT NULL,";
		}
		$columnas .= "<th>" . str_replace(array("\n", "\r"), '', $arr1[$i]) . "</th>";
		$filas .= "<td> <?php echo \$areadata['" . str_replace(array("\n", "\r"), '', $arr1[$i]) . "'];?></td>";
	}
	$insertres = mysqli_query($con, $insertqry);
}

//Creacion del script encargado de hacer una plantilla generica.
$scrpt = fopen($indicador_url, 'w');
fwrite($scrpt, "
<!DOCTYPE html>
<html>
<?php 
include 'head.php';
include 'menu.php';

 if(\$permiso_usuario=='True')
{
 ?>
<?php include 'database.php'; ?>
<?php
\$selectqry=\"SELECT * FROM `" . $nombre_indicador . "`\";
\$result= mysqli_query(\$con,\$selectqry);

?>

<body>
<div class='container'>
	<div class='row'>
		<div style='overflow-x:auto;' class='col-md-6'>
			<h4>Informe</h4>
			<hr>
			<table class='table table-bordered table-striped'>
				<thead>
					<tr><th>Periodo</th>"
	. $columnas .
	"</tr>
				</thead>
				<tbody>

				<?php
				include 'database.php';
				\$arealistqry='SELECT * from `" . $nombre_indicador . "` ';
				\$arealistres=mysqli_query(\$con,\$arealistqry);
				while (\$areadata=mysqli_fetch_assoc(\$arealistres)) {
				?>
				<tr>
				<td> <?php echo \$areadata['periodo'];?></td>
					" . $filas . "
					</tr>
				<?php
				}
				?>
					
				</tbody>
			</table>
		</div>

		<div class='col-md-4'>
			<h4>Añadir Informe</h4>
			<hr>
			<form method='post' action=\"indi_adddb.php?indicador_id=" . $datax2 . "&nombre_indicador=" . $nombre_indicador . "\">
			<div class=\"form-group\">
			<?php
			\$Y = date(\"Y\");
			\$M = date(\"m\");
			\$M = (int)\$M;

			if (\$M >= 7) {
				\$optiondate = \"<option value = '\$Y-2'>\$Y-2</option><option value = '\$Y-1'>\$Y-1</option>\";
			} else {
				\$optiondate = \"<option value = '\$Y-1'>\$Y-1</option>\";
			}
			?>
			<label for=\"data\">Seleccione el periodo</label>
			<select class=\"form-control\" name=\"z0\" id=\"data\">
				<?php
				\$Y = (int)\$Y;
				echo \$optiondate;
				for (\$y = 0; \$y < 4; \$y++) {
					\$Y--;
					for (\$p = 0; \$p < 2; \$p++) {
						echo \"<option value = '\$Y-\".(2-\$p).\"'>\$Y-\".(2-\$p).\"</option>\";
					}
				}
				?>
			</select>
		</div>
				" . $forma . "
				<div class='form-group'>
				<input name='area_submit' class='btn btn-primary' type='submit' value='Añadir informe'/>
				</div>
				<p name = 'indicador_id' value='" . $datax2 . "'></p>
				<p name = 'nombre_indicador' value='" . $nombre_indicador . "'></p>
			</form>
		</div>
	</div>
</div>
<?php 
}else
{
 include 'Sin_acceso.php';
}

 ?>
<?php include 'footer.php';?>
</body>
</html>
");

fclose($scrpt);

echo "<script> window.location ='Indicadores.php'; </script>";
