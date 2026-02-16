<?php include '../../layout/validar_session2.php' ?>

<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; 

$cls_requisiciones = new cls_requisiciones();


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Modulos de Requisiciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active"><a href="#">Inicio</a></li>
                        <!--<li class="breadcrumb-item active">Legacy User Menu</li> -->
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> Explorar Requisiciones</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <div class="form-group">
                            <button type="button" class="form-control btn-success" data-toggle="modal" data-target="#modal_crear_requisicion">Crear Requisicion</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <label for="">Codigo Requisiciones</label>
                        <input type="text" name="txt_cod_requisiciones" id="txt_cod_requisiciones" class="form-control" value="">
                    </div>
                    <div class="col">
                        <label>Area Solicitante</label>
                        <select name="txt_area_solicitante" id="txt_area_solicitante" class="form-control select2" value="">
                            <?php echo $cls_requisiciones->option_areas(); ?>
                        </select>
                    </div>
                    <div class="col">
                        <label>fecha</label>
                        <input type="date" name="txt_fecha_solicitante" id="txt_fecha_solicitante" class="form-control" value="">
                    </div>
                    <div class="col">
                        <label for="">Estatus</label>
                        <select id="txt_estatus" class="form-control select2">
                            <option value="" selected >Seleccione Estado</option>
                            <option value="1">Abierto</option>
                            <option value="2">Cerrado</option>
                        </select>
                    </div>
                    <div class="col">
                        <button type="button" id="btn_buscador" class="form-control btn-info">Buscar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table id="tabla_requisiciones">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Cod_Requisiciones</th>
                                    <th>Estatus</th>
                                    <th>Fecha Solicitante</th>
                                    <th>Area Solicitante</th>
                                    <th>Responsable</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                        </table>
                    </div>

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


<!-- MODALES -->
<div class="modal fade" id="modal_crear_requisicion">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Desea Crear La Requisicion</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form name="form_crear_requisicion" id="form_crear_requisicion" method="post">
                <div class="row">
                    
                    <div class="col">
                        <div class="form-group">
                            <label for="">Area solicitante</label>
                            <select name="txt_area" id="txt_area" class="form-control"  required="true">
                                <?php echo $cls_requisiciones->option_areas(); ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <button type="submit" class="btn btn-success">Crear Requisiciones</button>
                    </div>
                </div>
              </form>
            </div>
            <div class="modal-footer justify-content-between">
              
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

<!------->
<?php include '../../layout/footer/footer2.php' ?>

<script>


$(document).ready(function (e) {
        $("#form_crear_requisicion").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_requi.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    console.log(data.estado);
                    if(data.estado){
                        toastr.success('exitoso');
                    
                        window.location = "update/editar.php?id=" + data.id_requi+'&cod=121212';
                        
                    }else{
                        toastr.warning(data.errores);               
                    }
                },
                error: function (respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });
    $(document).ready(function() {
        var n = 1;
        // Declarar funcion destruir tabla
        function destruir_tabla() {
            var table = $('#tabla_requisiciones').DataTable({});
            table.destroy();
        }

        function datatable_requisiciones(cod_requisiciones, fecha_solicitante, area_solicitante,estatus) {
            var table = $('#tabla_requisiciones').DataTable({
                "paging": "false",
                "searching": "false",
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "data_table_requisicion.php",
                    'data': {
                        
                        'cod_requisiciones': cod_requisiciones,
                        'fecha_solicitante': fecha_solicitante,
                        'area_solicitante': area_solicitante,
                        'estatus':estatus
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
                        "data":"id"
                    },
                    {
                        "data":"status"
                    },
                    {
                        "data": "fecha_solicitud"
                    },
                    {
                        "data": "Area_Solicitante"
                    },
                    {
                        "data": "responsable"    
                    },
                   
                  
                    {
                        "data": null,
                "defaultContent": "<button class='btn btn-warning btn-sm'> <i class='fas fa-eye'></i> </button>"
                    }
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
//
           
            var cod_requisiciones = "";
            var fecha_solicitante = "";
            var area_solicitante = "";
            var estatus = "";


            if ($.fn.dataTable.isDataTable('#tabla_requisiciones')) {
                table = $('#tabla_requisiciones').datatable_requisiciones();
                table.destroy();
            }
            table = datatable_requisiciones(cod_requisiciones, fecha_solicitante, area_solicitante,estatus);
            setInterval(function() {
                table.ajax.reload(null, false);
            }, 5000);

            $('#tabla_requisiciones tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];

            window.location = "update/editar.php?id=" + id;
        });





        $("#btn_buscador").click(function(){
            var cod_requisiciones = $("#txt_cod_requisiciones").val();
            var fecha_solicitante = $('#txt_fecha_solicitante').val();
            var area_solicitante = $("#txt_area_solicitante").val();
            var estatus = $("#txt_estatus").val();
            if ($.fn.dataTable.isDataTable('#tabla_requisiciones')) {
                table = $('#tabla_requisiciones').DataTable();
                table.destroy();
            }
            table = datatable_requisiciones(cod_requisiciones, fecha_solicitante, area_solicitante,estatus);
            setInterval(function() {
                table.ajax.reload(null, false);
            }, 5000);
        });
    
    });
</script>



</body>

</html>