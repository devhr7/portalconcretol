<?php include '../../../layout/validar_session3.php'; ?>
<?php include '../../../layout/head/head3.php'; ?>
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
                        <h1>Registrar novedad</h1>
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
                <h3 class="card-title">Registrar novedad</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="form_crear_novedad" id="form_crear_novedad" method="post"
                        content="width=device-width, initial-scale=1">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Fecha</label>
                                    <input type="date" name="fecha_novedad" id="fecha_novedad" class="form-control" />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Crear novedad y seguir</label>
                                    <button type="submit" name="btn_crear_novedad" id="btn_crear_novedad"
                                        class="btn btn-block btn-success">
                                        Crear novedad
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Tabla novedades</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
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
        </div>

    </section>
</div>
<?php include '../../../layout/footer/footer3.php' ?>
<script>
$(document).ready(function() {

    $("#form_crear_novedad").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_crear_novedad.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(data) {
                console.log(data.estado);
                if (data.estado) {
                    toastr.success('exitoso');

                    window.location = '../update/editar.php?id=' + data.id_novedad;

                } else {
                    toastr.warning(data.msg);
                }
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });

    }));



    // $('#cliente').on('change', function() {
    $('#fecha_novedad').change(function() {
        var fecha_novedad = $('#fecha_novedad').val();
        if ($.fn.dataTable.isDataTable('#table_novedades')) {
            table_novedades = $('#table_novedades').DataTable();
            table_novedades.destroy();
        }
        table_novedades = datatable_novedades(fecha_novedad);
        setInterval(function() {
            table_novedades.ajax.reload(null, false);
        }, 5000);

        $('#table_novedades tbody').on('click', 'button', function() {
            var data = table_novedades.row($(this).parents('tr')).data();
            var id_novedad = data['id'];

            window.location = "../update/editar.php?id=" + id_novedad;
        });
    })
    var n = 1;

    function datatable_novedades(fecha) {
        var table_novedades = $('#table_novedades').DataTable({
            //"processing": true,
            //"scrollX": true,
            "ajax": {
                "url": "datatable_novedades.php",
                'data': {
                    'fecha_novedad': fecha,
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
});
</script>

</body>

</html>