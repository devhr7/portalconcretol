<?php include ("../../../layout/validar_session3.php") ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<?php include_once "../controlador/ControladorRequisiciones1.php"; 
$requisiciones = new ControladorRequisiciones();
?>
<link rel="stylesheet" type="text/css" href="../css/micss.css"/>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Item</h1>

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
                            

                        


                        </div>
                    </div>
                </div>
                <div id="contenido">
                
                    <?php
                        $idr = $_GET['id'];
                        $resultado = $requisiciones->listarRequisicion($idr);
                        while($requisicion = $resultado->fetch_assoc()){
                        $nombre = $requisicion['ITEM'];
                        $cantidad = $requisicion['CANTIDAD'];
                        $unidad = $requisicion['UNIDADDEMEDIDA'];
                        $rolUser = $rol_user;
                        $lugar = $requisicion['LUGAR'];
                        $estado = $requisicion['ESTADOREQUI'];
                        $descripcion = $requisicion['OBSERVACION']; 
                        $precio = $requisicion['PRECIO'];
                        $img = $requisicion['IMAGEN'];
                        }
                            ?>
                            <div class="row col-xs-12">
                            <h5 style="width : 250px; heigth : 1px" for="nombreProduct">Nombre del Producto:</h5>
                            <h5 style="width : 250px; heigth : 1px"for="cantidad">Cantidad:</h5>
                            <h5 style="width : 250px; heigth : 1px" for="lugar" >Precio Producto:</h5>
                            <h5>Imagen:</h5>
                            </div>
                             
                            <div class="row col-xs-12">
                            <FONT COLOR="green"><label style="width : 200px; heigth : 1px"for=""><?php echo $nombre?></label></FONT>
                            <span style="width : 50px; heigth : 1px" class="input-group-addon"></span>
                            <FONT COLOR="green"><label style="width : 200px; heigth : 1px"for=""><?php echo $cantidad?></label></FONT>
                            <span style="width : 50px; heigth : 1px" class="input-group-addon"></span>
                            <FONT COLOR="green"><label style="width : 200px; heigth : 1px"for=""><?php echo $precio?></label></FONT>
                            <span style="width : 50px; heigth : 1px" class="input-group-addon"></span>
                            <a style="width : 120px; heigth : 1px" class="btn btn-light" href=<?php echo "../img/requisiciones/" .$img ; ?>>VER </a>    
                            
                            </div>
                            
                            
                            <br><br><br>
                        <table class="table">
                                <thead >
                                    <tr>
                                        
                                        <th>✓</th>
                                        <th>FECHA</th>
                                        <th>PROVEEDOR</th>
                                        <th>PRECIO COTIZACION</th>
                                        <th>OPCIONES</th>
                                </thead>
                                <tbody>
                                <tr>
                                <form action="SeleccionarCoti.php" method="POST" enctype="multipart/form-data">
                                     <?php 
                                    if ($rol_user == 23 or $rol_user == 24){
                                    $resultado1 = $requisiciones->seleccionarCoti($idr);                             
                                    while($requisicion = $resultado1->fetch_assoc()){
                                        $archivo=$requisicion['ARCHIVO'];
                                        $seleccion = $requisicion['SELECCION'];
                                        $idchr = $requisicion['IDCHR'];
                                        
                                        ?>
                                    
                                    <td <?php if($seleccion==1){ ?> style="background-color:#C4D79B" <?php } ?> ><input type="checkbox" name="id[]" value="<?php echo $requisicion['IDCHR']; ?>"></td>
                                    <td <?php if($seleccion==1){ ?> style="background-color:#C4D79B" <?php } ?> ><?php echo $requisicion['FECHA']?> </td>
                                    <td <?php if($seleccion==1){ ?> style="background-color:#C4D79B" <?php } ?> ><?php echo $requisicion['RAZONSOCIAL'] ?></td>
                                    <td <?php if($seleccion==1){ ?> style="background-color:#C4D79B" <?php } ?> ><?php echo $requisicion['PRECIO'] ?></td>
                                    <td <?php if($seleccion==1){ ?> style="background-color:#C4D79B" <?php } ?>  ><a class="btn btn-warning" href=<?php echo "../img/" .$archivo ; ?>>VER </a></td>

                                </td>
                            
                                        
                                </tr>
                                
            <?php
                                    
                            
                                }
                            }
            ?>
        
                                    <tr>
                                    
                            </tr>
                            <button type="submit" name="publicar" class="btn btn-info" >Seleccionar</button> 
                                </form>
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

<script>
    $(document).ready(function() {
        $('#t_productos').DataTable();
    });
</script>

</body>

</html>