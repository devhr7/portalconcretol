<?php include '../../layout/validar_session2.php'; ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php';

$t1_terceros = new t1_terceros();
$oportunidad_negocio = new oportunidad_negocio();

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
                        <h1>Tabla de novedades</h1>
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
                <h3 class="card-title">Tabla de Novedades</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <table id="table_novedades">
                    <thead>
                        <th> N </th>
                        <th>Fecha</th>
                        <th> Codigo de la novedad </th>
                        <th>Detalle</th>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>

        <!-- /.card-body -->
        <div class="card-footer">
        </div>
        <!-- /.card-footer-->

    </section>
</div>
<?php include '../../layout/footer/footer2.php' ?>

<script>

if ($.fn.dataTable.isDataTable('#table_novedades')) {
            table_novedades = $('#table_novedades').DataTable();
            table_novedades.destroy();
        }
        table_novedades = datatable_novedades();
        setInterval(function() {
            table_novedades.ajax.reload(null, false);
        }, 5000);

        $('#table_novedades tbody').on('click', 'button', function() {
            var data = table_novedades.row($(this).parents('tr')).data();
            var id_novedad = data['id'];

            window.location = "update/editar.php?id=" + id_novedad;
        });

function datatable_novedades() {
        var table_novedades = $('#table_novedades').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "datatable_novedades.php",
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
                    "data": "id" // codigo de la novedad
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-eye'></i> Ver </button>"
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

</script>

</body>

</html>