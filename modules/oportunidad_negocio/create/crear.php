<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CREAR OPORTUNIDAD DE NEGOCIO</h1>
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
        $t1_terceros = new t1_terceros();
        $oportunidad_negocio = new oportunidad_negocio();
        ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">CREAR OPORTUNIDAD DE NEGOCIO</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i
                            class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="progress">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 0.5%" aria-valuenow="25"
                        aria-valuemin="0" aria-valuemax="100"> <span class=" text_progresbar">0% </span> </div>
                </div>
                <div id="contenido">
                    <form name="form_crear_op" id="form_crear_op" method="post">
                        <div class="row">
                            <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                    <label>Asesora Comercial</label>
                                    <select name="asesora_comercial" id="asesora_comercial" class="form-control select2" >           
                                        <?php echo $oportunidad_negocio->select_comercial() ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label>Fecha Contacto</label>
                                    <input type="date" name="fecha_contacto" id="fecha_contacto" class="form-control" />
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <div class="form-group">
                                    <label>Tipo Cliente</label>
                                    <select name="tipo_cliente" id="tipo_cliente" class="form-control select2">
                                        <option value="NULL">Seleccione</option>
                                        <option value="1">CONSTRUCTOR VIVIENDA</option>
                                        <option value="2">CONSTRUCTOR INSTITUCIONAL</option>
                                        <option value="3">PLAN MAESTRO</option>
                                        <option value="4">PÚBLICO</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col col-sm-6">
                                <div class="form-group">
                                    <label>Tipo PLAN MAESTRO</label>
                                    <select name="tipo_plan_maestro" id="tipo_plan_maestro" class="form-control select2">
                                        <option value="NULL">Seleccione</option>
                                        <option value="1">Tipo A</option>
                                        <option value="2">Tipo B</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2 col-sm-3">
                                <div class="form-group">
                                    <label for="">Departamento</label>
                                    <select name="departamento" id="departamento" class="form-control select2">
                                        <?php echo $oportunidad_negocio->select_departamento(null); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 col-sm-3">
                                <div class="form-group">
                                    <label for="municipio">Municipio</label>
                                    <select name="municipio" id="municipio" class="form-control select2">
                                       
                                    </select>
                                </div>
                            </div>
                            <div class="col-2 col-sm-2">
                                <div class="form-group">
                                    <label for="">Comuna</label>
                                    <select name="comuna" id="comuna" class="form-control select2">
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Barrio</label>
                                    <input type="text" name="barrio" id="barrio" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-4  col-sm-12">
                                <div class="form-group">
                                    <label>Numero de Documento</label>
                                    <input type="text" name="nit" id="nit" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-12">
                                <div class="form-gorup">
                                    <label>Nombre Completo</label>
                                    <input type="text" name="nombre_completo" id="nombrecompleto"
                                        class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4  col-sm-12">
                                <div class="form-gorup">
                                    <label>Apellido Completo</label>
                                    <input type="text" name="ap_completo" id="ap_completo" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Nombre de la Obra</label>
                                    <input type="text" name="nombre_obra" id="nombre_obra" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Direccion de la Obra</label>
                                    <input type="text" name="direccion_obra" id="direccion_obra" class="form-control" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="telefono_cliente">Telefono del Cliente</label>
                                        <input type="text" name="telefono_cliente" id="telefono_cliente" class="form-control" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-grou">
                                    <label for="">Nombre del Maestro</label>
                                    <input type="text" name="nombre_maestro" id="nombre_maestro" class="form-control">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Telefono Celular Maestro</label>
                                    <input type="text" name="celular_maestro" id="celular_maestro"
                                        class="form-control" />
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
                                    <label for="">Resultado de la Gestion</label>
                                    <select name="resultado" id="resultado" class="form-control select2">
                                        <option value="NULL">Seleccione</option>
                                        <option value="1">Ganado</option>
                                        <option value="2">Perdido</option>
                                        <option value="3">Visitar Nuevamente</option>
                                        <option value="4">Llamar Nuevamente</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Forma que se contacto con el cliente</label>
                                    <select name="contacto_cliente" id="contacto_cliente" class="form-control select2">
                                        <option value="NULL">Seleccione</option>
                                        <option value="1">Cliente llamo a solicitar Cotizacion</option>
                                        <option value="2">Estrategia Digital</option>
                                        <option value="3">Servicio al Cliente</option>
                                        <option value="4">Por Rutero Comercial</option>
                                        <option value="5">Campaña o Evento de mercadeo </option>
                                        <option value="6">Referido por otro Cliente </option>
                                        <option value="7">Campaña de Telemercadeo </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Observaciones</label>
                                    <input type="text" name="observaciones" id="observaciones" class="form-control ">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" name="crear_op" id="crear_op"
                                        class="btn btn-block btn-info">Crear</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <div id="bq-boton">

                                </div>

                            </div>
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

        <!-- Default box -->

        <!-- /.card -->
        

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- /.modal-dialog -->
</div>

<?php include '../../../layout/footer/footer3.php' ?>
<script>
$(document).ready(function(e) {
    $(".progress").hide();
    $(".select2").select2();

    $("#tipo_cliente").change(function() {
        var tipo_cliente =  $("#tipo_cliente").val();
       
        if(tipo_cliente == 3){
            $("#tipo_plan_maestro").attr('disabled', false);
        }else{
            $("#tipo_plan_maestro").attr('disabled', true);
        }
    });

    $("#municipio").change(function() {
        var municipio =  $("#municipio").val();
       
        if(municipio == 428){
            $("#comuna").attr('disabled', false);
        }else{
            $("#comuna").attr('disabled', true);
        }
    });

    $("#municipio").change(function() {
        $.ajax({
                url: "load_data.php",
                type: "POST",
                data: {
                    'task' : 2,
                    'id_municipio' : $('#municipio').val()
                },
                dataType: 'json',
                success: function (data)
                {
                    $('#comuna').html(data.option_comuna);
                },
                error: function (respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
    });
    
    $("#departamento").change(function() {
        $.ajax({
                url: "load_data.php",
                type: "POST",
                data: {
                    'task' : 1,
                    'id_departamento' : $('#departamento').val()
                },
                dataType: 'json',
                success: function (data)
                {
                    $('#municipio').html(data.option_municipio);
                },
                error: function (respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
    });
});
</script>

<script src="ajax_crear.js"></script>

</body>

</html>