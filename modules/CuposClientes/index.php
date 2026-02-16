<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>

<?php
require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';
?>


<?php
switch ($rol_user) {
    case 1:
        
        $t1_terceros = new t1_terceros();
        $t3_clientes = new t3_clientes();
    
        break;

    default:
        print( '<script> window.location = "../../../cerrar.php"</script>');

        break;
}
?>

<?php include 'sidebar.php' ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CUPO CLIENTES</h1>
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
                            <a href="create/crear.php" class="btn btn-block bg-gradient-success"> Crear Cupo Cliente </a>
                        </div>
                    </div>
                </div>
               
                <div id="contenido">
                <table id="TablaCupoCliente" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th> </th>
                                        <th> Nit</th>
                                        <th> Cliente </th>
                                        <th> TipoCliente </TH>
                                        <th> ESTADO </th>
                                        <th> DETALLE</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                   $datos =  $t3_clientes->get_datos_for_table();
                                   if($datos):
                                   foreach ($datos as $fila) {
                                    ?>
                                    <tr>
                                    <td> <?php  ?> </td>
                                    <td> <?php  ?> </td>
                                   
                                          <td> <?php echo $fila['ct3_IdTerceros']; ?> </td>
                                        <td> <?php echo $fila['ct3_TipoCliente']; ?> </td>
                                        <td> <?php echo $fila['ct3_CupoEstado']; ?> </td>
                                        <td> <a> Editar </a> </td>
                                       
                                    </tr>

                                    <?php
                                   }
                                endif;
?>
                                </tbody>
                        

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
        $('#TablaCupoCliente').DataTable({});
    });
</script>

</body>
</html>
