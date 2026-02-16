<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<?php //include '../../include/lib.php'; 
?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
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

        $t29_batch = new t29_batch();
        $php_clases = new php_clases();
        $t5_obras = new t5_obras();
        $t1_terceros = new t1_terceros();
        // $lib = new lib();

        if (isset($_GET['id'])) {
            $id_batch = $php_clases->HR_Crypt($_GET['id'], 2);
        }


        include 'datos_batch.php';


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

                <div id="seccion2">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h5>Baches Anexada a la remision <span><?PHP echo $remision_batch; ?></span></h5>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <table id="t_batch" class="display">
                                    <thead>
                                        <tr>
                                            <th>Fecha</th>
                                            <th>Hora</th>
                                            <th style="width:400px">cliente</th>
                                            <th style="width:200px">Obra</th>
                                            <th>Metros</th>
                                            <th style="width:400px">Producto</th>
                                            <th>Asentamiento</th>
                                            <th>Mixer</th>
                                            <th>Conductor</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $datos_batch = $t29_batch->select_batch_remi($remision_batch);
                                        foreach ($datos_batch as $datos) {
                                        ?>
                                            <tr>
                                                <td><?php echo $datos['ct29_Fecha']; ?></td>
                                                <td><?php echo $datos['ct29_Hora']; ?></td>
                                                <td><?php echo $datos['ct29_IdCliente']; ?></td>
                                                <td><?php echo $datos['ct29_IdObra']; ?></td>
                                                <td><?php echo $datos['ct29_MetrosCubicos']; ?></td>
                                                <td><?php echo $datos['ct29_NombreFormula'] . " - " . $datos['ct29_DescripcionFormula']; ?></td>
                                                <td><?php echo $datos['ct29_Asentamiento']; ?></td>
                                                <td><?php echo $datos['ct29_IdMixer']; ?></td>
                                                <td><?php echo $datos['ct29_MixerDriver']; ?></td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <hr>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <h5>Estado de la Remision</h5>
                            <label>Seleccione:</label>
                            <select>
                                <option value="Aprovado">Aprovada</option>
                                <option value="Anulado">Anulada</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <a href="../ver_remision/remision.php?id=<?php echo $php_clases->HR_Crypt($remision_batch, 1);  ?>"><button>Vista Previa</button></a>
                        </div>
                    </div>
                    <div class="col">
                        <form name="form_generar" id="form_generar" method="POST">
                            <div class="form-group">
                                <h5>Haz clic aqui para generar la Remision</h5>
                                <input type="hidden" name="txt_remision_batch" id="txt_remision_batch" value="<?php echo $php_clases->HR_Crypt($remision_batch, 1); ?>">
                                <button type="submit">Guardar y Generar Remision</button>
                            </div>
                        </form>
                    </div>
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
<script src="ajax_crear.js"></script>
<script>
    $(document).ready(function() {
        $('#t_batch').DataTable({
            "scrollX": true,
        });
    });
</script>

</body>

</html>