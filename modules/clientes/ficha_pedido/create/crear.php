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
                <h3 class="card-title">Ficha de Pedido</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form method="POST" name="F_crear" id="F_crear">

                        <!-- Cliente -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h5 class="card-tittle">CLIENTE</h5>
                            </div>
                            <div class="card-body">
                                <!--  Seccion Cliente -->

                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label> Fecha : </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cliente_fecha" id="cliente_fecha" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Nombre:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cliente_nombre" id="cliente_nombre">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>C.C.N° :</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cliente_cc" id="cliente_cc">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Direccion de Obra:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cliente_direccion_obra" id="cliente_direccion_obra">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>TEL:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cliente_tel_obra" id="cliente_tel_obra">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label>Direccion de Entrega Factura:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cliente_direccion_entregafactura" id="cliente_direccion_entregafactura">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>TEL:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="cliente_tel_entregafactura" id="cliente_tel_entregafactura">
                                        </div>
                                    </div>
                                </div>

                                <!--  Fin Seccion Cliente  -->
                            </div>
                        </div>
                        <!-- ============================================== -->
                        <!---  Plan Maestro -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">PLAN MAESTRO</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label> Fecha : </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_fecha" id="planmaestro_fecha" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Nombre:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_nombre" id="planmaestro_nombre">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>C.C.N° :</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_cc" id="planmaestro_cc">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Direccion:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_direccion" id="planmaestro_direccion">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>TEL:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_tel" id="planmaestro_tel">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================== -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">DATOS CONCRETOS</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-3">
                                        <div class="form-group">
                                            <label> Tipo de Concreto: </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_fecha" id="planmaestro_fecha" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Precio m3 con iva incluido:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_nombre" id="planmaestro_nombre">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Valor Total:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_cc" id="planmaestro_cc">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Abono:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_direccion" id="planmaestro_direccion">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Saldo:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_tel" id="planmaestro_tel">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Válidez:</label>
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_direccion" id="planmaestro_direccion">
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Oferta:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_tel" id="planmaestro_tel">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <h5>BANCOLOMBIA CUENTA CORRIENTE 06838753842</h5>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <h5>COLPATRIA CUENTA CORRIENTE 5751006804</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================== -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">MODIFICACION</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label> Fecha: </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_fecha" id="planmaestro_fecha" />
                                        </div>
                                    </div>
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label> Hora: </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_fecha" id="planmaestro_fecha" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-1">
                                        <div class="form-group">
                                            <label>Otros:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_nombre" id="planmaestro_nombre">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================== -->
                        <div class="card card-info">
                            <div class="card-header">
                                <h5 class="card-tittle">DATOS DE LA ESTRUCTURA</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label> Tipo de estructura: </label>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option> Placa</option>
                                                <option> Muro</option>
                                                <option> Piscina</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col"></div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label> Requiere Medicion: </label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label> <input type="radio">Si </label>
                                            <label> <input type="radio"> No </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Tipo de placa:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <select class="form-control">
                                                <option> Maciza</option>
                                                <option> Aligerada</option>
                                                <option> Calceton</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-2">
                                        <div class="form-group">
                                            <label>Fecha Programada:</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="planmaestro_nombre" id="planmaestro_nombre">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-header">
                                <h5 class="card-tittle">Placa Superior Torta</h5>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h5>Area Inicial </h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            Largo 1
                                            <input type="form-control" placeholder="mt">

                                        </div>
                                        <div class="col">
                                            Ancho 1
                                            <input type="form-control" placeholder="mt">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            Largo 2
                                            <input type="form-control" placeholder="mt">

                                        </div>
                                        <div class="col">
                                            Ancho 2
                                            <input type="form-control" placeholder="mt">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            Largo 3
                                            <input type="form-control" placeholder="mt">
                                        </div>
                                        <div class="col">
                                            Ancho 3
                                            <input type="form-control" placeholder="mt">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            Prom. Largo
                                            <input type="form-control" placeholder="mt">
                                        </div>
                                        <div class="col">
                                            Prom. Ancho
                                            <input type="form-control" placeholder="mt">
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <h5>Vacios</h5>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">Escalera</div>
                                        <div class="col-2">
                                            <div class="form-group">
                                               <code>Largo</code> 
                                                <input class="form-control form-control-sm form-control-border" >
                                            </div>


                                        </div>
                                        <div class="col-2">
                                            <div class="form-group">
                                               <code>Largo</code> 
                                                <input class="form-control form-control-sm form-control-border" >
                                            </div>


                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-2">Patio</div>

                                        <div class="col">
                                            Largo 2
                                            <input type="form-control" placeholder="mt">

                                        </div>
                                        <div class="col">
                                            Ancho 2
                                            <input type="form-control" placeholder="mt">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">Patio</div>

                                        <div class="col">
                                            Largo 3
                                            <input type="form-control" placeholder="mt">
                                        </div>
                                        <div class="col">
                                            Ancho 3
                                            <input type="form-control" placeholder="mt">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-2">Tragaluz</div>

                                        <div class="col">
                                            <div class="form-group">
                                            Prom. Largo
                                            <input type="text" class="form-control form-control-border" id="exampleInputBorder" placeholder=".form-control-border">
                                            
                                            </div>
                                            
                                        </div>
                                        <div class="col">
                                            Prom. Ancho
                                            <input type="form-control" placeholder="mt">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!---  Datos Concreto -->





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