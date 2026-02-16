<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>

<?php

switch ($rol_user) {
    case 1:
    case 8:
    case 9:
    case 10:
    case 11:
    case 12:
    case 13:
    case 14:
    case 15:
    case 16:
    case 17:
    case 20:
    case 29:
    case 22:
    case 26:
    case 27:
    case 32:
    case 33:
        $t26_remisiones = new t26_remisiones();
        $t1_terceros = new t1_terceros();
        $php_clases = new php_clases();
        $t5_obras = new t5_obras();
        $t10_vehiculo = new t10_vehiculo();
        break;

    default:
        print('<script> window.location = "../index.php"</script>');

        break;
}




$id_remision  = $_GET['id'];
//$id_remision  = $php_clases->HR_Crypt($_GET['id'], 2);

$array_roles = array(1, 8, 15,16,20, 22,29, 33);
$array_roles01 = array(1, 8, 15,16,20, 22);
$permisos = $php_clases->permisos($rol_user, $array_roles);
$permisos01 = $php_clases->permisos($rol_user, $array_roles01);

$datos_remision = $t26_remisiones->get_remision_id($id_remision);

while ($fila_remi = $datos_remision->fetch(PDO::FETCH_ASSOC)) {

    $id_obra = $fila_remi['ct26_idObra'];
    $nombre_obra = $fila_remi['ct26_nombre_obra'];

    $id_cliente = $fila_remi['ct26_idcliente'];
    $nombre_cliente = $fila_remi['ct26_razon_social'];
    $codigo_remi = $fila_remi['ct26_codigo_remi'];
    $img_remi = $fila_remi['ct26_imagen_remi'];
    $id_conductor = $fila_remi['ct26_conductor'];
    $id_placa = $fila_remi['ct26_id_vehiculo'];
    $placa = $fila_remi['ct26_vehiculo'];
    $estado = $fila_remi['ct26_estado'];

    $hora_salida_planta = $fila_remi['ct26_hora_salida_planta'];


    $hora_llegada_obra = $fila_remi['ct26_hora_llegada_obra'];

    $hora_inicio_descargue = $fila_remi['ct26_hora_inicio_descargue'];

    $hora_teminada_descargue = $fila_remi['ct26_hora_terminada_descargue'];

    $hora_llegada_planta = $fila_remi['ct26_hora_llegada_planta'];
}



