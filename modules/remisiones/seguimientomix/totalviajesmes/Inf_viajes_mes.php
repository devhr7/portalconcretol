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
                    <h1>VIAJES</h1>
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
                        <select class="form-control select2" name="ciudad" id="ciudad" >
                            <option value="0" selected>Seleccione</option>
                            <option value="HONDA">HONDA</option>
                            <option value="IBAGUE">IBAGUE</option>
                        </select>
                    </div>
                    <div class="col-2">
                        <label>MES</label>
                        <select class="form-control select2" name="mes" id="mes" >
                            <option value="0" selected>Seleccione</option>
                            <option value="01">ENERO</option>
                            <option value="02">FEBRERO</option>
                            <option value="03">MARZO</option>
                            <option value="04">ABRIL</option>
                            <option value="05">MAYO</option>
                            <option value="06">JUNIO</option>
                            <option value="07">JULIO</option>
                            <option value="08">AGOSTO</option>
                            <option value="09">SEPTIEMBRE</option>
                            <option value="10">OCTUBRE</option>
                            <option value="11">NOVIEMBRE</option>
                            <option value="12">DICIEMBRE</option>
                    
                        </select>
                    </div>
                    <div class="col-3">
                        <h2>Total de Viajes</h2>
                        <span id="hviajes"></span>
                    </div>
                    <div class="col-3">
                    <h2>Total Metro Cubicos</h2>

                        <span id="hmetros"></span>
                    </div>
                    <div class="col">
                    <h2>METROS / VIAJES</h2>

                        <span id="hmetrosviajes"></span>
                    </div>
                    
                </div>
                <BR>

                <div id="contenido">
                    <table id="tviajes" class="display" style="width:100%">
                        <thead>
                            <tr>
                            <th>N</th>

                                <th>Fecha</th>
                                <th>N Viajes</th>
                                <th>N Vehiculos</th>
                                <th>Metros </th>
                                <th>M3/Viajes </th>
                                <th>Viajes/Vehiculos  </th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfooter>
                            <tr>
                            <th>N</th>
                            <th>Fecha</th>
                                <th>N Viajes</th>
                                <th>N Vehiculos</th>
                                <th>Metros </th>
                                <th>M3/Viajes </th>
                                <th>Viajes/Vehiculos </th>
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

        function datatable_viajes(ciudad, mes) {
            var table = $('#tviajes').DataTable({
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "data_table_viajes_mes.php",
                    'data': {
                        'ciudad': ciudad,
                        'mes': mes,
                    },
                    'type': 'post',
                    "dataSrc": ""
                },
                "order": [
                    [0, 'desc']
                ],
                "columns": [
                    {
                        "data": "fecha_mes"
                    },
                    {
                        "data": "fecha_mes"
                    },
                    
                    {
                        "data": "viajes"
                    },
                    {
                        "data": "vehiculos"
                    },
                    {
                        "data": "metros"
                    },
                    {
                        "data": "m3_viajes"
                    },
                    {
                        "data": "viajes_vehi"
                    },
                ],
                'paging': false,
                'searching': false
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
        $('#ciudad').on('change', function() {
            var ciudad = $('#ciudad').val();
            var mes = $('#mes').val();
            if ($.fn.dataTable.isDataTable('#tviajes')) {
                table = $('#tviajes').DataTable();
                table.destroy();
            }


            table = datatable_viajes(ciudad, mes);
            setInterval(function() {
                table.ajax.reload(null, false);
            }, 5000);


             // 
             $.ajax({
            url: "data_table_totalviajes_mes.php",
            type: "POST",
            data: {
                'mes': $('#mes').val(),
                'ciudad': $('#ciudad').val()
            },
            success: function(data) {
                
                console.log(data.viajes);
                document.getElementById("hviajes").innerHTML="<h3>"+  data.viajes +"</h3>";
                document.getElementById("hmetros").innerHTML="<h3>"+  data.metros +"</h3>";
                document.getElementById("hmetrosviajes").innerHTML="<h3>"+  data.tmetrosviajes +"</h3>";
                document.getElementById("vehiculosviajes").innerHTML="<h3>"+  data.tmetrosviajes +"</h3>";


                
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },

            });
            

        });

        $('#mes').on('change', function() {
            var ciudad = $('#ciudad').val();
            var mes = $('#mes').val();
            if ($.fn.dataTable.isDataTable('#tviajes')) {
                table = $('#tviajes').DataTable();
                table.destroy();
            }
            table = datatable_viajes(ciudad, mes);
            setInterval(function() {
                table.ajax.reload(null, false);
            }, 5000);



            // 
            $.ajax({
            url: "data_table_totalviajes_mes.php",
            type: "POST",
            data: {
                'mes': $('#mes').val(),
                'ciudad': $('#ciudad').val()
            },
            success: function(data) {
                
                console.log(data.viajes);
                document.getElementById("hviajes").innerHTML="<h3>"+  data.viajes +"</h3>";
                document.getElementById("hmetros").innerHTML="<h3>"+  data.metros +"</h3>";
                document.getElementById("hmetrosviajes").innerHTML="<h3>"+  data.tmetrosviajes +"</h3>";


                
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },

            });
        });


    });
</script>

</body>

</html>