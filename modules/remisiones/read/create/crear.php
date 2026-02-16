<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php
require '../../../include/get_datos.php';
require '../../../include/conexion.php';
 
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


 //$conexion_bd = new conexion();
 //$conexion_bd->connect();

$get_datos = new get_datos();

$t10_vehiculo = new t10_vehiculo();
$t1_terceros = new t1_terceros();
$php_clases = new php_clases();
     ?>  

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Subir Remisiones</h1>
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
                            <h3 class="card-title">Crear Remisiones</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                            </div>
                        </div>
                        <div class="card-body">
                            <div id="contenido">
                                <form name="F_crear" id="F_crear" method="POST">


                                <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                           
                                                <label>Cliente</label>
                                                <select class="js-example-basic-single select2  form-control" id="C_IdTerceros" name="C_IdTerceros" required />
                                                <?php echo $t1_terceros->option_cliente(); ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Obra</label>
                                                <select class="js-example-basic-single select2 form-control" id="C_Obras" name="C_Obras" required />
                                                    <?php //var_dump($get_datos->Select_Cliente($conexion_bd)); ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-7">
                                            <div class="form-group">
                                                <label>Codigo de la Remision</label>
                                                <input name="C_codigo" id="C_codigo" type="text" class="form-control" placeholder="Digite el nombre" required>
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label>Subir Imagen</label>
                                                <input type="radio" class="form-control tipoarchivo" name="subirtipo"  value="image/x-png,image/jpeg" required checked="">
                                            </div>
                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                                <label>Subir PDF</label>
                                                <input type="radio" class="form-control tipoarchivo" name="subirtipo"  value="application/pdf" required> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input  class="form-control" type="file" name="imgfiles" id="imgfiles" accept="image/x-png,image/jpeg" required="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Seleccionar Vehiculo</label>
                                                <select class="js-example-basic-single select2 form-control" id="C_vehiculo" name="C_vehiculo">
                                                    <?php 
                                                     echo $t10_vehiculo->select_conductor();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Seleccionar Seleccionar Conductor</label>
                                                <select class="js-example-basic-single select2 form-control" id="C_Conductor" name="C_Conductor">
                                                    <?php 
                                                        echo $t1_terceros->select_conductor();
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <input type="submit" class="btn btn-block bg-gradient-orange" name="Registrar" value="Registrar" id="Guardar">
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
    $(document).ready(function () {
        $('.select2').select2();

    });
    $(document).ready(function () {
        $('.tipoarchivo').change(function () {
            $('#imgfiles').attr("accept", $('input[name=subirtipo]:checked').val());
        });
    });
</script>
<script src="ajax_crear.js"></script>
<script>
    $(document).ready(function () {
    
        $('#C_IdTerceros').on('change', function () {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data:
                        {
                            idCliente: ($('#C_IdTerceros').val()),
                            task: "1",
                        },
                success: function (response)
                {
                    console.log(response.estado);
                    $('#C_Obras').html(response.obras);
                },
                error: function (respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    })



</script>
</body>
</html>







