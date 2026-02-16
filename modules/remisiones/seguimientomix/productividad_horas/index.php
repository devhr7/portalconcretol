<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>



<?php
switch ($rol_user) {
    case 1:
    case 3:
    case 8:
    case 10:
    case 12:
    case 13:
    case 15:
    case 16:
    case 17:
    case 19:
    case 20:
    case 22:
    case 26:
    case 27:
    case 29:
    case 32:
        $php_clases = new php_clases();
        $t1_terceros = new t1_terceros();
        $t5_obras = new t5_obras();
        break;

    default:
        //print('<script> window.location = "../index.php"</script>');

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
                    <h1>CICLO HORAS</h1>
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
                <div class="row">
                    <div class="col-2">
                        <label>Ciudad</label>
                        <select class="form-control select2" name="ciudad" id="ciudad">
                            <option value="0" selected>Seleccione</option>
                            <option value="HONDA">HONDA</option>
                            <option value="IBAGUE">IBAGUE</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label>Fecha</label>
                        <input type="date" name="fecha" id="fecha" class="form-control">
                    </div>
                    <div id="contenido">
                        <table id="t_remisiones" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>N</th>
                                    <th>Codigo</th>
                                    <th>Obra</th>
                                    <th>Mixer</th>
                                    <th>Metros </th>
                                    <th>Conductor</th>
                                    <th>Hora Cargue</th>
                                    <th>Hora Salida Planta</th>
                                    <th>Hora llegada a obra</th>
                                    <th>Hora Programada</th>
                                    <th>Cumplimiento</th>
                                    <th>Hora inicio descargue</th>
                                    <th>Hora terminacion descargue</th>
                                    <th>Ciclo espera en obra</th>
                                    <th>Ciclo descargue</th>
                                    <th>Ciclo en obra</th>
                                    <th>Ciclo del Vije</th>
                               
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            <tfooter>
                                <tr>
                                    <th>N</th>
                                    <th>Codigo</th>
                                    <th>Obra</th>
                                    <th>Mixer</th>
                                    <th>Metros </th>
                                    <th>Conductor</th>
                                    <th>Hora Cargue</th>
                                    <th>Hora Salida Planta</th>
                                    <th>Hora llegada a obra</th>
                                    <th>Hora Programada</th>
                                    <th>Cumplimiento</th>

                                    <th>Hora inicio descargue</th>
                                    <th>Hora terminacion descargue</th>
                                    <th>Ciclo espera en obra</th>
                                    <th>Ciclo descargue</th>
                                    <th>Ciclo en obra</th>
                                    <th>Ciclo del Vije</th>
                                    
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

<?php include '../../../../layout/footer/footer4.php' ?>



<script>
    $(document).ready(function() {

        var n = 1;

        function datatable_viajes(ciudad, fecha) {
            var table = $('#t_remisiones').DataTable({
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "data_table_remisiones.php",
                    'data': {
                        'ciudad': ciudad,
                        'fecha': fecha,
                    },
                    'type': 'post',
                    "dataSrc": ""
                },
                "order": [
                    [0, 'desc']
                ],
                "columns": [

                    {
                        "data": "ct26_id_remision"
                    },
                    {
                        "data": "ct26_codigo_remi"
                    },
                    {
                        "data": "ct26_nombre_obra"
                    },
                    {
                        "data": "ct26_vehiculo"
                    },
                    {
                        "data": "ct26_metros"
                    },
                    {
                        "data": "ct26_nombre_conductor"
                    },
                    {
                        "data": "ct26_hora_remi"
                    },
                    {
                        "data": "ct26_hora_salida_planta"
                    },
                    {
                        "data": "ct26_hora_llegada_obra"
                    },
                    {
                        "data": "hora_programada"
                    },{
                        "data": "cumplimiento"
                    },
                    {
                        "data": "ct26_hora_inicio_descargue"
                    },
                    {
                        "data": "ct26_hora_terminada_descargue"
                    },
                   
                    {
                        "data": "ciclo_espera_obra"
                    },
                    {
                        "data": "ciclo_descargue"
                    },
                    {
                        "data": "ciclo_obra"
                    },
                    {
                        "data": "cicloviaje"
                    },

                ],
                'paging': false,
                'searching': false
                //"scrollX": true,
            });



           



        }


        $('#ciudad').on('change', function() {
                var ciudad = $('#ciudad').val();
                var fecha = $('#fecha').val();
                if ($.fn.dataTable.isDataTable('#t_remisiones')) {
                    table = $('#t_remisiones').DataTable();
                    table.destroy();
                }


                table = datatable_viajes(ciudad, fecha);
                setInterval(function() {
                    table.ajax.reload(null, false);
                }, 5000);

 
            });


            $('#fecha').on('change', function() {
                var ciudad = $('#ciudad').val();
                var fecha = $('#fecha').val();
                if ($.fn.dataTable.isDataTable('#t_remisiones')) {
                    table = $('#t_remisiones').DataTable();
                    table.destroy();
                }


                table = datatable_viajes(ciudad, fecha);
                setInterval(function() {
                    table.ajax.reload(null, false);
                }, 5000);


            });
    });
</script>

</body>

</html>