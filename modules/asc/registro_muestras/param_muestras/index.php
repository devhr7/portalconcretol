<?php include '../../../../layout/validar_session4.php' ?>

<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

$cls_laboratorio = new cls_laboratorio();
$cls_productos = new t4_productos();


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REGISTRO DE TOMA DE MUESTRAS ENSAYO A COMPRESIÓN O FLEXIÓN</h1>
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
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title"> PARAMETRIZAR EDADES DE PRODUCTOS </h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-block btn-success" data-toggle="modal" data-target="#modal_registrar_param"><i class="fas fa-mountain"></i>Crear</button>
                </div>
            </div>
            <div class="card-body">
                <!--- BUSCADOR   --->
                <div class="row">
                    <div class="col">
                        <select name="txt_buscar_producto" id="txt_buscar_producto" class="select2 form-control">
                            <?php echo $cls_laboratorio->option_producto_edit_buscador(); ?>

                        </select>
                    </div>
                    <div class="col">
                        <button type="button" id="btn_buscar_producto" class="btn btn-secondary form-control">Buscar</button>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <table id="tabla_parametrizar_edades_productos">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Codigo Producto</th>
                                    <th>Descripcion Producto</th>
                                    <th>Edades</th>
                                    <th>Cilindros</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <!------ RENDIMIENTO VOLUMETRICO --->
            <div class="modal fade" id="modal_registrar_param">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">

                        <div class="modal-header">
                            <h4 class="modal-title">Crear Edad Producto</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="form_registrar_param_edad" id="form_registrar_param_edad" method="post">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Producto</label>
                                            <select name="txt_producto" id="txt_producto" class="select2 form-control" style="width:100%">
                                                <?php echo $cls_productos->option_producto_edit(); ?>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Edad</label>
                                            <br>
                                            <select name="txt_periodo_fallo" id="txt_periodo_fallo" value="" class="form-control select2" style="width:100%" required>
                                                <<?php echo $cls_laboratorio->option_periodos(); ?> </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Numero de Cilindros</label>
                                            <input type="text" name="txt_numcilindros" id="txt_numcilindros" class="form-control">
                                        </div>
                                    </div>


                                </div>

                                <div class="row">


                                    <div class="col">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success form-control" id="btn_guardar"> Guardar</button>
                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>

            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!-- MODALES -->


<!------->
<?php include '../../../../layout/footer/footer4.php' ?>

<script>
    /** TABLA REMISIONES */
    $(document).ready(function() {
        var n = 1;
        // Declarar funcion destruir tabla

        //*** TALA PARAM PRODUCTO */
        function datatable_param_producto(id_producto) {
            var table_param_producto = $('#tabla_parametrizar_edades_productos').DataTable({
                "paging": "true",
                "searching": "false",
                "processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_param_muestras.php",
                    'data': {
                        'id_producto': id_producto
                    },
                    'type': 'post',
                    "dataSrc": ""
                },

                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "codigo_producto"
                    },
                    {
                        "data": "descripcion_producto"
                    },
                    {
                        "data": "nombre_periodo"
                    },
                    {
                        "data": "num_fallos"
                    },
                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-danger btn-sm btn_delete'> <i class='fas fa-trash-alt'></i> </button>"
                    }

                ],

                //"scrollX": true,
            });
            table_param_producto.ajax.reload();
            return table_param_producto;
        }



        $('#tabla_parametrizar_edades_productos tbody').on('click', 'button.btn_delete', function() {
            var data = table_param_producto.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: 'Esta seguro de eliminar',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si eliminar',
                cancelButtonText: 'No, cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "php_eliminar_param_muestra.php",
                        type: "POST",
                        data: {
                            'id': data['id']
                        },
                        success: function(data) {
            table_param_producto.ajax.reload();
            toastr.success('exitoso');

                            
                            result.dismiss === Swal.DismissReason.cancel
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });

                } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                ) {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                    )
                }
            })
        });







        /** FORMULARIO CREAR MUESTRA */

        $('.select2').select2();



        $("#form_registrar_param_edad").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_param_muestra.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data.estado);
                    if (data.estado) {
                        toastr.success('exitoso');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));


        $("#btn_buscar_producto").click(function() {
            var id_producto = $("#txt_buscar_producto").val();
            console.log("id_producto :"+id_producto)
            if ($.fn.dataTable.isDataTable('#tabla_parametrizar_edades_productos')) {
                table_param_producto = $('#tabla_parametrizar_edades_productos').DataTable().destroy();
            }
            table_param_producto = datatable_param_producto(id_producto);
           
        });

        var id_producto = $("#txt_buscar_producto").val();
        if ($.fn.dataTable.isDataTable('#tabla_parametrizar_edades_productos')) {
            table_param_producto = $('#tabla_parametrizar_edades_productos').DataTable();
            table_param_producto.destroy();
        }
        table_param_producto = datatable_param_producto(id_producto);
      
        
    });
</script>



</body>

</html>