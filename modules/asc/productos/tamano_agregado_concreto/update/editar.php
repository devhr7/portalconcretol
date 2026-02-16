<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; ?>

<?php
//Se crea un objeto de la clase t23_tamano_agregado
$t23_tamano_agregado = new t23_tamano_agregado();
//Se crea un objeto de la clase php_clases
$php_clases = new php_clases();
//Se obtiene el id
$id_producto = $_GET['id'];
//Se le asigna una variable al objeto de t23_tamano_agregado y se llama una funcion llamada get_tamano_agregado_concre_id y tiene como parametro el id
$datos_producto = $t23_tamano_agregado->get_tamano_agregado_concre_id($id_producto);
//Se verifica si la variable que se le asigno al objeto t23_tamano_agregado es un arreglo o no
if (is_array($datos_producto)) {
    foreach ($datos_producto as $key) {
        $CodTAC = $key['ct23_CodTAC'];
        $DescripcionTAC = $key['ct23_DescripcionTAC'];
    }
} else {
    echo "no es un array";
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tamaño agregado del concreto</h1>
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
                <h3 class="card-title">Modificar tamaño agregado del concreto</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <!-- Inicio del formulario -->
                    <form method="POST" name="FormModificarTamanoAgregado" id="FormModificarTamanoAgregado">
                        <input type="hidden" name="txt_id" id="txt_id" value="<?php echo $id_producto ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Codigo resistencia Concreto </label>
                                    <input type="text" class="form-control" id="txt_CodTAC" name="txt_CodTAC" value="<?php echo $CodTAC ?>" maxlength="2">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label> Descripcion RC </label>
                                    <input type="text" class="form-control" id="txt_DescripcionTAC" name="txt_DescripcionTAC" value="<?php echo $DescripcionTAC ?>">
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row" style="text-align:center">
                                <!-- Boton eliminar -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="button" id="btn-eliminar" name="btn-eliminar" class="btn btn-block btn-danger">Eliminar</button>
                                    </div>
                                </div>
                                <!-- Boton guardar -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-block btn-success">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- Fin del formulario -->
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

<?php include '../../../../layout/footer/footer4.php' ?>
<script>
    //Esta funcion ayuda a modificar los datos de la tabla tamaño agregado del concreto mediante el id del formulario FormModificarTamanoAgregado
    $(document).ready(function(e) {
        $("#FormModificarTamanoAgregado").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_editar.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
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
        //Este formulario ayuda a eliminar los datos de la tabla tamaño agregado del concreto mediante el id del boton btn-eliminar
        $("#btn-eliminar").click(function() {
            var id = <?php echo $id_producto ?>;
            Swal.fire({
                title: 'Esta Seguro(a) de Eliminar el tamaño agregado del concreto', // mensaje de la alerta
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'No', // text boton
                confirmButtonText: 'Si Eliminar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "php_eliminar.php",
                        type: "POST",
                        data: {
                            task: 1,
                            id: id,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'El tamaño agregado del concreto fue eliminada correctamente',
                                    'success'
                                )
                                window.location = '../index.php'
                            } else {
                                console.log("error");

                            }
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });
                }
            })
        });
    });
</script>
</body>

</html>