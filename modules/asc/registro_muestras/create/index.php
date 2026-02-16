<?php include '../../../../layout/validar_session4.php' ?>

<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$cls_laboratorio = new cls_laboratorio();


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Modulos de Laboratorio</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="#">Inicio</a></li>
                        <!--<li class="breadcrumb-item active">Legacy User Menu</li> -->
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">REGISTRO DE TOMA DE MUESTRAS ENSAYO A COMPRESIÓN O FLEXIÓN</h3>

                <div class="card-tools">
                    <button type="button" id="btn_crear_muestra_ext" name="btn_crear_muestra_ext" class="btn btn-success form-control"><i class="fas fa-save"></i> Crear Muestra sin remision</button>
                </div>
            </div>
            <div class="card-body">
                <form id="form_crear_muestra" name="form_crear_muestra" method="post">
                    <input type="hidden" name="txt_id_remi" id="txt_id_remi">
                    <div class="row">
                        <div class="col-2">
                            <div class="form-group">
                                <label for="">Fecha de Toma</label>
                                <input type="date" name="txt_fecha_muestra" id="txt_fecha_muestra" class="form-control">
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="">Hora de Toma</label>
                                <input type="time" name="txt_hora_muestra" id="txt_hora_muestra" class="form-control">

                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="">Temperatura</label>
                                <input type="text" name="txt_temperatura" id="txt_temperatura" class="form-control">

                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="">Asentamiento</label>
                                <input type="text" name="txt_asentamiento" id="txt_asentamiento" class="form-control">

                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="">Codigo Remision</label>

                                <h6><span id="htcod_remi">Codigo Remision</span></h6>
                            </div>
                        </div>


                        <div class="col">
                            <div class="form-group">
                                <label for="">Cliente</label>
                                <h6><span id="htnombre_cliente">Nombre_cliente</span></h6>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Obra</label>
                                <h6><span id="htnombre_obra">Nombre Obra</span></h6>
                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col">
                            <div class="form-group">
                                <label for="">Diseño</label>
                                <h6><span id="htdiseño">Diseño</span></h6>

                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="">Metros Cubicos</label>
                                <h6><span id="htmetros">00</span> M3</h6>

                            </div>
                        </div>
                        <div class="col-1">

                            <div class="form-group">
                                <label for="">Mixer</label>
                                <h6><span id="htplaca">Placa</span></h6>
                            </div>

                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <h5><span id="muestra"> </span></h5>
                                <button type="submit" id="btn_crear_muestra" name="btn_crear_muestra" class="btn btn-success form-control"><i class="fas fa-save"></i> Crear Muestra</button>
                            </div>
                        </div>


                    </div>
                </form>

            </div>
            <div class="card-header card-outline card-secondary">
                <h3 class="card-title">BUSCADOR DE REMISIONES</h3>

                <div class="card-tools">

                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Fecha</label>
                            <input type="date" name="txt_buscar_fecha" id="txt_buscar_fecha" class="form-control" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Numero Remision</label>
                            <input type="text" name="txt_buscar_remision" id="txt_buscar_remision" class="form-control" />
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="">Planta</label>
                            <select name="txt_buscar_planta" id="txt_buscar_planta" class="form-control select2">
                                <option value="">Todos</option>
                                <option value="RMI">RMI- Planta 1 - Mirolindo</option>
                                <option value="RZO">RZO- Planta 2 - Mirolindo</option>
                                <option value="RMT">RMT- Planta 3 - Torreon</option>
                                <option value="HND">HND- Planta 4 - Honda</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button type="button" id="btn_buscar_remi" name="btn_buscar_remi" class="btn btn-info  form-control"><i class="fas fa-search"></i> Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="ROW">
                    <div class="COL">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table id="tabla_remisiones" class="cell-border row-border">
                            <thead>
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th style="width:50px">Fecha</th>
                                    <th style="width:20px">Linea</th>
                                    <th style="width:100px">Hora Cargue</th>
                                    <th style="width:50px">Remision</th>

                                    <th style="width:30%">Cliente</th>
                                    <th style="width:30%">Obra</th>
                                    <th style="width:30px">Mixer</th>
                                    <th style="width:40%">Producto</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>

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


