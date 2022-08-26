<?php
include("database.php");
include("head.php");
$name = '';
$status = '';
$rol = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $insertqry = "SELECT * FROM usuarios WHERE id_usuario = $id";
    $insertres = mysqli_query($con, $insertqry);
    if (mysqli_num_rows($insertres) == 1) {
        $usuariodata = mysqli_fetch_array($insertres);
        $name = $usuariodata['nombre_usuario'];
        $status = $usuariodata['estado_usuario'];
        $rol = $usuariodata['departamento_usuario'];
    }
}

if (isset($_POST['update'])) {
    $id = $_GET['id'];
    $status = $_POST['estado_usuario'];
    $rol = $_POST['departamento_usuario'];
    $area = $_POST['area_id'];

    $query = "UPDATE usuarios set estado_usuario = '$status',  departamento_usuario = '$rol', area_id=$area WHERE id_usuario= $id";
    mysqli_query($con, $query);
    header('Location: registrar.php');
}
if ($datosUsuario['departamento_usuario'] == 'Admin' || $datosUsuario['departamento_usuario'] == 'JA') {
?>

    <div class="d-flex justify-content-center">
        <div class="col-md-4">
            <form action="edit_usuario.php?id=<?php echo $_GET['id']; ?>" method="POST">
                <br>
                <br>
                <h2> Editando el usuario <?php echo $name; ?> </H2>
                <br>
                <div class="mb-3">
                    <label for="status"><b>Estatus</b></label>
                    <select class="form-control" name="estado_usuario" value="<?php echo $status; ?>" id="status">
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>

                <div class="form-group" id="dhide">
                    <label for="form-control"><b>Rol asignado</b></label>
                    <select class="form-control" name="departamento_usuario" value="<?php echo $rol; ?>">
                        <option value="" selected disabled>Seleccione un rol</option>
                        <?php if ($datosUsuario['departamento_usuario'] == 'Admin') { ?>
                            <option value="Admin">Administrador</option>
                            <option value="JA">Jefe de área</option>
                            <option value="EG">Encargado de gestión</option>
                        <?php } else if ($datosUsuario['departamento_usuario'] == 'JA') { ?>
                            <option value="EG">Encargado de gestión</option>
                        <?php } ?>
                    </select>
                </div>

                <script>
                    document.getElementById('dhide').addEventListener('change', function() {
                        var style = this.value != "Selecciona Area" ? 'block' : 'none';
                        document.getElementById('hide').style.display = style;
                    });
                </script>


                <div class="form-group" id="hide" style="display: none;">
                    <label for="lbl1"><b>Seleccionar area perteneciente</b></label>
                    <select class="form-control" name="area_id" id="lbl1">
                        <option value="NULL">No Aplica</option>
                        <?php
                        if ($datosUsuario['departamento_usuario'] == 'Admin') {
                            $arealistqry = "SELECT * from areas where estado_area='Activo'";
                        } else if ($datosUsuario['departamento_usuario'] == 'JA') {
                            $arealistqry = "SELECT * from areas where estado_area='Activo' and area_id = '".$datosUsuario['area_id']."'";
                        }
                        $arealistres = mysqli_query($con, $arealistqry);
                        while ($areadata = mysqli_fetch_assoc($arealistres)) {
                        ?>
                            <option value="'<?php echo $areadata['area_id']; ?>'"><?php echo $areadata['nombre_area']; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <button class=" btn btn-success" name="update">
                    Actualizar
                </button>
            </form>
        </div>
    </div>
<?php
} else {
    include 'Sin_acceso.php';
}

?>
<?php include('footer.php'); ?>