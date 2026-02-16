<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebarcancelado.php' ?>
<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';
?>


<?php
switch (intval($_SESSION['rol_funcionario'])) {
    case 1:
        $t29_batch = new t29_batch();
        $php_clases = new php_clases();

        break;

    default:
        //print('<script> window.location = "../../../cerrar.php"</script>');
        print('<script> console.log("mal")</script>');

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
                <h3 class="card-title">Listado batch </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <?php

                $datostabla = $t29_batch->select_batch_cancelado();
                ?>

                <div id="contenido">
                    <table id="t_batch" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>N </th>
                                <th>Fecha</th>
                                <th>Remision</th>
                                <th>Cliente</th>
                                <th>Obra </th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php



                            $x = 0;
                            if (is_array($datostabla)) {
                                foreach ($datostabla as $datos) {
                                    $x++;
                                    $id_batch = $datos['ct29_Id']; ?>
                                    <tr>
                                        <td><?php echo $x; ?></td>
                                        <td><?php echo $datos['ct29_Fecha'] //$php_clases->formatofeha($datos['ct29_Fecha'], 'd-m-Y'); 
                                            ?></td>
                                        <td><?php echo $datos['ct29_Remision']; ?></td>
                                        <td><?php echo $datos['ct29_IdCliente']; ?></td>
                                        <td><?php echo $datos['ct29_IdObra']; ?></td>
                                        <td> <a class="btn btn-warning btn-sm" href="verbatch/index.php?id=<?php echo $php_clases->HR_Crypt($id_batch, 1); ?>&vk=cancel"><i class="fas fa-eye"></i></a></td>
                                    </tr>
                                <?php
                                }
                            } else {
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfooter>
                            <tr>
                                <th>N </th>
                                <th>Fecha</th>
                                <th>Remision</th>
                                <th>Cliente</th>
                                <th>Obra </th>
                                <th>Detalle</th>
                            </tr>
                        </tfooter>
                    </table>
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
<script src="ajax_crear.js"></script>
<script>
    $(document).ready(function() {
        $('#t_batch').DataTable();
    });
</script>


</body>

</html>