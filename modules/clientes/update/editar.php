<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<?php //include '../../../include/model/tablas/conexionPDO.php'; 
?>

<?php
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
?>
<?php

$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
$t3_clientes = new t3_clientes();


$id = $php_clases->HR_Crypt($_GET['id'], 2);
$datos = $t1_terceros->search_tercero_custom_id($id);

while ($fila = $datos->fetch(PDO::FETCH_ASSOC)) {

    $nit = $fila['ct1_NumeroIdentificacion'];
    $razon_social = $fila['ct1_RazonSocial'];
    $naturaleza = $fila['ct1_naturaleza'];
    $dv = $fila['ct1_dv'];
    $nombre1 = $fila['ct1_Nombre1'];
    $nombre2 = $fila['ct1_Nombre2'];
    $apellido1 = $fila['ct1_Apellido1'];
    $apellido2 = $fila['ct1_Apellido2'];
    $tipo_documento = $fila['ct1_TipoIdentificacion'];
    $telefono = $fila['ct1_Telefono'];
    $celular = $fila['ct1_Celular'];
    $email = $fila['ct1_CorreoElectronico'];

    $tipo_documento = $fila['ct1_TipoIdentificacion'];

    
}


$datos_cliente_int = $t3_clientes->get_datos_cliente($id);

foreach ($datos_cliente_int as $key) {
    $forma_pago = $key['ct3_ModalidadPago'];
    $cupo_cliente = $key['ct3_Cupo'];
    $tipo_cliente = $key['ct3_TipoCliente'];
    $saldo_cliente = $key['ct3_SaldoCartera'];
}

