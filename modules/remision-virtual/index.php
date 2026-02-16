<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>

<?php
switch ($rol_user) {

    case 1:
    case 3:
    case 8:
    case 15:
    case 16:
    case 20:
    case 27:
    case 28:


        $php_clases = new php_clases();
        $t29_batch = new t29_batch();


        break;

    default:

        //print( '<script> window.location = "../../../cerrar.php"</script>');

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
                    <h1>REMISIONES VIRTUAL</h1>
                </div>
                <div class="col-sm-6">
                    <!--
                              <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Bacthes</li>
                                <li class="breadcrumb-item ">Exportar Batch</li>
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
                <h3 class="card-title">Busqueda Avanzada</h3>
                <div class="card-tools">

                </div>
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h5>Completa alguno de los 2 campos para continuar</h5>
                            </div>
                        </div>
                    </div>
                    <form name="form_busqueda" id="form_busqueda" method="GET" action="index.php" >
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Seleccionar Fecha</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="date" name="cp_fecha" id="cp_fecha">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Buscar por codigo de la remision</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <input type="text" name="cp_codigo_remi" id="cp_codigo_remi">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button id="btn_enviar"  type="submit" n>Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <?php

                    echo "la fecha es " . $_GET['cp_fecha'] . "el codigo es " . $_GET['cp_codigo_remi'];

                    ?>
                </div>
            </div>
            <!-- /.card-body -->

        </div>
        <!-- /.card -->



        <div class="card">
            <div class="card-header">
                <h3 class="card-title"> BATCH</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">



                <div id="contenido">
                    <?php

                        if (isset($_GET['cp_fecha']) || isset($_GET['cp_codigo_remi'])) :
                            $cp_fecha = $_GET['cp_fecha'];
                            $cp_codigo_remi = $_GET['cp_codigo_remi'];
                            $datos_tabla = $t29_batch->select_batch_buscador($cp_codigo_remi, $cp_fecha);
                            
                           
                            
                        endif;
                    ?>
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

<?php include '../../layout/footer/footer2.php' ?>

<script>
    $(document).ready(function() {
        $('#t_remisiones').DataTable();
    });
</script>

<?php 
if(isset($_GET['cp_fecha'])||isset($_GET['cp_codigo_remi'])):
    ?>
<script>
    $(document).ready(function (e) {
        <?php 
if(isset($_GET['cp_fecha'])||isset($_GET['cp_codigo_remi'])):
    ?>


<?php endif; ?>
    });
</script>


</body>

</html>