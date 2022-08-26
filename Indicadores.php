<!DOCTYPE html>
<html>
<?php include 'head.php'; ?>

<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script type="text/javascript">
        var td;
        $(document).ready(function() {
            $('input[type=radio]').change(function() {
                var n = $(this).val();
                td = n;
                switch (n) {
                    case 'num':
                        document.getElementById('mostrar').style.display = 'none';
                        document.getElementById('identificadores').value = '';
                        break;
                    case 'txt':
                        document.getElementById('mostrar').style.display = 'block';
                        break;
                }
            });
        });
        $(document).ready(function() {
            $('#aclmn').click(function() {
                var ctn = document.getElementById('identificadores').value;
                var nombre = document.getElementById('n-col').value;
                console.log(td);
                $.ajax({
                    url: "query/columnas.php",
                    method: "POST",
                    data: {
                        nombre,
                        ctn,
                        td: td,
                    },
                    success: function(data) {
                        console.log(data);
                        $('#cols-bdy').html('');
                        $('#cols-bdy').html(data);
                    }
                })
            })
        })

        function dicol(id, accion) {
            $.ajax({
                url: "query/dicol.php",
                method: "POST",
                data: {
                    ID: id,
                    accion
                },
                success: function(data) {
                    console.log(data);
                    if (accion == 1) {
                        $('#col-info').html(data);
                    } else if (accion = 2) {
                        $('#cols-bdy').html(data);
                    }
                }
            })
        }
        function myFunction() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById("myInput");
            filter = input.value.toUpperCase();
            ul = document.getElementById("cols-bdy");
            li = ul.getElementsByTagName("label");
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("a")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }
        }
        //borrar indicador
        $(document).ready(function() {
            $(".borrar").click(function() {
                document.getElementById('borrar-indicador').value = $(this).val();
            });
        });

        $(document).ready(function() {
            $("#borrar-indicador").click(function() {
                id = $(this).val();
                $.ajax({
                    url: "delete_IDC.php",
                    method: "POST",
                    data: {
                        id: $(this).val()
                    },
                    success: function(data) {
                        window.location = 'Indicadores.php';
                    }
                })
            });
        });
    </script>
    <style>
        #cols-bdy {
            margin: 0;
            padding: 5px;
        }

        .list-item {
            padding: 5px;
            margin-left: 5px;
        }

        .list-group .list-group-item {
            display: flex;
            justify-content: space-between;
        }

        .list-group .list-group-item a {
            padding: 0.4em;
        }
    </style>
</head>

