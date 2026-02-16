<?php include '../../../../layout/validar_session4.php' ?>
<?php include '../../../../layout/head/head4.php'; ?>
<?php include 'sidebar.php' ?>
<?php
$pedidos = new pedidos();
$id = $_GET['id'];
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PEDIDO # <b><?= $id ?></b></h1>
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
    <section class="content">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">PEDIDO</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div id="contenido">
                    <div class="row">
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#modal_cargar">
                                    <i class="fas fa-download"></i> CARGAR PRECIOS
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-12">
                            <div class="form-group">
                                <label>PRODUCTOS</label>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#crear_precio_producto">
                                    <i class="fas fa-plus"></i> ADICIONAR PRECIO PRODUCTO
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="table_precio_productos" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Status</th>
                            <th>Producto</th>
                            <th>%</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- Default box -->
            <div class="modal fade " id="crear_precio_producto">
                <div class="modal-dialog  modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ADICIONAR PRECIO PRODUCTO</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="form_crear_precio_producto" id="form_crear_precio_producto" method="post">
                                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="id_producto">Producto</label>
                                            <br>
                                            <select class="form-control select2" style="width:100%" name="id_producto" id="id_producto">
                                                <?= $pedidos->select_productos(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="descuento">Descuento</label>
                                            <input type="number" name="descuento" id="descuento" class="form-control validanumericos" required="true" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="subtotal">Subtotal</label>
                                            <input type="number" name="subtotal" id="subtotal" class="form-control" required="true"  />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="cantidad">Cantidad m3</label>
                                            <input type="number" name="cantidad" id="cantidad" class="form-control validanumericos" required="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for=""></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <div class="card-body">
                <div id="contenido">
                    <div class="row">
                        <div class="col-md-9 col-sm-12">
                            <div class="form-group">
                                <label>BOMBEO</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#crear_precio_bomba">
                                <i class="fas fa-plus"></i> ADICIONAR PRECIO BOMBA
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="table_precio_bomba" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Status</th>
                            <th>Tipo de bomba</th>
                            <th>Cant. min</th>
                            <th>Cant. max</th>
                            <th>Precio</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- Default box -->
            <div class="modal fade" id="crear_precio_bomba">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ADICIONAR PRECIO BOMBA</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="form_crear_precio_bomba" id="form_crear_precio_bomba" method="post">
                                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="id_tipo_bomba">Tipo de bomba</label>
                                            <select class="form-control select2" name="id_tipo_bomba" id="id_tipo_bomba">
                                                <?= $pedidos->select_bomba(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="rango">Rango M3</label>
                                            <label for="minimo">Minimo</label>
                                            <input type="number" name="minimo" id="minimo" class="form-control validanumericos" required="true" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="rango">Rango M3</label>
                                            <label for="maximo">Maximo</label>
                                            <input type="number" name="maximo" id="maximo" class="form-control validanumericos" required="true" />
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input type="text" name="precio" id="precio" class="form-control" required="true" onkeyup="format(this)" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for=""></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <div class="card-body">
                <div id="contenido">
                    <div class="row">
                        <div class="col-md-9 col-sm-12">
                            <div class="form-group">
                                <label>SERVICIOS ADICIONALES</label>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12">
                            <div class="form-group">
                                <button type="button" class="btn btn-block btn-info" data-toggle="modal" data-target="#crear_precio_servicio_adicional">
                                <i class="fas fa-plus"></i> ADICIONAR SERVICIO
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <table id="table_precio_servicios" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>N</th>
                            <th>Status</th>
                            <th>Servicio</th>
                            <th>Precio</th>
                            <th>Detalles</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- Default box -->
            <div class="modal fade" id="crear_precio_servicio_adicional">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">ADICIONAR PRECIO SERVICIO</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="form_crear_precio_servicio" id="form_crear_precio_servicio" method="post">
                                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="id_tipo_servicio">Tipo de servicio</label>
                                            <br>
                                            <select class="form-control select2" name="id_tipo_servicio" id="id_tipo_servicio" style="width:100%">
                                                <?= $pedidos->select_servicio(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="precio">Precio</label>
                                            <input type="text" name="precio" id="precio" class="form-control" required="true" onkeyup="format(this)" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for=""></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <div class="modal fade" id="modal_cargar">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">CARGAR PRECIOS</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col">
                                    <div class="btn-group">
                                        <input type="hidden" class="btn-check" name="options" id="option1" autocomplete="off" />
                                        <label class="btn btn-primary" for="option1" data-toggle="modal" data-target="#cargar_precios">Cargar lista de precios existentes por codigo</label>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="btn-group">
                                        <input type="hidden" class="btn-check" name="options" id="option2" autocomplete="off" />
                                        <label class="btn btn-primary" for="option2" data-toggle="modal" data-target="#cargar_excel">Cargar lista de precios en un archivo excel</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <div class="modal fade" id="cargar_precios">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">CARGAR PRECIOS</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="form_cargar_precio_servicio" id="form_cargar_precio_servicio" method="post">
                                <input type="hidden" name="id_pedido_cargar" id="id_pedido_cargar" value="<?= $id ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="codigo_pedido_existente">Digite el Codigo del pedido existente para cargar los datos</label>
                                            <input type="text" name="txt_cod_load" id="txt_cod_load" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for=""></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Guardar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <div class="modal fade" id="cargar_excel">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">CARGAR PRECIOS EXCEL</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name="form_productos" id="form_productos" method="post">
                                <input type="hidden" name="id" id="id" value="<?= $id ?>">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Seleccione una opcion</label>
                                            <br>
                                            <select class="select2 form-control" name="id_select_producto" id="id_select_producto" style="width:100%">
                                                <option selected disabled value="">Seleccione</option>
                                                <option value="1">Actualizar toda la lista</option>
                                                <option value="2">Adicionar precios</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Seleccionar Archivo</label>
                                            <!-- input para seleccionar el archivo -->
                                            <input type="file" class="form-control" name="file_productos" id="file_productos" disabled="true" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-10">
                                        <div class="form-group">
                                            <label for=""></label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <!-- boton para guardar el archivo -->
                                            <button type="submit" class="btn btn-success" name="btn_subirarchivo" id="btn_subirarchivo" onclick="return confirm('¿Desea agregar los productos?')">
                                                Subir
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
        </div>
    </section>
</div>
<?php include '../../../../layout/footer/footer4.php' ?>

<script>
    $(function() {
        $(".progress").hide();
        $('.select2').select2();
    });

    $(function() {
        $('.validanumericos').keypress(function(e) {
                if (isNaN(this.value + String.fromCharCode(e.charCode)))
                    return false;
            })
            .on("cut copy paste", function(e) {
                e.preventDefault();
            });
    });

    $(document).ready(function() {
        // Formulacio Cargar Precios
        $("#form_cargar_precio_servicio").on('submit', (function(e) {
            $('#cargar_precios').modal('toggle');
            e.preventDefault();
            $.ajax({
                url: "php_cargar_precios_pedidos.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.estado) {
                        toastr.success('Se ha cargado los precios correctamente');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        $("#form_crear_precio_producto").on('submit', (function(e) {
            $('#crear_precio_producto').modal('toggle');
            e.preventDefault();
            $.ajax({
                url: "php_crear_precio_producto.php",
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
    })

    $(document).ready(function() {
        $("#form_crear_precio_bomba").on('submit', (function(e) {
            $('#crear_precio_bomba').modal('toggle');
            e.preventDefault();
            $.ajax({
                url: "php_crear_precio_bomba.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    if (data.estado) {
                        toastr.success('Se ha guardado correctamente');
                        table_bomba.ajax.reload();
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    })

    $(document).ready(function() {
        $("#form_crear_precio_servicio").on('submit', (function(e) {
            $('#crear_precio_servicio_adicional').modal('toggle');
            e.preventDefault();
            $.ajax({
                url: "php_crear_precio_servcicio.php",
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
    })

    $(document).ready(function() {
        var n = 1;
        var id_pedido = <?= $id ?>;
        var table_producto = $('#table_precio_productos').DataTable({
            "ajax": {
                "url": "data_table_productos.php",
                'data': {
                    'id_pedido': id_pedido,
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
                    "data": "status"
                },
                {
                    "data": "codigo_producto"
                },
                {
                    "data": "porcentaje_descuento"
                },
                {
                    "data": "cantidad_m3"
                },
                {
                    "data": "precio_m3"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-danger btn-sm' id = 'btn-eliminar'> <i class='fas fa-trash'></i> </button>"
                }
            ],
            //"scrollX": true,
        });

        table_producto.on('order.dt search.dt', function() {
            table_producto.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        $('#table_precio_productos tbody').on('click', 'button', function() {
            var data = table_producto.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: '¿Esta Seguro(a) que desea eliminar el producto?', // mensaje de la alerta
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
                        url: "php_eliminar_producto.php",
                        type: "POST",
                        data: {
                            task: 1,
                            id: id,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'El producto fue eliminado correctamente',
                                )
                                table_producto.ajax.reload();
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
            table_producto.ajax.reload(null, false);
        }, 5000);
    })

    $(document).ready(function() {
        var n = 1;
        var id_pedido = <?= $id ?>;
        var table_bomba = $('#table_precio_bomba').DataTable({
            "ajax": {
                "url": "data_table_bomba.php",
                'data': {
                    'id_pedido': id_pedido,
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
                    "data": "status"
                },
                {
                    "data": "nombre_tipo_bomba"
                },
                {
                    "data": "min_m3"
                },
                {
                    "data": "max_m3"
                },
                {
                    "data": "precio"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-danger btn-sm' id = 'btn-eliminar'> <i class='fas fa-trash'></i> </button>"
                }
            ],
            //"scrollX": true,
        });
        table_bomba.on('order.dt search.dt', function() {
            table_bomba.column(0, {
                search: 'applied',
                order: 'applied'
            }).nodes().each(function(cell, i) {
                cell.innerHTML = i + 1;
            });
        }).draw();
        $('#table_precio_bomba tbody').on('click', 'button', function() {
            var data = table_bomba.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: '¿Esta Seguro(a) que desea eliminar la bomba?', // mensaje de la alerta
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
                        url: "php_eliminar_bomba.php",
                        type: "POST",
                        data: {
                            task: 1,
                            id: id,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'La bomba fue eliminada correctamente',
                                )
                                table_bomba.ajax.reload();
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
            table_bomba.ajax.reload(null, false);
        }, 5000);
    })

    $(document).ready(function() {
        var n = 1;
        var id_pedido = <?= $id ?>;
        var table = $('#table_precio_servicios').DataTable({
            "ajax": {
                "url": "data_table_servicios.php",
                'data': {
                    'id_pedido': id_pedido,
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
                    "data": "status"
                },
                {
                    "data": "nombre_tipo_servicio"
                },
                {
                    "data": "precio"
                },
                {
                    "data": null,
                    "defaultContent": "<button class='btn btn-danger btn-sm' id = 'btn-eliminar'> <i class='fas fa-trash'></i> </button>"
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
        $('#table_precio_servicios tbody').on('click', 'button', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            Swal.fire({
                title: '¿Esta Seguro(a) que desea eliminar el servicio?', // mensaje de la alerta
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
                        url: "php_eliminar_servicios.php",
                        type: "POST",
                        data: {
                            task: 1,
                            id: id,
                        },
                        success: function(response) {
                            if (response.estado) {
                                Swal.fire(
                                    'El servicio fue eliminado correctamente',
                                )
                                table.ajax.reload();
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
            table.ajax.reload(null, false);
        }, 5000);
    })

    $('#id_producto').change(function() {
        var subtotal = $("#subtotal").val();
        $.ajax({
            url: "ajax_get_data_precios.php",
            type: "POST",
            data: {
                task: 1,
                id_producto: $('#id_producto').val(),
                descuento: $('#descuento').val(),
            },
            success: function(response) {
                $("#subtotal").val(response.subtotal);
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    })

    $('#descuento').change(function() {
        var subtotal = $("#subtotal").val();
        $.ajax({
            url: "ajax_get_data_precios.php",
            type: "POST",
            data: {
                task: 1,
                id_producto: $('#id_producto').val(),
                descuento: $('#descuento').val(),
            },
            success: function(response) {
                $("#subtotal").val(response.subtotal);
            },
            error: function(respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    })

    $("#id_select_producto").change(function() {
        var producto = $("#id_select_producto").val();
        console.log(producto);
        if (producto == 1) {
            $("#file_productos").attr('disabled', false);
            $("#form_productos").on('submit', (function(e) {
                $('#cargar_excel').modal('toggle');
                e.preventDefault();
                $.ajax({
                    url: "../importar_dos/ajax_productos_uno.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        if (data.estado) {
                            toastr.success('Guardado Correctamente');
                        } else {
                            toastr.info(data.result);
                        }
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                        //location.reload();
                    }
                });
            }));
        } else if (producto == 2) {
            $("#file_productos").attr('disabled', false);
            $("#form_productos").on('submit', (function(e) {
                e.preventDefault();
                $.ajax({
                    url: "../importar_dos/ajax_productos_dos.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        console.log(data);
                        if (data.estado) {
                            toastr.success('Guardado Correctamente');
                        } else {
                            toastr.info(data.result);
                        }
                    },
                    error: function(respuesta) {
                        alert(JSON.stringify(respuesta));
                        //location.reload();
                    }
                });
            }));
        } else {
            $("#file_productos").attr('disabled', true);
        }
    });


    function format(input) {
        var num = input.value.replace(/\./g, '');
        if (!isNaN(num)) {
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g, '$1.');
            num = num.split('').reverse().join('').replace(/^[\.]/, '');
            input.value = num;

        } else {

            input.value = input.value.replace(/[^\d\.]*/g, '');
        }
    }
</script>