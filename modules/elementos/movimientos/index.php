<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php';

$t1_terceros = new t1_terceros();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>MOVIMEINTOS EPP</h1>
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
        <?php
        $elementos = new elementos();
        ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">MOVIENTOS EPP</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#crear_movimiento_epp">
                                Crear Movimiento EPP
                            </button>
                        </div>
                    </div>
                </div>
                <table id="table_salidas_epp" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Fecha</th>
                            <th>Tipo Movimiento</th>
                            <th>Nombre empleado</th>
                            <th>Cargo</th>
                            <th>Area</th>
                            <th>Elemento EPP</th>
                            <th>Cantidad</th>
                            <th>observaciones</th>
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
        <div class="modal fade" id="crear_movimiento_epp">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Movimiento EPP</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="form_crear_movimiento_epp" id="form_crear_movimiento_epp" method="post">
                            <div class="row">
                                <div class="col">
                                    <label for="">Tipo Movimiento</label>
                                    <select class="form-control " name="txt_tipo_movimiento" id="txt_tipo_movimiento">
                                        <?php echo $elementos->option_tipo_movimiento(); ?>
                                    </select>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="fecha">Fecha</label>
                                        <input type="date" name="fecha" id="fecha" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="id_empleado">Empleado</label><br>
                                        <select class="select2 form-control" name="id_empleado" id="id_empleado" style="width:100%">
                                            <?php echo $elementos->option_empleados(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="id_epp">Elementos EPP</label><br>
                                        <select class="select2 form-control" name="id_epp" id="id_epp" style="width:100%">
                                            <?php echo $elementos->option_descripcion_epp() ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cantidad">Cantidad</label>
                                        <input type="number" name="cantidad" id="cantidad" class="form-control" required="true" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Observaciones</label>
                                        <input type="text" name="txt_observaciones" id="txt_observaciones" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

        <div class="modal fade" id="editar_movimiento_epp">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar Movimiento EPP</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="form_edit_movimiento_epp" id="form_edit_movimiento_epp" method="post">
                            <input type="hidden" name="id_movimiento_edit" id="id_movimiento_edit">
                            <div class="row">
                                <div class="col">
                                    <label for="">Tipo Movimiento</label>
                                    <select class="form-control " name="txt_tipo_movimiento_edit" id="txt_tipo_movimiento_edit">

                                    </select>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="fecha_edit">Fecha</label>
                                        <input type="date" name="fecha_edit" id="fecha_edit" class="form-control" />
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="id_empleado_edit">Empleado</label><br>
                                        <select class="select2 form-control" name="id_empleado_edit" id="id_empleado_edit" style="width:100%">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label for="id_epp_edit">Elementos EPP</label><br>
                                        <select class="select2 form-control" name="id_epp_edit" id="id_epp_edit" style="width:100%">

                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="cantidad_edit">Cantidad</label>
                                        <input type="number" name="cantidad_edit" id="cantidad_edit" class="form-control" required="true" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Observaciones</label>
                                        <input type="text" name="txt_observaciones_edit" id="txt_observaciones_edit" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <div class="modal fade" id="eliminar_movimiento_epp">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Esta Seguro de eliminar Eliminar Movimiento EPP?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id_movimiento_eliminar" id="id_movimiento_eliminar">
                        <button type="button" class="btn btn-danger" id="btn_eliminar_movimiento" name="btn_eliminar_movimiento">Eliminar</button>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include '../../../layout/footer/footer3.php' ?>
<script>
    $(function() {
        $(".progress").hide();
        $('.select2').select2();
    });

    $(document).ready(function() {


        $("#btn_eliminar_movimiento").click(function() {

            $.ajax({
                url: "php_eliminar.php",
                type: "POST",
                data: {
                    id_mov_eliminar: $("#id_movimiento_eliminar").val(),
                },
                success: function(response) {
                    toastr.success('Se ha Eliminado Correctamente');
                $('#eliminar_movimiento_epp').modal('toggle');
                    
                },

                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                  
                },
            });
        });
        $("#form_edit_movimiento_epp").on('submit', (function(e) {
            $('#editar_movimiento_epp').modal('toggle');
            e.preventDefault();
            $.ajax({
                url: "php_editar.php",
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

        $("#form_crear_movimiento_epp").on('submit', (function(e) {
            $('#crear_movimiento_epp').modal('toggle');
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

        var n = 1;
        var table = $('#table_salidas_epp').DataTable({
            "ajax": {
                "url": "data_table_salidas.php",
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "fecha"
                },
                {
                    "data": "nombre_movimiento" // TIPO MOVIMIENTO
                },
                {
                    "data": "nombre_empleado"
                },
                {
                    "data": "nombre_cargo"
                },
                {
                    "data": "nombre_area"
                },
                {
                    "data": "nombre_elemento_epp"
                },
                {
                    "data": "cantidad"
                },
                {
                    "data": "observaciones"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm btn_editar'> <i class='fas fa-edit'></i> </button>  <button class='btn btn-danger btn-sm btn_eliminar'><i class='fas fa-trash-alt'></i> </button>"
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
        $('#table_salidas_epp tbody').on('click', 'button.btn_editar', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];

            $.ajax({
                url: "get_data_edit.php",
                type: "POST",
                data: {
                    'task': 1,
                    'id_movimiento': data['id']
                },
                dataType: 'json',
                success: function(data) {
                    $('#id_movimiento_edit').val(data.datos_mv.id); // id
                    $('#txt_tipo_movimiento_edit').html(data.datos_mv.option_tipo_movimiento); // Movimientos
                    $('#fecha_edit').val(data.datos_mv.fecha); // Fecha
                    $('#id_empleado_edit').html(data.datos_mv.option_empleados); // Empleados
                    $('#id_epp_edit').html(data.datos_mv.option_elementos); // Elementos
                    $('#cantidad_edit').val(data.datos_mv.cantidad); // Cantidad
                    $('#txt_observaciones_edit').val(data.datos_mv.observaciones); // Observaciones

                    console.log(data.datos_mv.fecha)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });


            $("#editar_movimiento_epp").modal("show");
        });
        $('#table_salidas_epp tbody').on('click', 'button.btn_eliminar', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            $.ajax({
                url: "get_data_edit.php",
                type: "POST",
                data: {
                    'task': 1,
                    'id_movimiento': data['id']
                },
                dataType: 'json',
                success: function(data) {
                    $('#id_movimiento_eliminar').val(data.datos_mv.id); // id
                    var id_mov_eliminar = data.datos_mv.id;



                },

                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
            $("#eliminar_movimiento_epp").modal("show");
        });
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);
    });
</script>
</body>

</html>