?>


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
                <h3 class="card-title">EDITAR CLIENTE</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form method="POST" name="F_editar" id="F_editar">
                        <input type="hidden" name="id_cliente" id="id_cliente"  value="<?php echo $id; ?>"  />
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Tipo Cliente (*)</label>
                                    <div class="form-group">
                                        <?php
                                        switch ($tipo_cliente) {
                                            case 1:
                                                $op_tipo_tercero = "<option value='1' selected> Constructora </option>";
                                                break;
                                            case 2:
                                                $op_tipo_tercero = "<option value='2' selected> Plan Maestro </option>";

                                                break;
                                            case 3:
                                                $op_tipo_tercero = "<option value='3' selected> Institucional </option>";

                                                break;

                                            default:
                                                $op_tipo_tercero = "<option disabled selected> no se ha clasificado este cliente </option>";
                                                break;
                                        }
                                        ?>
                                        <select class="form-control select2" style="width: 100%;" name="tbx_tipotercero" id="tbx_tipotercero">
                                            <?php print $op_tipo_tercero; ?>
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
                                    <?php

                                    switch ($forma_pago) {
                                        case 1:
                                            $op_forma_pago = "<option value='1' selected> Credito </option>";
                                            break;
                                        case 2:
                                            $op_forma_pago = "<option value='2' selected> Anticipado</option>";
                                            break;
                                        default:
                                            $op_forma_pago = "<option disabled selected> No se ha especificado la forma de pago </option>";
                                            break;
                                    }
                                    ?>
                                    <select class="form-control select2" style="width: 100%;" name="txt_forma_pago" id="txt_forma_pago">
                                        <?php print $op_forma_pago; ?>
                                        <option value="1"> Credito </option>
                                        <option value="2"> Pago Anticipado </option>
                                    </select>
                                </div>


                            </div>
                            <div class="col">
                                <div class="form-group" style=" text-align:center">
                                    <label>Naturaleza (*)</label>
                                    <?php
                                    $op_naturaleza_pn = "";
                                    $op_naturaleza_pj = "";
                                    switch ($naturaleza) {
                                        case 'PN':
                                            $op_naturaleza_pn  = " checked='checked' ";
                                            break;

                                        case 'PJ':
                                            $op_naturaleza_pj  = " checked='checked' ";

                                            break;
                                        default:

                                            break;
                                    }


                                    ?>
                                    <div class="form-group clearfix">
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="r_PJ" name="r_naturaleza" value="PJ" <?php print_r($op_naturaleza_pj); ?>>
                                            <label for="r_PJ"> Persona Juridica
                                            </label>
                                        </div>
                                        <div class="icheck-primary d-inline">
                                            <input type="radio" id="r_PN" value="PN" name="r_naturaleza" <?php print_r($op_naturaleza_pn); ?>>
                                            <label for="r_PN"> Persona Natural
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">

                                <?php

                                switch ($tipo_documento) {
                                    case 1:
                                        $op_tipo_doc = "<option value='1' selected> Nit </option>";
                                        break;
                                    case 2:
                                        $op_tipo_doc = "<option value='2' selected> Cedula Ciudadania</option>";
                                        break;
                                    default:
                                        $op_tipo_doc = "<option disabled selected> No se ha especificado Tipo Documento </option>";
                                        break;
                                }
                                ?>
                                <label> Tipo Documento (*)</label>
                                <select class="form-control select2" style="width: 100%;" name="tbx_tipoDocumento" id="tbx_tipoDocumento" required>

                                    <?php print_r($op_tipo_doc); ?>
                                    <option disabled>Seleccionar </option>

                                    <option value="1">Nit</option>
                                    <option value="2">Cedula Ciudadania</option>
                                </select>
                            </div>
                            <div class="col-5">
                                <div class="form-group">
                                    <label>Numero de documento (*)</label>
                                    <input type="number" name="tbx_NumeroDocumento" id="tbx_NumeroDocumento" class="form-control" placeholder="" value="<?php print_r($nit); ?>" />
                                </div>
                            </div>
                            <div id="boxPJ1">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>dv </label>
                                        <input type="number" name="tbx_dv" id="tbx_dv" class="form-control" max="1" placeholder="" value="<?php print_r($dv); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="boxPJ2">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> Razon social (*)</label>
                                        <input type="text" name="tbx_RazonSocial" id="tbx_RazonSocial" class="form-control" placeholder="" value="<?php print_r($razon_social); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="boxPN1">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> Primer Nombre (*)</label>
                                        <input type="text" name="tbx_pnombre1" id="tbx_pnombre1" class="form-control" placeholder="" value="<?php print_r($nombre1); ?>" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Segundo Nombre</label>
                                        <input type="text" name="tbx_pnombre2" id="tbx_pnombre2" class="form-control" placeholder="" value="<?php print_r($nombre2); ?>" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Primer Apellido</label>
                                        <input type="text" name="tbx_papellido1" id="tbx_papellido1" class="form-control" placeholder="" value="<?php print_r($apellido1); ?>" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label> Segundo Apellido</label>
                                        <input type="text" name="tbx_papellido2" id="tbx_papellido2" class="form-control" placeholder="" value="<?php print_r($apellido2); ?>" />
                                    </div>
                                </div>
                            </div>
                        </div>


                        <hr>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label> E- Mail </label>
                                    <input type="text" name="tbx_email" id="tbx_email" class="form-control" placeholder="" value="<?php print_r($email); ?> " />
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label> Telefono </label>
                                    <input type="text" name="tbx_telefono" id="tbx_telefono" class="form-control" placeholder="" value="<?php print_r($telefono); ?>" />
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
                        <div class="row" id="blq_cupo">
                            <div class="col">
                                <div class="form-group">
                                    <label>Cupo Cliente</label>
                                    <input type='text' class='form-control ' name='txt_cupo' onkeyup='format(this)' value="<?php print_r($cupo_cliente) ?>" required />
                                </div>
                            </div>
                        </div>
                        <?php

                        if ($rol_user == 1) {
                        ?>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label> <input type="checkbox" id="habi_saldo"> Habilitar </label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label>Saldo Cliente</label>
                                        <input type="text" class="form-control" name="saldo_cliente" id="saldo_cliente" onkeyup='format(this)' value="<?php echo $saldo_cliente; ?>"  />
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

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

<?php include '../../../layout/footer/footer3.php' ?>




<script>
    $(document).ready(function() {
        $("#boxPN1").hide();
        $("#boxPJ2").show();
        $("#boxPJ1").show();


        $("#txt_forma_pago").change(function(){
            var forma_pago =  $("#txt_forma_pago").val();

            if(forma_pago == 2){
                $("#txt_cupo").val(0);
                $("#blq_cupo").hide();
                
            }

            if(forma_pago == 1){
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


<script src="ajax_editar.js"></script>

</body>

</html>