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
                    <h1> OPORTUNIDAD DE NEGOCIO </h1>
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
        <?php
        /**
         * Validacion de Usuario
         */
        $op = new oportunidad_negocio();

        if (is_array($array_data = $op->getdata_oportunidad_negocio_for_id(intval($_GET['id'])))) {
            foreach ($array_data as $fila) {
                $id_comercial = $fila['asesora_comercial'];

                $data_array['fecha_contacto'] = $fila['fecha_contacto'];
                $fecha_contacto = $fila['fecha_contacto'];
                $tipo_cliente = $fila['tipo_cliente'];
                $tipo_plan_maestro = $fila['tipo_plan_maestro'];
                $departamento =  $fila['departamento'];
                $municipio =  $fila['municipio'];
                $comuna = $fila['comuna'];
                $barrio = $fila['barrio'];
                $nidentificacion = $fila['nidentificacion'];
                $razon_social = $fila['razon_social'];
                $nombres_completos = $fila['nombrescompletos'];
                $apellidos_completos = $fila['apellidoscompletos'];
                $nombre_obra = $fila['nombre_obra'];
                $direccion_obra = $fila['direccion_obra'];
                $telefono_cliente = $fila['telefono_cliente'];
                $nombre_maestro = $fila['nombre_maestro'];
                $celular_maestro = $fila['celular_maestro'];
                $m3_potenciales = $fila['m3_potenciales'];
                $fecha_posible_fundida = $fila['fecha_posible_fundida'];
                $resultado = $fila['resultado'];
                $contacto_cliente = $fila['contacto_cliente'];
                $observacion = $fila['observacion'];
                $status_op = $fila['status_op'];
            }
        }
        ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">EDITAR OPORTUNIDAD DE NEGOCIO : <b><?php echo $_GET['id']; ?></b></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 0.5%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> <span class=" text_progresbar">0% </span> </div>
                </div>
                <div id="contenido">
                    <form name="form_edit_op" id="form_edit_op" method="post">
                        <input type="hidden" name="id_oportunidad_negocio" id="id_oportunidad_negocio" value="<?php echo $_GET['id']; ?>" />

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_hab_asesora_comercial" id="check_hab_asesora_comercial" ?>
                                        <label for="check_hab_asesora_comercial">
                                            Habilitar
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_hab_fecha_contacto" id="check_hab_fecha_contacto" ?>
                                        <label for="check_hab_fecha_contacto">
                                            Habilitar
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Asesora Comercial</label>
                                    <select name="asesora_comercial" id="asesora_comercial" class="form-control select2" disabled="true">
                                        <?php echo $op->select_comercial($id_comercial) ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Fecha Contacto</label>
                                    <input type="date" name="fecha_contacto" id="fecha_contacto" class="form-control" value="<?php echo $fecha_contacto ?>" disabled="true"/>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Tipo Cliente</label>
                                    <select name="tipo_cliente" id="tipo_cliente" class="form-control select2" disabled="true">
                                        <?php echo $op->select_tipo_cliente($tipo_cliente) ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label>Tipo PLAN MAESTRO</label>
                                    <select name="tipo_plan_maestro" id="tipo_plan_maestro" class="form-control select2" disabled="true">
                                        <!-- <option value="NULL">Seleccione</option>
                                        <option value="1">Tipo A</option>
                                        <option value="2">Tipo B</option> -->
                                        <?php echo $op->select_tipo_plan_maestro($tipo_plan_maestro) ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_hab_dpt_municipio" id="check_hab_dpt_municipio" ?>
                                        <label for="check_hab_dpt_municipio">
                                            Habilitar para modificar
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 col-sm-3">
                                <div class="form-group">
                                    <label for="">Departamento</label>
                                    <select name="departamento" id="departamento" class="form-control select2" disabled="true">
                                        <?php echo $op->select_departamento($departamento); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 col-sm-3">
                                <div class="form-group">
                                    <label for="municipio">Municipio</label>
                                    <select name="municipio" id="municipio" class="form-control select2" disabled="true">

                                        <?php echo  $op->select_municipio($departamento, $municipio) ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 col-sm-2">
                                <div class="form-group">
                                    <label for="">Comuna</label>
                                    <select name="comuna" id="comuna" class="form-control select2" disabled="true">
                                        <?php echo $op->select_comuna($municipio, $comuna) ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Barrio</label>
                                    <input type="text" name="barrio" id="barrio" class="form-control" value="<?php echo $barrio ?>" disabled="true">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_hab_datos_cliente" id="check_hab_datos_cliente" ?>
                                        <label for="check_hab_datos_cliente">
                                            Habilitar para modificar
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3  col-sm-12">
                                <div class="form-group">
                                    <label>Numero de Documento</label>
                                    <input type="text" name="nit" id="nit" class="form-control" value="<?php echo $nidentificacion ?>"disabled="true" />
                                </div>
                            </div>
                            <div class="col-md-3  col-sm-12">
                                <div class="form-gorup">
                                    <label>Nombre Completo</label>
                                    <input type="text" name="nombre_completo" id="nombre_completo" class="form-control" value="<?php echo $nombres_completos ?>" disabled="true"/>
                                </div>
                            </div>
                            <div class="col-md-3  col-sm-12">
                                <div class="form-gorup">
                                    <label>Apellido Completo</label>
                                    <input type="text" name="ap_completo" id="ap_completo" class="form-control" value="<?php echo $apellidos_completos ?>" disabled="true" />
                                </div>
                            </div>
                            <div class="col-md-3  col-sm-12">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="telefono_cliente">Telefono del Cliente</label>
                                        <input type="text" name="telefono_cliente" id="telefono_cliente" class="form-control" value="<?= $telefono_cliente ?>" disabled="true" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_hab_datos_obra" id="check_hab_datos_obra" ?>
                                        <label for="check_hab_datos_obra">
                                            Habilitar para modificar
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6  col-sm-12">
                                <div class="form-group">
                                    <label for="">Nombre de la Obra</label>
                                    <input type="text" name="nombre_obra" id="nombre_obra" class="form-control" value="<?= $nombre_obra ?>" disabled="true" />
                                </div>
                            </div>
                            <div class="col-md-6  col-sm-12">
                                <div class="form-group">
                                    <label for="">Direccion de la Obra</label>
                                    <input type="text" name="direccion_obra" id="direccion_obra" class="form-control" value="<?= $direccion_obra ?>" disabled="true"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_hab_datos_maestro" id="check_hab_datos_maestro" ?>
                                        <label for="check_hab_datos_maestro">
                                            Habilitar para modificar
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_hab_potencial" id="check_hab_potencial" ?>
                                        <label for="check_hab_potencial">
                                            Habilitar para modificar
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-grou">
                                    <label for="">Nombre del Maestro</label>
                                    <input type="text" name="nombre_maestro" id="nombre_maestro" class="form-control" value="<?= $nombre_maestro ?>" disabled="true">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Telefono Celular Maestro</label>
                                    <input type="text" name="celular_maestro" id="celular_maestro" class="form-control" value="<?= $celular_maestro ?>" disabled="true" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Total M3 Potenciales</label>
                                    <input type="text" name="m3_potenciales" id="m3_potenciales" class="form-control" value="<?= $m3_potenciales ?>" disabled="true" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Fecha Posible Fundida</label>
                                    <input type="date" name="fecha_posible_fundida" id="fecha_posible_fundida" class="form-control" value="<?= $fecha_posible_fundida ?>" disabled="true" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_hab_resultado" id="check_hab_resultado" ?>
                                        <label for="check_hab_resultado">
                                            Habilitar para modificar
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group clearfix">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" value="1" name="check_hab_contacto" id="check_hab_contacto" ?>
                                        <label for="check_hab_contacto">
                                            Habilitar para modificar
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Resultado de la Gestion</label>
                                    <select name="resultado" id="resultado" class="form-control select2" disabled="true">
                                        <?php echo $op->select_resultado($resultado) ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Forma que se contacto con el cliente</label>
                                    <select name="contacto_cliente" id="contacto_cliente" class="form-control select2" disabled="true">
                                        <?php echo $op->select_contacto($contacto_cliente) ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Observaciones</label>
                                    <input type="text" name="observacion" id="observacion" class="form-control " value="<?= $observacion ?>">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-12">
                                <button type="submit" name="crear_op" id="crear_op" class="btn btn-info form-control">Actualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Listado Visitas</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#crear_visita">
                            Crear Visita
                        </button>
                    </div>
                </div>
                <div id="contenido">
                    <table name="table_visitas" id="table_visitas">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Fecha</th>
                                <th>Resultado </th>
                                <th>Observacion</th>
                                <th>Detalle</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->


        <div class="modal fade" id="crear_visita">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Crear Visita</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="form_add_visita" id="form_add_visita" method="post">
                            <input type="hidden" name="id_cliente" id="id_clente" value="<?php echo intval($_GET['id']) ?>">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Fecha</label>
                                        <input type="date" name="fecha_vist" id="fecha_vist" class="form-control" />

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="result_visit">Resultado de la Visita</label>
                                        <select class="select2 form-control" name="result_vist" id="result_visit">
                                        <?php echo $op->select_resultado($status_op) ?>
                                         
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="obs_visit">Observaciones</label>
                                        <input type="text" name="obs_visit" id="obs_visit" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>


        <!--- Modal Editar Visita -->
        <div class="modal fade" id="edit_visita">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Ver Visita</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form name="form_edit_visita" id="form_edit_visita" method="post">
                            <input type="hidden" name="id_visita" id="id_visita" />
                            <input type="hidden" name="id_clente_edit" id="id_clente_edit" value="<?php echo intval($_GET['id']) ?>">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_fecha_vist">Fecha</label>
                                        <input type="date" name="edit_fecha_vist" id="edit_fecha_vist" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_result_visit">Resultado de la Visita</label>
                                        <select class="select2 form-control" name="edit_result_visit" id="edit_result_visit">
                                        <?php echo $op->select_resultado($status_op) ?>

                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="edit_obs_visit">Observaciones</label>
                                        <input type="text" name="edit_obs_visit" id="edit_obs_visit" class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary">Actualizar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<!-- /.modal-dialog -->
