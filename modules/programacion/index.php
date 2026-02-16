<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>
<!-- Content Wrapper. Contains page content -->


<?php


$t8_programacion = new t8_programacion();


$last_id_programacion = $t8_programacion->generar_code_prog();



?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PROGRAMACION</h1>

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
                <h3 class="card-title"> Ver Programaciones</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-3">
                        <a href="create/crear.php" class="btn btn-block btn-success">Crear Programacion</a>
                    </div>
                    <div class="col-3">
                        <button type="button" data-toggle="modal" class="btn btn-block btn-info" data-target="#list_agente"> <i class="fas fa-info-circle"></i> Agentes Servicio Disponibles</button>
                    </div>
                    <div class="col-3">
                        <button type="button" data-toggle="modal" class="btn btn-block btn-info"
                            data-target="#list_obra"> <i class="fas fa-info-circle"></i> Obras Disponibles</button>
                    </div>
                </div>

                <div id="contenido">
                    <table>
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Fecha</th>
                                <th>Linea Despacho</th>
                                <th>Metros Cubicos</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <div class="modal fade" id="list_agente" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Listado de Agentes de Servicio </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        
                            <table id="t_conductores" class="display compact" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>Nombre Conductor</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>

                            </table>
                        
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                        
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="list_obra" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Listado de Obras Bloqueadas </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <table id="t_obra" class="display compact" style="width:100%">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Cliente</th>
                                    <th>Obra</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>

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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../layout/footer/footer2.php' ?>

<script>
$(document).ready(function() {

    var n = 1;
    var table_obra = $('#t_obra').DataTable({
        //"processing": true,
        //"scrollX": true,
        "ajax": {
            "url": "data_table_obra.php",
            "dataSrc": ""
        },

        "order": [
            [0, 'desc']
        ],
        "columns": [

            {
                "data": "ct5_IdObras"
            },
            {
                "data": "ct1_RazonSocial"
            },
            {
                "data" : "ct5_NombreObra"
            },
            {
                "data": "ct5_estado2"
            },


        ],
        //"scrollX": true,

    });

    table_obra.on('order.dt search.dt', function() {
        table_obra.column(0, {
            search: 'applied',
            order: 'applied'
        }).nodes().each(function(cell, i) {
            cell.innerHTML = i + 1;
        });
    }).draw();


    setInterval(function() {
        table_obra.ajax.reload(null, false);
    }, 10000);



});
</script>

<script>
    $(document).ready(function() {

        var n = 1;
        var table = $('#t_conductores').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "data_table_conductores.php",
                "dataSrc": ""
            },

            "order": [
                [0, 'desc']
            ],
            "columns": [

                {
                    "data": "ct1_IdTerceros"
                },
                {
                    "data": "ct1_RazonSocial"
                },
                {
                    "data": "ct1_estado2"
                },
               

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


        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);



    });
</script>


</body>

</html>