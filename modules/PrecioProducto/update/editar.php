<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>




<?php 

$t1_terceros = new t1_terceros(); 
$php_clases = new php_clases();
$t6_precio_producto = new t6_precio_producto();
$t5_obras = new t5_obras();
$t4_productos = new t4_productos();



$id = $php_clases->HR_Crypt($_GET['id'],2);


$datos_precios = $t6_precio_producto->select_precio_producto_id($id);


while($fila_t6 = $datos_precios->fetch(PDO::FETCH_ASSOC)){
    $id_cliente = $fila_t6['ct6_IdTercero'];
    $id_obra = $fila_t6['ct6_IdObras'];
    $id_producto = $fila_t6['ct6_IdProducto'];

    $precio = $fila_t6['ct6_Precio'];



}
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Precio Producto</h1>
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
                <h3 class="card-title">Editar</h3>

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
                    <form name="F_editar" id="F_editar" method="POST">
                        <input type="hidden" name="id_precio" id="id_precio" value="<?php echo $id; ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Seleccione Cliente </label>
                                    <select class="form-control select2 " style="width: 100%;" id="Txb_IdTercero"
                                        name="Txb_IdTercero" aria-hidden="true">
                                        <?php echo  $option_cliente  = $t1_terceros->option_cliente_edit($id_cliente);
?>
                                    </select>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Seleccione la Obra </label>
                                    <select class="form-control select2 " style="width: 100%;" id="Txb_IdObras"
                                        name="Txb_IdObras" aria-hidden="true">
                                        <?php

echo $t5_obras->option_obra_edit($id_cliente, $id_obra);
?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <label> Seleccione el producto </label>
                                <select class="form-control select2 " style="width: 100%;" id="Txb_IdProducto"
                                    name="Txb_IdProducto" data-select2-id="" tabindex="-1" aria-hidden="true">
                                    <?php 

                                        echo $t4_productos->option_producto_edit($id_producto);

                                        ?>
                                </select>
                                <!-- <select class="form-control select2 " style="width: 100%;" id="Txb_IdProducto" name="Txb_IdProducto" data-select2-id="" tabindex="-1" aria-hidden="true"> </select> -->
                            </div>


                        </div><br>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label> Precio ($) </label>
                                    <input class="form-control" type="text" name="Txb_Precio" id="Txb_Precio"
                                        value="<?php echo $precio; ?>" placeholder="">
                                </div>
                            </div>
                        </div><br>




                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
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
$(document).ready(function() {
    $('.select2').select2();

});
</script>
<script>
$(function() {

    $(document).ready(function(e) {


        $('#Txb_IdTercero').on('change', function() {
            $.ajax({
                url: "getdatos.php",
                type: "POST",
                data: {
                    id_cliente: ($('#Txb_IdTercero').val()),
                    tipo: "Get_Obra",
                    task: 2,
                },
                success: function(response) {

                    if (response.estado) {
                        $('#Txb_IdObras').html(response.Obra);
                        //$('#CupoObra').html(response.cupclient);
                    } else {
                        //alert("Error al cargar terceros.");
                        console.log(response.msg);
                    }
                },
                error: function(respuesta) {

                    alert(JSON.stringify(respuesta));

                }
            });

        });

    });
});
</script>
<script src="ajax_editar.js"></script>


</body>

</html>