?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Editar Remision</h1>
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



                <h3 class="card-title"><a href='editar_avanzado.php?id=<?php print_r($id_remision); ?>'><i class="fas fa-tools"></i></a> Remision <strong> <?php print_r($codigo_remi); ?> </strong></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="form_update" id="form_update" method="POST">
                        <input type="hidden" name="id" value="<?php echo $id_remision ?>" />

                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txt_cliente">Cliente</label>
                                    <h5><?php print_r($nombre_cliente); ?></h5>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="txt_cliente">Obra</label>
                                    <h5><?php print_r($nombre_obra); ?></h5>
                                </div>
                            </div>
                            <div class="col-4">
                                <?php



                                switch ($estado) {
                                    case 1:
                                        $clase_status = "bg-gradient-success";
                                        $text_status = "FACTURADA";
                                        break;

                                    case 2:
                                        $clase_status = "bg-gradient-info";
                                        $text_status = "POR FACTURAR";
                                        break;

                                    case 3:
                                        $clase_status = "bg-gradient-warning";
                                        $text_status = "FALTA FIRMA";
                                        break;

                                    case 4:
                                        $clase_status = "bg-gradient-navy";
                                        $text_status = "POR SINCRONIZAR";
                                        break;
                                    case 5:
                                    $clase_status = "bg-gradient-navy";
                                    $text_status = "CONSUMO INTERNO";
                                    break;

                                    case 10:
                                        $clase_status = "bg-gradient-danger";
                                        $text_status = "ANULADA";
                                        break;

                                    default:
                                        $clase_status = "bg-gradient-gray";
                                        $text_status = "ERROR";
                                        break;
                                }

                                ?>
                                <div class="info-box <?php print_r($clase_status); ?>">
                                    <div class="info-box-content" align="center">
                                        <span class="info-box-text">
                                            <h3> <strong><?php print_r($text_status) ?></strong> </h3>
                                        </span>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" id="check_habilitar" name="check_habilitar" value="1">
                                            <label for="check_habilitar">
                                                Seleccione Subir Remision fisica
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Subir Imagen</label>
                                    <input type="radio" class="form-control tipoarchivo" name="subirtipo" value="image/x-png,image/jpeg" required checked="">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <label>Subir PDF</label>
                                    <input type="radio" class="form-control tipoarchivo" name="subirtipo" value="application/pdf" required>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <?php
                                    if (empty($img_remi)) {
                                        $img_remi = "../ver_remision/remision.php?id=" .  $php_clases->HR_Crypt($id_remision, 1);
                                    }
                                    ?>
                                    <a target="_blank" href="<?php echo $img_remi ?>" class="btn btn-info"> <i class="fas fa-eye"></i> Ver Remision</a>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div>
                                        <input type="file" class="form-control" name="imgfiles" id="imgfiles" accept="image/x-png,image/jpeg" disabled="disabled" required="required" />
                                        <label class="" for="imgfiles">Seleccionar Archivo</label>
                                    </div>
                                    <!-- <input class="form-control" type="file" name="imgfiles2" id="imgfiles2" accept="image/x-png,image/jpeg" disabled="disabled" />
                                    <label class="custom-file-label" for="imgfiles2">Choose file</label> !-->
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <?php

                                    switch ($rol_user) {
                                        case 1:
                                        case 9:
                                        case 14:
                                        case 15:
                                        case 16:
                                        case 20:
                                        case 22:
                                        case 26:
                                        

                                            $disabled = "  ";
                                            break;

                                        default:
                                            $disabled = " disabled = 'true' ";
                                            break;
                                    }

                                    ?>
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="checkbox" value="1" name="check_habilitar_horas" id="check_habilitar_horas" <?php print_r($disabled); ?>>
                                            <label for="check_habilitar_horas">
                                                Seleccione para editar Horas
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="h_salida_mix_planta">HORA DE SALIDA MIXER DE PLANTA</label>

                                    <input type="time" name="h_salida_mix_planta" id="h_salida_mix_planta" value='<?php echo $hora_salida_planta ?>' disabled="disabled">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="h_llegada_mix_obra">HORA DE LLEGADA MIXER A OBRA</label>
                                    <input type="time" name="h_llegada_mix_obra" id="h_llegada_mix_obra" value="<?php echo $hora_llegada_obra ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="h_inicio_descargue">HORA DE INICIO DE DESCARGUE</label>
                                    <input type="time" name="h_inicio_descargue" id="h_inicio_descargue" value="<?php echo $hora_inicio_descargue ?>" disabled="disabled">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="h_terminacion_descargue">HORA DE TERMINACION DE DESCARGUE</label>
                                    <input type="time" name="h_terminacion_descargue" id="h_terminacion_descargue" value="<?php echo $hora_teminada_descargue ?>" disabled="disabled">
                                </div>
                            </div>

                            <div class="col">
                                <div class="form-group">
                                    <label for="h_llegada_mix_planta">HORA DE LLEGADA MIXER EN PLANTA</label>
                                    <input type="time" name="h_llegada_mix_planta" id="h_llegada_mix_planta" value="<?php echo  $hora_llegada_planta ?>" disabled="disabled">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block bg-gradient-success" name="btn_actualizar_remi" id="btn_actualizar_remi"> Actualizar</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-block bg-gradient-primary" data-toggle="modal" data-target="#modal-novedades"> <i class="fas fa-info-circle"></i> Novedades</button>
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-block bg-gradient-orange" data-toggle="modal" data-target="#modal-anular" <?php echo $permisos ?>> <i class="fas fa-ban"></i> Anular</button>
                                </div>
                            </div>

                            <!-- /.modal -->
                            <div class="col-3"></div>
                            <div class="col-3">
                                <div class="form-group">
                                    <button type="button" class="btn btn-block bg-gradient-danger" data-toggle="modal" data-target="#modal-eliminar" <?php echo $permisos01 ?>> <i class="fas fa-trash"></i> Eliminar Remision</button>
                                </div>


                            </div>


                            <!---------------------------------------------------------------------------------  -->

                    </form>




                </div>
                <!-- </form> -->
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <div class="modal fade" id="modal-novedades">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Escriba las novedades de esta remision</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">

                                <textarea class="form-control" rows="3" name="txt_novedades" id="txt_novedades" maxlength="700"></textarea>

                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-success" id="btn-novedad">Guardar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal-anular">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Esta seguro de anular la remision </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Escriba la Razon de anular la remision</label>
                                <input type="text" name="txt_rz_anular" id="txt_rz_anular" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger" id="btn-anular">anular</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <div class="modal fade" id="modal-eliminar">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Esta seguro de eliminar la remision </h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Escriba la Razon de eliminar la remision</label>
                                <input type="text" name="txt_rz_eliminar" id="txt_rz_eliminar" class="form-control" required>
                            </div>
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-danger" id="btn-eliminar">Eliminar</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
        </div>
