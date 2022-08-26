<?php
require "../database.php";
$datao = '';
$qry = "SELECT * FROM indicadores WHERE area_id = '".$_POST['arex']."' AND estado_indicador = 'Activo'";
$res = mysqli_query($con, $qry);
$datao .= '<option value = "" disabled selected> Seleccione un indicador</option>';
while($row = mysqli_fetch_array($res)){
    $datao .= '<option value = "'.$row['indicador_id'].'"> '.$row['nombre_indicador'].' </option>';
}
echo $datao;
