<?php include '../../../layout/validar_session3.php' ?>

<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

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
        <div class="card card-primary">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="">Sede</label>
                            <select name="txt_sede" id="txt_sede" class="form-control">
                                <!----> <?php echo $cls_laboratorio->option_sede() ?> 
                                <!--<option value="RMI">IBAGUE</option>
                                <option value="HND">HONDA</option>
                                <option value="RMT">TORREON</option>-->
                                
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <button type="button" id="btn_sede">Seleccionar Sede</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">REGISTRO DE TOMA DE MUESTRAS ENSAYO A COMPRESIÓN O FLEXIÓN</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">


                <div class="row">
                    <div class="col">
                        <table id="tabla_registro_muestras">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Fecha</th>
                                    <th>Muestra</th>
                                    <th>Consecutivo Interno</th>
                                    <th>Remision</th>
                                    <th>Periodo</th>
                                    <th>Promedio KG/CM2</th>
                                    <th>%</th>
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

        <!-- Default box -->
       

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- MODALES -->

<!------->
<?php include '../../../layout/footer/footer3.php' ?>

<script>
    $(document).ready(function() {
        var n = 1;
        var sede = $("#txt_sede").val();

        // funcion tabla registro de muestras
        function datatable_muestras(sede) {
            var table = $('#tabla_registro_muestras').DataTable({
                "paging": "false",
                "searching": "false",

                //"scrollX": true,
                "ajax": {
                    "url": "data_table_reg_muestras.php",
                    'data': {
                        "sede": sede,

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
                        "data": "fecha_muestra" // Fecha
                    },
                    {
                        "data": "id" // Muestra
                    },
                    {
                        "data": "consecutivo_interno"
                    },
                    {
                        "data": "cod_remi" // Remision
                    },
                    {
                        "data": "periodo" // Remision
                    },
                    {
                        "data": "promediokgcm2" // Remision
                    },
                    {
                        "data": "porcentaje" // Remision
                    },

                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-warning btn-sm'><i class='fas fa-edit'></i> </button>"
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
        if ($.fn.dataTable.isDataTable('#tabla_registro_muestras')) {
            table = $('#tabla_registro_muestras').datatable_muestras(sede);
            table.destroy();
        }
        var sede = $("#txt_sede").val();
        table = datatable_muestras(sede);

        /**
         * setInterval(function() {
            table.ajax.reload(null, false);
        }, 15000);
        **/

        $('#tabla_registro_muestras tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];

            window.location = "update/index.php?id=" + id;
        });





        var n = 1;
        // Declarar funcion destruir tabla
  

 
        //


        $("#btn_sede").click(function() {
            var sede = $("#txt_sede").val();
            table.destroy();
            table = datatable_muestras(($("#txt_sede").val()));

            table.ajax.reload(null, false);


            ///////////////////////////



        });



    });
</script>



</body>

</html>