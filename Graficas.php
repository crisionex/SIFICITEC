<!DOCTYPE html>
<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.6.2/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-datalabels/2.0.0/chartjs-plugin-datalabels.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script lang="javascript" src="https://cdn.sheetjs.com/xlsx-latest/package/dist/xlsx.full.min.js"></script>
    <link rel="stylesheet" href="dist/css/genstyle.css">
    <title>Visualizador de indicadores FCITEC</title>
    <script>
        var chart;
        var per = [];
        $(document).ready(function() {
            $('#area').change(function() {
                var area = $(this).val();
                $.ajax({
                    url: "query/datagfc.php",
                    method: "POST",
                    data: {
                        arex: area
                    },
                    success: function(data) {
                        $('#periodo').html('<option value="" disabled selected>Seleccionar Periodo</option>');
                        $('#desgregar').html('<option value="" disabled selected>Desgregar por</option>');
                        $('#etiqueta').html('<option value="" disabled selected>Seleccionar Etiqueta</option>');
                        $('#indicador').html('<option value="" disabled selected>Seleccione un indicador</option>');
                        $('#indicador').html(data);
                    }
                })
            })
        })
        $(document).ready(function() {
            $('#indicador').change(function() {
                var indi = $(this).val();
                $.ajax({
                    url: "query/prd.php",
                    method: "POST",
                    data: {
                        indi: indi
                    },
                    success: function(data) {
                        $('#periodo').html('<option value="" disabled selected>Seleccionar Periodo</option>');
                        $('#desgregar').html('<option value="" disabled selected>Desgregar por</option>');
                        $('#etiqueta').html('<option value="" disabled selected>Seleccionar Etiqueta</option>');
                        $('#periodo').html(data);
                    }
                })
            })
        })
        $(document).ready(function() {
            $('#periodo').change(function() {
                var id = document.getElementById('indicador').value;
                per = [];
                $('input:checked').each(function() {
                    per.push($(this).val());
                });
                $.ajax({
                    url: "query/desgregar.php",
                    method: "POST",
                    data: {
                        id: id
                    },
                    success: function(data) {
                        $('#desgregar').html('<option value="" disabled selected>Desgregar por</option>');
                        $('#etiqueta').html('<option value="" disabled selected>Seleccionar Etiqueta</option>');
                        $('#desgregar').html(data);
                    }
                })
            })
        })
        $(document).ready(function() {
            $('#desgregar').change(function() {
                var indi = document.getElementById('indicador').value;

                $.ajax({
                    url: "query/geteti.php",
                    method: "POST",
                    data: {
                        indi: indi
                    },
                    success: function(data) {
                        $('#etiqueta').html('<option value="" disabled selected>Seleccionar Etiqueta</option>');
                        $('#etiqueta').html(data);
                    }
                })
            })
        })
        $(document).ready(function() {
            $('#etiqueta').change(function() {
                var area_id = document.getElementById('area').value;
                var smid = document.getElementById('indicador').value;

                var desgregar = document.getElementById('desgregar').value;
                var etiqueta = $(this).val();

                document.getElementById('descargar').style.display = 'block';

                $.ajax({
                    url: "query/idcslc.php",
                    method: "POST",
                    dataType: 'JSON',
                    data: {
                        area_id,
                        smid: smid,
                        per: per,
                        etiqueta: etiqueta,
                        desgregar: desgregar
                    },
                    success: function(data) {
                        console.log(data);
                        graficacion(data);

                        if (chart) {
                            chart.destroy();
                        }
                    }
                })
                $.ajax({
                    url: "query/gettbl.php",
                    method: "POST",
                    data: {
                        area_id,
                        smid,
                        per,
                        etiqueta,
                        desgregar
                    },
                    success: function(data) {
                        $('#table-set').html(data);
                    }
                })
            })
        })

        function HTMLEXCEL(type) {
            var data = document.getElementById('tabla-generada');
            var nombre = $('#indicador option:selected').text();

            var file = XLSX.utils.table_to_book(data, {
                sheet: "sheet1"
            });
            XLSX.write(file, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            });
            XLSX.writeFile(file, nombre + '.' + type);
        }
        $(document).ready(function() {
            $("#descargar").click(function() {
                HTMLEXCEL('xlsx');
            });
        });
    </script>
    <style>
        .checkbox-menu li label {
            display: block;
            padding: 3px 10px;
            clear: both;
            font-weight: normal;
            line-height: 1.42857143;
            color: #333;
            white-space: nowrap;
            margin: 0;
            transition: background-color .4s ease;
        }

        .checkbox-menu li input {
            margin: 0px 5px;
            top: 2px;
            position: relative;
        }

        .checkbox-menu li.active label {
            background-color: #cbcbff;
            font-weight: bold;
        }

        .checkbox-menu li label:hover,
        .checkbox-menu li label:focus {
            background-color: #f5f5f5;
        }

        .checkbox-menu li.active label:hover,
        .checkbox-menu li.active label:focus {
            background-color: #b8b8ff;
        }
    </style>
</head>

<body style="background-color: #fbfbfb;"><br>
    <div class="container border rounded" style="background: white;">
        <br>
        <h2>Graficado de resultados</h2>
        <div class="row">
            <div class="col">
                <label for="area" style="padding: 5px;"><b>Seleccionar area</b></label>
                <select class="form-control" name="area" id="area">
                    <option value="" disabled selected>Seleccione un area</option>
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
            <div class="col">
                <label for="indicador" style="padding: 5px;"><b>Seleccionar indicador</b></label>
                <select class="form-control" name="indicador" id="indicador">
                    <option value="" disabled selected>Seleccione un indicador</option>
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col">
                <label for="periodo" style="padding: 5px;"><b>Seleccionar periodo</b></label>
                <div class="dropdown border rounded">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="collapse" href="#periodo" role="button" aria-expanded="false" aria-controls="periodo" style="width: 100%">
                        Seleccionar periodo
                    </button>
                    <ul class="dropdown-menu checkbox-menu collapse" id="periodo" style="width: 100%;">
                    </ul>
                </div>
            </div>
            <div class="col">
                <label for="desgregar" style="padding: 5px;"><b>Desgregar por</b></label>
                <select class="form-control" name="desgregar" id="desgregar">
                    <option value="" disabled selected>Desgregar por</option>
                </select>
                <br>
            </div>
            <div class="col">
                <label for="etiqueta" style="padding: 5px;"><b>Clasificar por</b></label>
                <select class="form-control" name="etiqueta" id="etiqueta">
                    <option value="" disabled selected>Seleccionar Etiqueta</option>
                </select>
                <br>
            </div>
        </div>
        <hr>
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
        <!-- <button class="btn btn-outline-primary" id="imprimir">imprimir grafico</button> -->
        <button class="btn btn-outline-primary" id="descargar" style="display: none;">Hoja de calculo</button>
        <br><br>

        <center>
            <div class="col chart-container" style="height:60vh; width:60vw" id="graficochido">
                <canvas id="myChart">
                    <div class="col" id="b1"></div>
                </canvas>
            </div>
        </center>
        <br><br>
        <div class="row" style="overflow-x: scroll;">
            <div id="table-set">
            </div>
        </div>

    </div>
    <script src="dist/js/pdfgen.js"></script>
    <?php include 'footer.php'; ?>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script type="text/javascript" src="dist/js/bootstrap-iconpicker.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</html>