</div>

</section>
</div>



<?php include '../../../layout/footer/footer3.php' ?>


<script>
    $(document).ready(function() {
        $('.select2').select2();

    });
    $(document).ready(function() {
        $('.tipoarchivo').change(function() {
            $('#imgfiles').attr("accept", $('input[name=subirtipo]:checked').val());
        });
    });
</script>

<script>
    $(document).ready(function() {
        $("#form_update").on('submit', (function(e) {
            e.preventDefault();

            $.ajax({
                url: "php_editar.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {

                    const datos_errores = Object.values(data.errores);
                    console.log(datos_errores);
                    if (data.estado) {
                        toastr.success('exitoso');

                    } else {
                        for (let index = 0; index < datos_errores.length; index++) {

                            toastr.warning(data.errores[index]);
                        }
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });

    $(document).ready(function() {


        $("#btn-novedad").click(function() {




            var id_remi = "<?php echo $_GET['id'] ?>";

            var txt_novedades = $('#txt_novedades').val();


            $.ajax({
                url: "php_novedades.php",
                type: "POST",
                data: {
                    id_remi: id_remi,
                    txt_novedades: txt_novedades,
                },
                success: function(response) {
                    console.log(response.estado);
                    if (response.estado) {
                        toastr.success("Novedad Guardada Correctamente");

                    } else {
                        toastr.warning("Error al guardar la novedad");
                        toastr.warning("Contactar con el Administrador");
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                    window.window.location = url;
                },

            });
        });





        $("#btn-eliminar").click(function() {




            var id_remi = "<?php echo $_GET['id'] ?>";
            var url = "../index.php";
            var txt_rz_eliminar = $('#txt_rz_eliminar').val();


            $.ajax({
                url: "php_eliminar.php",
                type: "POST",
                data: {
                    id_remi: id_remi,
                    txt_rz_eliminar: txt_rz_eliminar,


                },
                success: function(response) {
                    console.log(response.estado);
                    if (response.estado) {
                        window.window.location = url;
                    } else {
                        toastr.warning("Error al eliminar la remision");
                        toastr.warning("Contactar con el Administrador");
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                    window.window.location = url;
                },

            });
        });
        $("#btn-anular").click(function() {

//var url = "../index.php";
$.ajax({
    url: "php_anular.php",
    type: "POST",
    data: {
        'id_remi': <?php echo $_GET['id'] ?>,
        'rz_anular': $('#txt_rz_anular').val()
    },
    success: function(response) {
        if (response.estado) {
            toastr.success("Anulo Exitosamente la remision");
            location.reload();

        } else {
            toastr.warning("Error al anular la remision");
            toastr.warning("Contactar con el Administrador");
        }
    },
    error: function(respuesta) {
        alert(JSON.stringify(respuesta));
    },

});
});

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

<script>
    $(document).ready(function() {

        $('#check_habilitar').click(function() {
            if (!$(this).is(':checked')) {

                $("#imgfiles").attr('disabled', true);
            } else {
                $("#imgfiles").attr('disabled', false);
            }
        });

        $('#check_habilitar_horas').click(function() {
            if (!$(this).is(':checked')) {
                $("#h_salida_mix_planta").attr('disabled', true);
                $("#h_llegada_mix_obra").attr('disabled', true);
                $("#h_inicio_descargue").attr('disabled', true);
                $("#h_terminacion_descargue").attr('disabled', true);
                $("#h_llegada_mix_planta").attr('disabled', true);
            } else {
                $("#h_salida_mix_planta").attr('disabled', false);
                $("#h_llegada_mix_obra").attr('disabled', false);
                $("#h_inicio_descargue").attr('disabled', false);
                $("#h_terminacion_descargue").attr('disabled', false);
                $("#h_llegada_mix_planta").attr('disabled', false);
            }
        });

    });
</script>






</body>

</html>