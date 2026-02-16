<div class="modal fade" id="modal_crear_evento" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Agregar Crear Visita Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_crear_vitita" name="form_crear_vitita" method="post">

                    <div class="row">
                        <!-- Asesor Comercial --->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="result_visit">Asesor Comercial </label>

                                <select name="txt_asesora_comercial" style="width:100%" id="txt_asesora_comercial"
                                    class="form-control select2">

                                </select>

                            </div>
                        </div>
                        <!-- Objetivo de la visita -->
                        <div class="col-3">
                            <div class="form-group">
                                <!--- visita comercial ---- Cambiar --- Oportunidad de Negocio --->
                                <label for="result_visit">Objetivo de la visita</label>
                                <select class="select2 form-control" style="width:100%" name="objetivo_visita"
                                    id="objetivo_visita">
                                    <?= $visita_clientes->select_tipo_visita() ?>
                                </select>
                            </div>
                        </div>

                        <!--- Cliente Nuevo o Actual -->
                        <div class="col">
                            <div class="form-group clearfix">
                                <label for="">Cliente Nuevo ?</label>
                                <div class="">
                                    <input type="radio" name="cliente_nuevo" value="1" id="cliente_nuevo"> SI
                                </div>
                                <div class="">
                                    <input type="radio" name="cliente_nuevo" value="0" id="cliente_actual"> NO
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Tipo Cliente</label>
                                <select name="tipo_cliente" id="tipo_cliente" class="form-control select2"
                                    style="width:100%" required="true">
                                    <?php echo $oportunidad_negocio->select_tipo_cliente() ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Tipo PLAN MAESTRO</label>
                                <select name="tipo_plan_maestro" id="tipo_plan_maestro" class="form-control select2"
                                    style="width:100%">
                                    <?php echo $oportunidad_negocio->select_tipo_plan_maestro() ?>
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Documento</label>
                                        <input type="text" name="nit" id="nit" class="form-control" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-gorup">
                                        <label>Nombres Completos</label>
                                        <input type="text" name="nombre_completo" id="nombrecompleto"
                                            class="form-control" />
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="telefono_cliente">Telefono del Cliente</label>
                                            <input type="text" name="telefono_cliente" id="telefono_cliente"
                                                class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Nombre de la Obra</label>
                                        <input type="text" name="nombre_obra" id="nombre_obra" class="form-control" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Direccion de la Obra</label>
                                        <input type="text" name="direccion_obra" id="direccion_obra"
                                            class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="row">
                                <!--  Sede --->
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="sede">Sede</label>
                                        <select name="txt_sede" id="txt_sede" class="form-control select2 "
                                            style="width:100%">

                                            <option value="1">Ibague</option>
                                            <option value="2">Honda</option>
                                            <?php
                                    // IBAGUE HONDA
                                    //echO $op->select_sede($id_sede); 
                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="form-group">
                                        <label for="">Departamento</label>
                                        <select name="departamento" id="departamento" class="form-control select2"
                                            required="true" style="width:100%">
                                            <?php echo $oportunidad_negocio->select_departamento(null); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="form-group">
                                        <label for="municipio">Municipio</label>
                                        <select name="municipio" id="municipio" class="form-control select2"
                                            required="true" style="width:100%">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 ">
                                    <div class="form-group">
                                        <label for="">Zona/Comuna</label>
                                        <select name="comuna" id="comuna" class="form-control select2" required="true"
                                            style="width:100%">

                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Barrio</label>
                                        <input type="text" name="barrio" id="barrio" class="form-control"
                                            style="width:100%">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group clearfix">
                                <label for="">Maestro Nuevo ?</label>
                                <div class="">
                                    <input type="radio" name="maestro_nuevo" value="1" id="maestro_nuevo"> SI
                                </div>
                                <div class="">
                                    <input type="radio" name="maestro_nuevo" value="0" id="maestro_actual"> NO
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nombre del Maestro</label>
                                <input type="text" name="nombre_maestro" id="nombre_maestro" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Telefono Celular Maestro</label>
                                <input type="text" name="celular_maestro" id="celular_maestro" class="form-control" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Total M3 Potenciales</label>
                                <input type="text" name="m3_potenciales" id="m3_potenciales" class="form-control" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Fecha Posible Fundida</label>
                                <input type="date" name="fecha_posible_fundida" id="fecha_posible_fundida"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Resultado de la Visita</label>
                                <select name="resultado" id="resultado" class="form-control select2" style="width:100%">
                                    <?php echo $oportunidad_negocio->select_resultado_visita() ?>
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Forma que se contacto con el cliente</label>
                                <select name="contacto_cliente" id="contacto_cliente" class="form-control select2"
                                    style="width:100%">
                                    <?php echo $oportunidad_negocio->select_contacto() ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="obs_visit">Observaciones:</label>
                                <input type="text" name="obs_visit" id="obs_visit" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label for="">inicio</label>
                                <input class="form-control" type="text" name="txt_inicio" id="txt_inicio" />
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="">fin</label>
                                <input class="form-control" type="text" name="txt_fin" id="txt_fin" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert alert-success alert-dismissible">
                               
                                <h5><span> Aprobado</span></h5>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <button type="submit" class="btn btn-primary" id="btnCrear"> Guardar </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-success"> Aprobar Visita</button>
                        </div>
                    </div>
                </form>

                <hr>
                <hr>
                
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <table class="table table-striped" id="tabla_anexos">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nombre del anexo</th>
                                        <th>Archivo</th>
                                        <th>Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div> <!-- Fin del Modal Body -->

            <div class="modal-footer">

            </div>

        </div>
    </div>
    <!-- /.modal-content -->
</div>

<script>
$(document).ready(function(e) {
    $(".progress").hide();
    $(".select2").select2();

    $("#tipo_cliente").change(function() {
        var tipo_cliente = $("#tipo_cliente").val();
        console.log(tipo_cliente);
        if (tipo_cliente == 2) {
            $("#tipo_plan_maestro").attr('disabled', false);
        } else {
            $("#tipo_plan_maestro").attr('disabled', true);
        }
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
});
</script>