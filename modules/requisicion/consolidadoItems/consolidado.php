<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include '../sidebar.php' ?>

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

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Consolidado items Requisiciones</h1>

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



                <h3 class="card-title"> Buscador</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <div class="row">
                        <div class="col">
                            <label for="">Codigo Requisiciones</label>
                            <input type="text" name="txt_cod_requisiciones" id="txt_cod_requisiciones" class="form-control" value="">
                        </div>
                        <div class="col">
                            <label>Area Solicitante</label>
                            <select name="txt_area_solicitante" id="txt_area_solicitante" class="form-control select2" value="">
                                <?php echo $cls_requisiciones->option_areas(); ?>
                            </select>
                        </div>
                        <div class="col">
                            <label>fecha</label>
                            <input type="date" name="txt_fecha_solicitante" id="txt_fecha_solicitante" class="form-control" value="">
                        </div>
                        <div class="col">
                            <label for="">Estatus</label>
                            <select id="txt_estatus" class="form-control select2">
                                <option value="" selected>Seleccione Estado</option>
                                <option value="1">Abierto</option>
                                <option value="2">Cerrado</option>
                            </select>
                        </div>
                        <div class="col">
                            <button type="button" id="btn_buscador" class="form-control btn-info">Buscar</button>
                        </div>
                    </div>
                </div>

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

</div>

</section>
</div>


<SCRipt>
    /////////////////////////////////////////////////////////////
    $(document).ready(function() {
        // Tabla de Items de la Requisicion
        var id_requisicion = 340;

        $("#btn_buscador").click(function() {
            var cod_requisiciones = $("#txt_cod_requisiciones").val();
            var fecha_solicitante = $('#txt_fecha_solicitante').val();
            var area_solicitante = $("#txt_area_solicitante").val();
            var estatus = $("#txt_estatus").val();
            if ($.fn.dataTable.isDataTable('#table_items')) {
                table = $('#table_items').DataTable();
                table.destroy();
            }
            table = table_consolidado_items_requisiciones(cod_requisiciones, fecha_solicitante, area_solicitante, estatus);
            setInterval(function() {
                table.ajax.reload(null, false);
            }, 5000);
        });

        //** TABLA ITEMS REQUISICION */

        function table_consolidado_items_requisiciones(cod_requisiciones, fecha_solicitante, area_solicitante, estatus) {
            var table_items = $('#table_items').DataTable({

                "ajax": {
                    "url": "datatable_items.php",
                    'data': {
                        'cod_requisiciones': cod_requisiciones,
                        'fecha_solicitante': fecha_solicitante,
                        'area_solicitante': area_solicitante,
                        'estatus': estatus
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
        }

    });
</script>

<?php include '../../../layout/footer/footer3.php' ?>
</body>

</html>