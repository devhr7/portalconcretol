<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>

<?php
$t4_productos = new t4_productos();
$php_clases = new php_clases();

$id_producto = $php_clases->HR_Crypt($_GET['id'], 2);
// $id_producto = $_GET['id'];

$datos_producto = $t4_productos->get_productos_for_id($id_producto);

foreach ($datos_producto as $key) {
    $id_tipo_concreto = $key['ct4_TipoConcreto'];
    $id_resistencia_concre = $key['ct4_Resistencia'];
    $id_tamano_agregado = $key['ct4_TamanoMAgregado'];
    $id_caract_concre = $key['ct4_CaracteristicaConcreto'];
    $id_color_concre = $key['ct4_Color'];
    $nombre_producto = $key['ct4_Nombre'];
    $descripcion_producto = $key['ct4_Descripcion'];

}

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PRODUCTOS</h1>
                   
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
                <h3 class="card-title">Editar Producto</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form method="POST" name="FormEditarProducto" id="FormEditarProducto">
                        <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $id_producto ?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Tipo de Concreto </label>
                                    <select class="form-control select2 select2-orange" id="Txb_TipoConcreto" name="Txb_TipoConcreto" data-dropdown-css-class="select2-orange" style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Resistencia de Concreto </label>
                                    <select class="form-control select2 select2-orange" id="Txb_ResistenciaConcreto" name="Txb_ResistenciaConcreto" data-dropdown-css-class="select2-orange" style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Tamaño Maximo Agregado </label>
                                    <select class="form-control select2 select2-orange" id="Txb_TMAgregado" name="Txb_TMAgregado" data-dropdown-css-class="select2-orange" style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label> Caracteristica del Concreto </label>
                                    <select class="form-control select2 select2-orange" id="Txb_CrtConcreto" name="Txb_CrtConcreto" data-dropdown-css-class="select2-orange" style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label> Color del Concreto </label>
                                    <select class="form-control select2 select2-orange" id="Txb_ColorConcreto" name="Txb_ColorConcreto" data-dropdown-css-class="select2-orange" style="width: 100%;">

                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="info-box mb-3 bg-info">
                                    <span class="info-box-icon"><i class="far fa-comment"></i></span>

                                    <div class="info-box-content text-center">
                                        <span class="info-box-text" id="CodigoConcreto"><?php print_r($nombre_producto); ?> </span>
                                        <input class="form-control" type="hidden" name="Txb_Nombre" id="Txb_Nombre" placeholder="" value="<?php echo $nombre_producto ?>">
                                        <span class="info-box-number" id="DescripcionConcreto"> <?php print_r($descripcion_producto); ?> </span>
                                        <input class="form-control" type="hidden" name="Txb_Descripcion" id="Txb_Descripcion" placeholder="" value="<?php echo $descripcion_producto ?>">
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row" style="text-align:center">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="button" id="btn-eliminar" name="btn-eliminar" class="btn btn-block btn-danger">Eliminar</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
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

<?php include '../../../layout/footer/footer3.php' ?>


<script>
    $(function() {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
        });

        //Initialize Select2 Elements
        $('.select2').select2()


    });
</script>