<!-- MODALES -->


<!------->
<?php include '../../../../layout/footer/footer4.php' ?>

<script>
    /** FORMULARIO CREAR MUESTRA */
    $(document).ready(function(e) {
        $("#form_crear_muestra").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_muestra.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data.estado);
                    if (data.estado) {
                        toastr.success('exitoso');
                        window.location = '../update/index.php?id=' + data.id_muestra;
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

    /** TABLA REMISIONES */
    $(document).ready(function() {
        var n = 1;
        // Declarar funcion destruir tabla
        function destruir_tabla() {
            var table = $('#tabla_remisiones').DataTable({});
            table.destroy();
        }

        function datatable_remisiones(fecha = null, remision = null, planta = null) {
            var table = $('#tabla_remisiones').DataTable({
                //"padign": true,
                //"searching": true,
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "data_table_remision.php",
                    'data': {

                        'fecha': fecha,
                        'remision': remision,
                        'planta': planta

                    },
                    'type': 'post',
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
                        "data": "linea"
                    },
                    {
                        "data": "hora_cargue"
                    },

                    {
                        "data": "remision"
                    },
                    {
                        "data": "cliente"
                    },
                    {
                        "data": "obra"
                    },
                    {
                        "data": "mixer"
                    },
                    {
                        "data": "producto"
                    },
                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-info btn_ver_remi btn-sm'> <i class='fas fa-eye'></i> </button>"
                    }
                ],
                'paging': true,
                'searching': true
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
        //

        var fecha = "";
        var remision = "";
        var planta = "";

        if ($.fn.dataTable.isDataTable('#tabla_remisiones')) {
            table = $('#tabla_remisiones').datatable_remisiones();
            table.destroy();
        }
        table = datatable_remisiones(fecha, remision, planta);
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 5000);

        $('#tabla_remisiones tbody').on('click', 'button.btn_ver_remi', function() {
            var data = table.row($(this).parents('tr')).data();
            console.log(data)
            var id = data['id'];
            $("#txt_fecha_muestra").val(data['fecha_actual']);
            $("#txt_hora_muestra").val(data['hora_actual']);
            $("#htnombre_cliente").html(data['cliente']);
            $("#htnombre_obra").html(data['obra']);
            $("#htplaca").html(data['mixer']);
            $("#htdiseño").html(data['producto']);
            $("#htmetros").html(data['metros']);
            $("#htcod_remi").html(data['remision']);
            $("#txt_id_remi").val(data['id']);




        });

        $("#btn_crear_muestra_ext").click(function() {
            var fecha_muestra = $("#txt_fecha_muestra").val();
            var hora_muestra = $('#txt_hora_muestra').val();

            $.ajax({
                url: "php_crear_muestra_ext.php",
                type: "POST",
                data: {
                    fecha_muestra: fecha_muestra,
                    hora_muestra: hora_muestra
                },

                success: function(data) {
                    console.log(data.estado);
                    if (data.estado) {
                        toastr.success('exitoso');
                        console.log("muestra creada" + data.id_muestra);
                        window.location = '../update/index.php?id=' + data.id_muestra;
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });



        $("#btn_buscar_remi").click(function() {
            var fecha = $("#txt_buscar_fecha").val();
            var remision = $('#txt_buscar_remision').val();
            var planta = $("#txt_buscar_planta").val();

            if ($.fn.dataTable.isDataTable('#tabla_remisiones')) {
                table = $('#tabla_remisiones').DataTable();
                table.destroy();
            }
            table = datatable_remisiones(fecha, remision, planta);
            setInterval(function() {
                table.ajax.reload(null, false);
            }, 5000);
        });

    });
</script>



</body>

</html>