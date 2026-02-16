<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>
<!-- Content Wrapper. Contains page content -->


<?php

$t1_terceros = new t1_terceros();
$t8_programacion = new t8_programacion();


$get_fecha = $_GET['fecha'];
$get_codprog = $_GET['codprog'];
$get_linea = $_GET['linea'];





?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agregar Registros a la Programacion</h1>

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
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">20210416LN1</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <form name="form_crear_prog" id="form_crear_prog" method="POST">

                    <input type="hidden" name="fecha_prog" id="fecha_prog" value="<?php echo $_GET['fecha']; ?>" />
                    <input type="hidden" name="linea_despacho" id="linea_despacho" value="<?php echo $_GET['linea']; ?>" />
                    <input type="hidden" name="codprog" id="codprog" value="<?php echo $_GET['codprog']; ?>" />



                    <section>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="txb_horacargue">Hora de Cargue</label>
                                    <br>
                                    <input type="time" class="form-control input-sm" id="txb_horacargue" name="txb_horacargue">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="">Hora de Mixe en Obra</label>
                                    <br>
                                    <input type="time" class="form-control input-sm" id="txb_hora_mixer_obra" name="txb_hora_mixer_obra">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txb_cliente"> Cliente </label>
                                    <br>

                                    <select class="js-example-responsive" style="width: 100%" name="txb_cliente" id="txb_cliente">
                                        <?php

                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txb_obras"> Obra </label>
                                    <select class="js-example-responsive" style="width: 100%" name="txb_obras" id="txb_obras">
                                        <option disabled selected> Debe selccionar una Cliente</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="txb_producto"> Producto </label>
                                    <select class="js-example-responsive " style="width: 100%" name="txb_producto" id="txb_producto">
                                        <option disabled selected> Seleccione Producto </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-1">
                                <div class="form-group">
                                    <label> Cantidad </label>
                                    <input type="text" class="form-control input-sm" id="txb_cantidad" name="txb_cantidad">
                                    <input type="hidden" name="txb_precio" id="txb_precio">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label> </label>
                                    <div class="col align-self-center" align="center">
                                        <button class="btn btn-block btn-info " id="calcular" name="calcular" type="button"> calcular </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="info-box mb-3 bg-info">
                                    <span class="info-box-icon"><i class="fas fa-donate"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">Sub Total </span>
                                        <span class="info-box-number">
                                            <h4> <span id="txb_subTotal">$ 000.000.000 </span></h4>
                                            <input type="hidden" class="form-control" id="txb_subTotal" name="txb_subTotal">
                                        </span>

                                    </div>
                                    <!-- /.info-box-content -->
                                </div>

                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label for="txt_mixer">Mixer</label>
                                    <select class="js-example-responsive" style="width: 100%" name="txt_mixer" id="txt_mixer">
                                     
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="">Conductor</label>
                                    <select class="js-example-responsive" style="width: 100%" name="txt_conductor" id="txt_conductor">
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class='info-box mb-3 bg-warning' id="EstadoClient">
                                    <span class="info-box-icon"><i class="fas fa-dollar-sign"></i> </span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Cupo Cliente en pesos</span>
                                        <span class="info-box-number">
                                            <div id="cupocliente">$ 000.000.000</div>
                                            <input type="hidden" class="form-control" id="txb_cupoCliente" name="txb_cupoCliente">
                                        </span>
                                        <div class="progress" id="BarraCliente">

                                        </div>
                                        <span class="info-box-text">Saldo Cliente en pesos</span>
                                        <span class="info-box-number">
                                            <div id="saldocliente"></div>
                                            <input type="hidden" class="form-control" id="txb_saldoCliente" name="txb_saldoCliente">
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                            <div class="col-3">
                                <div class='info-box mb-3 bg-warning' id="EstadoObra">
                                    <span class="info-box-icon"><i class="far fa-building"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Cupo Obra en Cantidad</span>
                                        <span class="info-box-number">
                                            <div id="cupoObra"></div>
                                            <input type="hidden" class="form-control" id="txb_cupoObra" name="txb_cupoObra">
                                        </span>
                                        <div class="progress" id="BarraObra">
                                        </div>
                                        <span class="info-box-text">Saldo Obra en Cantidad</span>
                                        <span class="info-box-number">
                                            <div id="saldoObra"></div>
                                            <input type="hidden" class="form-control" id="txb_saldoObra" name="txb_saldoObra">
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                        </div>
                    </section>
                    <section>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Observaciones</label>
                                    <input type="text" class="form-control input-sm" id="txb_observaciones" name="txb_observaciones">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="col align-self-center" align="center">
                                    <label></label>
                                    <button class="btn btn-block btn-success " id="btn-guardar_prog" name="btn-guardar_prog" type="submit" width="100%"> Guardar Registro </button>
                                </div>
                            </div>
                        </div>
                    </section>
                    <br>
                </form>
            </div>
        </div>

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="t_detalle">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hora de Cargue</th>
                            <th>Hora en Obra</th>
                            <th>Cliente</th>
                            <th>Obra</th>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Vehiculo</th>
                            <th>Conductor</th>
                            <th>Observaciones</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="modal fade" id="modal-anular">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Anular Detalle Programacion</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
            <div class="modal fade" id="modal-editar">
                <div class="modal-dialog  modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Editar Registro</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="editar_registro" id="editar_registro" type="POST">
                        <input type="hidden" name="id_detalle_prog" id="id_detalle_prog">

                        <div class="modal-body">
                                <table class="table table-striped" style="word-wrap: break-word;">
                                    <thead>
                                        <tr>
                                            <th>Hora Cargue</th>
                                            <th>Hora mixer en Obra</th>
                                            <th>Mixer</th>
                                            <th>Conductor</th>
                                            <th>Observacion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td><input type="time" class="form-control input-sm" name="hora_cargue" id="hora_cargue"></td>
                                            <td><input type="time" class="form-control input-sm" name="hora_mix_obra" id="hora_mix_obra"></td>
                                            <td><select class="js-example-responsive" style="width: 100%" name="txt_mixer_edit" id="txt_mixer_edit"></select></td>
                                            <td><select class="js-example-responsive" style="width: 100%" name="txt_conductor_edit" id="txt_conductor_edit"></select></td>
                                            <td><input type="txt" class="form-control input-sm" name="observacion_edit" id="observacion_edit"></td>
                                        </tr>

                                    </tbody>
                                </table>
                            
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>

        <!-- Default box -->

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

