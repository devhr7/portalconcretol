<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REGISTRAR ELEMENTOS</h1>
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
    <section class="content">
        <?php
        $elementos = new elementos();
        ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">CREAR ELEMENTOS</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 0.5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span class=" text_progresbar">0% </span>
                    </div>
                </div>
                <div id="contenido">
                    <form name="form_crear_elemento_epp" id="form_crear_elemento_epp" method="post" content="width=device-width, initial-scale=1">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>EPP</label>
                                    <select name="id_epp" id="id_epp" class="form-control select2 ">
                                        <?= $elementos->option_epp(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tipo EPP</label>
                                    <select name="id_tipo_epp" id="id_tipo_epp" class="form-control select2 ">
                                        <?= $elementos->option_tipo_epp(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tamaño</label>
                                    <select name="id_tamano" id="id_tamano" class="form-control select2 ">
                                        <?= $elementos->option_tamano(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Color</label>
                                    <select name="id_color" id="id_color" class="form-control select2 ">
                                        <?= $elementos->option_color(); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="info-box mb-3 bg-info">
                                    <span class="info-box-icon"><i class="far fa-comment"></i></span>
                                    <div class="info-box-content text-center">
                                        <span class="info-box-number" id="descripcion_epp"></span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <input class="form-control" type="hidden" name="Txb_Descripcion" id="Txb_descripcion" placeholder="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">ELEMENTOS EPP</h3>
            </div>
            <div class="card-body">
                <table id="table_elementos_epp" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Nombre EPP</th>
                            <th>Tipo EPP</th>
                            <th>Tamaño</th>
                            <th>Color</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </section>
</div>
<?php include '../../../layout/footer/footer3.php' ?>

<script>
    $(function() {
        $(".progress").hide();
        $('.select2').select2();
    });

    $(document).ready(function(e) {
        var n = 1;
        var table = $('#table_elementos_epp').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "data_table_elementos.php",
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "descripcion"
                },
                {
                    "data": "nombre_tipo_epp"
                },
                {
                    "data": "nombre_tamano"
                },
                {
                    "data": "nombre_color"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-edit'></i> </button>"
                }
            ],
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
        $('#table_elementos_epp tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];

            window.location = "../update_epp/editar.php?id=" + id;
        });
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);
    });

    $(document).ready(function(e) {
        $("#form_crear_elemento_epp").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        $('#id_epp').on('change', function() {

            $.ajax({
                url: "get_datos.php",
                type: "POST",
                data: {

                    id_epp: ($('#id_epp').val()),
                    id_tipo_epp: ($('#id_tipo_epp').val()),
                    id_tamano: ($('#id_tamano').val()),
                    id_color: ($('#id_color').val()),
                    task: "1",
                },
                success: function(response) {

                    $('#descripcion_epp').html(response.DescpF);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                }
            });
        });
        $('#id_tipo_epp').on('change', function() {

            $.ajax({
                url: "get_datos.php",
                type: "POST",
                data: {

                    id_epp: ($('#id_epp').val()),
                    id_tipo_epp: ($('#id_tipo_epp').val()),
                    id_tamano: ($('#id_tamano').val()),
                    id_color: ($('#id_color').val()),
                    task: "1",
                },
                success: function(response) {

                    $('#descripcion_epp').html(response.DescpF);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                }
            });
        });
        $('#id_tamano').on('change', function() {

            $.ajax({
                url: "get_datos.php",
                type: "POST",
                data: {

                    id_epp: ($('#id_epp').val()),
                    id_tipo_epp: ($('#id_tipo_epp').val()),
                    id_tamano: ($('#id_tamano').val()),
                    id_color: ($('#id_color').val()),
                    task: "1",
                },
                success: function(response) {

                    $('#descripcion_epp').html(response.DescpF);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                }
            });
        });
        $('#id_color').on('change', function() {

            $.ajax({
                url: "get_datos.php",
                type: "POST",
                data: {

                    id_epp: ($('#id_epp').val()),
                    id_tipo_epp: ($('#id_tipo_epp').val()),
                    id_tamano: ($('#id_tamano').val()),
                    id_color: ($('#id_color').val()),
                    task: "1",
                },
                success: function(response) {

                    $('#descripcion_epp').html(response.DescpF);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                }
            });
        });
    });
</script>