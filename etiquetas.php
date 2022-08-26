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
    <script type="text/javascript">
        var agrupacion;
        $(document).ready(function() {
            $('#actualizar').click(function() {
                var longitud = $('#AG').children('p').length;
                var netq = agrupacion;
                var nombre = document.getElementById('etiqueta').value;


                var ars = $(this).val();
                $.ajax({
                    url: "query/etiquetadoE.php",
                    method: "POST",
                    data: {
                        etiquetas: netq,
                        longitud: longitud,
                        nombre: nombre
                    },
                    success: function(data) {
                        $("#alertatoast1").html(data);
                        document.getElementById('alertatoast1').className = 'position-fixed bottom-0 end-0 p-3 display'
                        setTimeout(function() {
                            document.getElementById('alertatoast1').className = 'position-fixed bottom-0 end-0 p-3 hidden'
                        }, 3000);
                    }
                });
            });
        });

        $(document).ready(function() {
            $('#fx').click(function() {
                var nombre = document.getElementById('nombre-etiqueta').value;
                var area_id = document.getElementById('area').value;
                var indicador_id = document.getElementById('indicador').value;
                $.ajax({
                    url: "query/etiquetadoR.php",
                    method: "POST",
                    data: {
                        area_id,
                        indicador_id,
                        nombre: nombre
                    },
                    success: function(data) {
                        $("#alertatoast").html(data);
                        var nombre = document.getElementById('nombre-etiqueta').value = '';
                        document.getElementById('alertatoast').className = 'position-fixed bottom-0 end-0 p-3 display'
                        setTimeout(function() {
                            document.getElementById('alertatoast').className = 'position-fixed bottom-0 end-0 p-3 hidden'
                        }, 3000);
                        get_ind(indicador_id);
                    }
                });
            });
        });

        $(document).ready(function() {
            $("#area").change(function() {
                var ars = $(this).val();
                $.ajax({
                    url: "query/datagfc.php",
                    method: "POST",
                    data: {
                        arex: ars
                    },
                    success: function(data) {
                        $("#indicador").html(data);
                    }
                });
            });
        });

        $(document).ready(function() {
            $("#indicador").change(function() {
                var ars = $(this).val();
                get_ind(ars);
            });
        });

        function get_ind(ars) {
            $.ajax({
                url: "query/geteti.php",
                method: "POST",
                data: {
                    indi: ars
                },
                success: function(data) {
                    $("#etiqueta").html(data);
                    var b1 = document.getElementById('CE');
                    b1.disabled = false;
                }
            });
        }

        $(document).ready(function() {
            $("#etiqueta").change(function() {
                var ars = $(this).val();
                $.ajax({
                    url: "query/etq.php",
                    method: "POST",
                    data: {
                        id: ars,
                    },
                    success: function(data) {
                        $("#AG").html(data);
                        var b2 = document.getElementById('actualizar');
                        b2.disabled = false;
                    }
                });
            });
        });
        $(document).ready(function() {
            $("#etiqueta").change(function() {
                var longitud = $('#AG').children('p').length;
                var ars = $(this).val();
                $.ajax({
                    url: "query/gettxt.php",
                    method: "POST",
                    data: {
                        id: ars,
                        longitud: longitud
                    },
                    success: function(data) {
                        $("#NAG").html(data);
                        document.getElementById("recorte").style.display = 'block';

                    }
                });
            });
        });

        //por nombre
        $(document).ready(function() {
            $("#area1").change(function() {
                var ars = $(this).val();
                $.ajax({
                    url: "query/datagfc.php",
                    method: "POST",
                    data: {
                        arex: ars
                    },
                    success: function(data) {
                        $("#indicador1").html(data);
                    }
                });
            });
        });

        $(document).ready(function() {
            $("#indicador1").change(function() {
                var ars = $(this).val();
                $.ajax({
                    url: "query/geteti.php",
                    method: "POST",
                    data: {
                        indi: ars
                    },
                    success: function(data) {
                        var b1 = document.getElementById('CE1');
                        b1.disabled = false;
                    }
                });
            });
        });

        $(document).ready(function() {
            $("#CE1").click(function() {
                var area_id = document.getElementById('area1').value;
                var indicador_id = document.getElementById('indicador1').value;
                $.ajax({
                    url: "query/CE1.php",
                    method: "POST",
                    data: {
                        area_id,
                        indicador_id
                    },
                    success: function(data) {
                        $("#CA").html(data);
                    }
                })
            })
        })

        $(document).ready(function() {
            $('#fx1').click(function() {
                var area_id = document.getElementById('area1').value;
                var indicador_id = document.getElementById('indicador1').value;
                var ne = document.getElementById('nombre-etiqueta1').value;
                var checkbd;
                // $('input:checked').each(function() {
                //     checkbd.push($(this).val());
                // });
                var checkbd = $('input:checked').val();

                $.ajax({
                    url: "query/CEN.php",
                    method: "POST",
                    data: {
                        area_id,
                        indicador_id,
                        ne: ne,
                        checkbd
                    },
                    success: function(data) {
                        $("#alertatoast").html(data);
                        var nombre = document.getElementById('nombre-etiqueta').value = '';
                        document.getElementById('alertatoast').className = 'position-fixed bottom-0 end-0 p-3 display'
                        setTimeout(function() {
                            document.getElementById('alertatoast').className = 'position-fixed bottom-0 end-0 p-3 hidden'
                        }, 3000);
                    }
                });
            });
        });
    </script>
    <link rel="icon" href="dist/img/Logo.png" type="image/x-icon">
    <style>
        .col {
            background-color: white;
            margin: 1rem;
            border-radius: 10px;
            justify-content: space-between;
            max-width: 200px;
            padding: 10px 0;
        }

        .draggable {
            padding: 1rem;
            margin: 1rem;
            border-radius: 5px;
            border: 1px;
            cursor: move;
        }

        .draggable.dragging {
            opacity: 1;
        }

        .hidden {
            display: none;
        }

        .display {
            display: block;
        }
    </style>
