<?php
$programacion = new programacion();

// $id = $_GET['id_evento'];
?>
<div class="modal fade" id="modal_show_evento" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Evento </h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form_mostrar_event" name="form_mostrar_event" method="post">
                <div class="modal-body">
                    <input type="hidden" value="" id="id_prog_evento" name="id_prog_evento" />
                    <input type="hidden" value="2" id="task" name="task" />
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="edit_txt_cliente" class="control-label">Cliente</label>
                                <select name="edit_txt_cliente" id="edit_txt_cliente" class="form-control select2" style="width: 100%;">

                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="edit_txt_obra" class="form-label">Obra</label>
                                <select name="edit_txt_obra" id="edit_txt_obra" class="form-control select2" style="width: 100%;">
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="edit_txt_cant" class="col-sm-2 form-label">Cantidad</label>
                                <input name="edit_txt_cant" id="edit_txt_cant" class="form-control" style="width: 100%;" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="edit_txt_producto" class="control-label">Producto</label>
                                <select name="edit_txt_producto" id="edit_txt_producto" class="form-control select2" style="width: 100%;">

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="edit_start" class="form-label">Fecha Inicial</label>
                                <input type="text" name="edit_start" class="form-control" id="edit_start">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="edit_end" class="control-label">Fecha Final</label>
                                <input type="text" name="edit_end" class="form-control" id="edit_end">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btn_guardar" class="btn btn-success">Guardar</button>
                    <button type="button" id="btn_eliminar" class="btn btn-danger">Eliminar</button>
                </div>
            </form>

        </div>

    </div>
    <!-- /.modal-content -->
</div>