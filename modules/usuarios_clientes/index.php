<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>


<?php
switch ($rol_user) {
    case 1:
    case 8:
    case 12:
    case 13:
    case 16:
    case 15:
    case 19:
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
                    <h1>Usuarios Clientes</h1>
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
                            <a href="create/crear.php" class="btn btn-block btn-info"> Crear Usuario</a>
                        </div>
                    </div>
                </div>
                <div id="contenido">
                    <table id="t_usuarios" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Cedula Ciudadania </th>
                                <th>Nombre usuario </th>
                                <th> Apellido Usuario </th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            $datos = $t1_terceros->select_user_cliente2();
                            if ($datos) {
                                foreach ($datos as $key1) {
                                    $i++;
                                    $id = $key1['ct1_IdTerceros'];
                                    $num = $key1['ct1_NumeroIdentificacion'];
                                    $nombre1 = $key1['ct1_Nombre1'];
                                    $apellido1 = $key1['ct1_Apellido1'];
                                    $id_cliente1 = $key1['ct1_id_cliente1'];
                                    $datoscli = $t1_terceros->select_tercero_id2($id_cliente1);?>
                                    <tr>
                                        <td><?php echo $i;  ?></td>
                                        <td><?php echo $num; ?></td>
                                        <td><?php echo $nombre1; ?></td>
                                        <td><?php echo $apellido1; ?></td>
                                        <td><a href="update/editar.php?id=<?php echo $id; ?>" class="btn btn-block btn-info">Editar</a></td>
                                    </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>N</th>
                                <th>Cedula Ciudadania </th>
                                <th>Nombre usuario </th>
                                <th> Apellido Usuario </th>
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
        $('#t_usuarios').DataTable({});
    });
</script>

</body>

</html>