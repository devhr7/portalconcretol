<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>
<?php include '../../include/lib.php'; ?>

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
        case 26:
        case 27:
        case 29:
        case 20:

       
        $php_clases = new php_clases();
        $t5_obras = new t5_obras();
        $t1_terceros = new t1_terceros();
        $lib = new lib();

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
                                <h1>Obra</h1>
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
                            <h3 class="card-title">Lista de obras</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                                <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>    
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="row">
                                    <?php
                                
                                   switch($rol_user)
                                   {
                                       case 1:
                                       case 8:
                                       case 12:
                                       case 13:
                                       case 14:
                                           case 26:
                                           case 27:
                                           
                                   ?>
                                   <div class="col-2">
                                   <a href="create/crear.php" class="btn btn-block btn-info"> Crear  Obra</a>
                               </div>
                                         
                                   <?php
                                       break;
                                   
                                       default:
                                           
                                       
                                       break;
                                   }
                                   ?>
                                    
                                </div>
                            </div>
                            <div id="contenido">
                                <table id="t_obra" class="display" style="width:100%">
                                <thead>
                                        <tr>
                                            <th>N </th>
                                            <th>NI Cliente</th>
                                            <th>Cliente</th>
                                            <th>Nombre Obra </th>
                                            <th>Estado</th>
                                            <th>Detalle</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $i = 0;
                                        $datos = $t5_obras->select_obras();
                                        while($fila = $datos->fetch(PDO::FETCH_ASSOC)){

                                            $datos_terceros= $t1_terceros->search_tercero_custom_id($fila['ct5_IdTerceros']);
                                                while($filat = $datos_terceros->fetch(PDO::FETCH_ASSOC)){
                                                    $nit = $filat['ct1_NumeroIdentificacion'];
                                                    $razon_social = $filat['ct1_RazonSocial'];
                                                }

                                            $i++;
                                            $id = $fila['ct5_IdObras'];
                                            $ct5_EstadoObra = $fila['ct5_EstadoObra'];
                                            $ct5_NombreObra = $fila['ct5_NombreObra'];
                                            

                                            
                                            
                                            ?>
                                            <tr>
                                                <td><?php echo $i;  ?></td>
                                                <td><?php echo $nit; ?></td>
                                                <td><?php echo $razon_social; ?></td>
                                                <td><?php echo $ct5_NombreObra; ?></td>
                                                <td><?php 
                                                
                                               echo  $lib->estado($ct5_EstadoObra);
                                                
                                                ?></td>
                                                <td class="project-actions">
                                            <a class="btn btn-info btn-sm" href=''><i class="far fa-eye"></i></a>
                                            <a class="btn btn-warning btn-sm"  href="update/editar.php?id='<?php echo $php_clases->HR_Crypt($id,1) ;?>"><i class="fas fa-edit"></i></a>
                                            </td>
                                              

                                            
                                            </tr>


                                            <?php
                                        }

                                    ?>
                                    </tbody>
                                    <tfooter>
                                        <tr>
                                            <th>N </th>
                                            <th>NI Cliente</th>
                                            <th>Cliente</th>
                                            <th>Nombre Obra </th>
                                            <th>Estado</th>
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
            $(document).ready(function () {
                $('#t_obra').DataTable({});
            });
        </script>

    </body>
</html>
