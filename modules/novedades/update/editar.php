<?php include '../../../layout/validar_session3.php'; ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php';


$t1_terceros = new t1_terceros();
$cls_novedades = new novedades_despacho();
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id_novedad = intval($_GET['id']);
    if (is_array($data_novedades = $cls_novedades->select_novedad_despacho_for_id($id_novedad))) {
        foreach ($data_novedades as $key) {
            $fecha_novedad = $key['fecha'];
        }
    }
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <label for=""></label>
                        <h1>Gestion de novedades</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <!--
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                        <li class="breadcrumb-item active">Actual</li>
                    </ol>
                -->
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Gestion novedad <b><?php echo $id_novedad; ?> </b> </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <h3><?php //echo $fecha_novedad; 
                                ?></h3>
                        </div>
                    </div>
                </div>
                <hr>
                <form name="form_add_cliente_obra" id="form_add_cliente_obra" method="post">
                    <input id="txt_id_novedad" name="txt_id_novedad" value="<?php echo $id_novedad; ?>" type="hidden">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Cliente</label>
                                <select class="js-example-basic-single select2  form-control" id="txt_cliente" name="txt_cliente" required />
                                <option value="1">cliente_prueba</option>
                                <?php print_r($t1_terceros->option_cliente_edit($id_cliente)); ?>

                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label>Obra</label>
                                <select class="js-example-basic-single select2 form-control" id="txt_obra" name="txt_obra" required />
                                <option value="0">Seleccione un Obra</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="">Adicionar Cliente y Obra</label>
                                <button type="submit" name="btn_adicionar_cliente_obra" id="btn_adicionar_cliente_obra" class="btn btn-block btn-success">
                                    Adicionar
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <div class="col">
                        <table name="table_clientes_obras" id="table_clientes_obras">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cliente</th>
                                    <th>Obra </th>
                                    <th>Novedades</th>
                                    <th>Detalle </th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-6">

                        <button type="button" class="btn btn-block btn-warning" name="cargar_remisiones" id="cargar_remisiones"> <i class='fas fa-folder'></i> Cargar Remisiones </button>
                    </div>
                    <div class="col-6">
                        <button type="button" class="btn btn-block btn-info" name="adicionar_novedades_generales" id="adicionar_novedades_generales" data-toggle="modal" data-target="#modal_adicionar_novedades"> <i class='fas fa-eye'></i> Novedades
                            Generales</button>
                    </div>
                </div>
                <hr>
                <form id="form_guardar_remi" name="form_guardar_remi" method="post">
                    <input type="hidden" name="id_novedades_for_remision" name="id_novedades_for_remision" value="<?php echo $id_novedad; ?>">
                    <div class="row">
                        <div class="col">
                            <table name="table_remisiones" id="table_remisiones" class="display" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>Select</th>
                                        <th>Novedades</th>
                                        <th>Remision</th>
                                        <th>Cliente </th>
                                        <th>Obra </th>
                                        <th>Mixer </th>
                                        <th>Hora </th>
                                        <th>Cod Producto </th>
                                        <th>Detalle </th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <button type="submit" class="btn btn-block btn-success" name="guardar_novedades_generales" id="guardar_novedades_generales"><i class="fas fa-save"></i> Guardar Novedades
                                Remisiones Generales</button>
                        </div>
                    </div>
                </form>
            </div> <!--  Fin del Cardbody -->
        </div>

        <hr>

        <!--Modal Ver novedades cliente y obra -->
        <div class="modal fade" id="modal_novedades_generales_cli_ob">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ver Novedades </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <hr>
                        <div class="row">
                            <div class="col">
                                <table id="datatable_novedades_cli_obra" class="display" width="100%" cellspacing="0">
                                    <thead>
                                        <th>N</th>
                                        <th>Remision</th>
                                        <th>Tipo Novedad</th>
                                        <th>Area Afectada</th>
                                        <th>Novedad</th>
                                        <th>Observaciones</th>
                                        <th>Detalle</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


        <div class="modal fade" id="modal_adicionar_novedades">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Novedades </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="post" id="form_novedades" name="form_novedades">
                            <div class="row">
                                <div class="col">
                                    <input type="hidden" name="task_novedad" id="task_novedad">
                                    <input type="hidden" name="id_novedad" id="id_novedad">
                                    <input type="hidden" name="id_remision" id="id_remision">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Tipo de Novedad</label>
                                        <select class="select2  form-control" id="txt_tipo_novedad" name="txt_tipo_novedad" style="width:100%" required />
                                        <?php echo  $cls_novedades->option_tipo_novedades(); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Area Afectada</label>
                                        <select class="j select2  form-control" id="txt_area_novedad" name="txt_area_novedad" style="width:100%" required />

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Novedad</label>
                                        <select class="select2  form-control" id="txt_novedad" name="txt_novedad" style="width:100%" required />


                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Observaciones</label>
                                        <input type="text" id="txt_obs" name="txt_obs" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-gorup">
                                        <button type="submit" class="btn btn-success" id="btn_guardar_novedad" name="btn_guardar_novedad">Guardar Novedad</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <table id="datatable_novedades" class="display" width="100%" cellspacing="0">
                                    <thead>
                                        <th></th>
                                        <th>Tipo Novedad</th>
                                        <th>Area Afectada</th>
                                        <th>Novedad</th>
                                        <th>Observaciones</th>
                                        <th>Detalle</th>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>

                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>


    </section>
