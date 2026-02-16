

<!DOCTYPE html>
<html>

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>CONCRE TOLIMA</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!------->
    <!-- Titulo del Documento-->
    <title>
        CONCRE TOLIMA SA
    </title>
    <!-- Icono del titulo del documento-->
    <link href="../assets/images/logos/LogoConcretol.png" rel="icon" type="image">
    
    <!------------>
    <!-- Iconos-->
    <!--Font Awesome-->
    <link href="../plugins/fontawesome-free/css/all.css" rel="stylesheet" />
    <!-- Ionicons-->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" />
    <!--Tema-->
    <link href="../dist/css/adminlte.css" rel="stylesheet" />
    <!--- sweetalert2.css---->
    <link href="../plugins/sweetalert2/dist/sweetalert2.css" rel="stylesheet" />
    <!-- Toastr -->
    <link href="../plugins/toastr/toastr.css" rel="stylesheet" />
    <!----Fuentes de letra---->
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet" />
    <!-- ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"> </script>
    
    
    

    <style>
    .fondo-index {
        background: url("../assets/images/fondos/fondo.jpg");
        background-size: 100% 100%;
        background-repeat: no-repeat;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
    </style>
 

</head>

<body class="hold-transition login-page fondo-index">
    <!--Body-->
    <div class="login-box">
        <!----Logo------>
        <section id="banner">
            <div class="login-logo">
                <div class="">
                    <a href="#">
                        <img src="../assets/images/logos/logo.concretol-v7.png"
                            style="border-radius:5%; -webkit-box-shadow: 21px 21px 31px 1px rgba(0,0,0,0.75);-moz-box-shadow: 21px 21px 31px 1px rgba(0,0,0,0.75); box-shadow: 21px 21px 31px 1px rgba(0,0,0,0.75);"
                            width="50%">
                        </img>
                    </a>
                </div>
            </div>
        </section>
        <!-- /.login-logo -->
        <section id="main">
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">
                        Restablecimiento de Contraseña
                    </p>
                    <div id="pageMessage">
                        Ingresa el usuario/email  y dar clic en el boton <b>Restablecer </b> para cambiar la contraseña? 
                    </div>
                    <br>
                    <!---    --->
                    <form id="form_reset" method="POST" name="form_reset">
                        <!---  Animacion Cargando -->
                        <div align="center" id="pageAnimation">
                            <i class="fa fa-spinner fa-spin" style="font-size:24px">
                            </i>
                        </div>
                        <!--- /.Animacion cargando -->
                        <div class="input-group mb-3">
                            <input class="form-control" id="usuario" name="usuario" placeholder="Usuario" type="email" >
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user">
                                    </span>
                                </div>
                            </div>
                            </input>
                        </div>
                        <br>
                        <div class="social-auth-links text-center mb-3">
                            <button class="btn btn-block btn-warning" type="submit" id="reset_pass">
                                Restablecer
                            </button>
                        </div>
                        
                        <div class="social-auth-links text-center mb-3">
                            <!-- <a href="restabler_pass.php"> ¿Has olvidado tu contraseña ?</a> -->
                        </div>
                        </br>
                    </form>
                    <p class="mb-0">
                        <i class="fas fa-arrow-left">
                        </i>
                        <a class="text-center" href="index.php">
                            Atras
                        </a>
                        <!--- enlace ---->
                    </p>
                    </br>
                </div>
                <!-- /.login-card-body -->
            </div>
        </section>
    </div>
    <!-- /.login-box -->
    <!---/body -->
    <!-- Scripts-->
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="../build/js/AdminLTE.js"></script>
    <script src="../plugins/sweetalert2/dist/sweetalert2.all.js"></script>
    <script src="../plugins/sweetalert2/dist/sweetalert2.js"></script>
    <script src="../plugins/toastr/toastr.min.js"></script>
    
    
</script>






<script type="text/javascript">
    $(document).ready(function (e) {



        $("#form_reset").on('submit', (function (e) {
        e.preventDefault(e);

Swal.fire({
  title: 'Estas Seguro de Restablecer la contraseña?',
  text: "Se enviara se enviara un correo de restablecimiento",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Si, Restablecer'
}).then((result) => {
  if (result.value) {





    Swal.fire(
      'Deleted!',
      'Your file has been deleted.',
      'success'
    )
  }
})






        console.log("clicl")
    }));


    });
</script>

    <!-- /animaciones-->
    <script>
    $('#pageAnimation').hide();
    </script>
</body>

</html>