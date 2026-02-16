<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>
<!-- <?php include '../../include/model/autoload2.php'; ?> -->


<?php require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php'; ?>
<?php 
switch($rol_user)
{
    case 1:
    case 8:
    case 20:
        $t10_vehiculo = new t10_vehiculo();
        $php_class = new php_class();
        $t1_terceros = new t1_terceros();

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
                                        <a href="create/crear.php"><button> Crear </button></a>
                                    </div>
                                </div>
                            </div>
                            <div id="contenido">
                                <table id="t_vehiculos" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th> N </th>
                                            <th> Vehiculo</th>
                                            <th>Conductor Asignado</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $result = $t10_vehiculo->select_vehiculos_all();
                                        $i = 1;
                                        if($result){
                                            while($fila = $result->fetch(PDO::FETCH_ASSOC)){
                                                $N = $i;
                                                $placa = $fila['ct10_Placa'];
                                                $conductor = $fila['ct10_conductor_asignado'];
                                               
                                                    if ($conductor != null || $conductor != 0) {
                                                        $result_2 = $t1_terceros->search_tercero_custom_id($conductor);

                                                        while ($fila2 = $result_2->fetch(PDO::FETCH_ASSOC)) {

                                                            $razon_social = $fila2['ct1_RazonSocial'];
                                                        }
                                                    } else {
                                                       $razon_social = "no hay conductor asignado"; 
                                                    }
                                                    


                                                ?>
                                                <tr>
                                                    <td><?php echo $N; ?></td>
                                                    <td><?php echo  $placa ?></td>
                                                    <td><?php echo  $razon_social ?></td>
                                                    

                                                  
                                                    
                                                </tr>
                                                <?php
                                                $i++;
                                            }
                                        }


?>
                                    </tbody>
                                    <tfooter>
                                    <tr>
                                            <th> N </th>
                                            <th> Vehiculo</th>
                                            <th>Conductor Asignado</th>
                                    
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

        <script>
            $(document).ready(function () {
                $('#t_vehiculos').DataTable({});
            });
        </script>

    </body>
</html>