</div>
<?php include '../../../layout/footer/footer3.php' ?>

<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.4/js/dataTables.select.min.js"></script>


<script>
    // Tablas
    $(document).ready(function() {
        $('.select2').select2();
        var id_novedad = '<?php echo $id_novedad; ?>';
        var fecha_novedad = '<?php echo $fecha_novedad; ?>';

        // accion boton Eliminar en la tabla de novedades generales y por remision
        $('#datatable_novedades tbody').on('click', 'button', function() {
            var data = table_novedades.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: '',
                text: "",
                icon: 'success',
                html: "Esta seguro de eliminar la Novedad <br>",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "eliminar_novedad.php",
                        type: "POST",
                        data: {
                            id: id,
                            task: $('#task_novedad').val()
                        },
                        success: function(response) {
                            table_novedades.ajax.reload();
                            toastr.success('exitoso');
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });

                } else {


                }
            })

        });

        // Accion de Eliminar en la tabla de novedades por cliente y obra
        $('#datatable_novedades_cli_obra tbody').on('click', 'button', function() {
            var data = table_novedades_cli_obra.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: '',
                text: "",
                icon: 'success',
                html: "Esta seguro de eliminar la Novedad<br>",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "eliminar_novedad.php",
                        type: "POST",
                        data: {
                            id: data['id'], // el id de la novedad
                            task: 2 // task 2 Elimina por Remision
                        },
                        success: function(response) {
                            // Recargar la ta bla
                            table_novedades_cli_obra.ajax.reload();
                            if(data.estado){
                                toastr.success("Eliminado Correctamente");
                            }else{
                                toastr.warning("Eliminado Correctamente");
                            }
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });

                } else {


                }
            })

        });



        /**
         * ============================================================================================
         * Tablas
         * ============================================================================================
         */

        // tabla novedades cliente y obras
        function datatable_novedades_cli_obra(id_novedad, id_cliente, id_obra) {
            var table_novedades_cli_obra = $('#datatable_novedades_cli_obra').DataTable({
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_novedades_cli_obra.php",
                    'data': {
                        'id_novedad': id_novedad,
                        'id_cliente': id_cliente,
                        'id_obra': id_obra,
                    },
                    'type': 'post',
                    "dataSrc": ""

                },
                "order": [
                    [0, 'desc']
                ],
                "columns": [{
                        "data": 'id',
                    },
                    {
                        "data": 'cod_remision',
                    },
                    {
                        "data": "tipo_novedad"
                    },
                    {
                        "data": "area_afectada" // codigo de la novedad
                    },
                    {
                        "data": "novedad" // codigo de la novedad
                    },
                    {
                        "data": "observacion"
                    },
                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-danger btn-sm'> Eliminar </button>"
                    }
                ],


                //"scrollX": true,
            });

            table_novedades_cli_obra.on('order.dt search.dt', function() {
                table_novedades_cli_obra.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            //table_novedades_cli_obra.ajax.reload();
            return table_novedades_cli_obra;
        } //  fin de la funcion


        // tabla de cliente y obras
        function datatable_novedades(id_novedad, id_remision = null) {
            var table_novedades = $('#datatable_novedades').DataTable({
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_novedades.php",
                    'data': {
                        'id_novedad': id_novedad,
                        'id_remision': id_remision,
                    },
                    'type': 'post',
                    "dataSrc": ""

                },
                "order": [
                    [0, 'desc']
                ],
                "columns": [{
                        "data": 'id',
                    },
                    {
                        "data": "tipo_novedad"
                    },
                    {
                        "data": "area_afectada" // codigo de la novedad
                    },
                    {
                        "data": "novedad" // codigo de la novedad
                    },
                    {
                        "data": "observacion"
                    },
                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-danger btn-sm'> Eliminar </button>"
                    }
                ],


                //"scrollX": true,
            });

            table_novedades.on('order.dt search.dt', function() {
                table_novedades.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            table_novedades.ajax.reload();
            return table_novedades;
        } //  fin de la funcion


        /**
         * ==============================================================
         * Formularios
         * ==============================================================
         */
        // Guardar novedades Generales en Remisiones.
        $("#form_guardar_remi").on('submit', (function(e) {
            // actualizar la tabla
            e.preventDefault();
            $.ajax({
                url: "php_crear_remi.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    if (data.estado) {
                        toastr.success('exitoso');
                    } else {
                        toastr.warning(data.msg);
                    }

                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });



        }));


        /**
         * ==============================================================
         * Formularios
         * ==============================================================
         */

         /**
          * Accion Eliminar NOVEDAD cliente y Obra asociados al id de la novedad
          */
        $('#table_clientes_obras tbody').on('click', 'button.btn_eliminar', function() {
            var data = table_cliente_obra.row($(this).parents('tr')).data();
            var id_novedad = data['id']; // trae el id de la tabla de novedades tiene clientes y obras

            // alerta de eliminar
            Swal.fire({
                title: '',
                text: "",
                icon: 'success',
                html: "Esta seguro de eliminar  <br>", // mensaje de alerta
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    // ajax para eliminar cliente y Ivra
                    $.ajax({
                        url: "eliminar_cliente_obra.php",
                        type: "POST",
                        data: {
                            id: id_novedad, // id de la Novedad
                            task: "1",   
                        },
                        success: function(response) {
                            table_cliente_obra.ajax.reload(); // Recarga de la Tabla
                            toastr.success("Cliente y Obra Eliminado Correctamente");
                            //$('#txt_obra').html(response.obras); // 
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });

                } else {


                }
            })

        });


        /**
         * Cargar Novedades por cliente y obra
         */
        $('#table_clientes_obras tbody').on('click', 'button.btn_vernovedades', function() {
            // traer los datos y guardarlos en variables
            var data = table_cliente_obra.row($(this).parents('tr')).data();
            var id_novedad = data['id_novedad'];
            var fecha_novedad = '<?php echo $fecha_novedad; ?>';
            var id_cliente = data['id_cliente'];
            var id_obra = data['id_obra'];

            /** Recargar tabla de novedades de clientes y obra */
            // Busca la Tabla y la destruye
            if ($.fn.dataTable.isDataTable('#datatable_novedades_cli_obra')) {
                table_novedades_cli_obra = $('#datatable_novedades_cli_obra').DataTable();
                table_novedades_cli_obra.destroy();
            }
            // se crea la tabla
            table_novedades_cli_obra = datatable_novedades_cli_obra(id_novedad, id_cliente, id_obra);
            // Recargar tabla cada 5 segundos
            table_novedades_cli_obra.ajax.reload(null, false);
            
            
        });

        /**
         *  Cargar en la tabla de remisiones por cliente y obra.
         * se filtra id_novedad, id_cliente, id_obra
         */
        $('#table_clientes_obras tbody').on('click', 'button.btn_cargar_remisiones', function() {
            var data = table_cliente_obra.row($(this).parents('tr')).data();
            var id_novedad = data['id_novedad'];
            var fecha_novedad = '<?php echo $fecha_novedad; ?>';
            var id_cliente = data['id_cliente'];
            var id_obra = data['id_obra'];

            /** Recargar tabla de novedades de clientes y obra */
            // Busca la Tabla y la destruye
            if ($.fn.dataTable.isDataTable('#table_remisiones')) {
                table_remisiones = $('#table_remisiones').DataTable();
                table_remisiones.destroy();
            }
            // se crea la tabla
            table_remisiones = datatable_remisiones(id_novedad, fecha_novedad, id_cliente, id_obra);
            // Recargar tabla cada 5 segundos
            
                table_remisiones.ajax.reload(null, false);
            
        });

        /**
         * Accion Eliminar Clientes y obras asosciadas al id de la 
         */
        $('#table_clientes_obras tbody').on('click', 'button.btn_eliminar', function() {
            var data = table_cliente_obra.row($(this).parents('tr')).data();
            var id_novedad = data['id'];

            Swal.fire({
                title: '',
                text: "",
                icon: 'success',
                html: "Esta seguro de eliminar Cliente y Obra <br>",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "eliminar_cliente_obra.php",
                        type: "POST",
                        data: {
                            id: id_novedad,
                            task: "1",
                        },
                        success: function(response) {

                            $('#txt_obra').html(response.obras);
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });

                } else {


                }
            })

        });

        // ver novedades abrir el modal de la novedades generales. 
        $('#adicionar_novedades_generales').on('click', function() {
            $("#id_remision").val(null);
            $("#id_novedad").val(id_novedad);
            $("#task_novedad").val('1'); // 1 novedades generales , 2 novedades remisiones
            if ($.fn.dataTable.isDataTable('#datatable_novedades')) {
                table_novedades = $('#datatable_novedades').DataTable();
                table_novedades.destroy();
            }
            table_novedades = datatable_novedades(id_novedad,null);

            

        });

        $('#txt_tipo_novedad').on('change', function() {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data: {
                    tipo_novedad: ($('#txt_tipo_novedad').val()),
                    task: "2",
                },
                success: function(response) {

                    $('#txt_area_novedad').html(response.subtipo_novedad);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });

        $('#txt_area_novedad').on('change', function() {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data: {
                    tipo_novedad: ($('#txt_tipo_novedad').val()),
                    subtipo_novedad: ($('#txt_area_novedad').val()),
                    task: "3",
                },
                success: function(response) {

                    $('#txt_novedad').html(response.novedades);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });



        // acciones en los botones en la tabla de remisiones
        $('#table_remisiones tbody').on('click', 'button', function() {
            var data = table_remisiones.row($(this).parents('tr')).data();

            $("#id_remision").val(data['id']);
            $("#id_novedad").val(id_novedad);
            $("#task_novedad").val('2'); // 1 novedades generales , 2 novedades remisiones

            
            
            if ($.fn.dataTable.isDataTable('#datatable_novedades')) {
                table_novedades = $('#datatable_novedades').DataTable();
                table_novedades.destroy();
            }
            table_novedades = datatable_novedades(id_novedad, data['id']);

            $("#modal_adicionar_novedades").modal('show');
        });

        $('#txt_cliente').on('change', function() {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data: {
                    idCliente: ($('#txt_cliente').val()),
                    task: "1",
                },
                success: function(response) {

                    $('#txt_obra').html(response.obras);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });

        // crear tablas
        table_cliente_obra = datatable_cliente_obras(id_novedad);
        setInterval(function() {
            table_cliente_obra.ajax.reload(null, false);
        }, 3000);

        // $('#cliente').on('change', function() {

        var n = 1;

        // tabla de cliente y obras
        function datatable_cliente_obras(id_novedad) {
            var table_cliente_obra = $('#table_clientes_obras').DataTable({
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_cli_obra.php",
                    'data': {
                        'id_novedad': id_novedad,
                    },
                    'type': 'post',
                    "dataSrc": ""

                },
                "order": [
                    [0, 'desc']
                ],
                "columns": [{
                        "data": 'id',
                    },
                    {
                        "data": "nombre_cliente"
                    },
                    {
                        "data": "nombre_obra" // codigo de la novedad
                    },
                    {
                        "data": "cant_novedades"
                    },
                    {
                        // modal_novedades_generales_cli_ob  = ln 161
                        // btn_vernovedades = ln 470
                        // btn_cargar_remisiones
                        "data": null,
                        "defaultContent": "<button class='btn btn_vernovedades btn-info btn-sm' data-toggle='modal' data-target='#modal_novedades_generales_cli_ob'> <i class='fas fa-eye'></i> Novedades </button>  <button class='btn btn_cargar_remisiones btn-warning btn-sm'> <i class='fas fa-folder'></i> Remisiones </button> <button class='btn btn-danger btn_eliminar btn-sm'> <i class='fas fa-trash'></i> </button>"
                    }
                ],


                //"scrollX": true,
            });

            table_cliente_obra.on('order.dt search.dt', function() {
                table_cliente_obra.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            table_cliente_obra.ajax.reload();
            return table_cliente_obra;
        } //  fin de la funcion
        // =======================================================+
        // crear tablas




        $("#cargar_remisiones").click(function() {
            var id_novedad = '<?php echo $id_novedad; ?>';
            var fecha_novedad = '<?php echo $fecha_novedad; ?>';
            if ($.fn.dataTable.isDataTable('#table_remisiones')) {
                table_remisiones = $('#table_remisiones').DataTable();
                table_remisiones.destroy();
            }
            table_remisiones = datatable_remisiones(id_novedad, fecha_novedad, null, null);
        });


        // $('#cliente').on('change', function() {

        var n = 1;

        // tabla de cliente y obras
        function datatable_remisiones(id_novedad, fecha_novedad, id_cliente, id_obra) {
            var table_remisiones = $('#table_remisiones').DataTable({
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_remisiones.php",
                    'data': {
                        'id_novedad': id_novedad,
                        'fecha_novedad': fecha_novedad,
                        'id_cliente': id_cliente,
                        'id_obra': id_obra
                    },
                    'type': 'post',
                    "dataSrc": "",
                },
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "ckeck",
                    },
                    {
                        "data": 'num_novedades',
                    },
                    {
                        "data": "codigo_remi"
                    },
                    {
                        "data": "razon_social"
                    },
                    {
                        "data": "nombre_obra"
                    },
                    {
                        "data": "vehiculo"
                    },
                    {
                        "data": "hora_remi"
                    },
                    {
                        "data": 'cod_producto'
                    },
                    {
                        "data": null,
                        "defaultContent": "<button  type='button' class='btn btn-warning btn-sm'> Novedades </button><button  type='button' class='btn ver_remi btn-info btn-sm'> <i class='fas fa-eye'></i> </button>"
                    },

                ],


                //"scrollX": true,
            });

            table_remisiones.on('order.dt search.dt', function() {
                table_remisiones.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            table_remisiones.ajax.reload();
            return table_remisiones;
        } //  fin de la funcion
    });
</script>


<script>
    // adicionar Cliente y Obra en la tabla
    $(document).ready(function() {
        var n = 1;
        $("#form_add_cliente_obra").on('submit', (function(e) {
            // actualizar la tabla
            e.preventDefault();
            $.ajax({
                url: "php_add_cliente_obra.php",
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
                        toastr.warning(data.msg);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });

        }));


        $("#form_novedades").on('submit', (function(e) {
            // actualizar la tabla
            e.preventDefault();
            $.ajax({
                url: "guardar_novedades.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    toastr.success("Exitoso");
                    var id_novedad = '<?php echo $id_novedad; ?>';
                    
                    table_novedades.ajax.reload();
                    

                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });

        }));

    });
</script>

</body>

</html>