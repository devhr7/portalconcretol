<?php

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

$php_clases = new php_clases();
$general_modelos = new general_modelos();
$t40_votaciones = new t40_votaciones();

if(isset($_GET['id_votante'])){

    $id_votante = (int)$_GET['id_votante'];

}else{

}

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CONCRE TOLIMA</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Icono del titulo del documento-->
    <link href="../../../assets/images/logos/LogoConcretol.png" rel="icon" type="image">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../../plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="../../../dist/css/adminlte.min.css">
    <!--- sweetalert2.css---->
    <link href="../../../plugins/sweetalert2/dist/sweetalert2.css" rel="stylesheet" />
    <!-- Toastr -->
    <link href="../../../plugins/toastr/toastr.css" rel="stylesheet" />
    <link href="../../../plugins/select2/css/select2.css" rel="stylesheet" />

    <link href="../../../plugins/datatables/datatables.css" rel="stylesheet" />
    <link rel="stylesheet" href="../../../plugins/ekko-lightbox/ekko-lightbox.css" />
    <link rel="stylesheet" type="text/css" href="../../../plugins/DataTables/datatables.min.css" />

    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">

    <link href="../../../custom/remi.css" rel="stylesheet" />

</head>

<body class="sidebar-collapse layout-top-nav" style="height: auto;">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->

        <!-- /.navbar -->



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
                            <h1>Elecciones CONCRE TOLIMA SA</h1>
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


                <?php

                $datos_campana = $t40_votaciones->select_campana();


                foreach ($datos_campana as $key) {
                    ?>
                    <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title"> ELECCIONES <?php echo $key['ct40_nombrecampvota']; ?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                            <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="contenido">
                            <form name="F_votacion_camp1" id="F_votacion_camp1" method="POST">
                                <div class="row">
                                    <?php
                                    
                                    $id_campana  = (int)$key['ct40_idcampvota']; 

                                    $result_veri =  $t40_votaciones->verificacion($id_votante,$id_campana);

                                    if($result_veri){
                                        $disabled = " disabled ";
                                    }else{
                                        $disabled = "  ";
                                    }
                                    
                                    include 'candidatos.php';
                                    
                                    if($result_veri){
                                        $disabled = " disabled ";
                                    }else{
                                        $disabled = "  ";
                                    }

                                    ?>
                                </div>
                                <hr>
                            </form>
                        </div>
                    </div>
                </div> 
<?php
                }

                ?>
             
            </section>



            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php include '../../../layout/footer/footer3.php' ?>



</body>

</html>