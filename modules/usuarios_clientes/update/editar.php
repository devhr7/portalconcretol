<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php' ?>
<?php require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; ?>
<?php
$php_clases = new php_clases();
$t1_terceros = new t1_terceros();
$t5_obras = new t5_obras();
$id = $_GET['id'];
$datos_tercero = $t1_terceros->search_tercero_custom_id($id);

while ($fila_t1 = $datos_tercero->fetch(PDO::FETCH_ASSOC)) {
    $numero_identificacion = $fila_t1['ct1_NumeroIdentificacion'];
    $nombre1 = $fila_t1['ct1_Nombre1'];
    $apellido1 = $fila_t1['ct1_Apellido1'];
    $id_obra = $fila_t1['ct1_obra_id'];
    $id_cliente1 = $fila_t1['ct1_id_cliente1'];
}
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Usuarios Clientes</h1>
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
                <h3 class="card-title">Editar Usuario Cliente <?= $id ?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <form name="F_editar" id="F_editar" method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                        <script>
                            var id = <?php echo json_encode($id); ?>;
                        </script>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Nombres Completos</label>
                                    <input name="C_nombres" id="C_nombres" type="text" class="form-control" value="<?php echo $nombre1; ?>" placeholder="Digite el nombre">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Apellidos Completos</label>
                                    <input name="C_Apellidos" id="C_Apellidos" type="text" class="form-control" value="<?php echo $apellido1 ?>" placeholder="Digite los Apellidos">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label>Numero de Cedula de ciudadania</label>
                                    <input name="C_NumeroID" id="C_NumeroID" type="text" class="form-control" placeholder="Digite el numero de la Cedula" value="<?php echo $numero_identificacion; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-info">Guardar</button>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button type="button" name="btn-restablecer" id="btn-restablecer" class="btn btn-block bg-gradient-warning">Restablecer Contraseña</button>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button type="button" class="btn btn-block btn-danger" id="btn-eliminar"> Eliminar Usuario</button>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#crear_cliente_obra">
                                        <i class="fas fa-plus"></i> ADICIONAR CLIENTE Y OBRA
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal fade " id="crear_cliente_obra">
                        <div class="modal-dialog  modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">ADICIONAR CLIENTE Y OBRA</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name="form_guardar_cliente_obra" id="form_guardar_cliente_obra" method="POST">
                                        <input type="hidden" name="id" id="id" value="<?php echo $id ?>">
                                        <script>
                                            var id = <?php echo json_encode($id); ?>;
                                        </script>
                                        <div class="row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label>Seleccionar cliente</label>
                                                    <select class="js-example-basic-single select2 form-control" id="C_IdTerceros" name="C_IdTerceros" style="width:100%" required>
                                                        <?php echo $t1_terceros->option_cliente_edit(); ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label> Selecccionar Obra</label>
                                                    <select class="js-example-basic-single select2 form-control" id="C_Obras" name="C_Obras" style="width:100%">
                                                        <?php echo $t5_obras->option_obra($id_cliente1); ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <button type="submit" class="btn btn-block btn-info">Guardar</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal-content -->
                    </div>
                    <table id="table_clientes_obras" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>N</th>
                                <th>Cliente</th>
                                <th>Obra</th>
                                <th>Detalles</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
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
        $('.select2').select2();
    });
</script>
<script>
    $(document).ready(function() {
        $('#C_IdTerceros').on('change', function() {
            $.ajax({
                url: "get_data.php",
                type: "POST",
                data: {
                    idCliente: ($('#C_IdTerceros').val()),
                    task: "1",
                },
                success: function(response) {
                    console.log(response.estado);
                    $('#C_Obras').html(response.obras);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        });
    });

    $("#form_guardar_cliente_obra").on('submit', (function(e) {
        e.preventDefault();
        $.ajax({
            url: "php_crear_cliente_obra.php",
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

    $(document).ready(function() {
        var n = 1;
        var id_usuario = <?= $id ?>;
        var table_clientes_obras = $('#table_clientes_obras').DataTable({
            "ajax": {
                "url": "datatable_clientes_obras.php",
                'data': {
                    'id_usuario': id_usuario,
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
                    "data": "cliente"
                },
                {
                    "data": "obra"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-danger btn-sm' id = 'btn-eliminar'> <i class='fas fa-trash'></i> </button>"
                }
            ],
            //"scrollX": true,
        });

        table_clientes_obras.on('order.dt search.dt', function() {
            table_clientes_obras.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        $('#table_clientes_obras tbody').on('click', 'button', function() {
            var data = table_clientes_obras.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: '¿Esta Seguro(a) que desea eliminar este cliente y obra?', // mensaje de la alerta
                text: "",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'No', // text boton
                confirmButtonText: 'Si Eliminar'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "php_eliminar_cliente_obra.php",
                        type: "POST",
                        data: {
                            task: 1,
                            id: id,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'El cliente y obra fueron eliminados correctamente',
                                )
                                table_clientes_obras.ajax.reload();
                            } else {
                                console.log("error");
                            }
                        },
                        error: function(respuesta) {
                            alert(JSON.stringify(respuesta));
                        },
                    });
                }
            })
        });
        setInterval(function() {
            table_clientes_obras.ajax.reload(null, false);
        }, 5000);
    });
</script>
<script src="ajax_editar.js"> </script>
<script src="ajax_restablecer_pass.js"> </script>
<script src="ajax_eliminar.js"> </script>
</body>

</html>