<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>

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
                    <h1>Vehiculo</h1>
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
                <h3 class="card-title">Registrar Nuevo Vehiculo</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>

                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="F_crear" id="F_crear" method="POST">


                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Escribir Placa del Vehiculo</label>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" id="txt_letras" name="txt_letras" class="form-control" placeholder="Solo Letras" >
                                </div>
                            </div>
                            <div class="col-1">
                                <center> - </center>
                            </div>
                            <div class="col-2">
                                <div class="form-group">
                                    <input type="text" id="txt_num" name="txt_num" class="form-control" placeholder="Solo numeros" >
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block bg-gradient-info">Guardar</button>
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
    $('#F_crear').validate({
        rules: {
            txt_letras: {
                required: true,
                maxlength: 3,
                minlength: 3,
                lettersonly: true,

            },
            txt_num: {
                required: true,
                maxlength: 3,
                minlength: 3,
                digits : true,
            },
            
        },
        messages: {
            txt_letras: {
                required: "Este campo es Requerido",
                
            },
            txt_num: {
                required: "Este campo es Requerido",
                
            },
           
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            $.ajax({
                url: "php_crear.php",
                type: "POST",
                data: $(form).serialize(),
                cache: false,
                processData: false,
                success: function(data) {
                    if(data.estado){
                        toastr.success('exitoso');
                        
                    }else{
                        toastr.warning(data.errores);               
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }
    });
});
</script>
</script>


</body>

</html>