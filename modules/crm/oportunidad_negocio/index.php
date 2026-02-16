<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php';

$t1_terceros = new t1_terceros();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>OPORTUNIDAD DE NEGOCIO</h1>
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

        <?php
        /**
         * Validacion de Usuario
         */
        $t1_terceros = new t1_terceros();
        ?>
        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">TABLA DE LAS OPORTUNIDADES DE NEGOCIO</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Codigo oportunidad de negocio</label>
                            <input type="number" name="txt_cod_oportunidad" id="txt_cod_oportunidad" class="form-control" />
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Buscar</label>
                            <button type="button" id="buscar" class="btn btn-block btn-info">Buscar</button>
                        </div>
                    </div>
                </div>
                <table id="table_op" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Cod. de la oportunidad</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>identificacion</th>
                            <th>Nombre cliente</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include '../../../layout/footer/footer3.php' ?>

<script>

 // Accion de Eliminar en la tabla de novedades por cliente y obra
 $('#table_op tbody').on('click', 'button.btn_eliminar', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: '',
                text: "",
                icon: 'success',
                html: "Esta seguro de eliminar la Oportunidad de negocio br>",
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonText: 'Aceptar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "eliminar_op.php",
                        type: "POST",
                        data: {
                            id: data['id'], // el id de la novedad
                            task: 2 // task 2 Elimina por Remision
                        },
                        success: function(response) {
                            // Recargar la ta bla
                            table.ajax.reload();
                            if(data.estado){
                                toastr.success("Eliminado Correctamente");
                            }else{
                                toastr.warning("Eliminado Correctamente");
                            }
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });

                } else {


                }
            })

        });



    $('.select2').select2();

    function datatable_oportunidad_negocio(cod, nombre) {
        var table = $('#table_op').DataTable({
            'searching': true,
            "processing": true,
            "scrollX": true,
            "ajax": {
                "url": "datatable.php",
                "data": {
                    'id': cod,
                    'razon_social': nombre,
                },
                'type': 'post',
                "dataSrc": ""
            },
            "order": [
                [0, 'desc']
            ],
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "id"
                },
                {
                    "data": "status_op"
                },
                {
                    "data": "fecha"
                },
                {
                    "data": "nidentificacion"
                },
                {
                    "data": "razon_social"
                },
                {
                    "data": "editar"
                }
            ],
            //"scrollX": true,

        });

        table.on('order.dt search.dt', function() {
            table.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();

        $('#table_op tbody').on('click', 'button.btn_editar', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            window.location = "editar/editar.php?id=" + id;
        });
        table.ajax.reload();
        return table;
    }

    $('#buscar').on('click', function() {
        var cod = $('#txt_cod_oportunidad').val();
        var nombre = $('#txd_cliente').val();
        if ($.fn.dataTable.isDataTable('#table_op')) {
            table = $('#table_op').DataTable();
            table.destroy();
        }
        table = datatable_oportunidad_negocio(cod, nombre);
        setInterval(function() {
            table.ajax.reload(null, false);
        }, 5000);
    });
</script>

</body>

</html>