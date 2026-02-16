<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>

<?php
$php_clases = new php_clases();
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Votaciones</h1>
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
                        <div class="col-3">
                            <a href="create/crear.php" class="btn btn-block bg-gradient-info"> Crear Campaña de Votacion </a>
                        </div>
                        <div class="col-6">
                        </div>
                        <div class="col-3">
                            <a href="excel.php" class="btn btn-block bg-gradient-success"> Exportar Registro de Numero de Votantes </a>
                        </div>
                    </div>
                </div>
                <div id="contenido">
                    <table id="t_campvotaciones" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Estado</th>
                                <th>Nombre Campaña</th>
                                <th>Periodo Votacion</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>


                        </tbody>
                        <footer>
                            <tr>
                            <th>N</th>
                                <th>Estado</th>
                                <th>Nombre Campaña</th>
                                <th>Periodo Votacion</th>
                                <th>Detalle</th>
                            </tr>
                        </footer>
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
var table = $('#t_campvotaciones').DataTable({
    //"processing": true,
    //"scrollX": true,
    "ajax": {
        "url": "data_table.php",
        "dataSrc": ""
    },
    "order": [
        [0, 'desc']
    ],
    "columns": [
        {
            "data":"ct40_idcampvota"
        },
        {
            "data": "ct40_estado"
        },
        {
            "data": "ct40_nombrecampvota"
        },
        {
            "data": "ct40_periodovotaini"
        },
        {
            "data": null,
            "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-eye'></i>VER </button>",
        },
        
    ],
    //"scrollX": true,

});


table.on( 'order.dt search.dt', function () {
    table.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
    cell.innerHTML = i+1;
} );
} ).draw();

$('#t_campvotaciones tbody').on('click', 'button', function() {
    var data = table.row($(this).parents('tr')).data();
    var id = data['ct40_idcampvota'];
    var nombrecamp = data['ct40_nombrecampvota'];
    window.location = "create/new_participantes.php?id="+ id + '&camp='+nombrecamp;
});

setInterval(function() {
    table.ajax.reload(null, false);
}, 10000);



});
</script>

</body>

</html>