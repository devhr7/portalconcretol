<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>

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
                    <form method="POST" name="creartercero" id="creartercero">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Tipo Cliente (*)</label>
                                    <div class="form-group">
                                        <select class="form-control select2" style="width: 100%;" name="tbx_tipotercero" id="tbx_tipotercero">
                                            <option disabled selected>Seleccionar </option>
                                            <option value="1">Constructor Vivienda</option>
                                            <option value="2">Plan Maestro</option>
                                            <option value="3">CONSTRUCTOR Institucional</option>
                                            <option value="4">Publico</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Acuerdo de Pago</label>
                                    <select class="form-control select2" style="width: 100%;" name="txt_acuerdo_pago" id="txt_acuerdo_pago">
                                        <option disabled selected>Seleccionar </option>
                                        <option value="1"> Credito </option>
                                        <option value="2"> Pago Anticipado </option>
                                    </select>
                                </div>


                            </div>
                            <div class="col">
                                <div class="form-group" style=" text-align:center">
                                    <label>Naturaleza (*)</label>
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="r_PN" name="r_naturaleza" value="PJ" checked="checked">
                                            <label for="r_PN"> Persona Juridica
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="r_PJ" value="PN" name="r_naturaleza">
                                            <label for="r_PJ"> Persona Natural
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label> Tipo Documento (*)</label>
                                <select class="form-control select2" style="width: 100%;" name="tbx_tipoDocumento" id="tbx_tipoDocumento" required>
                                    <option disabled selected>Seleccionar </option>
                                    <option value="1">Nit</option>
                                    <option value="2">Cedula Ciudadania</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Numero de documento (*)</label>
                                    <input type="text" name="tbx_NumeroDocumento" id="tbx_NumeroDocumento" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div id="boxPJ1">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>dv </label>
                                        <input type="text" name="tbx_dv" id="tbx_dv" class="form-control" max="1" placeholder="">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="boxPJ2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> Razon social (*)</label>
                                        <input type="text" name="tbx_RazonSocial" id="tbx_RazonSocial" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="boxPN1">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> Primer Nombre (*)</label>
                                        <input type="text" name="tbx_pnombre1" id="tbx_pnombre1" class="form-control" placeholder="" required>
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
                                        <label> Primer Apellido</label>
                                        <input type="text" name="tbx_papellido1" id="tbx_papellido1" class="form-control" placeholder="" required>
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
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Departamento</label>
                                    <select class="form-control select2" style="width: 100%;" name="tbx_departamento" id="tbx_departamento">
                                        <option value="" selected="selected">Seleccionar </option>
                                        <option value="1">Tolima</option>
                                        <option value="2">Cundinamarca</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Municipio</label>
                                    <select class="form-control select2" style="width: 100%;" name="tbx_municipio" id="tbx_municipio">
                                        <option disabled selected>Seleccionar </option>
                                        <option value="1">Ibague</option>
                                        <option value="2">Bogota</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> Direccion </label>
                                    <input type="text" name="tbx_direccion" id="tbx_direccion" class="form-control" placeholder="">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> E- Mail </label>
                                    <input type="text" name="tbx_email" id="tbx_email" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Telefono </label>
                                    <input type="text" name="tbx_telefono" id="tbx_telefono" class="form-control" placeholder="" required>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Celular </label>
                                    <input type="text" name="tbx_celular" id="tbx_celular" class="form-control">
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card card-outline card-info">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label> Nombre Completos del Contacto Comercial </label>
                                            <input type="text" class="form-control" name="txt_name_contact_comercial" id="txt_name_contact_comercial">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Telefono del Contacto Comercial</label>
                                            <input type="text" class="form-control" name="txt_tel_contact_comercial" id="txt_tel_contact_comercial">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Email del Contacto Comercial</label>
                                            <input type="text" class="form-control" name="txt_email_contact_comercial" id="txt_email_contact_comercial">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card card-outline card-info">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label> Nombre Completos del Contacto Area de Compras </label>
                                            <input type="text" class="form-control" name="txt_name_contact_compras" id="txt_name_contact_comercial">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Telefono del Contacto Area de Compras</label>
                                            <input type="text" class="form-control" name="txt_tel_contact_compras" id="txt_tel_contact_comercial">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Email del Contacto Area de Compras</label>
                                            <input type="text" class="form-control" name="txt_email_contact_compras" id="txt_email_contact_comercial">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="card card-outline card-info">
                            <div class="card-body">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <label> Nombre Completos del Contacto Area de Pagos </label>
                                            <input type="text" class="form-control" name="txt_name_contact_pagos" id="txt_name_contact_comercial">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Telefono del Contacto Area de Pagos</label>
                                            <input type="text" class="form-control" name="txt_tel_contact_pagos" id="txt_tel_contact_comercial">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label>Email del Contacto Area de Pagos</label>
                                            <input type="text" class="form-control" name="txt_email_contact_pagos" id="txt_email_contact_comercial">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="container">
                                <div class="row ">
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
           
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../../layout/footer/footer3.php' ?>


