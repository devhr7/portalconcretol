<?php include ("../../../layout/validar_session3.php") ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<?php include_once "../controlador/ControladorRequisiciones1.php"; 
$requisiciones = new ControladorRequisiciones();
?>
<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>
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
            <div class="card-body">
                <div class="form-group">
                    <div class="row">
                        <div class="col">
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
                        $prioridad = $requisicion['PRIORIDAD'];
                        $descripcion = $requisicion['OBSERVACION']; 
                        $imagen = $requisicion['IMAGEN'];
                        }
                        
                        if($estado =="EN COTIZACION"){
                        ?>
                        <form action="ActualizarRequisicion.php" method="POST" enctype="multipart/form-data">

                        <div class="row col-xs-12">
                        <h5  style="width : 500px; heigth : 1px" for="nombreProduct">Nombre del Producto:</h5>
                        <h5 for="cantidad">Cantidad:</h5>
                        </div>
                        <div class="row col-xs-12">
                        <input style="width : 200px; heigth : 1px" class="form-control" type="text" name="nombreProduct" id="nombreProduct" value="<?php echo $nombre?>">
                        <span style="width : 300px; heigth : 1px" class="input-group-addon"></span>
                        <input style="width : 200px; heigth : 1px" class="form-control" type="number" name="cantidad" id="cantidad" value="<?php echo $cantidad?>"><br/>
                        <br>
                        </div>
                        <div class="row col-xs-12">
                        <h5 style="width : 500px; heigth : 1px" for="unidad">Unidad de Medida:</h5>
                        <h5 for="lugar" >Lugar De Entrega:</h5>
                        </div>
                        <div class="row col-xs-12">
                        <input style="width : 200px; heigth : 1px" class="form-control" type="text" name="unidad" id="unidad" value="<?php echo $unidad ?>" ><br/>
                        <br>
                        <label class="form-check" for="txtId" hidden>ID</label>
                        <input class="form-control" type="text" name="txtId" id="txtId"  value= "<?php echo $rolUser; ?>" hidden readonly> <br>
                        <span style="width : 300px; heigth : 1px" class="input-group-addon"></span>
                        <select style="width : 200px; heigth : 1px" class="form-control" type="text" name="lugar" id="lugar" required>
                        <option Value = "Mirolindo">Mirolindo</option>
                        <option Value = "Honda">Honda</option>
                        <option Value = "Torreon">Torreon</option>
                        </select><br/><br/>
                        </div>
                        <div class="row col-xs-12">
                        
                        <h5 style="width : 250px; heigth : 1px" for="lugar" ></h5>
                        <h5  for="unidad">Prioridad:</h5>
                        </div>
                        <div class="row col-xs-12">
                        <input style="width : 500px; heigth : 1px" class="form-control" type="text" name="" id="" value="" hidden ><br/>
                        <br>
                        <label class="form-check" for="txtId" hidden>ID</label>
                        <input class="form-control" type="text" name="txtId" id="txtId"  value= "<?php echo $rolUser; ?>" hidden readonly> <br>
                        <span style="width : 250px; heigth : 1px" class="input-group-addon"></span>
                        <select style="width : 200px; heigth : 1px" class="form-control" type="text" name="prioridad" id="prioridad" required>
                        <option Value = "Alta">Alta</option>
                        <option Value = "Media">Media</option>
                        <option Value = "Baja">Baja</option>
                        </select><br/><br/>
                        </div>
                        <h5> Descripción: </h5>
                        <textarea class="form-control"name="descripcion" id="descripcion"rows="10" cols="100" required><?php echo $descripcion ?></textarea>
                        <br><br>
                        <a class="btn btn-outline-secondary" href=<?php echo "../img/requisiciones/" .$imagen ; ?>>VER IMAGEN </a>
                        <br> <br>
                        <input type="checkbox" value="1" name="chec" id="chec" onchange="comprobar();"/><label for="chec">Selecionar Imagen</label>
                                            
                       <script>
                          function comprobar()
                                {   
                                    if (document.getElementById("chec").checked)
                                    document.getElementById('img').disabled = false;
                                    
                                        
                                    else
                                    document.getElementById('img').disabled = true;
                                    
                                        
                                }
                        </script>
                            
                            <h5>Imagen:</h5>
                            <input class="form-control" class="form-check" type="file" name="img" id="img" src="img/" disabled>
                        <label class="form-check" for="IdU" hidden>ID</label>
                        <input class="form-control" type="text" name="IdU" id="IdU"  value= "<?php echo $idr; ?>" hidden readonly> <br>
                        
                        
                        <br><br><br>
                        <button type="submit" name="publicar" class="btn btn-info">Modificar</button>                 
                        <?php 
                        }else{
                            ?>
                            <div class="row col-xs-12">
                        <h5  style="width : 500px; heigth : 1px" for="nombreProduct">Nombre del Producto:</h5>
                        <h5 for="cantidad">Cantidad:</h5>
                        </div>
                        <div class="row col-xs-12">
                        <input style="width : 200px; heigth : 1px" class="form-control" type="text" name="nombreProduct" id="nombreProduct" value="<?php echo $nombre?>" readonly>
                        <span style="width : 300px; heigth : 1px" class="input-group-addon"></span>
                        <input style="width : 200px; heigth : 1px" class="form-control" type="number" name="cantidad" id="cantidad" value="<?php echo $cantidad?>" readonly><br/>
                        <br>
                        </div>
                        <div class="row col-xs-12">
                        <h5 style="width : 500px; heigth : 1px" for="unidad">Unidad de Medida:</h5>
                        <h5 for="lugar" >Lugar De Entrega:</h5>
                        </div>
                        <div class="row col-xs-12">
                        <input style="width : 200px; heigth : 1px" class="form-control" type="text" name="unidad" id="unidad" value="<?php echo $unidad ?>" readonly><br/>
                        <br>
                        <label class="form-check" for="txtId" hidden>ID</label>
                        <input class="form-control" type="text" name="txtId" id="txtId"  value= "<?php echo $rolUser; ?>" hidden readonly> <br>
                        <span style="width : 300px; heigth : 1px" class="input-group-addon"></span>
                        <input style="width : 200px; heigth : 1px" class="form-control" type="text" name="lugar" id="lugar" value="<?php echo $lugar ?>" readonly><br/>
                        </select><br/><br/>
                        </div>
                        <div class="row col-xs-12">
                        
                        <h5 style="width : 250px; heigth : 1px" for="lugar" ></h5>
                        <h5  for="unidad">Prioridad:</h5>
                        </div>
                        <div class="row col-xs-12">
                        <input style="width : 500px; heigth : 1px" class="form-control" type="text" name="" id="" value="" hidden ><br/>
                        <br>
                        <label class="form-check" for="txtId" hidden>ID</label>
                        <input class="form-control" type="text" name="txtId" id="txtId"  value= "<?php echo $rolUser; ?>" hidden readonly> <br>
                        <span style="width : 250px; heigth : 1px" class="input-group-addon"></span>
                        <input style="width : 200px; heigth : 1px" class="form-control" type="text" name="lugar" id="lugar" value="<?php echo $prioridad ?>" readonly><br/>
                        </select><br/><br/>
                        </div>
                            <h5> Descripción: </h5>
                            <textarea class="form-control"name="descripcion" id="descripcion"rows="10" cols="100" readonly><?php echo $descripcion ?></textarea>
                            <br><br>
                            
                                <h5>Imagen:</h5>
                            <a class="btn btn-light" href=<?php echo "../img/requisiciones/" .$imagen ; ?>>VER </a>
                            <label class="form-check" for="IdU" hidden>ID</label>
                            <input class="form-control" type="text" name="IdU" id="IdU"  value= "<?php echo $idr; ?>" hidden readonly> <br>
                            <br><br><br>
                            <button type="submit" name="publicar" class="btn btn-info" disabled>Modificar</button> 
                        <?php
                        }
                        ?>
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
<script>
    $(document).ready(function() {
        $('#t_productos').DataTable();
    });
</script>

</body>

</html>