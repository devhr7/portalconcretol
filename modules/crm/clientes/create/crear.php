<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CLIENTE</h1>
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
        $t1_terceros = new t1_terceros();
        $oportunidad_negocio = new oportunidad_negocio();
        ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">CREAR CLIENTE</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
           
                <div id="contenido">
                    <form method="POST" name="F_crear" id="F_crear">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Asesora comercial</label>
                                    <select name="asesora_comercial" id="asesora_comercial" class="form-control select2" required="true">
                                        <?php echo $oportunidad_negocio->select_comercial() ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Sede</label>
                                    <select name="sede" id="sede" class="form-control select2" required="true">
                                        <?php echo $oportunidad_negocio->select_sede() ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Tipo Cliente</label>
                                    <select name="tipo_cliente" id="tipo_cliente" class="form-control select2" required="true">
                                        <?php echo $oportunidad_negocio->select_tipo_cliente() ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Tipo PLAN MAESTRO</label>
                                    <select name="tipo_plan_maestro" id="tipo_plan_maestro" class="form-control select2" required="true">
                                        <?php echo $oportunidad_negocio->select_tipo_plan_maestro() ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            
                            <div class="col">
                                <div class="form-group">
                                    <label>Naturaleza (*)</label>
                                    <select class="form-control select2" style="width: 100%;" name="naturaleza" id="naturaleza" required="true">
                                        <?= $t1_terceros->select_naturaleza() ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> Tipo Documento (*)</label>
                                    <select class="form-control select2" style="width: 100%;" name="tbx_tipoDocumento" id="tbx_tipoDocumento" required="true">
                                        <?= $t1_terceros->select_tipo_documento() ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Numero de documento (*)</label>
                                    <input type="number" name="tbx_NumeroDocumento" id="tbx_NumeroDocumento" class="form-control" placeholder="" required="true">
                                </div>
                            </div>
                            <div id="boxPJ1" class="col">
                                <div class="form-group">
                                    <label>dv </label>
                                    <input type="number" name="tbx_dv" id="tbx_dv" class="form-control" max="9" placeholder="">
                                </div>
                            </div>
                        </div>
                        <div id="boxPJ2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> Razon social (*)</label>
                                        <input type="text" name="tbx_RazonSocial" id="tbx_RazonSocial" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="boxPN1">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> Primer Nombre (*)</label>
                                        <input type="text" name="tbx_pnombre1" id="tbx_pnombre1" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Segundo Nombre</label>
                                        <input type="text" name="tbx_pnombre2" id="tbx_pnombre2" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Primer Apellido (*)</label>
                                        <input type="text" name="tbx_papellido1" id="tbx_papellido1" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Segundo Apellido</label>
                                        <input type="text" name="tbx_papellido2" id="tbx_papellido2" class="form-control" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> E- Mail </label>
                                    <input type="text" name="tbx_email" id="tbx_email" class="form-control" placeholder="" required="false">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Telefono </label>
                                    <input type="text" name="tbx_telefono" id="tbx_telefono" class="form-control" placeholder="" required="true">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Celular </label>
                                    <input type="text" name="tbx_celular" id="tbx_celular" class="form-control" data-inputmask="'alias': 'numeric', 'groupSeparator': ',' , 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" data-mask>
                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col">
                                <div class="form-group">
                                    <label>Direccion</label>
                                    <input type='text' class='form-control ' name='txt_direccion' id="txt_direccion" required />
                                </div>
                            </div>
                        </div>
                        <div class="row" id="blq_cupo">
                            <div class="col">
                                <div class="form-group">
                                    <label>Cupo Cliente</label>
                                    <input type='text' class='form-control ' name='txt_cupo' onkeyup='format(this)' value="0"  />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="container">
                                <div class="col">
                                    <div class="col align-self-center">
                                        <button class="btn btn-block btn-info swalDefaultSuccess" type="submit"> CREAR CLIENTE </button>
                                    </div>
                                </div>
                                <br><br>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-footer"></div>
        </div>
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../../../layout/footer/footer4.php' ?>
<script>
    $(function() {
        $(".progress").hide();
        $('.select2').select2();
    });
    $("#tipo_cliente").change(function() {
        var tipo_cliente = $("#tipo_cliente").val();
        console.log(tipo_cliente);
        if (tipo_cliente == 2) {
            $("#tipo_plan_maestro").attr('disabled', false);
        } else {
            $("#tipo_plan_maestro").attr('disabled', true);
        }
    });
    $(document).ready(function() {
        $("#boxPN1").hide();
        $("#boxPJ2").show();
        $("#boxPJ1").show();
        // boton Cargar datos del cliente de la oportunidad de negocio
        $("#btn_cargar_data").click(function() {
            // traemos los datos del campo codigo de la oportunidad de negocio
            var id_oportunidad = $("#txt_op").val();
            // se crea el ajax para cargar datos
            $.ajax({
                url: "load_op.php", // archivo donde se encuentra la consulta
                type: "POST",
                data: {
                    // transferimos la variable con POST
                    id_oportunidad: id_oportunidad
                },
                success: function(data) {
                    // Restultado del ajax
                    if (data.estado) {
                        $("#asesora_comercial").val(data.asesora_comercial);
                        $("#sede").val(data.sede);
                        $("#tipo_plan_maestro").val(data.plan_maestro);
                        $("#tbx_NumeroDocumento").val(data.nidentificacion);
                        $("#tbx_pnombre1").val(data.nombrescompletos);
                        $("#tbx_papellido1").val(data.apellidoscompletos);
                        $("#tbx_telefono").val(data.telefono_cliente);
                        $("#tbx_tipotercero").val(data.tipo_cliente);
                        $("#tbx_RazonSocial").val(data.nombrescompletos + " " + data.apellidoscompletos);
                        $("#tbx_celular").val(data.telefono_cliente);
                        toastr.success('Exitoso');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        })
        $("#txt_forma_pago").change(function() {
            var forma_pago = $("#txt_forma_pago").val();

            if (forma_pago == 2) {
                $("#txt_cupo").val(0);
                $("#blq_cupo").hide();
            }
            if (forma_pago == 1) {
                $("#blq_cupo").show();
            }
        });

        $("#naturaleza").change(function() {
            var naturaleza = $("#naturaleza").val();
            if (naturaleza == "PJ") {
                $("#boxPN1").hide();
                $("#boxPJ1").show();
                $("#boxPJ2").show();
                var apellido1 = $("#tbx_papellido1").val();
                var apellido2 = $("#tbx_papellido2").val();
                var nombre1 = $("#tbx_pnombre1").val();
                var nombre2 = $("#tbx_pnombre2").val();
                $("#tbx_pnombre1").val();
                $("#tbx_pnombre2").val();
                $("#tbx_papellido1").val();
                $("#tbx_papellido2").val();
                $("#tbx_RazonSocial").val(nombre1 + ' ' + nombre2 + ' ' + apellido1 + ' ' + apellido2);
            } else if (naturaleza == "PN") {
                $("#boxPN1").show();
                $("#boxPJ1").hide();
                $("#boxPJ2").hide();
                $("#tbx_pnombre1").val();
                $("#tbx_pnombre2").val();
                $("#tbx_papellido1").val();
                $("#tbx_papellido2").val();
                $("#tbx_RazonSocial").val();
            } else {
                $("#boxPN1").hide();
                $("#boxPJ2").hide();
                $("#boxPJ1").hide();
            }
        });
    })
</script>

<script type="text/javascript">
    function format(input) {
        var num = input.value.replace(/\./g, '');
        if (!isNaN(num)) {
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/, '');
            input.value = num;
            document.getElementById("h2valor").innerHTML = "$ " + num;
        } else {
            input.value = input.value.replace(/[^\d\.]*/g, '');
        }
    }
</script>

<script src="ajax_crear2.js"></script>

</body>

</html>