</div>

<?php include '../../../../layout/footer/footer4.php' ?>
<script>
    $(document).ready(function(e) {
        $('.select2').select2();

        $(".progress").hide();


        $("#tipo_cliente").change(function() {
        var tipo_cliente =  $("#tipo_cliente").val();
       
        if(tipo_cliente == 2){
            $("#tipo_plan_maestro").attr('disabled', false);
        }else{
            $("#tipo_plan_maestro").attr('disabled', true);
        }
    });

        $('#check_hab_asesora_comercial').click(function() {
            if (!$(this).is(':checked')) {
                $("#asesora_comercial").attr('disabled', true);
            } else {
                $("#asesora_comercial").attr('disabled', false);
            }
        });
        $('#check_hab_fecha_contacto').click(function() {
            if (!$(this).is(':checked')) {
                $("#fecha_contacto").attr('disabled', true);
                $("#tipo_cliente").attr('disabled', true);
                $("#tipo_plan_maestro").attr('disabled', true);
            } else {
                $("#fecha_contacto").attr('disabled', false);
                $("#tipo_cliente").attr('disabled', false);
                $("#tipo_plan_maestro").attr('disabled', false);
            }
        });
        $('#check_hab_dpt_municipio').click(function() {
            if (!$(this).is(':checked')) {
                $("#departamento").attr('disabled', true);
                $("#municipio").attr('disabled', true);
                $("#comuna").attr('disabled', true);
                $("#barrio").attr('disabled', true);
            } else {
                $("#departamento").attr('disabled', false);
                $("#municipio").attr('disabled', false);
                $("#comuna").attr('disabled', false);
                $("#barrio").attr('disabled', false);
            }
        });
        $('#check_hab_datos_cliente').click(function() {
            if (!$(this).is(':checked')) {
                $("#nit").attr('disabled', true);
                $("#nombre_completo").attr('disabled', true);
                $("#ap_completo").attr('disabled', true);
                $("#telefono_cliente").attr('disabled', true);
            } else {
                $("#nit").attr('disabled', false);
                $("#nombre_completo").attr('disabled', false);
                $("#ap_completo").attr('disabled', false);
                $("#telefono_cliente").attr('disabled', false);
            }
        });
        $('#check_hab_datos_obra').click(function() {
            if (!$(this).is(':checked')) {
                $("#nombre_obra").attr('disabled', true);
                $("#direccion_obra").attr('disabled', true);
            } else {
                $("#nombre_obra").attr('disabled', false);
                $("#direccion_obra").attr('disabled', false);
            }
        });
        $('#check_hab_datos_maestro').click(function() {
            if (!$(this).is(':checked')) {
                $("#nombre_maestro").attr('disabled', true);
                $("#celular_maestro").attr('disabled', true);
            } else {
                $("#nombre_maestro").attr('disabled', false);
                $("#celular_maestro").attr('disabled', false);
            }
        });
        $('#check_hab_potencial').click(function() {
            if (!$(this).is(':checked')) {
                $("#m3_potenciales").attr('disabled', true);
                $("#fecha_posible_fundida").attr('disabled', true);
            } else {
                $("#m3_potenciales").attr('disabled', false);
                $("#fecha_posible_fundida").attr('disabled', false);
            }
        });
        $('#check_hab_resultado').click(function() {
            if (!$(this).is(':checked')) {
                $("#resultado").attr('disabled', true);
            } else {
                $("#resultado").attr('disabled', false);
            }
        });
        $('#check_hab_contacto').click(function() {
            if (!$(this).is(':checked')) {
                $("#contacto_cliente").attr('disabled', true);
            } else {
                $("#contacto_cliente").attr('disabled', false);
            }
        });
    });
