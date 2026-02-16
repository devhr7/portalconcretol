<?php include '../../../layout/validar_session3.php' ?>

<?php
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>

<?php require 'modelo_t26.php'; ?>

<?php
$t26_remisiones = new t26_remisiones();
$php_clases = new php_clases();
$modelo_t26 = new modelo_t26();


$id = $php_clases->HR_Crypt($_GET['id'], 2);
$nombre_obra = $php_clases->HR_Crypt($_GET['ob'], 2);

$id_conductor = (int)$php_clases->HR_Crypt($_SESSION['id_usuario'], 2);


$t26_remisiones->validar_falta_horas_remi_conductor($id_conductor);

$result = $t26_remisiones->get_remision_id($id);



//$datos_remision = $get_datos->get_all($conexion_bd, 'ct26_remisiones', 'ct26_id_remision', $id);

while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {



    $date = new DateTime($fila['ct26_fecha_remi']);
    $datef = $date->format("d-m-Y");
    $codigo_remision = $fila['ct26_codigo_remi'];
    //$img_remision = $fila['ct26_imagen_remi'];
    $notificacion = $fila['ct26_notificacion'];

    $Hora_salida_planta = $fila['ct26_hora_salida_planta'];
    if (empty($Hora_salida_planta) || is_null($Hora_salida_planta)) {
        $Hora_salida_planta = date('H:i:s');
    }

    $Hora_llegada_obra = $fila['ct26_hora_llegada_obra'];
    if (empty($Hora_llegada_obra) || is_null($Hora_llegada_obra)) {
        $Hora_llegada_obra = date('H:i:s');
    }

    $Hora_inicio_descargue = $fila['ct26_hora_inicio_descargue'];
    if (empty($Hora_inicio_descargue) || is_null($Hora_inicio_descargue)) {
        $Hora_inicio_descargue = date('H:i:s');
    }

    $Hora_terminacion_descargue = $fila['ct26_hora_terminada_descargue'];
    if (empty($Hora_terminacion_descargue) || is_null($Hora_terminacion_descargue)) {
        $Hora_terminacion_descargue = date('H:i:s');
    }
    $Hora_llegada_planta = $fila['ct26_hora_llegada_planta'];
    if (empty($Hora_llegada_planta) || is_null($Hora_llegada_planta)) {
        $Hora_llegada_planta = date('H:i:s');
    }



    $nombre_recibido = $fila['ct26_recibido'];
    $fecha_recibido = $fila['ct26_fechaRecibido'];

    $codutor = $fila['ct26_conductor'];
    $vehiculo = $fila['ct26_vehiculo'];

    //$servicio_bomba = $fila['ct26_servicio_bomba'];
    //$cantidad_bombeada = $fila['ct26_cant_bomba'];
    $observaciones = $fila['ct26_observaciones'];

    $tipo_bomba = $fila['ct26_tipo_bomba'];


    //$notificacion = 6;
}
?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Remisiones</h1>
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
                <h3 class="card-title">ENTREGA DE PRODUCTO</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <h5>Fecha</h5>
                                <h3><?php echo $datef ?></h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <h5>Remision</h5>
                                <h3>
                                    <?php
                                    echo $codigo_remision;
                                    ?>
                                </h3>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <h5>Obra</h5>
                                <h3>
                                    <?php
                                    echo $nombre_obra;
                                    ?>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- Main node for this component -->
                    <div class="timeline">
                        <!-- Timeline time label -->
                        <div class="time-label">
                            <span class="bg-green"><?php echo $datef ?></span>
                        </div>

                        <!-- Aceptacion del Producto -->
                        <div id="bloque_1"></div>
                        <!-- Fin Aceptacion del Producto -->

                        <?php
                        include 'notificacion.php';
                        ?>


                    </div>


                    <hr>
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
    $(document).ready(function(e) {

        //
        $("#b_llegada_planta").click(function() {
            var hora = $("#ch_llegada_planta").val();
            var id_remision = <?php echo $id ?>;

            $.ajax({
                url: "ajax_detalle_Remi_1.php",
                type: "POST",
                data: {
                    task: 7,
                    id_Remision: id_remision,
                    hora: hora,
                },
                success: function(response) {
                    toastr.success('La hora fue Guardada Correctamente');
                    location.reload();
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },

            });
        });



        $("#b_observaciones").click(function() {
            var obs = $("#c_observaciones").val();
            var id_remision = <?php echo $id ?>;

            $.ajax({
                url: "ajax_detalle_Remi_1.php",
                type: "POST",
                data: {
                    task: 6,
                    id_Remision: id_remision,
                    obs: obs,
                },
                success: function(response) {
                    toastr.success('Las observaciones fueron Guardadas Correctamente');
                    location.reload();
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },

            });
        });
        
        
        /*

        $("#b_bomba").click(function() {



            if ($("#check_si").is(':checked')) {
                var opc = 1;
            } else {
                var opc = 0;
            }

            if ($("#check_bomba_est").is(':checked')) {
                var tipo_bomba = 1;
            }
            if ($("#check_bomba_auto").is(':checked')) {
                var tipo_bomba = 2;
            }


            var cant_bombeada = $("#c_cantidad_bombeada").val();

            var id_remision = <?php echo $id ?>;


            $.ajax({
                url: "ajax_detalle_Remi_1.php",
                type: "POST",
                data: {
                    task: 5,
                    id_Remision: id_remision,
                    check: opc,

                    cant_bombeada: cant_bombeada,
                    tipo_bomba: tipo_bomba,

                },
                success: function(response) {

                    toastr.success('el servicio de bombe fue guardado correctamente');
                    location.reload();
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },

            });
        });*/

        $("#b_terminacion_descargue").click(function() {
            var hora = $("#ch_terminacion").val();
            var id_remision = <?php echo $id ?>;

            $.ajax({
                url: "ajax_detalle_Remi_1.php",
                type: "POST",
                data: {
                    task: 4,
                    id_Remision: id_remision,
                    hora: hora,
                },
                success: function(response) {
                    toastr.success('La hora fue Guardada Correctamente');
                    location.reload();
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },

            });
        });


        $("#b_descargueProduct").click(function() {
            var hora = $("#h_descargueProduct").val();
            var id_remision = <?php echo $id ?>;

            $.ajax({
                url: "ajax_detalle_Remi_1.php",
                type: "POST",
                data: {
                    task: 3,
                    id_Remision: id_remision,
                    hora: hora,
                },
                success: function(response) {
                    toastr.success('La hora fue Guardada Correctamente');
                    location.reload();
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },

            });
        });


        $("#b_llegadaVehiculo").click(function() {
            var hora = $("#ch_llegadaObra").val();

            var id_remision = <?php echo $id ?>;

            $.ajax({
                url: "ajax_detalle_Remi_1.php",
                type: "POST",
                data: {
                    task: 2,
                    id_Remision: id_remision,
                    hora: hora,
                },
                success: function(response) {
                    toastr.success('La hora fue Guardada Correctamente');
                    location.reload();
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },

            });
        });



        $("#bh_salida_planta").click(function() {
            var hora = $("#h_salida_planta").val();
            var id_remision = <?php echo $id ?>;

            $.ajax({
                url: "ajax_detalle_Remi_1.php",
                type: "POST",
                data: {
                    task: 1,
                    id_Remision: id_remision,
                    h_salida_planta: hora,
                },
                success: function(response) {
                    toastr.success('La hora fue Guardada Correctamente');
                    location.reload();
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },

            });
        });


        $("#f_recibido").on('submit', (function(e) {
            var form = new FormData(this);
            var id_remision = <?php echo $id ?>;

            form.append('task', 10);
            form.append('id_Remision', id_remision);
            e.preventDefault();
            $.ajax({
                url: "ajax_detalle_Remi_1.php",
                type: "POST",
                data: form,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data.estado);
                    location.reload();
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