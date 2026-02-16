<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>OPORTUNIDAD DE NEGOCIO</h1>
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
        /**
         * Validacion de Usuario
         */
        $t1_terceros = new t1_terceros();
     ?>
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">TABLA DE LAS OPORTUNIDADES DE NEGOCIO</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                            <table id="table_op" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>N</th>
                                        <th>status</th>
                                        <th>Fecha</th>
                                        <th>identificacion</th>
                                        <th>Nombre cliente</th>
                                        <th>Detalle</th>
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
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../layout/footer/footer2.php' ?>
<script>
    $(document).ready(function() {

        var n = 1;
        var table = $('#table_op').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "datatable.php",
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "status_op"
                },
                {
                    "data": "fecha"
                },
                {
                    "data": "nidentificacion"
                },
                {
                    "data": "razon_social"
                }, 
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-eye'></i> </button>"
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
        $('#table_op tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            window.location = "editar/editar.php?id=" + id;
        });
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);
    });
</script>

</body>

</html>