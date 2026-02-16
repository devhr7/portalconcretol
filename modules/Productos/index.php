<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Productos</h1>
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
                        <div class="col">
                            <a href="create/crear.php"><button> Crear </button></a>
                        </div>
                    </div>
                </div>
                <div id="contenido">
                    <table id="t_productos" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> N </th>
                                <th> ESTADO </th>
                                <th> NOMBRE </th>
                                <th> DESCRIPCION </th>
                                <th> DETALLE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $t4_productos = new t4_productos();
                            $datos_productos = $t4_productos->tabla_productos();
                            $php_clases = new php_clases();
                            $x = 1;
                            foreach ($datos_productos as $fila_productos) {
                                $IdProducto = htmlspecialchars($fila_productos['ct4_Id_productos']);
                                $Estado = htmlspecialchars($fila_productos['ct4_EstadoProducto']);
                                $CodigoSyscafe = htmlspecialchars($fila_productos['ct4_CodigoSyscafe']);
                                $Nombre = htmlspecialchars($fila_productos['ct4_Nombre']);
                                $descripcion = htmlspecialchars($fila_productos['ct4_Descripcion']);
                            ?>
                                <tr>
                                    <td><?php echo $x++; ?></td>
                                    <td><?php echo $php_clases->estado($Estado); ?> </td>
                                    <td><?php echo $Nombre ?> </td>
                                    <td> <?php echo $descripcion ?></td>
                                    <td class="project-actions">
                                        <a class="btn btn-info btn-sm" href='update/editar.php?id=<?php echo $php_clases->HR_Crypt($IdProducto, 1); ?>'><i class="far fa-eye"></i></a>
                                        <!--<a class="btn btn-warning btn-sm" href='update/editar.php?id=<?php echo $php_clases->HR_Crypt($IdProducto, 1); ?>'><i class="fas fa-edit"></i></a> -->
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> N </th>
                                <th> ESTADO </th>
                                <th> NOMBRE </th>
                                <th> DESCRIPCION </th>
                                <th> DETALLE</th>
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
        $('#t_productos').DataTable();
    });
</script>

</body>

</html>