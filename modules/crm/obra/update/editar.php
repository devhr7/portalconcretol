<?php include '../../../../layout/validar_session4.php'; ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php'; ?>
<?php
// cargar Clases
$php_clases = new php_clases();
$t5_obras = new t5_obras();
$t1_terceros = new t1_terceros();
$oportunidad_negocio = new oportunidad_negocio();
$pedidos = new pedidos();
$id_obra  = $php_clases->HR_Crypt($_GET['id'], 2);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-10">
                    <h1>Obras</h1>
                </div>
                <div class="col">
                    <a class="btn btn-block btn-success" data-toggle="modal" data-target="#crear_pedido"> Crear pedido</a>
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
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="F_editar" id="F_editar" method="POST">
                        <?php
                        $datos_obra = $t5_obras->select_obras_id($id_obra);
                        while ($fila_obra = $datos_obra->fetch(PDO::FETCH_ASSOC)) {
                            $id_cliente = $fila_obra['ct5_IdTerceros'];
                            $NombreObra = $fila_obra['ct5_NombreObra'];
                            $direccion_obra = $fila_obra['ct5_DireccionObra'];
                            $id_departamento = $fila_obra['ct5_id_departamento'];
                            $id_municipio = $fila_obra['ct5_id_ciudad'];
                            $id_comuna = $fila_obra['ct5_id_comuna'];
                            $segmento = $fila_obra['ct5_segmento'];
                            $barrio = $fila_obra['ct5_barrio'];
                            $latitud = $fila_obra['latitud'];
                            $longitud = $fila_obra['longitud'];
                            $distanciaRMI = $fila_obra['distanciaRMI'];
                            $distanciaRZO = $fila_obra['distanciaRZO'];
                            $distanciaRMT = $fila_obra['distanciaRMT'];
                            $distanciaHND = $fila_obra['distanciaHND'];
                        }
                        ?>
                        <input type="hidden" value="<?php echo $id_obra ?>" name="id_obra" id="id_obra">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Datos de la obra</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 0.5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span class=" text_progresbar">0% </span> </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Cliente Pagador</label>
                                            <select class="js-example-basic-single select2 form-control" id="cliente" name="cliente" required>
                                                <?php echo $t1_terceros->option_cliente_edit($id_cliente); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Nombre de la Obra</label>
                                            <input name="nombre_obra" id="nombre_obra" type="text" class="form-control" placeholder="Digite el nombre" value="<?php echo $NombreObra ?>" required>
                                        </div>
                                    </div>
                                </div> <!-- Fin Row -->
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Departamento</label>
                                            <select name="departamento" id="departamento" class="form-control select2">
                                            <?php echo $oportunidad_negocio->select_departamento($id_departamento); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Ciudad</label>
                                            <select name="municipio" id="municipio" class="form-control select2">
                                            <?php echo  $oportunidad_negocio->select_municipio($id_departamento, $id_municipio) ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Zona/Comuna</label>
                                            <select name="comuna" id="comuna" class="form-control select2" required="true">
                                            <?php echo $oportunidad_negocio->select_comuna($id_municipio, $id_comuna) ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="">Barrio</label>
                                            <input type="text" name="barrio" id="barrio" class="form-control" value = "<?=$barrio?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Segmento</label>
                                            <select class="js-example-basic-single select2 form-control" name="segmento" id="segmento">
                                                <?= $t5_obras->select_segmentacion($segmento) ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Direccion</label>
                                            <input name="direccion" id="direccion" type="text" class="form-control" value="<?= $direccion_obra ?> ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Latitud</label>
                                            <input type="text" class="form-control" name="txt_latitud" id="txt_latitud" value="<?php echo $latitud; ?>" />
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Longitud</label> 
                                            <input type="text" class="form-control" name="txt_longitud" id="txt_longitud" value="<?php echo $longitud; ?>" />

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Distancia RMI</label> 
                                            <input type="text" class="form-control" name="txt_distanciaRMI" id="txt_distanciaRMI" value="<?php echo $distanciaRMI; ?>" />

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Distancia RZO</label> 
                                            <input type="text" class="form-control" name="txt_distanciaRZO" id="txt_distanciaRZO" value="<?php echo $distanciaRZO; ?>" />

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Distancia RMT</label> 
                                            <input type="text" class="form-control" name="txt_distanciaRMT" id="txt_distanciaRMT" value="<?php echo $distanciaRMT; ?>" />

                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Distancia HND</label> 
                                            <input type="text" class="form-control" name="txt_distanciaHND" id="txt_distanciaHND" value="<?php echo $distanciaHND; ?>" />

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block bg-gradient-orange" name="boton_guardar" id="boton_guardar"> Guardar </button>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button type="button" class="btn btn-block bg-gradient-red" name="btn-eliminar" id="btn-eliminar"> Eliminar </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal fade" id="crear_pedido">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">CREAR PEDIDO</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="form_crear_pedido" id="form_crear_pedido" method="post" content="width=device-width, initial-scale=1">
                                <div class="row">
                                    <div class="col">
                                        <label for="cliente">Cliente</label>
                                        <input type="text" name="cliente" id="cliente" class="form-control" disabled="true" value="<?= $pedidos->get_cliente($id_cliente) ?>" />
                                        <input type="hidden" name="id_cliente" id="id_cliente" class="form-control" value="<?= $id_cliente ?>" />
                                    </div>
                                    <div class="col">
                                        <label for="obra">Obra</label>
                                        <input type="text" name="obra" id="obra" class="form-control" disabled="true" value="<?= $NombreObra ?>" />
                                        <input type="hidden" name="id_obra" id="id_obra" class="form-control" value="<?= $id_obra ?>" />
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>FECHA DE VENCIMIENTO</label>
                                            <input type="date" name="fecha_vencimiento" id="fecha_vencimiento" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>ASESORA COMERCIAL</label>
                                            <select name="asesora_comercial" id="asesora_comercial" class="form-control select2" required style="width:100%">
                                                <?php echo $oportunidad_negocio->select_comercial() ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-4">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-block btn-success">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php include '../../../../layout/footer/footer4.php' ?>

