<?php include '../../../layout/validar_session3.php'; ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php'; ?>
<?php include '../../../include/lib.php'; ?>


<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>


<?php
// cargar Clases
$php_clases = new php_clases();

$modulo_batch = true;

if ($modulo_batch) {
    //cargar Clases
    $php_clases = new php_clases();
    $t5_obras = new t5_obras();
    $t1_terceros = new t1_terceros();
    $lib = new lib();
    $id_obra  = $php_clases->HR_Crypt($_GET['id'], 2);
    $array_roles = array(1);
    $permisos = $lib->permisos($rol_user, $array_roles);
} else {
    print('<script> console.log("mal")</script>');
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Obras</h1>
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
                        <i class="fas fa-minus"></i></button>
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
                            $segmento = $fila_obra['ct5_segmento'];
                        }

                        ?>
                        <input type="hidden" value="<?php echo $id_obra ?>" name="id_obra" id="id_obra">


                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Datos del Proyecto</h3>
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
                                </div> <!-- Fin Row -->
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Nombre de la Obra</label>
                                            <input name="nombre_obra" id="nombre_obra" type="text" class="form-control" placeholder="Digite el nombre" value="<?php echo $NombreObra ?>" required>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Departamento</label>
                                            <select name="departamento" id="departamento" class="form-control select2">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Ciudad</label>
                                            <select name="ciudad" id="ciudad" class="form-control select2">

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">

                                            <label>Segmento</label>
                                            <select class="js-example-basic-single select2 form-control" name="segmento" id="segmento">
                                                <optgroup label="Vivienda">
                                                    <option value="1">Vivienda de interés social (VIS) ( < 135 SMLMV ) </option>
                                                    <option value="2">Vivienda diferente de interés social (NO VIS) - ( > 135 SMLMV )</option>
                                                </optgroup>
                                                <optgroup label="Obras Civiles">
                                                    <option value="10">530201 Carreteras, calles, vías férreas y pistas de aterrizaje, puentes, carreteras elevadas y túneles.</option>
                                                    <option value="11">530202 Puertos, canales, presas, sistemas de riego y otras obras hidráulicas.</option>
                                                    <option value="12">530203 Tuberías para la conducción de gas a larga distancia, líneas de comunicación y cables de poder, tuberías y cables locales y obras conexas.</option>
                                                    <option value="13">530204 Construcciones en minas y plantas industriales</option>
                                                    <option value="14">530205 Construcciones deportivas al aire libre, otras obras de ingeniería civil</option>
                                                </optgroup>
                                                <optgroup label="Edificaciones">
                                                    <option value="20">EDIFICACIONES - bodegas, edificaciones comerciales, edificaciones industriales, oficinas, hoteles, edificaciones para administración pública, centros sociales y/o recreacionales, entre otros.</option>
                                                </optgroup>
                                                <optgroup label="Otros">
                                                    <option value="30">OTROS - aquellos despachos de los cuales no es posible identificar su destino o uso. Entre ellos: mayoristas, intermediarios, comercializadores, distribuidores, transformadores (prefabricados), etc.</option>
                                                </optgroup>

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Direccion</label>
                                            <input name="direccion" id="direccion" type="text" class="form-control" placeholder="Digite el direccion">
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

<?php include '../../../layout/footer/footer3.php' ?>


<script>
    $(document).ready(function() {
        $(".progress").hide();
        $('.select2').select2();
        var id_obra = 0;
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
        $('#departamento').on('change', function() {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data: {
                    id_departamento: ($('#departamento').val()),
                    task: 2,
                },
                success: function(response) {
                    $('#ciudad').html(response.ciudad);
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
</script>

</body>

</html>