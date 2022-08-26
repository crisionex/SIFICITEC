<?php
require_once "../database.php";

$qry = "SELECT * FROM indicadores WHERE indicador_id = '" . $_POST['indicador_id'] . "' AND area_id = '" . $_POST['area_id'] . "'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

$arr1 = array();
$arr2 = array();
$qry = "SELECT * FROM columnas WHERE td = 'txt'";
$res1 = mysqli_query($con, $qry);

while($row1 = mysqli_fetch_assoc($res1)){
    $arr1[] = $row1['nombre'];
}

$qry = "SHOW COLUMNS FROM `" . $row['nombre_indicador'] . "`";
$res = mysqli_query($con, $qry);

while($row = mysqli_fetch_assoc($res)){
    $arr2[] = $row['Field'];
}
$datao = '';
$i = 0;

foreach($arr1 as $key => $value){
    foreach($arr2 as $key1 => $value1) {
        if ($value == $value1) {
          $datao .= "<input class=\"form-check-input\" type=\"radio\" name=\"checkbd[]\" value=\"" . $value1 . "\" id=\"$i\">" . $value1 . "<br>";
            $i++;
         }
     }
 }
echo $datao;
