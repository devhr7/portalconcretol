<?php include '../../../../layout/validar_session_cliente4.php' ?>
<?php include '../../../../layout/head/headcliente4.php' ?>
<?php include 'sidebar.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PROGRAMACION SEMANAL</h1>
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
                <h3 class="card-title">VER PROGRACIONES SEMANALES</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id='calendar'></div>
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

<!-- Modal -->
<?php include 'modal_crear_event.php' ?>
<?php include 'modal_mostrar_event.php' ?>

<!-- /.modal-dialog -->

<?php include '../../../../layout/footer/footercliente4.php' ?>

<script src="calendar.js"> </script>
<script>
    $(function() {
        $('.select2').select2();
        $("#form_mostrar_event").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_editar_prog_semanal.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        $("#form_crear_event").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_crear_prog_semanal.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        $('#txt_cliente').on('change', function() {
            //Ajax 
            var formData = new FormData();
            formData.append('task', 2);
            formData.append('cliente', $("#txt_cliente").val());
            $.ajax({
                url: "load_data.php", // URL
                type: "POST", // Metodo HTTP
                //data: formData,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#txt_obra").html(data.select_obra)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });

        $('#edit_txt_cliente').on('change', function() {
            //Ajax 
            var formData = new FormData();
            formData.append('task', 2);
            formData.append('cliente', $("#edit_txt_cliente").val());
            $.ajax({
                url: "load_data.php", // URL
                type: "POST", // Metodo HTTP
                //data: formData,
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    $("#edit_txt_obra").html(data.select_obra)
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    });
</script>

</body>

</html>