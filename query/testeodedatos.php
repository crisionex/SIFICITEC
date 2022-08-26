<?php
require "../database.php";

$qry = "SELECT * FROM indicadores WHERE nombre_indicador = '" . $_POST['arex'] . "'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_array($res);

$qry = "SELECT * FROM areas WHERE area_id = '" . $row['area_id'] . "'";
$res = mysqli_query($con, $qry);
$row1 = mysqli_fetch_assoc($res);
$arr1 = "";
array($arr1);
$arr1 =  preg_split('/[\n]+/', $row['tbli']);

$cat = "<h6>Responsable: </h6>
<p>" . $row['responsable'] . "</p>
<h6>Perteneciente a:</h6>
<p>" . $row1['nombre_area'] . "</p>
<h6>Nombre:</h6>
<p>" . $row['nombre_indicador'] . "</p>
<br>
<h6>Columnas:</h6>
<table class=\"table table-bordered\">
    <tbody>
    <tr>";

$cntd = 0;
for ($i = 0; $i < sizeof($arr1); $i++) {
    if ($cntd < 3) {
        $cat .= "
            <td>".$arr1[$i]."</td>";
            $cntd++;
    } else {
        $cat .= "</tr><tr>
        <td>".$arr1[$i]."</td>";
        $cntd = 1;
    }
}
$cat .= "
</tr>
</tbody>
</table>
</div>
 <div class=\"modal-footer\">
    <a href=\"Indicadores_db.php?area_id=".$row['area_id']."&nombre_indicador=".$row['nombre_indicador']."\" class=\"btn btn-success\">Autorizar</a>
    <button onclick ='borrar(this.value)' class='btn btn-danger text-light' value='".$row['indicador_id']."'>Rechazar</button>";
echo $cat;
