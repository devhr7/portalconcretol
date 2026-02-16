<?php include '../../../layout/validar_session_cliente3.php' ?>
<?php include '../../../layout/head/headcliente3.php'; ?>

<?php include 'sidebar.php' ?>
<?php //include '../../../include/model/autoload3.php'; ?>

<?php include '../../../include/LibreriasHR.php';
require '../../../librerias/autoload.php';
include '../../../modelos/autoload.php';
include '../../../vendor/autoload.php';
?>

<?php 
switch($_SESSION['rol'])
{
    case 101:
     
        $LibreriasHR = new LibreriasHR();
        $t27_factura = new t27_factura();
        $t1_terceros = new t1_terceros(); 
        $t5_obras = new t5_obras();

    break;

    default:
        //print( '<script> window.location = "../../../cerrar.php"</script>');
    
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
                                <h1>Bienvenido  <strong> <?php echo  $_SESSION['nombre_usuario']; ?> </strong></h1>
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
                           <h3> Lista de Facturas</h3>
                           <hr>
                         
                            <div id="contenido">
                            <table id="example" class="display" style="width:100%">
      <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Numero Factura</th>
                                        <th>Fecha de subida </th>
                                        <th> Obra </th>
                                        <th> valor Factura </th>
                                        <th> Detalles </th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                <?php 
                                    
                                    $i = 0;

                                        $datos_factura = $t27_factura->select_factura_cliente($_SESSION['id_usuario']);
                                        while($fila_factura = $datos_factura->fetch(PDO::FETCH_ASSOC)){
                                            $i++;
                                            $id = $fila_factura['ct27_id_factura'];
                                            $nombre_factura = $fila_factura['ct27_nombre_factura'];
                                            $fecha_subda = $fila_factura['ct27_fecha_subda'];
                                            $valor_factura = $fila_factura['ct27_valorfact'];
                                           
                                            $id_obra = $fila_factura['ct27_id_obra'];
                                            //$valor_factura = $fila_factura['ct27_valorfact'];

                                            $datos_obras = $t5_obras->select_obras_id($id_obra);
                                            while($fila_obra = $datos_obras->fetch(PDO::FETCH_ASSOC)){
                                                $NombreObra = $fila_obra['ct5_NombreObra'];                                            
                                            }

                                            ?>
                                            <tr>
                                                <td><?php echo $i;  ?></td>
                                                <td><?php echo $nombre_factura; ?></td>
                                                <td><?php echo $fecha_subda; ?></td>
                                              
                                                <td><?php echo $NombreObra; ?></td>
                                                <td><?php echo $valor_factura; ?></td>
                                                                                 
                                                <td><a href="detalle_fact.php?id='<?php echo $LibreriasHR->HR_Crypt($id,1) ;?>" class="btn btn-block btn-info">Ver Factura</a></td>
                                            </tr>
                                            <?php
                                        }
?>                                    
                                </tbody>
                                <tfooter>
                                    <tr>
                                                                                                    <th>No</th>
                                        <th>Numero Factura</th>
                                        <th>Fecha de subida </th>
                                        <th> Obra </th>
                                        <th> valor Factura </th>
                                        <th> Detalles </th>
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
            


            <?php include '../../../layout/footer/footercliente3.php' ?>

    <script src="../../../plugins/datatables/datatables.js"></script>

       
        <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
        </script>

    </body>
</html>
