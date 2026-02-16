<?php include '../../../layout/validar_session3.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>
<?php
$t12_rolesu = new t12_rolesu();
$t1_terceros = new t1_terceros();
$php_clases = new php_clases();
$id = $php_clases->HR_Crypt($_GET['id'], 2);
$datos_t1 = $t1_terceros->search_tercero_custom_id($id);
$array_roles = array(1, 5);
$permisos = $php_clases->permisos($rol_user, $array_roles);

while ($fila = $datos_t1->fetch(PDO::FETCH_ASSOC)) {
    $ct1_NumeroIdentificacion = $fila['ct1_NumeroIdentificacion'];
    $ct1_Nombre1 = $fila['ct1_Nombre1'];
    $ct1_Nombre2 = $fila['ct1_Nombre2'];
    $ct1_Apellido1 = $fila['ct1_Apellido1'];
    $ct1_Apellido2 = $fila['ct1_Apellido2'];
    $ct1_rol = $fila['ct1_rol'];
}
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
                    <h1>Titulo</h1>
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
                <h3 class="card-title">Editar</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="F_editar" id="F_editar" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id ?>">

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Numero de Cedula de ciudadania</label>
                                    <input name="C_NumeroID" id="C_NumeroID" type="text" value="<?php echo $ct1_NumeroIdentificacion ?>" class="form-control" placeholder="Digite el numero de la Cedula">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nombre 1</label>
                                    <input name="C_nombre1" id="C_nombre1" type="text" value="<?php echo $ct1_Nombre1 ?>" class="form-control" placeholder="Digite el nombre">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Nombre 2</label>
                                    <input name="C_nombre2" id="C_nombre2" type="text" value="<?php echo $ct1_Nombre2 ?>" class="form-control" placeholder="Digite los Apellidos">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Apellido 1</label>
                                    <input name="C_apellido1" id="C_apellido1" type="text" value="<?php echo $ct1_Apellido1 ?>" class="form-control" placeholder="Digite el nombre">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Apellido 2</label>
                                    <input name="C_apellido2" id="C_apellido2" type="text" value="<?php echo $ct1_Apellido2 ?>" class="form-control" placeholder="Digite los Apellidos">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Selecciona Rol</label>
                                    <select class="js-example-basic-single select2 form-control" id="C_Rol" name="C_Rol">
                                        <?php echo $t12_rolesu->option_roles($ct1_rol); ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-block bg-gradient-orange" name="Actualizar" value="Actualizar" id="Guardar">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button type="button" class="btn btn-block bg-gradient-danger" id="btn-eliminar" <?php echo $permisos ?>> Eliminar Funcionario</button>
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

<script src="ajax_editar.js"></script>
<script>
    $(document).ready(function() {
        $("#btn-eliminar").click(function() {
            var url = "../index.php";
            var id_funcionario = "<?php echo $_GET['id'] ?>";
            Swal.fire({
                title: 'Esta seguro de eliminar este funcionario?',
                //text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "php_eliminar.php",
                        type: "POST",
                        data: {
                            id_funcionario: id_funcionario,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'Eliminnado!',
                                    'El funcionario ha sido eliminado correcctamente',
                                    'success'
                                )
                            }                            
                            window.location = url;
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                            window.location = url;
                        },

                    });






                }
            })




        });


    });
</script>

</body>

</html>