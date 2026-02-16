<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>

<?php
require '../../../include/get_datos.php';
require '../../../include/conexion.php';



$conexion_bd = new conexion();
$conexion_bd->connect();

// $get_datos = new get_datos();
$t29_batch = new t29_batch();
$t1_terceros = new t1_terceros(); 
$t4_productos = new t4_productos(); 
$t10_vehiculo = new t10_vehiculo(); 
$php_clases = new php_clases();

        $id  = $php_clases->HR_Crypt($_GET['id'], 2);

        $datos = $t29_batch->get_datos_batch($id);

        while($fila_batch = $datos->fetch(PDO::FETCH_ASSOC)){
        
            $Nit = $fila_batch['ct29_NIT'];
       // $codigo_remi = $fila_batch['ct29_Remision'];
      //  $fecha = $fila_batch['ct29_Fecha'];
      //  $hora = $fila_batch['ct29_Hora'];
     //  $cliente = $fila_batch['ct29_IdCliente'];
        // $mixer = $fila_batch['ct29_IdMixer'];
        // $obra = $fila_batch['ct29_IdObra'];
      //  $conductor = $fila_batch['ct29_MixerDriver'];
      //  $planta = $fila_batch['ct29_IdPlanta'];
      //  $sello = $fila_batch['ct29_NumeroSello'];
     //   $metrosC = $fila_batch['ct29_MetrosCubicos'];
        // $producto = $fila_batch['ct29_ElementoFundir'];
      //  $asentamiento = $fila_batch['ct29_Asentamiento'];
      //  $observacion = $fila_batch['ct29_OBSERVACIONES'];
      }



     ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>BATCH</h1>
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
                <h3 class="card-title">BATCH </h3>

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

                        <input type="hidden" name="id_batch" id="id_batch" value="<?php //echo $id ?>">


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Codigo</label>
                                    <input type="text" class="form-control" name="Txb_Codigo" id="Txb_Codigo"
                                        value="<?php //echo $codigo_remi ;?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Fecha</label>
                                    <input type="date" class="form-control" name="Txb_Fecha" id="Txb_Fecha"
                                        value="<?php // echo $fecha ;?>">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Hora</label>
                                    <input type="time" class="form-control" name="Txb_Hora" id="Txb_Hora"
                                        value="<?php //echo $hora ;?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Seleccione el cliente</label>
                                    <input type="hidden" name="id" id="id">
                                    <select class="form-control select2" id="Txb_Cliente" name="Txb_Cliente">
                                        <?php echo $option = $t1_terceros->cliente_batch($Nit); ?>

                                    </select>
                                    <?php var_dump($Nit) ?>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Seleccione la mixer</label>
                                    <select class="form-control select2" id="Txb_Mixer" name="Txb_Mixer" required>
                                        <?php //echo $t10_vehiculo->select_conductor(); ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Seleccione la obra</label>
                                    <select class="js-example-basic-single select2 form-control" id="Txb_Obra"
                                        name="Txb_Obra" required>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Seleccione el conductor</label>
                                    <!-- <select class="js-example-basic-single select2 form-control" id="Txb_Conductor" name="Txb_Conductor" required> -->
                                    <input type="text" class="form-control" name="Txb_Conductor" id="Txb_Conductor"
                                        placeholder="" value="<?php echo $conductor ;?>">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Planta</label>
                                    <input type="text" class="form-control" name="Txb_Planta" id="Txb_Planta"
                                        placeholder="Digite los M3" value="<?php echo $planta ;?>">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Sello de segurdad N°</label>
                                    <input type="text" class="form-control" name="Txb_Sello" id="Txb_Sello"
                                        placeholder="" value="<?php echo $sello ;?>">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Metros Cubicos</label>
                                    <input type="text" class="form-control" name="Txb_Metros" id="Txb_Metros"
                                        placeholder="Digite los M3" value="<?php echo $metrosC ;?>">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label>Producto</label>
                                    <select class="js-example-basic-single select2 form-control" id="Txb_Producto"
                                        name="Txb_Producto" required>
                                        <?php //echo $t4_productos->option_producto(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Asentamiento</label>
                                    <input type="text" class="form-control" name="Txb_Asentamiento"
                                        id="Txb_Asentamiento" placeholder="Digite el asentamiento"
                                        value="<?php echo $asentamiento ;?>">
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Observaciones</label>
                                    <input type="text" class="form-control" name="Txb_Observacion" id="Txb_Observacion"
                                        placeholder="Escriba las observaciones" value="<?php echo $observacion ;?>">
                                </div>
                            </div>
                        </div><br>

                        <div class="row">

                            <div class="col">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-block bg-gradient-orange" name="Registrar"
                                        value="Guardar" id="Guardar">
                                </div>
                            </div>

                            <div class="col">

                            </div>
                    </form>
                    <div class="form-group">
                        <a href="../export_pdf/index.php?id=<?php echo $id; ?>" class="btn btn-block bg-gradient-yellow"
                            name="Remision" id="Remision">Exportar Remision</a>
                    </div>
                </div>
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


<!-- <script>
    $(document).ready(function () {
        $('.select2').select2();

    });
    $(document).ready(function () {
        $('.tipoarchivo').change(function () {
            $('#imgfiles').attr("accept", $('input[name=subirtipo]:checked').val());
        });
    });
</script> -->
<script src="ajax_editar.js"></script>

<script>
$(document).ready(function() {

    $('#Txb_Cliente').on('change', function() {
        $.ajax({
            url: "get_data.php",
            type: "POST",
            data: {
                idCliente: ($('#Txb_Cliente').val()),
                task: "1",
            },
            success: function(response) {
                console.log(response.estado);
                $('#Txb_Obra').html(response.obras);
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    });
})
</script>
<!-- <script>
$(document).ready(function(){

    $('#Habilitar').click(function() {
    if (!$(this).is(':checked')) {

        $("#F_editar").prop('disabled', true);
    }else{
        $("#F_editar").prop('disabled', false);
    }
  });


}
);

</script>
 -->





</body>

</html>