</head>
<?php
if ($datosUsuario['departamento_usuario'] == 'Admin') {
?>

    <body>
        <?php include 'menu.php'; ?>
        <br>
        <style>
            nav>.nav.nav-tabs {

                border: none;
                color: #fff;
                background: #6ba06c;
                border-radius: 0;

            }

            nav>div a.nav-item.nav-link,
            nav>div a.nav-item.nav-link.active {
                border: none;
                padding: 18px 25px;
                color: #fff;
                background: #6ba06c;
                border-radius: 0;
            }

            nav>div a.nav-item.nav-link.active:after {
                content: "";
                position: relative;
                bottom: -60px;
                left: -10%;
                border: 15px solid transparent;
                border-top-color: var(--color-amarillo);
            }

            .tab-content {
                background: #fdfdfd;
                line-height: 25px;
                border: 1px solid #ddd;
                border-top: 5px solid var(--color-amarillo);
                border-bottom: 5px solid var(--color-amarillo);
                padding: 30px 25px;
            }

            nav>div a.nav-item.nav-link:hover,
            nav>div a.nav-item.nav-link:focus {
                border: none;
                background: var(--color-verde);
                color: #fff;
                border-radius: 0;
                transition: all 0.20s linear;
            }
        </style>
        <div class="container-lg">
            <div class="row">
                <div class="col-x-12 ">
                    <nav>
                        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Etiquetas Numericas</a>
                            <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Etiquetas de texto</a>
                        </div>
                    </nav>
                    <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                            <div class='container border' style="border-radius: 5px; background-color:white;">
                                <div class='row'>
                                    <br>
                                    <h2 class="text-dark" style="padding: 15px;">Datos de referencia</h2>
                                    <div class='row-md-3'>
                                        <form role='form' action="" method="POST">
                                            <div class="form-group">
                                                <label for="area" style="padding: 5px;"><b>Seleccionar área</b></label>
                                                <select class="form-control" name="area" id="area">
                                                    <option value="" disabled selected>Seleccione un área</option>
                                                    <?php
                                                    require_once 'database.php';
                                                    $arealistqry = "SELECT * from areas where estado_area='Activo'";
                                                    $arealistres = mysqli_query($con, $arealistqry);
                                                    while ($areadata = mysqli_fetch_array($arealistres)) {
                                                    ?>
                                                        <option value="<?= $areadata['area_id']; ?>"><?= $areadata['nombre_area']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="indicador" style="padding: 5px;"><b>Seleccionar indicador</b></label>
                                                <select class="form-control" name="indicador" id="indicador">
                                                    <option value="" disabled selected>Seleccione un indicador</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="etiqueta" style="padding: 5px;"><b>Seleccionar etiqueta</b></label>
                                                <select class="form-control" name="etiqueta" id="etiqueta">
                                                    <option value="" disabled selected>Seleccionar etiqueta</option>
                                                </select>
                                                <br>
                                            </div>

                                        </form>
                                        <center>
                                            <button type="button" class="btn col-md-4 btn-primary text-light" data-bs-toggle="modal" data-bs-target="#crearetq" id="CE" disabled>Crear Etiqueta</button>
                                        </center>
                                        <br>
                                        <br>
                                        <div class="modal fade" id="crearetq" tabindex="-1" aria-labelledby="crearetqLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="crearetqLabel">Nueva etiqueta</h5>
                                                        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="mb-3">
                                                                <label for="nombre-etiqueta" class="col-form-label">Nombre de la etiqueta:</label>
                                                                <input autocomplete="off" autofill="off" type="text" class="form-control" value="" id="nombre-etiqueta" required>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary text-light" id="fx" data-bs-dismiss="modal" aria-label="Close">Crear etiqueta</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="container bg-light border rounded" style="display: none;" id="recorte">
                                <div class="row row-md-3">
                                    <center>
                                        <h1 class="display-6 text-dark">
                                            <br>
                                            Arrastre las columnas para crear o editar una etiqueta
                                        </h1>
                                    </center>
                                    <div class="col" id="AG" style="border: 0.15rem dotted  #007bff;">

                                    </div>
                                    <div class="col" id="NAG" style="border: 0.15rem dotted #333333;">
                                    </div>
                                </div>
                                <br>
                                <center>
                                    <button class=" btn col-md-4 btn-success" name="update" id="actualizar" disabled>
                                        Actualizar
                                    </button>
                                </center>
                                <br><br>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                            <div class='container border' style="border-radius: 5px; background-color:white;">
                                <div class='row'>
                                    <br>
                                    <h2 class="text-dark" style="padding: 15px;">Datos de referencia</h2>
                                    <div class='row-md-3'>
                                        <form role='form' action="" method="POST">
                                            <div class="form-group">
                                                <label for="area1" style="padding: 5px;"><b>Seleccionar área</b></label>
                                                <select class="form-control" name="area" id="area1">
                                                    <option value="" disabled selected>Seleccionar área</option>
                                                    <?php
                                                    require_once 'database.php';
                                                    $arealistqry = "SELECT * from areas where estado_area='Activo'";
                                                    $arealistres = mysqli_query($con, $arealistqry);
                                                    while ($areadata = mysqli_fetch_array($arealistres)) {
                                                    ?>
                                                        <option value="<?= $areadata['area_id']; ?>"><?= $areadata['nombre_area']; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="indicador1" style="padding: 5px;"><b>Seleccionar indicador</b></label>
                                                <select class="form-control" name="indicador" id="indicador1">
                                                    <option value="" disabled selected>Seleccionar indicador</option>
                                                </select>
                                            </div>
                                        </form>
                                        <center>
                                            <button type="button" class="btn col-md-4 btn-primary text-light" data-bs-toggle="modal" data-bs-target="#crearetq1" id="CE1" disabled>Crear etiqueta</button>
                                        </center>
                                        <br>
                                        <br>
                                        <div class="modal fade" id="crearetq1" tabindex="-1" aria-labelledby="crearetq1Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="crearetq1Label">Nueva etiqueta</h5>
                                                        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form>
                                                            <div class="mb-3">
                                                                <label for="nombre-etiqueta1" class="col-form-label">Nombre de la etiqueta:</label>
                                                                <input autocomplete="off" autofill="off" type="text" class="form-control" value="" id="nombre-etiqueta1" required>
                                                            </div>
                                                            <label for="CA" class="col-form-label">Columna asociada:</label>
                                                            <div class="mb-3 col justify-content-md-center" id="CA">
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-primary text-light" id="fx1" data-bs-dismiss="modal" aria-label="Close">Crear etiqueta</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11" id="alertatoast"></div>
        <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11" id="alertatoast1"></div>
        </div>
    <?php
} else {
    include 'Sin_acceso.php';
}
    ?>
    <?php include 'footer.php'; ?>
    </body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script src="dist/js/dad.js" defer></script>

</html>