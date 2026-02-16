<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>EDITAR ELEMENTO</h1>
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
        $datos = $elementos->get_elementos_epp_id($id);

        if (is_array($datos)) {
            foreach ($datos as $dato) {
                $nombre_epp = $dato['id_epp'];
                $nombre_tipo_epp = $dato['id_tipo_epp'];
                $nombre_tamano = $dato['id_tamano'];
                $nombre_color = $dato['id_color'];
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
                    <form name="form_editar_elemento_epp" id="form_editar_elemento_epp" method="post" content="width=device-width, initial-scale=1">
                        <input type="hidden" name="id" id="id" value="<?=$id ?>">
                        <div class="row">
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>EPP</label>
                                    <select name="id_epp" id="id_epp" class="form-control select2 ">
                                        <?= $elementos->option_epp($nombre_epp); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tipo EPP</label>
                                    <select name="id_tipo_epp" id="id_tipo_epp" class="form-control select2 ">
                                        <?= $elementos->option_tipo_epp($nombre_tipo_epp); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Tamaño</label>
                                    <select name="id_tamano" id="id_tamano" class="form-control select2 ">
                                        <?= $elementos->option_tamano($nombre_tamano); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="form-group">
                                    <label>Color</label>
                                    <select name="id_color" id="id_color" class="form-control select2 ">
                                        <?= $elementos->option_color($nombre_color); ?>
                                    </select>
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
        $("#form_editar_elemento_epp").on('submit', (function(e) {
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
                title: 'Esta Seguro(a) de Eliminar el elemento EPP', // mensaje de la alerta
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