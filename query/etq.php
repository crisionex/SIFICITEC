<?php 
require_once "../database.php";
$qry = "SELECT * FROM etiquetas WHERE id = '".$_POST['id']."'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

$datao = '';
$array = preg_split('/[\n,]+/', $row['etqs']);

for($i=0;$i<sizeof($array);$i++){
    if($array[$i]!=''){
    $datao .= '<p class="draggable bg-dark text-center text-light" draggable="true" data-id="'.str_replace(array("\n","\r"), '', $array[$i]).'">'.$array[$i].'</p>';
    }
}
echo $datao;
?>