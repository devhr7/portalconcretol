<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>
<?php include '../../include/conexion.php'; ?>

<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>



<?php 
switch($rol_user)
{
    case 1:
    case 8:
    case 12:
    case 13:
    case 14:
    case 27:
       
        $php_clases = new php_clases();
        $connection = new conexion();
        $connection->connect();


    break;

    default:
        print( '<script> window.location = "../../../cerrar.php"</script>');
    
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
                                <h1>Asignacion Precios</h1>
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
                                        <a href="create/crear.php" class="btn btn-block btn-info"> Crear </a>
                                    </div>
                                </div>
                            </div>
                            <div id="contenido">
                                


                        <table id="TablaPecioProducto" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th> N </th>
                                    <th> CLIENTE </th>
                                    <th> OBRA </TH>
                                    <th> PRODUCTO </th>
                                    <th> PRECIO </th>
                                    <th> ESTADO </th>
                                    <th> DETALLE</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = "SELECT ct6_precioproductos.ct6_IdPrecioProducto , ct6_precioproductos.ct6_Precio , ct6_precioproductos.ct6_Estado, 
                                ct1_terceros.ct1_RazonSocial, ct5_obras.ct5_NombreObra, ct4_productos.ct4_Nombre,   ct4_productos.ct4_Descripcion FROM ct6_precioproductos 
                                INNER JOIN ct1_terceros on ct6_precioproductos.ct6_IdTercero = ct1_terceros.ct1_IdTerceros 
                                INNER JOIN ct5_obras on ct6_precioproductos.ct6_IdObras = ct5_obras.ct5_IdObras 
                                INNER JOIN ct4_productos on ct6_precioproductos.ct6_IdProducto = ct4_productos.ct4_Id_productos  ORDER BY ct6_precioproductos.ct6_IdPrecioProducto DESC";

                                $stmt = mysqli_prepare($connection->myconn, $query);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $rowcount = $result->num_rows;

                                // var_dump($rowcount);
                                $x = 0;

                                if ($rowcount > 0) {

                                    while ($fila = $result->fetch_assoc()) {
                                        $IdPrecioProducto = htmlspecialchars($fila['ct6_IdPrecioProducto']);
                                        $Cliente = htmlspecialchars($fila['ct1_RazonSocial']);
                                        $Obra = htmlspecialchars($fila['ct5_NombreObra']);  // 
                                        $Producto = htmlspecialchars($fila['ct4_Nombre']);  // 
                                        $Descripcion = htmlspecialchars($fila['ct4_Descripcion']);
                                        $Precio = htmlspecialchars($fila['ct6_Precio']);  // 
                                        $Estado =  htmlspecialchars($fila['ct6_Estado']);

                                       



                                        $id = $php_clases->HR_Crypt($IdPrecioProducto, 1);

                                        //var_dump($cupo);

                                        if ($Estado == 1) {
                                            $s_clase = " badge-success ";
                                            $status = "Aprovado";
                                        }
                                        if ($Estado == 0) {
                                            $s_clase = " badge-info ";
                                            $status = "";
                                        }
                                        if ($Estado == 3) {
                                            $s_clase = " badge-warning ";
                                            $status = "Pendiente ";
                                        }
                                        if ($Estado == 2) {
                                            $s_clase = " badge-danger";
                                            $status = "Desabilitado";
                                        }

                                        $x++
                                ?>
                                        <tr>
                                            <td><?php echo $x ?> </td>
                                            <td><?php echo $Cliente ?></td>

                                            <td><?php echo $Obra ?> </td>
                                            <td><?php echo $Producto. " - ".$Descripcion  ?> </td>
                                            <td> <?php echo  "$ ".  number_format($Precio, 2, ',', ' ');  ?></td>
                                            <td><span class='badge <?php echo $s_clase; ?> float-right'> <?php echo $status ?> </span> </td>

                                            <td class="project-actions">
                                            <a class="btn btn-info btn-sm" href=''><i class="far fa-eye"></i></a>
                                            <a class="btn btn-warning btn-sm" href='update/editar.php?id=<?php echo $id; ?>'><i class="fas fa-edit"></i></a>
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
                                    <th> CLIENTE </th>
                                    <th> OBRA </TH>
                                    <th> PRODUCTO </th>
                                    <th> PRECIO </th>
                                    <th> ESTADO </th>
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
            $(document).ready(function () {
                $('#TablaPecioProducto').DataTable({});
            });
        </script>

    </body>
</html>
