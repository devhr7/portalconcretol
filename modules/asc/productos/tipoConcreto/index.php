<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tipo de concreto</h1>
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
                        <div class="col">
                            <a href="create/crear.php"><button> Crear </button></a>
                        </div>
                    </div>
                </div>
                <div id="contenido">
                    <table id="t_tipo_concreto" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> N </th>
                                <th> Codigo </th>
                                <th> Descripcion </th>
                                <th> Detalle </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th> N </th>
                                <th> Codigo </th>
                                <th> Descripcion </th>
                                <th> Detalle </th>
                            </tr>
                        </tfoot>
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

<?php include '../../../layout/footer/footer3.php' ?>

<script>
    $(document).ready(function() {
        var n = 1;
        var table = $('#t_tipo_concreto').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "data_table_tipo_concreto.php",
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "cod"
                },
                {
                    "data": "descripcion"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-edit'></i> </button>"
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
        $('#t_tipo_concreto tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            window.location = "update/editar.php?id=" + id;
        });
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);
    });
</script>
</body>

</html>