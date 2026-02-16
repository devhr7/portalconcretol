<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>

<?php

switch (intval($rol_user)) {
    case 1:
    case '1':
    case 23:
    case '23':

        $cls_requisiciones = new cls_requisiciones();

        break;

    default:
        //print('<script> window.location = "../index.php"</script>');
        $cls_requisiciones = new cls_requisiciones();

        break;
}

//Permisos 
if (intval($rol_user) == 1 || intval($rol_user) == 23) {
    $disabled = "  ";
} else {
    $disabled = " disabled='disabled' ";
}


// Permisos de estatus





$id_requisicion  = $_GET['id'];
//$id_remision  = $php_clases->HR_Crypt($_GET['id'], 2);
$datos_requisicion = $cls_requisiciones->get_data_requiscion($id_requisicion);

while ($fila_requi = $datos_requisicion->fetch(PDO::FETCH_ASSOC)) {
    $id_area = $fila_requi['id_area'];
    $id_estatus = $fila_requi['id_estatus'];
    $fecha_estatus = $fila_requi['fecha_estatus'];
}
// Permisos de estatus
if ($cls_requisiciones->verificar_estatus($id_requisicion)) {
    $permisos_estatus = "     ";
} else {
    $permisos_estatus = " disabled='disabled' ";
}


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Requisicion</h1>

                </div>
                <div class="col-sm-6">



                    <?php

                    ?>
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



                <h3 class="card-title"> <button class="btn btn-danger btn-sm" id="btn_Destroy" type="button" <?php echo $disabled; ?>><i class='fas fa-trash-alt'></i></button> Requisicion <?php echo $id_requisicion ?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">


                    <!--EDITAR REQUISICION--->
                    <form name="form_editar_requisicion" id="form_crear_requisicion" method="post">


                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <label for="">Area solicitante</label>

                                    <select name="txt_area" id="txt_area" class="form-control" disabled>
                                        <?php echo $cls_requisiciones->option_areas($id_area); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Estatus Requisicion</label>
                                    <select name="txt_estado_requisicion" id="txt_estado_requisicion" class="form-control" <?php echo $disabled; ?>>
                                        <?php echo $cls_requisiciones->option_estado_requisicion($id_estatus); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <label></label>
                                <button type="button" id="btn_estado_requisicion" class="form-control btn btn-info" <?php echo $disabled; ?>><i class="fas fa-save"></i> Actualizar Requisicion</button>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <button type="button" class="form-control btn-success" data-toggle="modal" data-target="#modal_add_producto" <?php echo $permisos_estatus ?>> <i class="fas fa-cart-plus"></i>Adicionar Producto</button>
                                </div>
                            </div>


                        </div>
                    </form>
                    <div class="row">
                        <div class="col">
                            <input type="hidden" name="id_item_comparativo" id="id_item_comparativo" value="">
                            <table id="table_items" class="cell-border row-border">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>status</th>
                                        <th>Item</th>
                                        <th>Detalle</th>
                                        <th>Cantidad</th>
                                        <th>Unidad Medida</th>
                                        <th>Lugar Entrega</th>
                                        <th>Posible Proveedor</th>
                                        <th>Prioridad</th>

                                        <th>Detalle</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>

                    <br>
                    <br>

                    <hr>
                    <hr>
                    <div class="form-group" id="bloque_cotizaciones">
                        <div class="row">
                            <div class="col">
                                <center>
                                    <h2><b>Comparativo del siguiente Item</b></h2>
                                </center>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <H4><b>Nombre Item: </b></H4>

                                    <H4><span id="spn_item">Item</span> </H4>
                                    <H4><b>Descripcion</b></H4>
                                    <H4><span id="spn_desp">Descripcion</span> </H4>

                                </div>
                            </div>
                            <div class="col">
                                <img id="imagen_item" name="imagen_item" src="" alt="" width="500" height="300">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <table id="table_item_cotizaciones" class="cell-border row-border   ">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>status</th>
                                            <th>proveedor</th>
                                            <th>Tipo Pago</th>
                                            <th>Precio Unit + IVA</th>
                                            <th>Cantidad</th>
                                            <th>Unidad Medida</th>
                                            <th>Precio Total + IVA</th>
                                            <th>FILE</th>
                                            <th>Observaciones</th>
                                            <th>Detalle</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!---->
                </div>
                <!-- </form> -->
            </div>
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
            <div class="modal fade" id="modal_add_producto">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Describa el producto o servicio de la requisicion</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <form name="adicionar_item" id="adicionar_item" method="post">
                                    <input type="hidden" name="id_requisicion" id="id_requisicion" value="<?php echo $_GET['id'] ?> ">
                                    <div class="row">
                                        <div class="col">
                                            <label>Nombre Producto</label>
                                            <input type="text" name="txt_nombre_producto" id="txt_nombre_producto" class="form-control" required="true">
                                        </div>
                                        <div class="col">
                                            <label for="">Descripcion completa con especificaciones</label>
                                            <textarea name="txt_descripcion" id="txt_descripcion" cols="5" rows="2" class="form-control" required="true"></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Cantidad</label>
                                            <input type="number" name="txt_cantidad" id="txt_cantidad" class="form-control" required="true">
                                        </div>
                                        <div class="col">
                                            <label>Unidad Medida</label>
                                            <input type="text" name="txt_unidad_medida" id="txt_unidad_medida" class="form-control" required="true">
                                        </div>
                                        <div class="col">
                                            <label>Lugar de Entrega</label>

                                            <select name="txt_lugar_entrega" id="txt_lugar_entrega" class="form-control" required="true">
                                                <?php echo $cls_requisiciones->option_lugar_entrega(); ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label>Prioridad</label>
                                            <select name="txt_prioridad" id="txt_prioridad" class="form-control" required="true">
                                                <?php echo $cls_requisiciones->option_prioridad(); ?>

                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <label for="">Posible Proveedor</label>
                                            <input type="text" name="txt_posible_proveedor" id="txt_posible_proveedor" class="form-control">
                                        </div>
                                        <div class="col">
                                            <label>Imagen del producto</label>
                                            <input type="file" class="form-control" name="img_producto" id="img_producto" accept="image/x-png,image/jpeg" />
                                        </div>

                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            <button type="submit" class="form-control btn btn-success">Adicionar Producto</button>
                                        </div>
                                    </div>
                                </form>

                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal_add_precio">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Adicionar Precio </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="post" name="form_add_precio" id="form_add_precio">
                                <input type="hidden" name="txt_id_item1" id="txt_id_item1" value="">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Proveedor</label>
                                            <input type="text" name="txt_proveedor" id="txt_proveedor" class="form-control" required="true">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Tipo de Pago</label>
                                            <select name="txt_tipo_pago" id="txt_tipo_pago" class="form-control" required="true">
                                                <option selected="selected" disabled="disabled">Seleccione tipo de Pago</option>
                                                <option value="1">Credito</option>
                                                <option value="2">Anticipado</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Precio unitario + IVA</label>
                                            <input type="text" name="txt_precio" id="txt_precio" class="form-control" required="true">
                                        </div>
                                    </div>

                                    <div class="col ">
                                        <div class="form-group">
                                            <label for="">Seleccione Cotizacion</label>
                                            <select name="txt_select_cotizacion" id="txt_select_cotizacion" class="form-control">
                                                <?php echo $cls_requisiciones->option_file_cotizaciones($id_requisicion); ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Subir Cotizacion</label>
                                            <input type="file" class="form-control" name="txt_file_cotizacion" id="txt_file_cotizacion" class="form_control" accept="image/x-png,image/jpeg,application/pdf" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="">Observacion</label>
                                    <input type="text" name="txt_observacion_precio" id="txt_observacion_precio" class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <button type="submit" class="form-control btn btn-success">Adicionar cotizacion</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                        <div class="modal-footer justify-content-between">

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal_eliminar">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Esta seguro de eliminar item de la requisicion </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_item_delete" id="id_item_delete" value="">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger" id="btn_eliminar_item" <?php echo $disabled; ?>>Si, Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal_eliminar_cotizacion">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Esta seguro de eliminar Cotizacion de la requisicion </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="id_cotizacion_delete" id="id_cotizacion_delete" value="">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger" id="btn_eliminar_cotizacion" <?php echo $disabled; ?>>Si, Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
</div>

