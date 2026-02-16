<?php
session_start();
//require '../../../include/conexionPDO.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

require 'modelo_t26.php';



//$con = new conexionPDO();
//$t10_vehiculo = new vehiculos_t10();
$t26_remisiones = new t26_remisiones();
$php_clases = new php_clases();
$modelo_t26 = new modelo_t26();

$id = $_GET['id'];
$nombre_obra = $_GET['ob'];


$result = $t26_remisiones->get_remision_id($id);



//$datos_remision = $get_datos->get_all($conexion_bd, 'ct26_remisiones', 'ct26_id_remision', $id);

while ($fila = $result->fetch(PDO::FETCH_ASSOC)) {



    $date = new DateTime($fila['ct26_fecha_remi']);
    $datef = $date->format("d-m-Y");
    $codigo_remision = $fila['ct26_codigo_remi'];
    $img_remision = $fila['ct26_imagen_remi'];
    $notificacion = $fila['ct26_notificacion'];

    $Hora_salida_planta = $fila['ct26_hora_salida_planta'];
    

    $Hora_llegada_obra = $fila['ct26_hora_llegada_obra'];
    
    
    $Hora_inicio_descargue = $fila['ct26_hora_inicio_descargue'];
    
    
    $Hora_terminacion_descargue = $fila['ct26_hora_terminada_descargue'];
    

    $Hora_llegada_obra_cli = $fila['ct26_hora_llegada_obra'];
    

    $Hora_inicio_descargue_cli = $fila['ct26_hora_inicio_descargue'];
    

    $Hora_terminacion_descargue_cli = $fila['ct26_hora_terminada_descargue'];
    

            



    $nombre_recibido = $fila['ct26_recibido'];
    $fecha_recibido = $fila['ct26_fechaRecibido'];

    $codutor = $fila['ct26_conductor'];
    $vehiculo = $fila['ct26_vehiculo'];

    $observaciones = $fila['ct26_observaciones_cli'];
    
    $servicio_bomba = $fila['ct26_servicio_bomba'];
    $cantidad_bombeada = $fila['ct26_cant_bomba'];

        $tipo_bomba = $fila['ct26_tipo_bomba'];
    //$notificacion = 6;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CONCRETOL</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="../../../assets/images/logos/LogoConcretol.png" rel="icon" type="image">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">

        <link rel="stylesheet" href="../../../plugins/select2/select2.css">

        <link rel="stylesheet" href="../../../plugins/sweetalert2/dist/sweetalert2.css">
        <!-- Google Font: Source Sans Pro -->
        <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

        <link rel="stylesheet" href="../../../plugins/ekko-lightbox/ekko-lightbox.css">
    </head>
    <body class="hold-transition sidebar-mini">
        <!-- Site wrapper -->
        <div class="wrapper">
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <img src="../../../assets/images/usuarios/images.png" class="user-image img-circle elevation-2" alt="User Image">
                            <span class="d-none d-md-inline"><?php echo $_SESSION['nombre_usuario']; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                            <!-- User image -->
                            <li class="user-header bg-primary">
                                <img src="../../../assets/images/usuarios/images.png" class="img-circle elevation-2" alt="User Image">

                                <p>
                                    <?php echo $_SESSION['nombre_usuario']; ?>
                                     <!-- <small></small> -->
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <!-- 
                            <li class="user-body">
                              <div class="row">
                                <div class="col-4 text-center">
                                  <a href="#">Followers</a>
                                </div>
                                <div class="col-4 text-center">
                                  <a href="#">Sales</a>
                                </div>
                                <div class="col-4 text-center">
                                  <a href="#">Friends</a>
                                </div>
                              </div>
                            
                            -->
                            <!-- /.row -->
                    </li>
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="../profile/passnew.php" class="btn btn-default btn-flat">Perfil</a>
                        <a href="../../cerrar.php" class="btn btn-default btn-flat float-right">Cerrar Sesion</a>
                    </li>
                </ul>
                </li>

                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-light-orange elevation-4">
                <!-- Brand Logo -->
                <a href="#" class="brand-link">
                    <img src="../../../assets/images/logos/Logo-v8.jpg"
                         alt="Concretol Logo"
                         class="brand-image img-circle elevation-3"
                         style="opacity: .8">
                    <span class="brand-text font-weight-light">REMIWEB CONCRETOL</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
                                 with font-awesome or any other icon font library -->
                            <!-- Atras
                            <li class="nav-item">
                              <a href="index.php" class="nav-link">
                                <i class="fas fa-hand-point-left"></i>
                                <p>
                                  Atras
                                </p>
                              </a>
                            </li>
                            -->

                            <li class="nav-header">Menu</li>
                            <li class="nav-item has-treeview menu-open">
                                <a href="#" class="nav-link active">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Entregas de Productos
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview menu-open">
                                    <li class="nav-item active">
                                        <a href="index.php" class="nav-link active">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>explorar</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Entregas de Productos</h1>
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
                            <h3 class="card-title">REMISION  </h3>

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

                                    <!-- Recibido  -->








                                    <!--  Remision -->

                                    <!--  Fin Remision -->


                                    <!-- The last icon means the story is complete -->

                                </div>


                                <hr>
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

            <footer class="main-footer">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 0.3
                </div>
                <strong>Copyright 2019-2020 <a href="#">HR</a>.</strong> Todos los derehos Reservados
            </footer>

            <!-- Control Sidebar -->
            <aside class="control-sidebar control-sidebar-dark">
                <!-- Control sidebar content goes here -->
            </aside>
            <!-- /.control-sidebar -->
        </div>
        <!-- ./wrapper -->

        
        

        <!-- jQuery -->
        <script src="../../../plugins/jquery/jquery.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="../../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
        <!-- AdminLTE App -->
        <script src="../../../dist/js/adminlte.min.js"></script>
    <script src="../../../plugins/select2/js/select2.full.js"></script>
    <script src="../../../plugins/select2/js/select2.js"></script>
    <script src="../../../plugins/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="../../../plugins/sweetalert2/dist/sweetalert2.js"></script>
    
    <script src="../../../plugins/datatables/datatables.js"></script>
<script src="../../../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
    <script src="../../../plugins/toastr/toastr.min.js"></script>
        <script>
            $(function () {
                $(document).on('click', '[data-toggle="lightbox"]', function (event) {
                    event.preventDefault();
                    $(this).ekkoLightbox({
                        alwaysShowClose: true
                    });
                });

                $('.filter-container').filterizr({gutterPixels: 3});
                $('.btn[data-filter]').on('click', function () {
                    $('.btn[data-filter]').removeClass('active');
                    $(this).addClass('active');
                });
            })
        </script>
        <script>

            $(document).ready(function (e) {

                //

                $("#b_observaciones").click(function () {
                    var obs = $("#c_observaciones").val();
                    var id_remision = <?php echo $id ?>;

                    $.ajax({
                        url: "ajax_detalle_Remi_1.php",
                        type: "POST",
                        data:
                                {
                                    task: 6,
                                    id_Remision: id_remision,
                                    obs: obs,
                                },
                        success: function (response)
                        {
                            toastr.success('las observaciones fueron guardados correctamente');
                            location.reload();
                        },
                        error: function (respuesta) {
                            alert(JSON.stringify(respuesta));
                        },

                    });
                });
                
                
                
                           
                $("#b_bomba").click(function () {
           
           
           
           if($("#check_si").is(':checked')) {  
                var opc = 1;
            } else {  
                var opc= 0;
            }  
            
               if($("#check_bomba_est").is(':checked')) {  
                var tipo_bomba = 1;
            } 
            if($("#check_bomba_auto").is(':checked')) {  
                var tipo_bomba = 2;
            }
         
                    var cant_bombeada   = $("#c_cantidad_bombeada").val();
                    
                    var id_remision     = <?php echo $id ?>;


                    $.ajax({
                        url: "ajax_detalle_Remi_1.php",
                        type: "POST",
                        data:
                                {
                                    task: 5,
                                    id_Remision: id_remision,
                                    check : opc,
                               
                                    cant_bombeada : cant_bombeada,
                                     tipo_bomba :tipo_bomba,
                                },
                        success: function (response)
                        {
                           
                            toastr.success('el servicio de bombe fue guardado correctamente');
                            location.reload();
                        },
                        error: function (respuesta) {
                            alert(JSON.stringify(respuesta));
                        },

                    });
                });

                $("#b_terminacion_descargue").click(function () {
                    var hora = $("#ch_terminacion").val();
                    var id_remision = <?php echo $id ?>;

                    $.ajax({
                        url: "ajax_detalle_Remi_1.php",
                        type: "POST",
                        data:
                                {
                                    task: 4,
                                    id_Remision: id_remision,
                                    hora: hora,
                                },
                        success: function (response)
                        {
                            toastr.success('la hora fue guardada correctamente');
                            location.reload();
                        },
                        error: function (respuesta) {
                            alert(JSON.stringify(respuesta));
                        },

                    });
                });


                $("#b_descargueProduct").click(function () {
                    var hora = $("#h_descargueProduct").val();
                    var id_remision = <?php echo $id ?>;

                    $.ajax({
                        url: "ajax_detalle_Remi_1.php",
                        type: "POST",
                        data:
                                {
                                    task: 3,
                                    id_Remision: id_remision,
                                    hora: hora,
                                },
                        success: function (response)
                        {
                            toastr.success('la hora fue guardada correctamente');
                            location.reload();
                        },
                        error: function (respuesta) {
                            alert(JSON.stringify(respuesta));
                        },

                    });
                });


                $("#b_llegadaVehiculo").click(function () {
                    var hora = $("#ch_llegadaObra").val();
                    var id_remision = <?php echo $id ?>;

                    $.ajax({
                        url: "ajax_detalle_Remi_1.php",
                        type: "POST",
                        data:
                                {
                                    task: 2,
                                    id_Remision: id_remision,
                                    hora: hora,
                                },
                        success: function (response)
                        {
                            toastr.success('la hora fue guardada correctamente');
                            location.reload();
                        },
                        error: function (respuesta) {
                            alert(JSON.stringify(respuesta));
                        },

                    });
                });



                $("#bh_salida_planta").click(function () {
                    var hora = $("#h_salida_planta").val();
                    var id_remision = <?php echo $id ?>;

                    $.ajax({
                        url: "ajax_detalle_Remi_1.php",
                        type: "POST",
                        data:
                                {
                                    task: 1,
                                    id_Remision: id_remision,
                                    h_salida_planta: hora,
                                },
                        success: function (response)
                        {
                             toastr.success('la hora fue guardada correctamente');
                            location.reload();
                        },
                        error: function (respuesta) {
                            alert(JSON.stringify(respuesta));
                        },

                    });
                });


                $("#btn_aceptar").click(function () {
                  
                    var id_remision = <?php echo $id ?>;

                    $.ajax({
                        url: "ajax_detalle_Remi_1.php",
                        type: "POST",
                        data:
                                {
                                    task: 10,
                                    id_Remision: id_remision,
                                   
                                },
                        success: function (response)
                        {
                             toastr.success('la remision fue aceptada correctamente');
                            location.reload();
                        },
                        error: function (respuesta) {
                            alert(JSON.stringify(respuesta));
                        },

                    });
                });








            });

        </script>
    </body>
</html>

