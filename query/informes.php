<?php
require "../database.php";

$datao = '
<table class="table table-striped table-bordered" style="text-align:center;" id="tabla-generada">
    <thead>
        <tr>
            <th>Area</th>
            <th>Responsable de area</th>
            <th>Indicador</th>
            <th>Responsable de indicador</th>
        </tr>
    </thead>
    <tbody>';

$qry = "SELECT * FROM usuarios WHERE departamento_usuario = 'JA'";
$res = mysqli_query($con, $qry);
while ($row = mysqli_fetch_assoc($res)) {
    $datao .= '        <tr>';
    $area = $row['area_id'];

    //nombre de usuario
    $nombreJA = $row['nombre_usuario'];

    $qry = "SELECT * FROM areas WHERE area_id = '$area' AND estado_area = 'Activo'";
    $res1 = mysqli_query($con, $qry);
    $rowarea = mysqli_fetch_assoc($res1);

    //nombre del area
    $nombrearea = $rowarea['nombre_area'];

    $qry = "SELECT * FROM acceso_areas WHERE permiso_usuario ='True' AND area_id = '$area'";
    $res2 = mysqli_query($con, $qry);

    //rowspan
    $numero_usuarios = mysqli_num_rows($res2);

    $datao .= '<td rowspan = "' . $numero_usuarios . '"> ' . $nombrearea . ' </td>
    <td rowspan = "' . $numero_usuarios . '"> ' . $nombreJA . ' </td>';


    while ($permiso_indi = mysqli_fetch_assoc($res2)) {
        $indicador_id = $permiso_indi['indicador_id'];
        $usuario_id = $permiso_indi['id_usuario'];

        $qry = "SELECT * FROM indicadores WHERE indicador_id = $indicador_id";
        $res3 = mysqli_query($con, $qry);
        $rowres = mysqli_fetch_assoc($res3);

        //nombre del indicador
        $nombre_indicador = $rowres['nombre_indicador'];

        $qry = "SELECT * FROM usuarios WHERE id_usuario = $usuario_id";
        $res4 = mysqli_query($con, $qry);
        $rowres = mysqli_fetch_assoc($res4);

        //nombre del usuario
        $nombre_usuario = $rowres['nombre_usuario'];

        $datao .= '<td>' . $nombre_indicador . '</td>
        <td>' . $nombre_usuario . '</td></tr>';
    };
}

$datao .= '
    </tbody>
</table>
';
echo $datao;
