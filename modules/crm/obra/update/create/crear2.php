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
                                    <label>Tipo Cliente (*)</label>
                                    <div class="form-group">
                                        <select class="form-control select2" style="width: 100%;" name="tbx_tipotercero" id="tbx_tipotercero">
                                            <option disabled selected>Seleccionar </option>
                                            <option value="1">Constructora</option>
                                            <option value="2">Plan Maestro</option>
                                            <option value="3">Institucional</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Forma de Pago</label>
                                    <select class="form-control select2" style="width: 100%;" name="txt_forma_pago" id="txt_forma_pago">
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
                                    <input type="number" name="tbx_NumeroDocumento" id="tbx_NumeroDocumento" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div id="boxPJ1">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>dv </label>
                                        <input type="number" name="tbx_dv" id="tbx_dv" class="form-control" max="1" placeholder="">
                                    </div>
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
                                        <label> Primer Apellido</label>
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
                                    <label>Genero</label>
                                    <select class="form-control select2" style="width: 100%;" name="tbx_genero" id="tbx_genero">
                                        <option disabled selected>Seleccionar </option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Femenino</option>
                                        <option value="SD">Sin definir</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Fecha de Nacimiento </label>
                                    <input type="date" class="form-control"  name="tbx_fechnacimiento" id="tbx_fechnacimiento">

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
                                    <input type="text" name="tbx_email" id="tbx_email" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Telefono </label>
                                    <input type="text" name="tbx_telefono" id="tbx_telefono" class="form-control" placeholder="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Celular </label>
                                    <input type="text" name="tbx_celular" id="tbx_celular" class="form-control" data-inputmask="'alias': 'numeric', 'groupSeparator': ',' , 'digits': 2, 'digitsOptional': false, 'prefix': '$ ', 'placeholder': '0'" data-mask>
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
            <div class="card-footer"></div>
        </div>


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../../../layout/footer/footer4.php' ?>


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

<script src="ajax_crear2.js"></script>

</body>

</html>