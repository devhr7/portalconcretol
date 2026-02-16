<?php include ("../../../layout/validar_session3.php") ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<?php include_once "../controlador/ControladorRequisiciones1.php"; 
$requisiciones = new ControladorRequisiciones();
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
                        
                        <form action="CrearProveedor.php" method="POST" enctype="multipart/form-data">
                            <label for="nit">NIT: </label>
                            <input class="form-control"type="text" id="nit" name="nit">
                            <label for="razonS">Razon Social: </label>
                            <input class="form-control"type="text" id="razonS" name="razonS">
                            <label for="precio">Ubicacion: </label>
                            <input class="form-control" type="text" name="ubicacion" id="ubicacion" required>
                            <br>
                            <button type="submit" name="publicar" class="btn btn-warning">AÑADIR</button> 
                        </form>
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