<!DOCTYPE html>
<html>
<?php
require 'database.php';
if (!isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['email']) && !empty($_SESSION['email'])) {

    $email = $_SESSION['email'];

    $get_datos_usuario = mysqli_query($con, "SELECT * FROM `usuarios` WHERE email = '$email'");
    $datosUsuario =  mysqli_fetch_assoc($get_datos_usuario);
} else {
    header('Location: salir.php');
    exit;
}
?>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<link rel="icon" href="dist/img/Logo.png" type="image/x-icon">
    <script type="text/javascript">
        $(document).ready(function() {
            $('#nugga').click(function() {
                var ars = $(this).val();
                $.ajax({
                    url: "query/testeodedatos.php",
                    method: "POST",
                    data: {
                        arex: ars
                    },
                    success: function(data) {
                        console.log(data);
                        $("#mdbdy").html(data);
                    }
                });
            });
        });

        function borrar(id) {
            console.log(id);
            $.ajax({
                url: "delete_IDC.php",
                method: "POST",
                data: {
                    id
                },
                success: function(data) {
                    window.location='Validaciones.php';
                }
            })
        }
    </script>
</head>
<?php
if ($datosUsuario['departamento_usuario'] == 'Admin') {
?>

    <body>
        <?php include 'menu.php'; ?>
        <br>
        <div class="container lg-12">
            <table class="table bg-white">
                <thead>
                    <tr>
                        <th colspan="2" class="col-md-10">
                            <h2 class="display-6 text-light" style="text-align: center;">Validaciones pendientes</h1>
                        </th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if ($datosUsuario['departamento_usuario'] == 'Admin') {
                        $qry = "SELECT * FROM indicadores WHERE estado_indicador = 'Pendiente'";
                        $res = mysqli_query($con, $qry);
                    } else {
                        $qry = "SELECT * FROM indicadores WHERE estado_indicador = 'Pendiente' AND area_id = '" . $datosUsuario['area_id'] . "'";
                        $res = mysqli_query($con, $qry);
                    }

                    while ($row = mysqli_fetch_assoc($res)) { ?>
                        <tr>
                            <td>
                                <h5 class="col align-items-center" style="border-right: 50%;"> Indicador: <?php echo $row['nombre_indicador']; ?></h5>
                            </td>
                            <td><button name="nugga" id="nugga" value="<?php echo $row['nombre_indicador']; ?>" type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Detalles adicionales
                                </button></td>
                        </tr>
                    <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">detalles del indicador</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" name="mdbdy" id="mdbdy">
                    </div>
                </div>
            </div>
        </div>

    <?php
} else {
    include 'Sin_acceso.php';
}
    ?>
    <?php include 'footer.php'; ?>
    </body>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</html>