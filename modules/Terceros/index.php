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
                    <h1>Bienvenido</h1>
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
                            <a href="create/"><button> Crear </button></a>
                        </div>
                    </div>
                </div>
                <div id="contenido">
                    <table id="TablaTerceros" class="table table-bordered table-striped ">

                        <thead>
                            <tr>
                                <th> N </th>
                                <th> TIPO TERCERO</th>
                                <th> TIPO IDENTIFICACION </th>
                                <th> NUMERO IDENTIFICACION </th>
                                <th> RAZON SOCIAL / NOMBRES COMPLETOS</th>
                                <th> ESTADO </th>
                                <th> DETALLE </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $t1_terceros = new t1_terceros();

                            $datos_tabla = $t1_terceros->tabla_terceros();


                            var_dump($datos_tabla);

                            $query = "SELECT ct1_terceros.ct1_IdTerceros, ct1_terceros.ct1_Estado, ct1_terceros.ct1_TipoIdentificacion , ct1_terceros.ct1_NumeroIdentificacion , ct1_terceros.ct1_RazonSocial , ct13_tipotercero.TipoTercero FROM ct1_terceros INNER JOIN ct13_tipotercero on ct1_terceros.ct1_TipoTercero = ct13_tipotercero.ct13_IdTipoTercero";
                            $stmt = mysqli_prepare($connection->myconn, $query);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            $rowcount = $result->num_rows;

                            // var_dump($rowcount);
                            $x = 0;

                            if ($rowcount > 0) {

                                while ($fila = $result->fetch_assoc()) {

                                    $IdTerceros = htmlspecialchars($fila['ct1_IdTerceros']);
                                    $TipoTercero = htmlspecialchars($fila['TipoTercero']);
                                    // $Naturaleza = htmlspecialchars($fila['ct1_naturaleza']);
                                    $TipoIdentificacion = htmlspecialchars($fila['ct1_TipoIdentificacion']);
                                    $NumeroIdentificacion = htmlspecialchars($fila['ct1_NumeroIdentificacion']);
                                    $RazonSocial = htmlspecialchars($fila['ct1_RazonSocial']);
                                    $Estado = htmlspecialchars($fila['ct1_Estado']);

                                    $id = $php_funcion->crypty($IdTerceros, 1);

                                    //var_dump($cupo);

                                    $x++
                            ?>
                                    <tr>
                                        <td><?php echo $x ?></td>

                                        <td><?php echo $TipoTercero ?> </td>
                                        <td><?php echo $TipoIdentificacion ?> </td>
                                        <td> <?php echo $NumeroIdentificacion ?> </td>
                                        <td> <?php echo $RazonSocial ?></td>



                                        <td><span class='badge <?php echo $s_clase; ?> float-right'> <?php echo $status ?> </span> </td>

                                        <td class="project-actions">

                                            <a class="btn btn-info btn-sm" href=''><i class="far fa-eye"></i></a>
                                            <a class="btn btn-warning btn-sm" href='editartercero.php?id=<?php echo $id; ?>'><i class="fas fa-edit"></i></a>




                                        </td>
                                    </tr>


                            <?php
                                }
                            } else {
                                echo '<tr> <td colspan="7"> No hay Registro en la base de datos </td> </tr>';
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th> N </th>
                                <th> TIPO TERCERO</th>
                                <th> TIPO IDENTIFICACION </th>
                                <th> NUMERO IDENTIFICACION </th>
                                <th> RAZON SOCIAL / NOMBRES COMPLETOS</th>
                                <th> ESTADO </th>
                                <th> DETALLE </th>



                                <th></th>
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
        $('#t_vehiculos').DataTable({});
    });
</script>

</body>

</html>