<script>
    $(function() {
        $(document).ready(function(e) {
            /**********************************************************************************************************************************/
            // LISTA CLIENTE      - cheke  
            /**********************************************************************************************************************************/
            $.ajax({
                url: "get_datosConcreto.php",
                type: "POST",
                data: {

                    tipo: "Get_DatosConcreto",
                    task: "1",

                    id_tipo_concreto: "<?php echo  $id_tipo_concreto; ?>",
                    id_resistencia_concre: "<?php echo  $id_resistencia_concre; ?>",
                    id_tamano_agregado: "<?php echo  $id_tamano_agregado; ?>",
                    id_caract_concre: "<?php echo  $id_caract_concre; ?>",
                    id_color_concre: "<?php echo  $id_color_concre; ?>",

                },
                success: function(response) {

                    if (response.estado) {
                        $('#Txb_TipoConcreto').html(response.TipoConcreto);
                        $('#Txb_ResistenciaConcreto').html(response.Resistencia);
                        $('#Txb_TMAgregado').html(response.TamanoAgregado);
                        $('#Txb_CrtConcreto').html(response.CaracteristicaConcreto);
                        $('#Txb_ColorConcreto').html(response.ColorConcreto);
                    } else {
                        console.log(response.msg);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                }
            });
            ////////////////////////////////////////////////////
            $('#Txb_TipoConcreto').on('change', function() {
                $('#CodigoConcreto').html("");
                $('#DescripcionConcreto').html("");
                $.ajax({
                    url: "GetDatos.php",
                    type: "POST",
                    data: {
                        Txb_TipoConcreto: ($('#Txb_TipoConcreto').val()),
                        Txb_ResistenciaConcreto: ($('#Txb_ResistenciaConcreto').val()),
                        Txb_TMAgregado: ($('#Txb_TMAgregado').val()),
                        Txb_CrtConcreto: ($('#Txb_CrtConcreto').val()),
                        Txb_ColorConcreto: ($('#Txb_ColorConcreto').val()),

                        tipo: "Get_Datos1",
                        task: "2",
                    },
                    success: function(response) {

                        $('#Txb_CodigoSyscafe').html(response.CodigoF);
                        $('#CodigoConcreto').html(response.CodigoF);
                        $('#DescripcionConcreto').html(response.DescpF);
                        $('#Txb_Nombre').val(response.CodigoF);
                        $('#Txb_Descripcion').val(response.DescpF);
                    },
                    error: function(respuesta) {

                        alert(JSON.stringify(respuesta));

                    }
                });
            });
            ///////////////////////////////////////////////////
            ////////////////////////////////////////////////////
            $('#Txb_ResistenciaConcreto').on('change', function() {
                $('#CodigoConcreto').html("");
                $('#DescripcionConcreto').html("");
                $.ajax({
                    url: "GetDatos.php",
                    type: "POST",
                    data: {
                        id_tipo_concreto: "<?php echo  $id_tipo_concreto; ?>",
                        id_resistencia_concre: "<?php echo  $id_resistencia_concre; ?>",
                        id_tamano_agregado: "<?php echo  $id_tamano_agregado; ?>",
                        id_caract_concre: "<?php echo  $id_caract_concre; ?>",
                        id_color_concre: "<?php echo  $id_color_concre; ?>",

                        Txb_TipoConcreto: ($('#Txb_TipoConcreto').val()),
                        Txb_ResistenciaConcreto: ($('#Txb_ResistenciaConcreto').val()),
                        Txb_TMAgregado: ($('#Txb_TMAgregado').val()),
                        Txb_CrtConcreto: ($('#Txb_CrtConcreto').val()),
                        Txb_ColorConcreto: ($('#Txb_ColorConcreto').val()),
                        tipo: "Get_Datos1",
                        task: "2",
                    },
                    success: function(response) {


                        $('#CodigoConcreto').html(response.CodigoF);
                        $('#DescripcionConcreto').html(response.DescpF);
                        $('#Txb_Nombre').val(response.CodigoF);
                        $('#Txb_Descripcion').val(response.DescpF);
                    },
                    error: function(respuesta) {

                        alert(JSON.stringify(respuesta));

                    }
                });
            });
            ///////////////////////////////////////////////////
            ////////////////////////////////////////////////////
            $('#Txb_TMAgregado').on('change', function() {
                $.ajax({
                    url: "GetDatos.php",
                    type: "POST",
                    data: {
                        id_tipo_concreto: "<?php echo  $id_tipo_concreto; ?>",
                        id_resistencia_concre: "<?php echo  $id_resistencia_concre; ?>",
                        id_tamano_agregado: "<?php echo  $id_tamano_agregado; ?>",
                        id_caract_concre: "<?php echo  $id_caract_concre; ?>",
                        id_color_concre: "<?php echo  $id_color_concre; ?>",

                        Txb_TipoConcreto: ($('#Txb_TipoConcreto').val()),
                        Txb_ResistenciaConcreto: ($('#Txb_ResistenciaConcreto').val()),
                        Txb_TMAgregado: ($('#Txb_TMAgregado').val()),
                        Txb_CrtConcreto: ($('#Txb_CrtConcreto').val()),
                        Txb_ColorConcreto: ($('#Txb_ColorConcreto').val()),
                        tipo: "Get_Datos1",
                        task: "2",
                    },
                    success: function(response) {

                        $('#CodigoConcreto').html(response.CodigoF);
                        $('#DescripcionConcreto').html(response.DescpF);
                        $('#Txb_Nombre').val(response.CodigoF);
                        $('#Txb_Descripcion').val(response.DescpF);

                    },
                    error: function(respuesta) {

                        alert(JSON.stringify(respuesta));

                    }
                });
            });
            ///////////////////////////////////////////////////
            ////////////////////////////////////////////////////
            $('#Txb_CrtConcreto').on('change', function() {
                $.ajax({
                    url: "GetDatos.php",
                    type: "POST",
                    data: {
                        id_tipo_concreto: "<?php echo  $id_tipo_concreto; ?>",
                        id_resistencia_concre: "<?php echo  $id_resistencia_concre; ?>",
                        id_tamano_agregado: "<?php echo  $id_tamano_agregado; ?>",
                        id_caract_concre: "<?php echo  $id_caract_concre; ?>",
                        id_color_concre: "<?php echo  $id_color_concre; ?>",

                        Txb_TipoConcreto: ($('#Txb_TipoConcreto').val()),
                        Txb_ResistenciaConcreto: ($('#Txb_ResistenciaConcreto').val()),
                        Txb_TMAgregado: ($('#Txb_TMAgregado').val()),
                        Txb_CrtConcreto: ($('#Txb_CrtConcreto').val()),
                        Txb_ColorConcreto: ($('#Txb_ColorConcreto').val()),
                        tipo: "Get_Datos1",
                        task: "2",
                    },
                    success: function(response) {

                        $('#CodigoConcreto').html(response.CodigoF);
                        $('#DescripcionConcreto').html(response.DescpF);
                        $('#Txb_Nombre').val(response.CodigoF);
                        $('#Txb_Descripcion').val(response.DescpF);
                    },
                    error: function(respuesta) {

                        alert(JSON.stringify(respuesta));

                    }
                });
            }); ////////////////////////////////////////////////////
            $('#Txb_ColorConcreto').on('change', function() {
                $.ajax({
                    url: "GetDatos.php",
                    type: "POST",
                    data: {
                        id_tipo_concreto: "<?php echo  $id_tipo_concreto; ?>",
                        id_resistencia_concre: "<?php echo  $id_resistencia_concre; ?>",
                        id_tamano_agregado: "<?php echo  $id_tamano_agregado; ?>",
                        id_caract_concre: "<?php echo  $id_caract_concre; ?>",
                        id_color_concre: "<?php echo  $id_color_concre; ?>",

                        Txb_TipoConcreto: ($('#Txb_TipoConcreto').val()),
                        Txb_ResistenciaConcreto: ($('#Txb_ResistenciaConcreto').val()),
                        Txb_TMAgregado: ($('#Txb_TMAgregado').val()),
                        Txb_CrtConcreto: ($('#Txb_CrtConcreto').val()),
                        Txb_ColorConcreto: ($('#Txb_ColorConcreto').val()),
                        tipo: "Get_Datos1",
                        task: "2",
                    },
                    success: function(response) {

                        $('#CodigoConcreto').html(response.CodigoF);
                        $('#DescripcionConcreto').html(response.DescpF);
                        $('#Txb_Nombre').val(response.CodigoF);
                        $('#Txb_Descripcion').val(response.DescpF);
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                    }
                });
            });

        });
        $("#FormEditarProducto").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_editar.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
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
        $("#btn-eliminar").click(function() {
            // definimos variable id para poder eliminar
            var id = <?php echo $id_producto ?>;
            Swal.fire({
                title: 'Esta Seguro(a) de Eliminar el tipo de concreto', // mensaje de la alerta
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No', // text boton
                confirmButtonText: 'Si Eliminar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "php_eliminar.php",
                        type: "POST",
                        data: {
                            task: 1,
                            id: id,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'El tipo de concreto fue eliminada correctamente',
                                    'success'
                                )
                                window.location = '../index.php'
                            } else {
                                console.log("error");

                            }
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });
                }
            })
        });
    });
</script>
<script src="ajax_editar.js"> </script>

</body>

</html>