<script>
    $(document).ready(function() {
        $("#boxPN1").hide();
        $("#boxPJ2").show();
        $("#boxPJ1").show();


        $("#r_PJ").change(function() {

            $("#boxPJ2").hide();
            $("#tbx_pnombre1").val();
            $("#tbx_pnombre2").val();
            $("#tbx_papellido1").val();
            $("#tbx_papellido2").val();
            $("#tbx_RazonSocial").val(' ');
            $("#boxPN1").show();
            $("#boxPJ1").hide();
        });

        $("#r_PN").change(function() {
            $("#boxPN1").hide();
            $("#boxPJ1").show();

            var apellido1 = $("#tbx_papellido1").val();
            var apellido2 = $("#tbx_papellido2").val();
            var nombre1 = $("#tbx_pnombre1").val();
            var nombre2 = $("#tbx_pnombre2").val();

            $("#tbx_pnombre1").val('');
            $("#tbx_pnombre2").val('');
            $("#tbx_papellido1").val('');
            $("#tbx_papellido2").val('');

            $("#tbx_RazonSocial").val(apellido1 + ' ' + apellido2 + ' ' + nombre1 + ' ' + nombre2);
            $("#boxPJ2").show();
        });
    })
</script>

<script>
    $(document).ready(function() {
        $('#creartercero').validate({
            rules: {
                tbx_tipotercero: {
                    required: true,
                },
                txt_acuerdo_pago: {
                    required: true,
                },
                tbx_tipoDocumento: {
                    required: true,
                },
                tbx_NumeroDocumento: {
                    required: true,
                    digits: true,
                    minlength: 5,
                    maxlength: 20,
                },
                tbx_dv: {
                    required: false,
                },
                tbx_RazonSocial: {
                    required: true,
                    minlength: 3,
                    maxlength: 100,
                },
                tbx_pnombre1: {
                    required: true,
                    minlength: 3,
                    maxlength: 30,

                },
                tbx_pnombre2: {
                    required: false,
                    minlength: 3,
                    maxlength: 30,
                },
                tbx_papellido1: {
                    required: true,
                    minlength: 3,
                    maxlength: 30,
                },
                tbx_papellido2: {
                    required: false,
                    minlength: 3,
                    maxlength: 30,
                },
                tbx_email: {
                    email: true,
                },
                tbx_telefono: {
                    digits: true,
                    minlength: 5,
                    maxlength: 20,
                },
                tbx_celular: {
                    digits: true,
                    minlength: 5,
                    maxlength: 20,
                }

            },
            messages: {

            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function(form) {
                $.ajax({
                    url: "php_crear.php",
                    type: "POST",
                    data: $(form).serialize(),
                    cache: false,
                    processData: false,
                    success: function(data) {
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
            }
        });
    });
</script>


</body>

</html>