</section>
</div>



<?php include '../../../layout/footer/footer3.php' ?>


<script>
    $(document).ready(function() {
        $('.select2').select2();



    });
</script>

<script>
    /////////////////////////////////////////////////////////////
    $(document).ready(function() {
        // Tabla de Items de la Requisicion
        var id_requisicion = <?php echo $_GET['id']; ?>;

        //** TABLA ITEMS REQUISICION */
        var table_items = $('#table_items').DataTable({

            "ajax": {
                "url": "datatable_items.php",
                'data': {
                    'id_requisicion': id_requisicion,
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
                    "data": "status" //estatus
                },
                {
                    "data": "nombre_producto" // Item
                },
                {
                    "data": "descripcion" // Detalle
                },
                {
                    "data": "cantidad" // Cantidad
                },
                {
                    "data": "medida" // Cantidad
                },
                {
                    "data": "lugar_entrega" // Lugar Entrega
                },
                {
                    "data": "posible_proveedor" // Posible proveedor
                },
                {
                    "data": "prioridad" // Prioridad
                },

                {

                    "defaultContent": "<button type='button' class='btn_add_precio btn btn-success btn-sm btn_add_precio'> <i class='fas fa-plus'></i> </button>  <button class='btn btn-info btn-sm btn_ver_comparativo'> <i class='fas fa-eye'></i> </button> <button class='btn btn-danger btn-sm btn_eliminar'> <i class='fas fa-trash-alt'></i> </button> "
                }
            ],
            'paging': false,
            'searching': false
            //"scrollX": true,
        });

        //** TABLA COTIZACIONES */
        function datatable_items_cotizaciones(id_item) {
            var table_cotizaciones = $('#table_item_cotizaciones').DataTable({
                //"processing": true,
                //"scrollX": true,
                "ajax": {

                    "url": "datatable_items_cotizaciones.php",
                    'data': {
                        'id_item': id_item,
                    },
                    'type': 'post',
                    'paging': 'false',
                    "dataSrc": ""
                },

                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "status" //estatus
                    },
                    {
                        "data": "proveedor" // proveedor
                    },
                    {
                        "data": "tipo_pago"
                    },
                    {
                        "data": "precio" // precio unitario
                    },
                    {
                        "data": "cantidad" // Cantidad
                    },
                    {
                        //"data": "medida" // Cantidad
                    },
                    {
                        "data": "preciototal" // precio Total
                    },
                    {
                        "data": "botonPDF"
                    },
                    {
                        "data": "observaciones"
                    },
                    {
                        "data": null,
                        "defaultContent": "<button type='button' class='btn btn-success btn-sm btn1_aprobado'  <?php echo $disabled; ?> > <i class='fas fa-check-circle'></i>  </button><button class='btn btn-danger btn-sm btn2_noaprobado'  <?php echo $disabled; ?> > <i class='fas fa-times-circle'></i> </button>  <button class='btn btn-info btn-sm btn3_eliminar_cot'  <?php echo $disabled; ?> > <i class='fas fa-trash-alt'></i> </button> "
                    }
                ],
                "createdRow": function(row, data, dataIndex) {
                    if (data[4] == "A") {
                        $(row).addClass('important');
                    }
                },
                'paging': false,
                'searching': false
                //"scrollX": true,
            });
            return table_cotizaciones;
        };



        $('#table_items tbody').on('click', 'button.btn_editar', function() {
            var data_items = table_items.row($(this).parents('tr')).data();
            alert("proximamente");
        });

        // Boton Adicionar Precio
        $('#table_items tbody').on('click', 'button.btn_add_precio', function() {
            var data_items = table_items.row($(this).parents('tr')).data();

            $("#txt_id_item1").val(data_items['id'])
            // ABRIR MODAL
            $("#modal_add_precio").modal("show");
        });

        // Eliminar Item
        $('#table_items tbody').on('click', 'button.btn_eliminar', function() {
            var data_items = table_items.row($(this).parents('tr')).data();
            var id = data_items['id'];
            $("#id_item_delete").val(data_items['id']);
            $("#modal_eliminar").modal("show");
        });




        $('#table_items tbody').on('click', 'button.btn_ver_comparativo', function() {
            var data_items = table_items.row($(this).parents('tr')).data();

            $("#spn_item").html(data_items['nombre_producto']);
            $("#spn_desp").html(data_items['descripcion']);

            var imagen_item = document.getElementById("imagen_item");
            imagen_item.setAttribute("src", data_items['file_item']);

            if ($.fn.dataTable.isDataTable('#table_item_cotizaciones')) {
                table_cotizaciones = $('#table_item_cotizaciones').DataTable();
                table_cotizaciones.destroy();
            }
            table_cotizaciones = datatable_items_cotizaciones(data_items['id']);
            // Boton Aprobado
            $('#table_item_cotizaciones tbody').on('click', 'button.btn1_aprobado', function() {
                var data_cotizaciones = table_cotizaciones.row($(this).parents('tr')).data();
                $.ajax({
                    url: "php_estado_item.php",
                    type: "POST",
                    data: {
                        task: 1,
                        id: data_cotizaciones['id'],
                        id_item: data_cotizaciones['id_item'],
                    },
                    success: function(response) {
                        toastr.success("Actualizado correctamente");
                        table_cotizaciones.ajax.reload();
                        table_items.ajax.reload();
                        //window.location.reload();
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    },
                })
            });
            // Boton No Aprobado
            $('#table_item_cotizaciones tbody').on('click', 'button.btn2_noaprobado', function() {
                var data_cotizaciones = table_cotizaciones.row($(this).parents('tr')).data();
                $.ajax({
                    url: "php_estado_item.php",
                    type: "POST",
                    data: {
                        task: 2,
                        id: data_cotizaciones['id'],
                        id_item: data_cotizaciones['id_item'],

                    },
                    success: function(response) {
                        toastr.success("Actualizado correctamente");
                        table_cotizaciones.ajax.reload();
                        table_items.ajax.reload();
                        //window.location.reload();
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    },
                })
            });
            // Boton Eliminar Cotizaciones
            $('#table_item_cotizaciones tbody').on('click', 'button.btn3_eliminar_cot', function() {
                var data_cotizaciones = table_cotizaciones.row($(this).parents('tr')).data();
                $("#id_cotizacion_delete").val(data_cotizaciones['id']);

                $("#modal_eliminar_cotizacion").modal("show");
            });
        });




        var id_item = 0;

        // Formularios 
        $("#adicionar_item").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_editar.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.estado) {
                        toastr.success('exitoso');
                        window.location.reload();
                        //table_items.ajax.reload();

                    } else {}
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        $("#btn_eliminar_item").click(function() {
            var id = $('#id_item_delete').val();
            $.ajax({
                url: "php_eliminar_item.php",
                type: "POST",
                data: {
                    id: id,
                },
                success: function(response) {
                    toastr.success("eliminado correctamente");
                    $("#modal_eliminar").modal("hide");

                    //table_items.ajax.reload();
                    table_items.ajax.reload();

                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));

                },
            });
        });


        $("#btn_eliminar_cotizacion").click(function() {
            var id = $('#id_cotizacion_delete').val();
            $.ajax({
                url: "php_eliminar_cotizacion.php",
                type: "POST",
                data: {
                    id: id,
                },
                success: function(response) {
                    toastr.success("eliminado correctamente");
                    $("#modal_eliminar_cotizacion").modal("hide");

                    table_cotizaciones.ajax.reload();

                    table_items.ajax.reload();

                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));

                },
            });
        });
        // actualizar estatus de requisiciones
        $("#btn_estado_requisicion").click(function() {
            var id = <?php echo $id_requisicion; ?>;
            var estado = $("#txt_estado_requisicion").val();
            $.ajax({
                url: "php_estado_requisicion.php",
                type: "POST",
                data: {
                    id: id,
                    estado: estado,
                },
                success: function(response) {
                    toastr.success("Actualizado Correctamente correctamente");
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));

                },
            });
        });
        // Formulario Adicionar Precio
        $("#form_add_precio").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_adicionar_precio.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.estado) {
                        $("#modal_add_precio").modal("hide");
                        toastr.success('exitoso');
                        table_items.ajax.reload();
                    } else {

                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        $('#txt_select_cotizacion').on('change', function() {
            if ($("#txt_select_cotizacion").val() == "subir_cotizacion") {
                document.getElementById('txt_file_cotizacion').disabled = false;
            } else {
                document.getElementById('txt_file_cotizacion').disabled = true;
            }
        });
    });

    // Eliminar Requisicion
    $("#btn_Destroy").click(function() {
        var id = <?php echo $id_requisicion; ?>;
        Swal.fire({
            title: 'Esta seguro(a) de eliminar?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "php_eliminar_requisicion.php",
                    type: "POST",
                    data: {
                        id: id,
                    },
                    success: function(response) {
                        Swal.fire(
                            'Eliminado!',
                            '',
                            'success'
                        )
                        location.href = "../index.php"
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));

                    },
                });


            }
        })
    });
</script>

</body>

</html>