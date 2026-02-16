<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>

<?php
$t10_vehiculo = new t10_vehiculo();
$php_clases = new php_clases();
?>

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
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col-2">
                            <a href="create/crear.php" class="btn btn-block bg-gradient-info"> Registrar Vehiculo </a>
                        </div>
                    </div>
                </div>
                <div id="contenido">
                    <table id="t_vehiculos" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Placa</th>
                                <th>Estado</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $datos_vehiculo = $t10_vehiculo->select_vehiculos_all();
                            $x = 1;
                            if ($datos_vehiculo) {
                                foreach ($datos_vehiculo as $fila) {
                            ?>
                                    <tr>
                                        <td><?php echo $x++; ?></td>
                                        <td><?php echo $fila['ct10_Placa'] ?></td>
                                        <td><?php echo $php_clases->estado($fila['ct10_Estado']) ?></td>
                                        <td class="project-actions">
                                            <a class="btn btn-warning btn-sm" href="update/editar.php?id='<?php echo $php_clases->HR_Crypt($fila['ct10_IdVehiculo'], 1); ?>"><i class="fas fa-edit"></i></a>
                                        </td>
                                    </tr>
                            <?php
                                }
                            }

                            ?>

                        </tbody>
                        <footer>
                            <tr>
                                <th>N</th>
                                <th>Placa</th>
                                <th>Estado</th>
                                <th>Detalle</th>
                            </tr>
                        </footer>
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

<script>
    $(document).ready(function() {
        $('#t_vehiculos').DataTable({});
    });
</script>

</body>

</html>