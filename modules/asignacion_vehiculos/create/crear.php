<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../include/model/autoload3.php'; ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php 
switch($rol_user)
{
    case 1:
    case 8:
        $t10_vehiculo = new t10_vehiculo();
        $t1_terceros = new t1_terceros();

        $php_class = new php_class();
    break;

    default:
        print( '<script> window.location = "../../../cerrar.php"</script>');
    
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
                                <h1>Agignacion de Vehiculos</h1>
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
                            <h3 class="card-title">Crear</h3>

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
                                                <label>Seleccionar Conductor</label>
                                                <select  class="js-example-basic-single" name="c_conductor" id="c_conductor">
                                                    <?php
                                                    $datos = $t1_terceros->search_conductor();
                                                    while ($fila = $datos->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                                        <option value="<?php echo $fila['ct1_IdTerceros']; ?>"> <?php echo $fila['ct1_NumeroIdentificacion'] . " - " . $fila['ct1_RazonSocial']; ?></option>
                                                        <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Seleccionar Vehiculo</label>
                                                <select class="js-example-basic-single" name="c_vehiculo" id="c_vehiculo">
                                                    <?php
                                                    $datos = $t10_vehiculo->select_vehiculos_all();
                                                    while ($fila = $datos->fetch(PDO::FETCH_ASSOC)) {
                                                        ?>
                                                        <option value="<?php echo $fila['ct10_IdVehiculo'] ?>"> <?php echo  $fila['ct10_Placa']; ?></option>
                                                        <?php
                                                    }
                                                    ?>

                                                </select>
                                            </div>
                                        </div>

                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <button type="submit">Guardar</button>
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
    $('.js-example-basic-single').select2();
});
</script>

<script src="ajax_crear.js"></script>



</body>
</html>







