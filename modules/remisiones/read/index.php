<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>

<?php
switch ($rol_user) {
    case 1:
    case 15:
    case 16:
    case 19:
    case 20:
    case 26:
    case 27:
    case 29:

        $php_clases = new php_clases();
        $t1_terceros = new t1_terceros();
        $t5_obras = new t5_obras();


        break;

    default:
        print('<script> window.location = "../index.php"</script>');

        break;
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REMISIONES</h1>
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
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <a href="create/crear.php" class="btn btn-block btn-info"> Subir Remision </a>
                        </div>
                    </div>
                </div>
                <div id="contenido">
                    <table id="t_remisiones" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Codigo</th>
                                <th>Cliente</th>
                                <th>Obra</th>
                                <th>Fecha</th>
                                <th style="width:100px">Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfooter>
                            <tr>

                                <th>N</th>
                                <th>Codigo</th>
                                <th>Cliente</th>
                                <th>Obra</th>
                                <th>Fecha</th>
                                <th>Detalle</th>
                            </tr>
                        </tfooter>
                    </table>
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

<?php include '../../layout/footer/footer2.php' ?>



<script>
    $(document).ready(function() {

        var n = 1;
        var table = $('#t_remisiones').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "data_table_remisiones.php",
                "dataSrc": ""
            },
           
            "order": [
                [0, 'desc']
            ],
            "columns": [
                
                {
                    "data":"ct26_id_remision"
                },
                {
                    "data": "ct26_codigo_remi"
                },
                {
                    "data": "ct26_razon_social"
                },
                {
                    "data": "ct26_nombre_obra"
                },
                {
                    "data": "ct26_fecha_remi"
                },

                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-eye'></i> </button>"
                }
            ],
            //"scrollX": true,

        });

        table.on( 'order.dt search.dt', function () {
            table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
        } );
    } ).draw();

        $('#t_remisiones tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['ct26_id_remision'];

            window.location = "update/editar.php?id=" + id;
        });

        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);



    });
</script>

</body>

</html>