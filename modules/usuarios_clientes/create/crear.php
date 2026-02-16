<?php include '../../../layout/validar_session3.php' ?>
<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>
<?php $t1_terceros = new t1_terceros(); ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios Clientes</h1>
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
                <h3 class="card-title">Crear Usuario Cliente</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="F_crear" id="F_crear" method="POST">
                    <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nombres Completos</label>
                                    <input name="C_nombres" id="C_nombres" type="text" class="form-control" placeholder="Digite el nombre">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Apellidos Completos</label>
                                    <input name="C_Apellidos" id="C_Apellidos" type="text" class="form-control" placeholder="Digite los Apellidos">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Numero de Cedula de ciudadania</label>
                                    <input name="C_NumeroID" id="C_NumeroID" type="text" class="form-control" placeholder="Digite el numero de la Cedula">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> seleccione Rol</label>
                                    <select class="js-example-basic-single select2 form-control" id="txt_rol" name="txt_rol">
                                        <option value="102"> Arquitecto/Ingeniero Constructor</option>
                                        <option value="103"> Almacenista -(Solo visualiza Remisiones) </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-info">Guardar</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
<script src="ajax_crear.js"> </script>
<script>
    $(document).ready(function() {
        $('#C_IdTerceros').on('change', function() {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data: {
                    idCliente: ($('#C_IdTerceros').val()),
                    task: "1",
                },
                success: function(response) {
                    console.log(response.estado);
                    $('#C_Obras').html(response.obras);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    })
</script>
</body>
</html>