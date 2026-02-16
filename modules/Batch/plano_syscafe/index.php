<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<?php //include '../../include/lib.php'; 
?>
<script>
    $("#resultado").hide();
</script>
<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
?>
<?php
switch ($rol_user) {
    case 1:
    case 26:
        case 27:
            case 28:
        $t29_batch = new t29_batch();
        $t5_obras = new t5_obras();
        $t1_terceros = new t1_terceros();
        // $lib = new lib();
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
                <h3 class="card-title"> Vista Previa de la Remision</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div>
                    <form id="form_export_plano_txt" name="form_export_plano_txt" method="GET" action="export_txt.php">
                        <div class="row">
                            <div class="col">
                                <h3>Seleccione un Rango de Fecha</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Fecha de Inicio:</label>
                                    <input class="form-control " type="date" name="txt_fechaini" id="txt_fechaini" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Fecha de Fin:</label>
                                    <input class="form-control " type="date" name="txt_fechafin" id="txt_fechafin" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Seleccionar Linea de despacho:</label>
                                    <select class="js-example-basic-single select2 form-control" name="txt_linea" id="txt_linea">
                                        <!-- <option selected="true" disabled>Seleccionar Linea de Despacho</option> -->
                                        <option value="todo">Todo</option>
                                        <option value="RMI">Linea 1</option>
                                        <option value="RZO">Linea 2</option>
                                        <option value="RMT">Ciudad Torreon</option>
                                        <option value="HND">Honda</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col" id="col_exportar">
                                <div class="form-group">
                                    <button id="exportar" class="btn btn-block bg-gradient-primary" type="submit">Exportar</button>
                                </div>
                            </div>
                            <div class="col" id="col_descargar">
                                <div class="form-group">
                                    <a id="descargar" class="btn btn-block bg-gradient-success" href="archivo.txt" download="archivo.txt"> Descargar Archivo</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../../layout/footer/footer3.php' ?>
<!-- <script src="ajax_crear.js"></script> -->
<script src="ajax_export.js"></script>

<script>
    $(function() {
        $('.select2').select2();
    });

    $("#col_descargar").hide();
    $("#col_exportar").hide();

    $(function() {
        $('#txt_fechafin').on('change', function() {
            $("#col_exportar").show();
        });
    });

    $(function() {
        $('#txt_fechafin').on('change', function() {
            $("#col_exportar").show();
        });
    });

    $(function() {
        const btn = document.getElementById('exportar');
        btn.onclick = function() {
            $("#col_descargar").show();
            $("#col_exportar").hide();
        }
    });

    $(function() {
        const btn = document.getElementById('descargar');
        btn.onclick = function() {
            location.reload();
        }
    });
</script>
</body>

</html>