</script>

<script>
    $(document).ready(function(e) {


        $("#fecha_vist").focus(function() {
            let formData = new FormData();

            formData.append('id_cliente', <?php echo intval($_GET['id']); ?>);

            $.ajax({
                url: "fecha_min.php",
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    $("#fecha_vist").attr({
                        "min": data.fecha,
                    });
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });


        function datatable_visitas(id_cliente) {
            var table = $('#table_visitas').DataTable({
                //"processing": true,
                //"scrollX": true,

                "ajax": {
                    "url": "datatable_visitas.php",
                    'data': {
                        'id_cliente': id_cliente,
                    },
                    'type': 'post',
                    "dataSrc": ""
                },
                "order": [
                    [0, 'desc']
                ],

                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "fecha"
                    },
                    {
                        "data": "resultado"
                    },
                    {
                        "data": "obs"
                    },
                    {
                        "data": null,
                        "defaultContent": "<button class='btn btn-warning btn-sm' data-toggle='modal' data-target='#edit_visita'> Editar </button> "
                    },

                ],
                'paging': false,
                'searching': false
                //"scrollX": true,

            });
            table.on('order.dt search.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            table.ajax.reload();
            return table;
        }



        if ($.fn.dataTable.isDataTable('#table_visitas')) {
            table_visitas = $('#table_visitas').DataTable();
            table_visitas.destroy();
        }
        var id_cliente = <?php echo intval($_GET['id']); ?>;
        table_visitas = datatable_visitas(id_cliente);
        setInterval(function() {
            table_visitas.ajax.reload(null, false);
        }, 5000);


        $('#table_visitas tbody').on('click', 'button', function() {
            var data = table_visitas.row($(this).parents('tr')).data();
            var id = data['id'];

            $('#id_visita').val(data['id'])
            $('#edit_fecha_vist').val(data['fecha']);
            //var resultado = data['resultado'];


            //$("#edit_result_visit option[value='']").prop("selected", 'selected');
            //$('#edit_result_visit').val(data['resultado']);
            $('#edit_obs_visit').val(data['obs']);

        });


        $("#form_edit_visita").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_edit_visita.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    const datos_errores = Object.values(data.errores);
                    console.log(datos_errores);
                    if (data.estado) {
                        toastr.success('visita Editada exitosamente');
                    } else {
                        for (let index = 0; index < datos_errores.length; index++) {
                            toastr.warning(data.errores[index]);
                        }
                    }
                    $('#edit_visita').modal('toggle');
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));


        $("#form_add_visita").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_addvisita.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    const datos_errores = Object.values(data.errores);
                    console.log(datos_errores);
                    if (data.estado) {
                        toastr.success('visita creada exitosamente');
                    } else {
                        for (let index = 0; index < datos_errores.length; index++) {
                            toastr.warning(data.errores[index]);
                        }
                    }
                    $('#crear_visita').modal('toggle');



                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        $("#form_edit_op").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "editar_oportunidad.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    const datos_errores = Object.values(data.errores);
                    console.log(datos_errores);
                    if (data.estado) {
                        toastr.success('Oportunidad Editada exitosamente');
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
</script>

</body>

</html>