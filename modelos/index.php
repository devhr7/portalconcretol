<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php
require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>
<?php

//$t10_vehiculo = new vehiculos_t10();
$t26_remisiones = new t26_remisiones();
$php_clases = new php_clases();
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Remi Web</h1>
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
                    <table id="t_remisiones" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Fecha</th>
                                <th>Obra</th>
                                <th>Remision</th>
                                <th>Estado</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            switch ($_SESSION['rol_funcionario']) {
                                case 1:
                                case 8:
                                case 15:
                                case 16:
                                case 29:
                                case 20:

                                    $result = $t26_remisiones->get_datos_for_admin();
                                    break;
                                case 25:

                                    $result = $t26_remisiones->get_datos_for_conductor($php_clases->HR_Crypt($_SESSION['id_usuario'], 2));
                                    break;
                                default:
                                    break;
                            }

                            //$row = $result->fetch(PDO::FETCH_ASSOC);
                            $n=1;
                            foreach ($result as $fila) {


                                if ($fila) {
                                    $id = $fila['ct26_id_remision'];
                                    $date = new DateTime($fila['ct26_fecha_remi']);
                                    $datef = $date->format("d-m-Y");
                            ?>
                                    <tr>
                                   <td> <?php echo $n++ ?> </td> 
                             
                                        <td>
                                            <?php echo $datef; ?>
                                        </td>
                                        <td>
                                            <?php echo $fila['ct26_nombre_obra']; ?>
                                        </td>
                                        <td>
                                            <?php echo $fila['ct26_codigo_remi'];  ?>
                                        </td>
                                        <td>
                                            <?php echo $php_clases->estado_remi($fila['ct26_estado']) ; ?>
                                        </td>
                                        <td>
                                            <a class="btn btn-block btn-success" href="llenar/detalle_remision.php?id='<?php echo $php_clases->HR_Crypt($id, 1) ?>'&ob='<?php echo $php_clases->HR_Crypt($fila['ct26_nombre_obra'], 1) ?>' "> <i class="fas fa-edit"></i> ver remision </a>

                                        </td>

                                    </tr>
                                <?php
                                } else {
                                ?>
                                    <tr>
                                        <td Colspan="5">
                                            Sin datos
                                        </td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>




                        </tbody>
                        <tfoot>
                            <tr>
                                <th>N </th>
                                <th>Fecha</th>
                                <th>Obra</th>
                                <th>Remision</th>
                                <th>Estado</th>
                                <th>Detalle</th>
                                
                            </tr>
                        </tfoot>
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
        $('#t_remisiones').DataTable({});
    });
</script>

</body>

</html>