<?php 
require_once "../database.php";

$qry = "SELECT * FROM etiquetas WHERE indicador_id = '".$_POST['indi']."'";
$res = mysqli_query($con, $qry);
$datao='';
$datao .= '<option value = "" disabled selected> Seleccionar etiqueta</option>';
while($row = mysqli_fetch_array($res)){
    $datao .= '<option value = "'.$row['id'].'"> '.$row['nombre'].' </option>';
}
echo $datao;

?>