<body>
    <?php
    if ($datosUsuario['departamento_usuario'] == 'Admin' || $datosUsuario['departamento_usuario'] == 'JA') {
    ?>

        <?php include 'menu.php'; ?>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <br>
                    <h4>Lista de indicadores</h4>
                    <hr>
                    <!-- Modal -->
                    <div class="modal fade" id="modal-ind" tabindex="-1" aria-labelledby="modal-indLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modal-indLabel">Cuidado!</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Esta a punto de borrar un indicador, esta accion es <b>Irreversible</b>, desea continuar?
                                </div>
                                <div class="modal-footer">
                                    <button id="borrar-indicador" type="button" class="btn btn-danger" data-bs-dismiss="modal">Entiendo y quiero continuar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered ">
                        <thead>
                            <tr>
                                <th>Nombre del área</th>
                                <th>Nombre del indicador</th>
                                <th>Estatus</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include 'database.php';
                            if ($datosUsuario['departamento_usuario'] == 'Admin') {
                                $indicadorlistqry = "SELECT indicadores.*,areas.nombre_area from indicadores inner join areas on areas.area_id=indicadores.area_id";
                                $indicadorlistres = mysqli_query($con, $indicadorlistqry);
                            } else {
                                $indicadorlistqry = "SELECT indicadores.*,usuarios.area_id, areas.nombre_area from indicadores inner join usuarios on usuarios.area_id=indicadores.area_id inner join areas on areas.area_id=indicadores.area_id WHERE nombre_usuario = '" . $datosUsuario['nombre_usuario'] . "'";
                                $indicadorlistres = mysqli_query($con, $indicadorlistqry);
                            }
                            while ($indicadordata = mysqli_fetch_assoc($indicadorlistres)) {
                            ?>
                                <tr>
                                    <td><?php echo $indicadordata['nombre_area']; ?></td>
                                    <td><?php echo $indicadordata['nombre_indicador']; ?></td>
                                    <td>
                                        <center><?php
                                                if ($indicadordata['estado_indicador'] == 'Pendiente') {
                                                    echo "<span class=\"badge bg-warning rounded-pill text-dark\">" . $indicadordata['estado_indicador'] . "</span>";
                                                } elseif ($indicadordata['estado_indicador'] == 'Activo') {
                                                    echo "<span class=\"badge bg-success rounded-pill\">" . $indicadordata['estado_indicador'] . "</span>";
                                                } elseif ($indicadordata['estado_indicador'] == 'Inactivo') {
                                                    echo "<span class=\"badge bg-danger rounded-pill\">" . $indicadordata['estado_indicador'] . "</span>";
                                                } ?>
                                        </center>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-danger borrar" data-bs-toggle="modal" data-bs-target="#modal-ind" value="<?php echo $indicadordata['indicador_id'] ?>">
                                            Borrar
                                        </button>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>

                        </tbody>
                    </table>
                </div>

                <div class="col-md-4">
                    <br>
                    <h4>Añadir indicador</h4>
                    <hr>
                    <form method="post" action="espera.php">
                        <div class="form-group">
                            <label for="sel-ar"><b>Área perteneciente</b></label>
                            <select id="sel-ar" class="form-control" name="area_id">
                                <option value="" disabled selected>Selecciona área</option>
                                <?php
                                if ($datosUsuario['departamento_usuario'] != 'Admin') {
                                    $arealistqry = "SELECT * from usuarios 
		inner join areas on areas.area_id=usuarios.area_id 
		where estado_area='Activo' AND id_usuario= '" . $datosUsuario['id_usuario'] . "'";
                                } else {
                                    $arealistqry = "SELECT * from areas where estado_area='Activo'";
                                }
                                $arealistres = mysqli_query($con, $arealistqry);
                                while ($areadata = mysqli_fetch_assoc($arealistres)) {
                                ?>
                                    <option value="<?php echo $areadata['area_id']; ?>"><?php echo $areadata['nombre_area']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="indx"><b>Nombre del indicador</b></label>
                            <input autocomplete="off" autofill="off" type="text" name="nombre_indicador" placeholder="Nombre del indicador" class="form-control" id="indx" required />
                        </div>
                        <div class="form-group">
                            <label for="lista-columnas"><b>Columnas asociadas</b></label>
                            <div class="accordion" id="lista-columnas">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse" aria-expanded="false" aria-controls="collapse">
                                            Columnas
                                        </button>
                                    </h2>

                                    <div id="collapse" class="accordion-collapse collapse" aria-labelledby="heading" data-bs-parent="#lista-columnas">
                                        <input autocomplete="off" autofill="off" type="text" class="form-control" id="myInput" type="text" onkeyup="myFunction()" placeholder="Buscar..." style="margin-top: 5px;">
                                        <div class="accordion-body" id="cols-bdy">
                                            <!-- Aqui van las columnas -->
                                            <?php
                                            $qry = "SELECT * FROM columnas";
                                            $res = mysqli_query($con, $qry);
                                            ?>
                                            <div class="list-group">
                                                <?php while ($row = mysqli_fetch_assoc($res)) { ?>
                                                    <label class="list-group-item border">
                                                        <a><input class="form-check-input me-1" type="checkbox" name="tbli[]" value="<?php echo $row['nombre'] ?>">
                                                            <?php echo $row['nombre'] ?></a>
                                                        <div class="btn-group" role="group" aria-label="Basic example">
                                                            <button type="button" onclick="dicol(this.value, 1)" class="btn btn-dark" value="<?php echo $row['id'] ?>" id="infcol" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-circle-info"></i></button>
                                                            <button type="button" onclick="dicol(this.value, 2)" class="btn btn-secondary" value="<?php echo $row['id'] ?>" id="infcol"><i class="fa-solid fa-trash"></i></button>
                                                        </div>
                                                    </label>
                                                <?php } ?>
                                            </div>
                                        </div>

                                        <center>
                                            <a class="text-decoration-underline" data-bs-toggle="modal" data-bs-target="#crearetq1" href="" id="CE1">¿No la encuentras? Créala!</a>
                                        </center>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <center>
                            <div class="form-group">
                                <input name="indicador_submit" class="btn btn-primary" type="submit" value="Añadir indicador" />
                            </div>
                        </center>
                        <?php
                        if (isset($_SESSION['alerta1'])) {
                            echo $_SESSION['alerta1'];
                            $_SESSION['alerta1'] = '';
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal info de columna-->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Informacion sobre la columna</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="col-info">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Crear columna-->
        <div class="modal fade" id="crearetq1" tabindex="-1" aria-labelledby="crearetq1Label" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="crearetq1Label">Nueva columna</h5>
                        <a id="nuevacol" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label for="n-col" class="col-form-label">Nombre de la columna:</label>
                                <input autocomplete="off" autofill="off" type="text" class="form-control" value="" id="n-col" required>
                            </div>
                            <label class="col-form-label">Tipo de dato:</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="dt" id="dtnm" value="num">
                                <label class="form-check-label" for="dtnm">
                                    Dato numerico
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="dt" id="dtnb" value="txt">
                                <label class="form-check-label" for="dtnb">
                                    Dato de texto
                                </label>
                            </div>
                            <div class="mb-3" style="display: none;" id='mostrar'>
                                <label for="identificadores" class="col-form-label">Identificadores:</label>
                                <textarea class="form-control" id="identificadores" rows="3" required></textarea>
                                <div class="form-text">Use como separador la tecla "Enter"</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary text-light" id="aclmn" data-bs-dismiss="modal" aria-label="Close">Crear columna</button>
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