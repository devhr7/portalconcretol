<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- Titulo de pagina -->
                    <h1>IMPORTAR PRECIOS BASE</h1>
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
                <h3 class="card-title"> </h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <!-- formulario de productos -->
                <form name="form_productos" id="form_productos" method="post">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label>Seleccione una opcion</label>
                                <select class="select2 form-control" name="id_select_producto" id="id_select_producto">
                                    <option selected disabled value="">Seleccione</option>
                                    <option value="1">Actualizar toda la lista</option>
                                    <option value="2">Adicionar precios</option>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label>Seleccionar Archivo</label>
                                <!-- input para seleccionar el archivo -->
                                <input type="file" class="form-control" name="file_productos" id="file_productos" disabled="true" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <!-- boton para guardar el archivo -->
                                <button type="submit" class="btn btn-success" name="btn_subirarchivo" id="btn_subirarchivo" onclick="return confirm('¿Desea agregar los productos?')">
                                <i class="fas fa-upload"></i> Subir
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
        </div>
    </section>
</div>

<?php include '../../../../layout/footer/footer4.php' ?>

<script>
    $(function() {
        $(".progress").hide();
        $('.select2').select2();
    });

    // subir Archivo
    $("#id_select_producto").change(function() {
        var producto = $("#id_select_producto").val();
        console.log(producto);
        if (producto == 1) {
            $("#file_productos").attr('disabled', false);
            $("#form_productos").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "ajax_productos_uno.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        if (data.estado) {
                            toastr.success('Guardado Correctamente');
                        } else {
                            toastr.info(data.result);
                        }
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                        location.reload();
                    }
                });
            }));
        } else if (producto == 2) {
            $("#file_productos").attr('disabled', false);
            $("#form_productos").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "ajax_productos_dos.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        if (data.estado) {
                            toastr.success('Guardado Correctamente');
                        } else {
                            toastr.info(data.result);
                        }
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                        location.reload();
                    }
                });
            }));
        } else {
            $("#file_productos").attr('disabled', true);
        }
    });
</script>
</body>

</html>