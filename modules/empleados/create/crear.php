<?php include '../../../layout/validar_session3.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>
<?php
$t12_rolesu = new t12_rolesu();
?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Empleados</h1>
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
                <h3 class="card-title">Crear</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="form_crear" id="form_crear" method="POST">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Numero de Cedula de ciudadania</label>
                                    <input name="num_ced" id="num_ced" type="text" class="form-control" placeholder="Digite el numero de la Cedula">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nombre 1</label>
                                    <input name="C_nombre1" id="C_nombre1" type="text" class="form-control" placeholder="Digite el nombre">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Nombre 2</label>
                                    <input name="C_nombre2" id="C_nombre2" type="text" class="form-control" placeholder="Digite los Apellidos">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Apellido 1</label>
                                    <input name="C_apellido1" id="C_apellido1" type="text" class="form-control" placeholder="Digite el nombre">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Apellido 2</label>
                                    <input name="C_apellido2" id="C_apellido2" type="text" class="form-control" placeholder="Digite los Apellidos">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Selecciona Rol</label>
                                    <select class="js-example-basic-single select2 form-control" id="C_Rol" name="C_Rol">
                                        <?php echo $t12_rolesu->option_roles(null); ?>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success" name="guardar" id="guardar">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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

<?php include '../../../layout/footer/footer3.php' ?>

<script src="ajax_crear.js">
    
</script>



<script>
    $(function() {
        $('.select2').select2()
    });
    $(document).ready(function(e) {
        $("#form_crear").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data.estado);
                    if (data.estado) {
                        toastr.success('exitoso');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });
</script>

</body>

</html>