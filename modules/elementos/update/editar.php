<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SALIDAS EPP PARA FUNCIONARIOS</h1>
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
    <section class="content">
        <?php
        $elementos = new elementos();
        $id = $_GET['id'];
        $datos = $elementos->get_salida_epp_id($id);

        if (is_array($datos)) {
            foreach ($datos as $dato) {
                $fecha = $dato['fecha'];
                $id_empleado = $dato['id_empleado'];
                $id_cargo = $dato['id_cargo'];
                $id_area = $dato['id_area'];
                $id_elemento_epp = $dato['id_elemento_epp'];
                $cantidad = $dato['cantidad'];
            }
        }
        ?>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">EDITAR ELEMENTOS</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 0.5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span class=" text_progresbar">0% </span>
                    </div>
                </div>
                <div id="contenido">

                    <form name="form_editar_salida_epp" id="form_editar_salida_epp" method="post">
                        <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="fecha">Fecha</label>
                                    <input type="date" name="fecha" id="fecha" class="form-control" value="<?= $fecha ?>" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="id_empleado">Empleado</label>
                                    <select class="select2 form-control" name="id_empleado" id="id_empleado">
                                        <?= $elementos->option_empleados($id_empleado); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="id_epp">Elementos EPP</label>
                                    <select class="select2 form-control" name="id_epp" id="id_epp">
                                        <?= $elementos->option_descripcion_epp($id_elemento_epp) ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="cantidad">Cantidad</label>
                                    <input type="number" name="cantidad" id="cantidad" class="form-control" value="<?= $cantidad ?>" required="true" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="button" id="btn-eliminar" name="btn-eliminar" class="btn btn-block btn-danger"> <i class="fas fa-trash"></i> Eliminar</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success"> <i class="fas fa-save"></i> Guardar</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <!-- Default box -->
    </section>
</div>
<?php include '../../../layout/footer/footer3.php' ?>

<script>
    $(function() {
        $(".progress").hide();
        $('.select2').select2();
    });

    $(document).ready(function(e) {
        $("#form_editar_salida_epp").on('submit', (function(e) {
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
                        toastr.success('Se ha guardado correctamente');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
        $("#btn-eliminar").click(function() {
            var id = <?php echo $id ?>;
            Swal.fire({
                title: 'Esta Seguro(a) de Eliminar la salida del EPP', // mensaje de la alerta
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
                                    'El elemento epp fue eliminada correctamente',
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