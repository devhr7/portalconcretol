<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>
<?php
require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';
?>

<?php
    $nombres_completos = $_GET['txt_nombres_completos'];
    $numero_documento = $_GET['txt_numero_documento'];
    $area = $_GET['select_area'];
    $cargo = $_GET['select_cargo'];
    $lugar_induccion = $_GET['txt_lugar_induccion'];
    $fecha_inicio_contrato = $_GET['date_inicio_contrato'];


?>

<?php
switch ($rol_user) {
    case 1:
    case 8:
    case 12:
    case 13:
    case 14:
    case 26:
    case 27:


        $php_clases = new php_clases();
        $t1_terceros = new t1_terceros();

        break;

    default:
        print('<script> window.location = "../../../cerrar.php"</script>');

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
                    <h1>LISTADO DE FORMATOS</h1>
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
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                
                <div id="contenido">

                <?php 
                    $id = 1;

                ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col">
                                <div>FORMATO DE INDUCCION AL CARGO</div>
                            </div>
                            <div class="col">
                                <div><a href="funcion_cargo.php?nombres=<?php echo $nombres_completos; ?>&documento=<?php echo $numero_documento; ?> &area=<?php echo $area; ?> &cargo=<?php echo $cargo; ?> &lugar=<?php echo $lugar_induccion; ?> &fecha_inicio=<?php echo $fecha_inicio_contrato; ?> " >descargar</a></div>
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

<?php include '../../layout/footer/footer2.php' ?>

<script>
    $(document).ready(function() {

    });
</script>

</body>

</html>