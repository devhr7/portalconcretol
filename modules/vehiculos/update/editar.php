<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>

<?php
$php_clases = new php_clases();
$t10_vehiculo = new t10_vehiculo();

$id_vehiculo = $php_clases->HR_Crypt($_GET['id'], 2);

$datos_vehiculo = $t10_vehiculo->select_vehiculos_id($id_vehiculo);

if ($datos_vehiculo) {
    foreach ($datos_vehiculo as $fila) {
        $letras = $fila['ct10_letras'];
        $num = $fila['ct10_num'];
        $placa = $fila['ct10_Placa'];
    }
}

?>
<script> var id = <?php echo json_encode($id_vehiculo);?>; </script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Vehiculos</h1>
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
                <h3 class="card-title">Editar Datos Vehiculo</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="F_editar" id="F_editar" method="POST">
                        <input type="hidden" value="<?php echo $_GET['id']; ?>" name="txt_id" id="txt_id">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Escribir Placa del Vehiculo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" id="txt_letras" name="txt_letras" value="<?php echo $letras; ?>" class="form-control" placeholder="Solo Letras">
                                </div>
                            </div>
                            <div class="col-1">
                                <center> - </center>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" id="txt_num" name="txt_num" class="form-control" value="<?php echo $num; ?>" placeholder="Solo numeros">
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit">Guardar</button>

                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <button type="button" id="btn-eliminar">Eliminar</button>
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
<script src="ajax_editar.js"></script>
<script src="ajax_eliminar.js"></script>

</body>

</html>