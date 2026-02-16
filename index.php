<?php
include 'librerias/autoload.php';
include 'vendor/autoload.php';
//Version Preliminar

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!------->
    <!-- Titulo del Documento-->
    <title>CONCRETOL</title>
    <!-- Icono del titulo del documento-->
    <link width="516" height="641" href="assets/images/logos/LogoConcretol.png" rel="icon" type="image">

    <!------------>
    <!-- Iconos-->
    <!--Font Awesome-->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.css">
    <!-- Ionicons-->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!---------->
    <!--Tema-->
    <link rel="stylesheet" href="dist/css/adminlte.css">
    <!------->
    <!----Fuentes de letra---->
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .fondo-index {
            background: url("assets/images/fondos/fondo.jpg");
            background-size: 100% 100%;
            background-repeat: no-repeat;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .contenedor-items {
            background: #e9ecef;
            padding: 50px 50px 50px 50px;
            border-radius: 50px;
            border: none;
            -webkit-box-shadow: 20px 21px 84px 0px rgba(0, 0, 0, 0.75);
            -moz-box-shadow: 10px 21px 84px 0px rgba(0, 0, 0, 0.75);
            box-shadow: 20px 21px 84px 0px rgba(0, 0, 0, 0.75);
        }
    </style>
</head>

<body class="hold-transition fondo-index">
    <!-- Contenido-->
    <div class="lockscreen-wrapper contenedor-items">
        <!-- lOGO -->
        <div class="lockscreen-logo">
            <a href=""><img  width="255" height="55" src="assets/images/logos/logo-concretol-v6.png"> </a>
            <br>
        </div>
        <section id="main">
            <div class="row hr-etq-a">
                <!--- Logo Clientes -->
                <div class="col">
                    <!-- Clientes -->
                    <div class="row">
                        <div class="col text-center">
                            <a href="clientes.php"><i class="fas fa-user-circle" style="font-size:9em"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <a href="clientes.php">Clientes</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <!-- Funcionarios -->
                    <div class="row">
                        <div class="col text-center">
                            <a href="funcionarios.php"><i class="fas fa-industry" style="font-size:9em"></i></a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <a href="funcionarios.php">Funcionarios</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /Contenido-->

    <!--Animaciones----->

    <!----/Animaciones-->

    <!----/Scripts-->

</body>

</html>

<?php
//
//FB::log('Mensaje de log');
//
?>