<?php include '../../../layout/footer/footer3.php' ?>
<script>
    $(document).ready(function() {
        $('.js-example-responsive ').select2();
    });
</script>
<script>
    $(document).ready(function() {

        var n = 1;
        var id_programacion = <?php echo intval($_GET['codprog']) ?>;
        console.log(id_programacion);
        var table = $('#t_detalle').DataTable({
            //"processing": true,
            //"scrollX": true,
            //'destroy': true,
            "ajax": {
                "url": "data_table.php",
                'type': 'post',
                'data': {
                    'id_programacion': id_programacion
                },
                "dataType": "json",
                "dataSrc": "",
                "cache": false,

            },
            "order": [
                [0, 'asc']
            ],

            "columns": [{
                    "data": "ct9_HoraCargue"
                },
                {
                    "data": "ct9_HoraCargue"
                },
                {
                    "data": "ct9_HoraMixerObra"
                },
                {
                    "data": "ct9_nombre_cliente"
                },
                {
                    "data": "ct9_nombre_obra"
                },
                {
                    "data": "ct9_nombre_producto"
                },
                {
                    "data": "ct9_Cantidad"
                },
                {
                    "data": "ct9_placa_mixer"
                },
                {
                    "data": "ct9_nombre_conductor"
                },
                {
                    "data": "ct9_Observaciones"
                },

                {
                    "data": null,
                    "defaultContent": " <button type='button' class='btn btn-editar btn-default' data-toggle='modal' data-target='#modal-editar'> Editar </button> <button type='button' class='btn btn-editar btn-default' data-toggle='modal' data-target='#modal-anular'> Anular </button>",

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


        $('#t_detalle tbody').on('click', 'button.btn-editar', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['ct9_IdDetalleProgramacion'];
            
            $('#id_detalle_prog').val(data['ct9_IdDetalleProgramacion']);
            $('#hora_cargue').val(data['ct9_HoraCargue']);
            $('#hora_mix_obra').val(data['ct9_HoraMixerObra']);
            $('#observacion_edit').val(data['ct9_Observaciones']);

            $.ajax({
                url: "get_datos_edit.php",
                type: "POST",
                data: {
                    id_conductor: data['ct9_idConductor'],
                    id_mixer: data['ct9_IdVehiculo'],
                },
                success: function(response) {
                    console.log(response);
                    $('#txt_mixer_edit').html(response.option_vehiculo);
                    $('#txt_conductor_edit').html(response.option_conductor);

                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });

        });
        $('#t_detalle tbody').on('click', 'button.btn-anular', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['ct9_IdDetalleProgramacion'];


        });

        setInterval(function() {
            table.ajax.reload(null, false);
        }, 5000);



    });
</script>



<script>
    $(function() {
        $(document).ready(function(e) {

            // Get -> Cliente
            $.ajax({
                url: "get_datos.php",
                type: "POST",
                data: {
                    task: 1,
                    tipo: "get_cliente",
                },
                success: function(response) {
                    $('#txb_cliente').html(response.option_cliente);
                    $('#txt_mixer').html(response.option_vehiculo);
                    $('#txt_conductor').html(response.option_conductor);

                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });

            // Get -> Datos Cliente y Obra
            $('#txb_cliente').on('change', function() {
                $('#btn-guardar_prog').hide();
                $.ajax({
                    url: "get_datos.php",
                    type: "POST",
                    data: {
                        id_cliente: $('#txb_cliente').val(),
                        task: 2,
                        tipo: "get_obra",
                    },
                    success: function(response) {
                        $('#txb_obras').html(response.option);
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    },
                });
            });

            // Get -> Datos Obra y Producto
            $('#txb_obras').on('change', function() {
                $('#btn-guardar_prog').hide();
                $('#txb_producto').html("");
                $.ajax({
                    url: "get_datos.php",
                    type: "POST",
                    data: {
                        id_cliente: $('#txb_cliente').val(),
                        id_obras: ($('#txb_obras').val()),
                        tipo: "get_datosobra",
                        task: 3,
                    },
                    success: function(response) {
                        if (response.estado) {
                            $('#txb_producto').html(response.option);
                            console.log(response.estado);
                        }
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    }
                });
            });

            // Get -> Precio Producto
            $('#txb_producto').on('change', function() {
                $('#btn-guardar_prog').hide();

                $.ajax({
                    url: "get_datos.php",
                    type: "POST",
                    data: {
                        id_cliente: $('#txb_cliente').val(),
                        id_obras: ($('#txb_obras').val()),
                        id_producto: ($('#txb_producto').val()),
                        tipo: "get_datosproductos",
                        task: 4,
                    },
                    success: function(response) {
                        if (response.estado) {

                            $('#txb_precio').val(response.precio);
                        }
                        console.log(response.precio);
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    }
                });
            });


            /////////////////////////////////////////////////////////////////////////////////////////////////

            // Click boton Calcular
            $("#calcular").click(function() {
                $('#btn-guardar_prog').hide();
                //$('#cupoObra').html("");
                $.ajax({
                    url: "calculate.php",
                    type: "POST",
                    data: {
                        id_cliente: $('#txb_cliente').val(),
                        id_obras: ($('#txb_obras').val()),
                        id_producto: ($('#txb_producto').val()),
                        precio_producto: ($('#txb_precio').val()),
                        cantidad: ($('#txb_cantidad').val()),
                        tipo: "calculate",
                        task: 10,
                    },
                    success: function(response) {

                        if (response.estado) {
                            $('#txb_subTotal').html('$ ' + response.sub_total_html);
                            if (response.habilitar_btn) {
                                $('#btn-guardar_prog').show();
                            }
                        } else {
                            alert(response.errores);
                        }

                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    }
                });
            });


            $(document).ready(function(e) {
                $("#form_crear_prog").on('submit', (function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "php_crear.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            console.log(data.estado);
                            if (data.estado) {
                                toastr.success('exitoso');

                            } else {
                                toastr.warning(data.errores);
                            }
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });
                }));
            });
            /////////////////////////////////////////////////////////////////////////////////////////////////////////7
            /////////////////////////////////////////////////////////////////////////////////////////////////////////7

            $(document).ready(function(e) {
                $("#editar_registro").on('submit', (function(e) {
                    e.preventDefault();
                    $.ajax({
                        url: "php_editar_registro.php",
                        type: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        success: function(data) {
                            console.log(data.estado);
                            toastr.warning(data.errores);
                            if (data.estado) {
                                toastr.success('exitoso');

                            } else {
                                toastr.warning(data.errores);
                            }
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });
                }));
            });
            
        });
    });
</script>


<script>
    $(document).ready(function() {

        $('#habilitar_fecha').click(function() {
            if (!$(this).is(':checked')) {

                $("#txt_fecha_prog").prop('disabled', true);
            } else {
                $("#txt_fecha_prog").prop('disabled', false);
            }
        });


    })
</script>



</body>

</html>