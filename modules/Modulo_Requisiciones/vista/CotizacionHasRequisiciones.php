<?php include ("../../../layout/validar_session3.php") ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<?php include_once "../controlador/ControladorRequisiciones1.php"; 
$requisiciones = new ControladorRequisiciones();
?>

<link rel="stylesheet" type="text/css" href="../DataTables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="../DataTables/DataTable/css/dataTables.bootstrap.min.css"/>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Añadir Cotizacion a Item</h1>
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
                        <form action="CrearCotizacionHasRequisicion.php" method="POST" enctype="multipart/form-data">
                            <br>
                            <H5>SELECCIONAR PRODUCTOS</H5>
                            <br>
                            <?php 
                            if ($rol_user == 23 or $rol_user == 24 ){
                                $requisiciones = new ControladorRequisiciones();
                                $resultado = $requisiciones->listarRequiCoti();
                            }

                            else{
                            
                            $requisiciones = new ControladorRequisiciones();
                            $resultado = $requisiciones->listarRequi($rol_user);
                            }
                            ?>
                            
                            <table class="table table-striped table-borderer" name ="myTable" id="myTable">
                                <thead>
                                    <tr>
                                        <th>✓</th>
                                        <th>FECHA</th>
                                        <th>PRODUCTO</th>
                                        <th>UNIDAD MEDIDA</th>
                                        <th>CANTIDAD</th>
                                        <th>ESTATUS</th>
                                        <th>OBSERVACION</th>
                                        <th>PRECIO</th>
                                        <th>OPCIONES</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                
                                     <?php 
                                     $idC = $_GET['id'];
                                     
                                    if ($rol_user == 23 or $rol_user == 24){
                                        ?>
                                    <?php
                                    while($requisicion = $resultado->fetch_assoc()){
                                        ?>
                                    
                                    <td><input type="checkbox" name="id[]" value="<?php echo $requisicion['IDREQUISICION']; ?>"></td>
                                    <td><?php echo $requisicion['FECHA'] ?></td>
                                    <td><?php echo $requisicion['ITEM'] ?></td>
                                    <td><?php echo $requisicion['UNIDADDEMEDIDA'] ?></td>
                                    <td><?php echo $requisicion['CANTIDAD'] ?></td>
                                    <td><?php echo $requisicion['ESTADOREQUI'] ?></td>
                                    <td><?php echo $requisicion['OBSERVACION'] ?></td>
                                    <td><input style="width : 100px; heigth : 1px" type="text" name="precio[]" id="precio"></td>
                                        <td>  
                                    <a class="btn btn-light" href=<?php echo "vista/EstadoCoti.php?id=" . $requisicion['IDREQUISICION']; ?>>Estado </a>  
                                    <td><input type="hidden" name="idC"id="idC"value="<?php echo $idC ?>"></td>
                                </td>
                                </tr>
            <?php
                                    
                                    }?>
                                    
                                    <button type="submit" name="publicar" class="btn btn-info">AÑADIR</button> 
                                    
                                    <?php
                                }
            ?>
        </tbody>
    </table>
    </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="contenido">
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
<?php include '../../../layout/footer/footer2.php' ?>


<script type="text/javascript"src="../DataTables/datatables.min.js"></script>
<script type="text/javascript"src="../js/popper.min.js"></script>
<script type="text/javascript"src="../js/bootstrap.min.js"></script>
<script type="text/javascript"src="../js/jquery-3.6.4.min.js"></script>
<script type="text/javascript"src="../DataTables/DataTable/js/jquery.dataTables.js"></script>

            

<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

</body>

</html>