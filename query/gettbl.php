<?php
require_once "../database.php";
session_start();
ob_start();
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

ob_end_clean();
//variables iniciales
$nombre = $_POST['etiqueta'];
$indicador_id = $_POST['smid'];
$area_id = $_POST['area_id'];
$periodo = $_POST['per'];
$total = 0;
$idcont = array();

$qry = "SELECT * FROM etiquetas WHERE id = '$nombre' AND indicador_id = '$indicador_id'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

//Datos etiqueta numerica
$nbren = $row['nombre'];
$etiquetas = preg_split('/[\,]+/', $row['etqs']);

$qry = "SELECT * FROM etiquetasn WHERE id = '" . $_POST['desgregar'] . "'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

//Datos etiqueta texto
$nbret = $row['nombre'];
$idfc = preg_split('/[\n]+/', $row['idfc']);
$ca = preg_split('/[\n]+/', $row['ca']);

$qry = "SELECT * FROM indicadores WHERE indicador_id = '$indicador_id'";
$res = mysqli_query($con, $qry);
$row = mysqli_fetch_assoc($res);

//datos indicador
$nombretbl = $row['nombre_indicador'];
$nombrecol = preg_split('/[\n]+/', $row['tbli']);

//generando tabla

//añadir periodo
$datao = '<table class="table table-striped table-bordered" style="text-align:center;" id="tabla-generada">


            <tr>
                <th colspan = "' . sizeof($ca) . '" class="table-warning">' . $nbret . '</th>
                ';

foreach ($nombrecol as $key => $value) {
    if ((!in_array(str_replace(array("\n", "\r"), '', $value), $ca) || !in_array($value, $ca)) && (!in_array(str_replace(array("\n", "\r"), '', $value), $etiquetas) || !in_array($value, $etiquetas))) {
        $datao .= '<th rowspan="2">' . str_replace(array("\n", "\r"), '', $value) . '</th>';
    }
}
$datao .= '     <th rowspan = "2">Periodo</th>
                <th colspan = "' . sizeof($etiquetas) . '" class="table-success">' . $nbren . '</th>
                <th rowspan = "2">Total</th>
            </tr>';
$datao .= '   <tr>
                ';

for ($i = 0; $i < 2; $i++) {
    if ($i == 0) {
        foreach ($nombrecol as $key => $value) {
            if ((in_array(str_replace(array("\n", "\r"), '', $value), $ca) || in_array($value, $ca))) {
                $datao .= '<td>' . str_replace(array("\n", "\r"), '', $value) . '</td>';
            }
        }
    }
    if ($i == 1) {
        foreach ($nombrecol as $key => $value) {
            if ((in_array(str_replace(array("\n", "\r"), '', $value), $etiquetas) || in_array($value, $etiquetas))) {
                $datao .= '<td>' . str_replace(array("\n", "\r"), '', $value) . '</td>';
            }
        }
    }
}

//añadir periodo en el query de abajo si se quiere limitar segun el periodo
$qry = "SELECT * FROM `$nombretbl` ";
$res = mysqli_query($con, $qry);

//si es que existen mas de dos columnas asociadas se tendra que editar esta parte, todo lo demas esta listo en caso de que haya mas de dos
while ($row = mysqli_fetch_assoc($res)) {
    foreach ($idfc as $key => $value) {
        //editar especificamente $row[$ca[0]] debido a que debemos obtner todos los resultados para $ca en el vector
        if ($row[$ca[0]] == str_replace(array("\n", "\r"), '', $value)) {
            $idcont["" . $row[$ca[0]] . ""] += 1;
            echo $row[$ca[0]] . "\n";
        }
    }
}
ob_end_clean();

$datao .= '<tbody>';
foreach ($idfc as $globalKey => $globalValue) {
    //añadir periodo en el query de abajo si se quiere limitar segun el periodo
    $qry = "SELECT * FROM `$nombretbl` ";
    $res = mysqli_query($con, $qry);
    if (isset($idcont["" . $globalValue . ""])) {
        $datao .= '<tr><td rowspan = "' . $idcont["" . $globalValue . ""] . '">' .  str_replace(array("\n", "\r"), '', $globalValue) . '</td>';
    }

    while ($row = mysqli_fetch_assoc($res)) {
        
        foreach ($nombrecol as $key => $value) {
        }

        for ($i = 0; $i < 3; $i++) {
            if ($i == 1) {
                foreach ($nombrecol as $key => $value) {
                    if ((!in_array(str_replace(array("\n", "\r"), '', $value), $ca) || !in_array($value, $ca)) && (!in_array(str_replace(array("\n", "\r"), '', $value), $etiquetas) || !in_array($value, $etiquetas)) && ($row['' . $ca[0] . ''] == $globalValue)) {
                        $datao .= '<td>' . $row['' . str_replace(array("\n", "\r"), '', $value) . ''] . '</td>
                        ';
                    }
                }
            }
            if ($i == 0) {
                // foreach ($nombrecol as $key => $value) {
                //     if ((in_array(str_replace(array("\n", "\r"), '', $value), $ca) || in_array($value, $ca))) {
                //         $datao .= '<td>' . $row['' . str_replace(array("\n", "\r"), '', $value) . ''] . '</td>';
                //     }
                // }
            }
            if ($i == 2 && ($row['' . $ca[0] . ''] == $globalValue)) {
                $datao.= '<td>'. $row['periodo'] .'</td>';
                foreach ($nombrecol as $key => $value) {
                    if ((in_array(str_replace(array("\n", "\r"), '', $value), $etiquetas) || in_array($value, $etiquetas)) && ($row['' . $ca[0] . ''] == $globalValue)) {
                        $datao .= '<td>' . $row['' . str_replace(array("\n", "\r"), '', $value) . ''] . '</td>
                        ';
                        $total += $row['' . str_replace(array("\n", "\r"), '', $value) . ''];
                    }
                }
                $datao .= '<td>' . $total . '</td></tr>
                ';
                $total = 0;
            }
        }
    }
}


$datao .= '</tbody></table>';

echo $datao;
