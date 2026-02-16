<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php';

$t1_terceros = new t1_terceros();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PEDIDOS</h1>
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
        $pedidos = new pedidos();
        ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">TABLA DE PEDIDOS</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <a href="create/crear.php" class="btn btn-block btn-success"><i class="fas fa-plus"></i> Crear pedido</a>
                    </div>

                    <div class="col-4">
                        <a href="documentos/SUBIR.xlsx" download="Formato subir precios productos pedidos.xlsx" class="btn btn-block btn-primary"><i class="fas fa-download"></i> Descargar formato de subir productos</a>
                    </div>

                    <div class="col-5">
                        <a href="documentos/Formato precios productos.xlsx" download="Formato precios productos.xlsx" class="btn btn-block btn-primary"><i class="fas fa-download"></i> Descargar formato de subir precios productos</a>
                    </div>
                </div>
                <br>
                <table id="table_pedidos" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Status</th>
                            <th>Codigo pedido</th>
                            <th>Fecha vencimiento</th>
                            <th>Nombre del cliente</th>
                            <th>Nombre de la obra</th>
                            <th>Nombre asesora comercial</th>
                            <th>Detalles</th>
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

<?php include '../../../layout/footer/footer3.php' ?>

<script>
    $(document).ready(function() {
        var n = 1;
        var table = $('#table_pedidos').DataTable({
            "ajax": {
                "url": "data_table_salidas.php",
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "status"
                },
                {
                    "data": "id"
                },
                {
                    "data": "fecha_vencimiento"
                },
                {
                    "data": "nombre_cliente"
                },
                {
                    "data": "nombre_obra"
                },
                {
                    "data": "nombre_asesora"
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
        $('#table_pedidos tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            window.location = "editar/editar.php?id=" + id;
        });
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 10000);
    })
</script>

</body>

</html>