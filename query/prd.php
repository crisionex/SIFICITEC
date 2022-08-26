<?php
require_once "../database.php";

$datao = '';

$qry = "SELECT * FROM indicadores WHERE indicador_id = " . $_POST['indi'] . "";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

$qry = "SELECT * FROM `" . $row['nombre_indicador'] . "`";
$res = mysqli_query($con, $qry);

while ($row = mysqli_fetch_assoc($res)) {
    $periodo[] = $row['periodo'];
}
if (isset($periodo)) {
    $periodo = array_unique($periodo, SORT_REGULAR);
    sort($periodo);
    foreach ($periodo as $key => $per) {
        $datao .= '<li>
                    <label>
                        <input type="checkbox" value="' . $per . '"> ' . $per . '
                    </label>
                </li>';
    }
}
echo $datao;
