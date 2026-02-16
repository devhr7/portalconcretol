<?php include ("../../../layout/validar_session3.php") ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<?php include_once "../controlador/ControladorRequisiciones1.php"; 
$requisiciones = new ControladorRequisiciones();
$resultado = $requisiciones->listarRequisiciones();

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Productos</h1>
                    

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
                            
                        <form action="InsertarRequisicion.php" method="POST" enctype="multipart/form-data">
        
                        <h5 for="nombreProduct">Nombre del Producto:</h5>
                        <input class="form-control" type="text" name="nombreProduct" id="nombreProduct" required><br/>
                        <br>
                        <h5 for="cantidad">Cantidad:</h5>
                        <input class="form-control" type="number" name="cantidad" id="cantidad" required><br/>
                        <br>
                        <h5 for="unidad">Unidad de Medida:</h5>
                        <input class="form-control" type="text" name="unidad" id="unidad" required><br/>
                        <br>
                        <label class="form-check" for="txtId" hidden>ID</label>
                        <input class="form-control" type="text" name="txtId" id="txtId"  value= "<?php echo $rol_user; ?>" hidden readonly> <br>
                        <h5 for="lugar" >Lugar De Entrega:</h5>
                        <select class="form-control" type="text" name="lugar" id="lugar" required>
                        <option Value = "Mirolindo">Mirolindo</option>
                        <option Value = "Honda">Honda</option>
                        <option Value = "Torreon">Torreon</option>
                        </select><br/>
                        <h5 for="prioridad" >Prioridad:</h5>
                        <select class="form-control" type="text" name="prioridad" id="prioridad" required>
                        <option Value = "Alta">Alta</option>
                        <option Value = "Media">Media</option>
                        <option Value = "Baja">Baja</option>
                        </select><br/>
                        <br>
                        <h5> Descripción: </h5>
                        <textarea class="form-control"name="descripcion" id="descripcion"rows="10" cols="100" required></textarea>
                        <br><br>
                            <h5>Imagen:</h5>
                        <input class="form-control" class="form-check"type="file" name="img" id="img" src="img/">
                        <br><br><br>
                        <button type="submit" name="publicar" class="btn btn-info">Publicar</button>
                                                    
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