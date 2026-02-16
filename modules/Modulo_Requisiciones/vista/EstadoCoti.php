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
                        <?php
                        $idr = $_GET['id'];
                        $resultado = $requisiciones->listarRequisicion($idr);
                        while($requisicion = $resultado->fetch_assoc()){
                        $nombre = $requisicion['ITEM'];
                        $cantidad = $requisicion['CANTIDAD'];
                        $unidad = $requisicion['UNIDADDEMEDIDA'];
                        $rolUser = $requisicion['ROLUSER'];
                        $lugar = $requisicion['LUGAR'];
                        $descripcion = $requisicion['OBSERVACION']; 
                        $imagen = $requisicion['IMAGEN'];
                        }
                        ?>
                        <form action="ActualizarEstado.php" method="POST" enctype="multipart/form-data">
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
                        <br>
                        <h5> Descripción: </h5>
                        <textarea class="form-control"name="descripcion" id="descripcion"rows="10" cols="100" ><?php echo $descripcion ?></textarea>
                        <br><br>
                            <h5>Imagen:</h5>
                            <a class="btn btn-outline-secondary" href=<?php echo "../img/requisiciones/" .$imagen ; ?>>VER IMAGEN </a>
                        <label class="form-check" for="IdU" hidden>ID</label>
                        <input class="form-control" type="text" name="IdU" id="IdU"  value= "<?php echo $idr; ?>" hidden readonly> <br>
                        <h5>Estado:</h5> 
                        <select class="form-control" type="text" name="estado" id="estado">
                        <option Value = "EN COTIZACION">EN COTIZACION</option>
                        <option Value = "APROBADO">APROBADO</option>
                        <option Value = "DESAPROBADO">DESAPROBADO</option>
                        </select>
                        <br><br><br>
                        <button type="submit" name="publicar" class="btn btn-info">ACTUALIZAR ESTADO</button>                 
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

