<?php include '../../layout/validar_session2.php' ?>
<?php include '../../layout/head/head2.php'; ?>
<?php include 'sidebar.php' ?>
<?php include_once "controlador/ControladorRequisiciones.php"; 


?>

<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="DataTables/DataTable/css/dataTables.bootstrap.min.css"/>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Items</h1>
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
            <?php 
                            if ($rol_user == 23 or $rol_user == 24){
                               
                                $requisiciones = new ControladorRequisiciones();
                                $resultado = $requisiciones->listarRequisiciones(); 
                                
                            }

                            else{
                            
                            $requisiciones = new ControladorRequisiciones();
                            $resultado = $requisiciones->listarRequi($rol_user);
                            }
                            ?>
                           
                            
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
                            
                            <a  href="vista/crearRequisicion.php"><button class="btn btn-secondary"> Crear </button></a>
                            
                            <?php
                            if ($rol_user == 23 or $rol_user == 24){?>
                            <a  href="vista/Cotizaciones.php"><button class="btn btn-secondary"> Añadir Cotizacion</button></a>
                            <?php }?>
                            
                            <?php if ($rol_user !== 23  ){ 
                                        ?>
                            <table class="table table-striped table-borderer" name ="myTable" id="myTable">
                                <thead >
                                    <tr>
                                        <th>FECHA</th>
                                        <th>PRODUCTO</th>
                                        <th>UNIDAD DE MEDIDA</th>
                                        <th>CANTIDAD</th>
                                        <th>ESTATUS</th>
                                        <th>PRIORIDAD</th>
                                        <th>OBSERVACIONES</th>
                                        <th >OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                     <?php 
                                    
                                    while($requisicion = $resultado->fetch_assoc()){
                                        $estadoRequi = $requisicion['ESTADOREQUI'];
                                        $item = $requisicion['ITEM'];
                                        ?>
                                    
                                    <td ><?php if ($item != null){echo $requisicion['FECHA']; } else { echo "-";}?> </td>
                                    <td><?php if ($item != null){echo $requisicion['ITEM']; } else { echo "-";}?></td>
                                    <td><?php if ($item != null){echo $requisicion['UNIDADDEMEDIDA']; } else { echo "-";}?></td>
                                    <td><?php if ($item != null){echo $requisicion['CANTIDAD']; } else { echo "-";} ?></td>
                                    <td <?php if ($estadoRequi == "EN COTIZACION"){ ?>  class="card text-white bg-warning mb-3" <?php } ?>
                                    <?php if ($estadoRequi == "DESAPROBADO"){ ?> class="card text-white bg-danger mb-3" <?php } ?> 
                                    <?php if ($estadoRequi == "APROBADO"){ ?> class="card text-white bg-success mb-3" <?php } ?>  ><?php if ($item != null){ echo $requisicion['ESTADOREQUI']; } else { echo "-";}  ?></td>
                                    <td><?php if ($item != null){echo $requisicion['PRIORIDAD']; } else { echo "-";}?> </td>
                                    <td><?php echo $requisicion['OBSERVACION'] ?></td>
                                    <td> <a class="btn btn-success" href=<?php echo "vista/updateRequisicion.php?id=" . $requisicion['IDREQUISICION']; ?>>Editar </a>
                                    |
                                    <a class="btn btn-danger" href=<?php echo "vista/eliminarRequisicion.php?id=" . $requisicion['IDREQUISICION']; ?>
                                         onclick="return confirm('¿Desea borrar esta requisicion?');" >Eliminar</a> 
                                    </td>
        </tr>
            <?php    
                } 
            ?>
        </tbody>
    </table>
    <?php }
                        if ($rol_user == 23 or $rol_user == 24){?>
                        <table class="table table-striped table-borderer" name ="myTable" id="myTable1">
                                <thead >
                                    <tr>
                                        <th>FECHA</th>
                                        <th>PRODUCTO</th>
                                        <th>UNIDAD DE MEDIDA</th>
                                        <th>CANTIDAD</th>
                                        <th>ESTATUS</th>
                                        <th>PRIORIDAD</th>
                                        <th>OBSERVACIONES</th>
                                        <th>OPCIONES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                     <?php 
                                
                                    while($requisicion = $resultado->fetch_assoc()){
                                        $estadoRequi = $requisicion['ESTADOREQUI'];
                                        ?>
                                    
                                    <td><?php echo $requisicion['FECHA'] ?> </td>
                                    <td><?php echo $requisicion['ITEM'] ?></td>
                                    <td><?php echo $requisicion['UNIDADDEMEDIDA'] ?></td>
                                    <td><?php echo $requisicion['CANTIDAD'] ?></td>
                                    <td <?php if ($estadoRequi == "EN COTIZACION"){ ?>  class="card text-white bg-warning mb-3" <?php } ?>
                                    <?php if ($estadoRequi == "DESAPROBADO"){ ?> class="card text-white bg-danger mb-3" <?php } ?> 
                                    <?php if ($estadoRequi == "APROBADO"){ ?> class="card text-white bg-success mb-3" <?php } ?>  ><?php echo $requisicion['ESTADOREQUI'] ?></td>
                                    <td><?php echo $requisicion['PRIORIDAD'] ?></td>
                                    <td><?php echo $requisicion['OBSERVACION'] ?></td>
                                    <td> <a class="btn btn-info" href=<?php echo "vista/Cotizacion.php?id=" . $requisicion['IDREQUISICION']; ?>>Precios </a>  
                                    |
                                    <a class="btn btn-light" href=<?php echo "vista/EstadoCoti.php?id=" . $requisicion['IDREQUISICION']; ?>>Estado </a>  

                                </td>
                                </tr>
            <?php
                                    }  
                                
                            
            ?>
            </tbody>
    </table>
    <?php }?>
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
<?php include '../../layout/footer/footer2.php' ?>

<script type="text/javascript"src="DataTables/datatables.min.js"></script>
<script type="text/javascript"src="js/popper.min.js"></script>
<script type="text/javascript"src="js/bootstrap.min.js"></script>
<script type="text/javascript"src="js/jquery-3.6.4.min.js"></script>
<script type="text/javascript"src="DataTables/DataTable/js/jquery.dataTables.js"></script>

            

<script type="text/javascript"src="js/main.js"></script>
<script>
            $(document).ready(function () {
            $('#myTable').DataTable();
        });
        </script>
<script>
            $(document).ready(function () {
            $('#myTable1').DataTable();
        });
        </script>
</body>

</html>