<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>
<?php
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Cliente</h1>
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
                <h3 class="card-title">Crear</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form method="POST" name="Formcreartercero" id="Formcreartercero">
                        <div class="container">
                            <div class="card-header">
                                <center>
                                    <h5>Seleccione el tipo de persona</h5>
                                </center>
                            </div>
                            <!-- Se abre una fila -->
                            <div class="row">
                                <div class="col-md-6">
                                    <center>
                                        <div class="form-group"><br>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="rpn" name="Txb_Naturaleza" value="PN">
                                                <label for="rpn" class="custom-control-label">Persona Natural</label>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                                <div class="col-md-3">
                                    <center>
                                        <div class="form-group"><br>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="rpj" name="Txb_Naturaleza" value="PJ">
                                                <label for="rpj" class="custom-control-label">Persona Juridica</label>
                                            </div>
                                        </div>
                                    </center>

                                </div>
                            </div><br><br> <!-- Se cierra la fila  -->
                            <div id="formulario">
                                <!-- Se abre una fila -->

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Tipo Cliente </label>
                                            <select class="form-control select2" name="Txb_tipo_cliente" id="Txb_tipo_cliente">
                                                <?php
                                                switch ($rol_user) {
                                                    case 1:
                                                        ?>
                                                        <option value = "1"> Constructora</option>
                                                        <?php
                                                        break;
                                                }
                                                switch ($rol_user) {

                                                    case 1:
                                                        ?>
                                                        <option value = "2"> Plan Maestro</option>
                                                        <?php
                                                        break;
                                                }

                                                switch ($rol_user) {


                                                    case 1:
                                                        ?>
                                                        <option value = "3"> Institucional</option>
                                                        <?php
                                                        break;

                                                    default:
                                                        ?>
                                                        <option disabled selected="selected"> No tiene Permisos</option>

                                                        <?php
                                                        break;
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Estado</label>
                                            <select class="form-control select2" name="Txb_Estado" id="Txb_Estado">
                                                <option disabled selected="selected">Seleccionar estado del Tercero</option>
                                                <option value="1" selected="selected">Aprovado</option>
                                                <option value="2">Inabilitado</option>
                                                <option value="3">Pendiente</option>
                                            </select>
                                        </div>
                                    </div>
                                </div> <!-- Se cierra la fila  -->

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> Tipo Identificacion </label>
                                            <select class="form-control select2" name="Txb_TipoIdentificacion" id="Txb_TipoIdentificacion">
                                                <option >Seleccione Un Tipo de Identificacion</option>
                                                <option value="NIT">NIT</option>
                                                <option value="CC">Cedula Ciudadania</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col">
                                        <div class="form-group ">
                                            <label for="Txb_NumeroIdentificacion">Numero Identificacion</label>
                                            <input type="text" class="form-control ancho" name="Txb_NumeroIdentificacion" id="Txb_NumeroIdentificacion" placeholder="">
                                        </div>

                                    </div>


                                    <div class="col-md-1" id="dv">
                                        <div class="form-group ">
                                            <center><label for=""> DV </label> </center>
                                            <input type="text" class="form-control" name="Txb_dv" id="Txb_dv" placeholder="">
                                        </div>
                                    </div>
                                </div>
                                <div id="Bloq_PersonaJuridica">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group ">
                                                <label for="Txb_RazonSocial">Razon Social</label>
                                                <input type="text" class="form-control ancho" name="Txb_RazonSocial" id="Txb_RazonSocial" placeholder="">
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <div class="card-header">
                                    <center>
                                        <h5>Datos personales</h5>
                                    </center>
                                </div>



                                <br><br>
                                <div id="Bloq_PersonaNatrural">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group "> <label for="">Primer Nombre</label>
                                                <input type="text" class="form-control" name="Txb_Nombre1" id="Txb_Nombre1" placeholder="">
                                            </div>

                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Segundo Nombre</label>
                                                <input type="text" class="form-control" name="Txb_Nombre2" id="Txb_Nombre2" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group ">
                                                <label for="">Primer Apellido</label>
                                                <input type="text" class="form-control" name="Txb_Apellido1" id="Txb_Apellido1" placeholder="">
                                            </div>

                                        </div>



                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Segundo Apellido</label>
                                                <input type="text" class="form-control" name="Txb_Apellido2" id="Txb_Apellido2" placeholder="">
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="">Fecha de Nacimiento</label>
                                            <input type="date" class="form-control" name="Txb_FechaNacimiento" id="Txb_FechaNacimiento" placeholder="">
                                        </div>

                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Numero Telefonico</label>
                                            <input type="text" class="form-control" name="Txb_Telefono" id="Txb_Telefono" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Numero Celular</label>
                                            <input type="text" class="form-control" name="Txb_Celular" id="Txb_Celular" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Correo Electronico</label>
                                            <input type="email" class="form-control" name="Txb_Email" id="Txb_Email" placeholder="">
                                        </div>
                                    </div>

                                </div>
                                <div class="card-header">
                                    <center>
                                        <h5>Datos de ubicacón</h5>
                                    </center>
                                </div>

                                <br><br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group ">
                                            <label for="">Pais</label>
                                            <input type="text" class="form-control" name="Txb_Pais" id="Txb_Pais" placeholder="">
                                        </div>

                                    </div>


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Departamento</label>
                                            <input type="text" class="form-control" name="Txb_Departamento" id="Txb_Departamento" placeholder="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Ciudad</label>
                                            <input type="text" class="form-control" name="Txb_Ciudad" id="Txb_Ciudad" placeholder="">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Direccion</label>
                                            <input type="text" class="form-control" name="Txb_Direccion" id="Txb_Direccion" placeholder="">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row" style="text-align:center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-block btn-success">Guardar</button>
                                    </div>
                                </div>
                            </div> <!-- Cierra el id de persona natural -->

                        </div>
                    </form>
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

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../../../layout/footer/footer4.php' ?>
<script src="ajax_crear.js"></script>

<script>
    $(function () {


        //Initialize Select2 Elements
        $('.select2').select2()

        $('#Txb_FechaNacimiento').inputmask('dd/mm/yyyy', {
            'placeholder': 'dd/mm/yyyy'
        })
        //Datemask2 mm/dd/yyyy

        //Money Euro

        $('[data-mask]').inputmask()


    });
</script>

<script>

    $(document).ready(function () {
        $('#formulario').hide();
        $("#rpn").change(function () {
            $('#formulario').show();
            $('#Bloq_PersonaJuridica').hide();
            $('#Bloq_PersonaNatrural').show();
            $('#dv').hide();
            Nombre1 = $('#Txb_Nombre1').val();
            Nombre2 = $('#Txb_Nombre2').val();
            Apellido1 = $('#Txb_Apellido1').val();
            Apellido2 = $('#Txb_Apellido2').val();

            $('#Txb_RazonSocial').val(Nombre1 + " " + Nombre2 + " " + Apellido1 + " " + Apellido2);
        });
        $("#rpj").change(function () {
            $('#formulario').show();
            $('#Bloq_PersonaJuridica').show();
            $('#Bloq_PersonaNatrural').hide();
            $('#dv').show();
            Nombre1 = $('#Txb_Nombre1').val();
            Nombre2 = $('#Txb_Nombre2').val();
            Apellido1 = $('#Txb_Apellido1').val();
            Apellido2 = $('#Txb_Apellido2').val();

            $('#Txb_RazonSocial').val(Nombre1 + " " + Nombre2 + " " + Apellido1 + " " + Apellido2);

        });


    });

</script>


</body>
</html>







