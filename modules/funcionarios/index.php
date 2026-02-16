<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>
<?php
require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';
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
                    <h1>CLIENTES</h1>
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
                    <form name="form_funcion" id="form_funcion" method="GET" action="listadoformatos.php">
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Nombres Completos</label>
                                    <input type="text" name="txt_nombres_completos" id="txt_nombres_completos">
                                </div>
                                <div class="col">
                                    <label>Numero de Documento</label>
                                    <input type="text" name="txt_numero_documento" id="txt_numero_documento">
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Seleccionar Area</label>
                                    <select name="select_area">
                                        <option value="1">Agentes de Servicio</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Seleccionar Cargo</label>
                                    <select name="select_cargo">
                                        <option value="1">Agentes de Servicio</option>
                                        <option value="2">Gerencia</option>
                                        <option value="3">Gerencia Administrativa</option>
                                        <option value="4">Gerencia Operativa</option>
                                    </select>
                                </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label>Lugar de induccion</label>
                                    <input type="text" name="txt_lugar_induccion" id="txt_lugar_induccion">
                                </div>
                                <div class="col">
                                    <label>FECHA INICIO CONTRATO</label>
                                    <input type="text" name="date_inicio_contrato" id="date_inicio_contrato">

                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-block btn-info">Enviar</button>
                                </div>
                            </div>
                        </div>
                    </form>
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