<script>
    $(document).ready(function() {
        $(".progress").hide();
        $('.select2').select2();
        // Ciudad
        $.ajax({
            url: "get_data.php",
            type: "POST",
            data: {
                task: 1,
                id_departamento: <?php echo intval($id_departamento); ?>,
                id_municipio: <?php echo intval($id_municipio); ?>
            },
            success: function(response) {
                console.log(response.post);
                $('#departamento').html(response.departamento);
                $('#ciudad').html(response.ciudad);
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });

        // Departamento
        $("#departamento").change(function() {
            $.ajax({
                url: "load_data.php",
                type: "POST",
                data: {
                    'task': 1,
                    'id_departamento': $('#departamento').val()
                },
                dataType: 'json',
                success: function(data) {
                    $('#municipio').html(data.option_municipio);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
        $("#municipio").change(function() {
            $.ajax({
                url: "load_data.php",
                type: "POST",
                data: {
                    'task': 2,
                    'id_municipio': $('#municipio').val()
                },
                dataType: 'json',
                success: function(data) {
                    $('#comuna').html(data.option_comuna);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    });
</script>

<script>
    $(document).ready(function(e) {
        $("#btn-eliminar").click(function() {
            var id_obra = <?php echo $id_obra ?>;
            var url = "../index.php";
            $.ajax({
                url: "php_eliminar.php",
                type: "POST",
                data: {
                    id_obra: id_obra,
                },
                success: function(response) {
                    window.window.location = url;
                },

                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                    window.window.location = url;
                },
            });
        });

        $("#F_editar").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_editar.php",
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

    $(document).ready(function(e) {
        $("#form_crear_pedido").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                        window.location = '../../pedidos/editar/editar.php?id=' + data.id;
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