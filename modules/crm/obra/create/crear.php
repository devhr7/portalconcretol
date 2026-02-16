<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>
<?php require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; ?>
<?php
$t1_terceros = new t1_terceros();
$t4_productos = new t4_productos();
$t5_obras = new t5_obras();
$modelo_obras = new modelo_obras();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Obra</h1>
                </div>
                <div class="col-sm-6">
                    <!--
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                            <li class="breadcrumb-item active">Actual</li>
                        </ol> 
                    -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Crear Obra</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="form_crear" id="form_crear" method="POST">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Datos de la obra</h3>
                            </div>
                            <div class="card-body">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 0.5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span class=" text_progresbar">0% </span> </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Cliente Pagador</label>
                                            <select class="js-example-basic-single select2 form-control" id="cliente" name="cliente" required>
                                                <?php echo $t1_terceros->option_cliente(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Nombre de la Obra</label>
                                            <input name="nombre_obra" id="nombre_obra" type="text" class="form-control" placeholder="Digite el nombre" required>
                                        </div>
                                    </div>
                                </div> <!-- Fin Row -->
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Departamento</label>
                                            <select name="departamento" id="departamento" class="form-control select2" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Ciudad</label>
                                            <select name="municipio" id="municipio" class="form-control select2" required>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Zona/Comuna</label>
                                            <select name="comuna" id="comuna" class="form-control select2" required="true">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Barrio</label>
                                            <input type="text" name="barrio" id="barrio" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Segmento</label>
                                            <select class="js-example-basic-single select2 form-control" name="segmento" id="segmento" required>
                                                <?= $t5_obras->select_segmentacion() ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Direccion</label>
                                            <input name="direccion" id="direccion" type="text" class="form-control" placeholder="Digite el direccion">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Latitud</label>
                                            <input type="text" class="form-control" name="txt_latitud" id="txt_latitud" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Longitud</label>
                                            <input type="text" class="form-control" name="txt_longitud" id="txt_longitud" />

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block bg-gradient-orange" name="boton_guardar" id="boton_guardar"> Guardar </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <hr>
                    <!-- /.modal -->
                    <hr>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <div class="card-title">Obras enlazadas al cliente</div>
            </div>
            <div class="card-body">
                <table class="table table-striped" id="tabla_obras">
                    <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Nombre de la Obra</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
<!-- /.card-body -->
<div class="card-footer">
</div>
<!-- /.card-footer-->
</div>
<!-- /.card -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include '../../../../layout/footer/footer4.php' ?>
<script>
    $(document).ready(function() {
        $(".progress").hide();
        $('.select2').select2();
        var id_obra = 0;
        // Ciudad
        $.ajax({
            url: "get_data.php",
            type: "POST",
            data: {
                task: 1,
            },
            success: function(response) {
                $('#departamento').html(response.departamento);
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
        // Departamento
        $("#departamento").change(function() {
            $.ajax({
                url: "load_data.php",
                type: "POST",
                data: {
                    'task': 1,
                    'id_departamento': $('#departamento').val()
                },
                dataType: 'json',
                success: function(data) {
                    $('#municipio').html(data.option_municipio);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
        $("#municipio").change(function() {
            $.ajax({
                url: "load_data.php",
                type: "POST",
                data: {
                    'task': 2,
                    'id_municipio': $('#municipio').val()
                },
                dataType: 'json',
                success: function(data) {
                    $('#comuna').html(data.option_comuna);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    });
</script>
<script src="ajax_crear.js"> </script>
<script>
    $(document).ready(function() {
        var n = 1;
        // Declarar funcion destruir tabla
        function destruir_tabla() {
            var table = $('#tabla_obras').DataTable({});
            table.destroy();
        }

        function datatable_obra(id_cliente) {
            var table = $('#tabla_obras').DataTable({
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "data_table_obra.php",
                    'data': {
                        'cliente': id_cliente,
                    },
                    'type': 'post',
                    "dataSrc": ""
                },
                "order": [
                    [0, 'desc']
                ],
                "columns": [{
                        "data": "id_obra"
                    },
                    {
                        "data": "nombre_obra"
                    },
                ],
                'paging': false,
                'searching': false
                //"scrollX": true,
            });
            table.on('order.dt search.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            table.ajax.reload();
            return table;
        }
        $('#cliente').on('change', function() {
            var id_cliente = $('#cliente').val();
            if ($.fn.dataTable.isDataTable('#tabla_obras')) {
                table = $('#tabla_obras').DataTable();
                table.destroy();
            }
            table = datatable_obra(id_cliente);
            setInterval(function() {
                table.ajax.reload(null, false);
            }, 5000);
        });
    });
</script>
</body>

</html>