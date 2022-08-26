<?php
require_once "../database.php";

$qry = "SELECT * FROM etiquetasn WHERE indicador_id = '".$_POST['id']."'";
$res = mysqli_query($con, $qry);
$datao='';
$datao .= '<option value = "" disabled selected>Desgregar por</option>';
while($row = mysqli_fetch_assoc($res)){
    $datao .= '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
}
echo $datao;
?>