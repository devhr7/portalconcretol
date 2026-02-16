<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>

<?php

$t26_remisiones = new t26_remisiones();
$t1_terceros = new t1_terceros();
$t10_vehiculo = new t10_vehiculo();
$php_clases = new php_clases();
$t5_obras = new t5_obras();
$t4_productos = new t4_productos();


$id_remision  = $php_clases->HR_Crypt($_GET['id'], 2);

$array_roles = array(1);
$permisos = $php_clases->permisos($rol_user, $array_roles);

$datos_remision = $t26_remisiones->get_remi_id($id_remision);

foreach ($datos_remision as $fila_remi) {

    $codigo_remi = $fila_remi['ct26_codigo_remi'];

    $id_cliente = $fila_remi['ct26_idcliente'];
    $razon_social = $fila_remi['ct26_razon_social'];

    $id_obra = $fila_remi['ct26_idObra'];
    $nombre_obra = $fila_remi['ct26_nombre_obra'];

    $id_mixer = $fila_remi['ct26_id_vehiculo'];
    $placa = $fila_remi['ct26_vehiculo'];

    $id_producto = $fila_remi['ct26_id_producto'];
    $productoF = $fila_remi['ct26_codigo_producto'] . " - " . $fila_remi['ct26_descripcion_producto'];

    $img_remi = $fila_remi['ct26_imagen_remi'];

    $id_conductor = $fila_remi['ct26_conductor'];
    $nombre_conductor = $fila_remi['ct26_nombre_conductor'];

    $remi_bomba = $fila_remi['ct26_bomba'];
    $op_bomba = $fila_remi['ct26_op_bomba'];
    $aux_bomba = $fila_remi['ct26_aux_bomba'];

    $observacionces = $fila_remi['ct26_observaciones_desp'];

    $tipo_hora_prog = $fila_remi['tipo_hora_prog'];

    $hora_programada = $fila_remi['hora_programada'];
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Sincronizacion de la remision <strong><?php echo $codigo_remi ?></strong></h1>
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
                <h3 class="card-title"><a href="../update/editar.php?id=<?php echo $id_remision; ?>"><i class="fas fa-pen-square"></i> </a>  Remision <strong><?php echo $codigo_remi ?></strong></h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="F_editar" id="F_editar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Cliente</label>
                                    <?php if (is_null($id_cliente)) : ?>
                                        <select class="js-example-basic-single select2  form-control " id="txt_cliente" name="txt_cliente" required>
                                            <?php echo $t1_terceros->option_cliente_edit($id_cliente); ?>
                                        </select>
                                    <?php else : ?>
                                        <input type="hidden" id="txt_cliente" name="txt_cliente" value="<?php echo $id_cliente ?>">
                                        <h3><?php echo $razon_social ?> </h3>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Obra</label>
                                    <?php if (is_null($id_obra)) : ?>
                                        <select class="js-example-basic-single select2 form-control" id="C_Obras" name="C_Obras" required="required">
                                            <?php echo $t5_obras->option_obra($id_cliente, $id_obra); ?>

                                        </select>
                                    <?php else : ?>
                                        <input type="hidden" id="C_Obras" name="C_Obras" value="<?php echo $id_obra ?>">

                                        <h3><?php echo $nombre_obra ?> </h3>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Mixer</label>
                                    <?php if (is_null($id_mixer)) : ?>
                                        <select class="js-example-basic-single select2  form-control " id="txt_mixer" name="txt_mixer" required="true">
                                            <?php echo $t10_vehiculo->select_mixer_edit(); ?>
                                        </select>
                                    <?php else : ?>
                                        <input type="hidden" id="txt_mixer" name="txt_mixer" value="<?php echo $id_mixer ?>">
                                        <h3><?php echo $placa ?></h3>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Conductor</label>
                                    <?php if (is_null($id_conductor)) : ?>
                                        <select class="js-example-basic-single select2 form-control" id="C_id_conductor" name="C_id_conductor" required="required">
                                            <?php echo $t1_terceros->select_conductor_remi($id_conductor); ?>
                                        </select>
                                    <?php else : ?>
                                        <input type="hidden" id="C_id_conductor" name="C_id_conductor" value="<?php echo $id_conductor ?>">
                                        <h3><?php echo $nombre_conductor; ?></h3>
                                    <?php endif ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>HORA PROGRAMADA</label>

                                   
                                        <select class="js-example-basic-single select2 form-control" id="select_hora_programada" name="select_hora_programada" required="required">
                                            
                                            <?php  echo $t26_remisiones->select_hora_programada($id_remision); ?>
                      
                                        </select>
                                        
                                        
                                        
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-gruop">
                                    <label>HORA PROGRAMADA</label>
                                        <br>
                                        <input type="time" id="hora_programada" name="hora_programada" value="<?php echo $hora_programada ?>">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Producto</label>
                                    <?php if (is_null($id_producto)) : ?>
                                        <select class="js-example-basic-single select2  form-control " id="C_IdProductos" name="C_IdProductos" required>
                                            <?php echo $t4_productos->option_producto_edit($id_producto); ?>
                                        </select>
                                    <?php else : ?>
                                        <input type="hidden" id="C_IdProductos" name="C_IdProductos" value="<?php echo $id_producto ?>">
                                        <h3><?php echo $productoF ?></h3>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Observaciones</label>
                                    <input type="text" class="form-control" id="txt_observaciones" name="txt_observaciones" value="<?php echo $observacionces ?>" />
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="select_servicio_bomba">Servicio de Bomba</label>
                                    <select class="form-control select2" name="select_servicio_bomba" id="select_servicio_bomba">
                                        <option value="NA" selected="selected">No tiene servicio bombeo</option>
                                        <option value="BOMBA1">Bomba 1</option>
                                        <option value="BOMBA2">Bomba 2</option>
                                        <option value="BOMBA3">Bomba 3</option>
                                        <option value="BOMBA4">Bomba 4</option>
                                        <option value="BOMBA5">Bomba 5</option>
                                        <option value="BOMBA6">Bomba 6</option>
                                        <option value="BOMBA7">Bomba 7</option>
                                        <option value="BOMBA8">Bomba 8</option>
                                        <option value="BOMBA9">Bomba 9</option>
                                        <option value="AUTOBOMBA">AUTOBOMBA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                <label for="select_op_bomba" >Seleccionar Operario de bomba</label>
                                <select name="select_op_bomba" id="select_op_bomba" class="form-control select2">

                                    
                                </select>
                                </div>
                                
                            </div>

                            <div class="col-4">
                            <div class="form-group">

                                <label for="select_aux_bomba">Seleccionar auxiliar de bomba</label>
                                <select name="select_aux_bomba" id="select_aux_bomba" class="form-control select2 ">
                                   
                                </select>

                            </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                        <div class="col-md-2">
                                <div class="form-group">
                                    <a href="../ver_remision/remision.php?id=<?php echo $php_clases->HR_Crypt($id_remision, 1);  ?>" class="btn btn-block btn-info" target="_blank"> <i class="fas fa-eye"></i> Vista Previa</a>
                                </div>
                            </div>
                            <div class="col-7"></div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-block bg-gradient-success" name="Actualizar" value="Sincronizar Remision" id="Guardar">
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
    $(document).ready(function() {
        $('.tipoarchivo').change(function() {
            $('#imgfiles').attr("accept", $('input[name=subirtipo]:checked').val());
        });
    });
</script>
<script src="ajax_editar.js"></script>
<script>
    $(document).ready(function() {
        
        $.ajax({
                url: "get_data.php",
                type: "POST",
                data: {                   
                    task: 2,
                    id_op_bomba : ($('#select_op_bomba').val()),
                    id_aux_bomba : ($('#select_aux_bomba').val()),
                },
                success: function(response) {
                  
                    $('#select_op_bomba').html(response.op_bomba);
                    $('#select_aux_bomba').html(response.aux_bomba);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        

        $("#btn-eliminar").click(function() {

            var id_remi = "<?php echo $_GET['id'] ?>";
            var url = "../index.php";
            $.ajax({
                url: "php_eliminar.php",
                type: "POST",
                data: {
                    id_remi: id_remi,

                },
                success: function(response) {
                    console.log(response.estado);
                    window.window.location = url;
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                    window.window.location = url;
                },

            });
        });

        $('#txt_cliente').on('change', function() {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data: {
                    idCliente: ($('#txt_cliente').val()),
                    task: "1",
                },
                success: function(response) {
                    console.log(response.estado);
                    $('#C_Obras').html(response.obras);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
        //////////////////////////////////
        

        //////////////////////////////
    })
</script>

<script>
    $(document).ready(function() {

        $('#check_habilitar').click(function() {
            if (!$(this).is(':checked')) {

                $("#imgfiles").prop('disabled', true);
            } else {
                $("#imgfiles").prop('disabled', false);
            }
        });


    })
</script>






</body>

</html>