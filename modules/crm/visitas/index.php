<?php include '../../../layout/validar_session3.php' ?>
<?php include '../../../layout/head/head3.php'; ?>
<?php include 'sidebar.php';

$t1_terceros = new t1_terceros();
$visita_clientes = new visitas_clientes();
$t5_obras = new t5_obras();
$oportunidad_negocio = new oportunidad_negocio();
$php_clases = new php_clases();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>VISITAS COMERCIALES</h1>
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
                <h3 class="card-title">Explorar las visitas comerciales</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize"><i class="fas fa-expand"></i></button>
                </div>
            </div>
            <div class="card-body">
                
              <div class="row">
                <div class="col">
                <div id='calendar'></div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->


    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<!----- modales ---------->
    <!--- modal Crear Visita Comercial -->
    <?php include 'modal/crear_visita.php'; ?>
    <?php include 'modal/editar_visita_comercial.php'; ?>



    <div class="modal fade" id="modal_editar_evento" data-bs-backdrop="static" data-bs-keyboard="false"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar Visita Cliente</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
    

            <div class="modal-body">
                <form id="form_editar_visita" name="form_editar_visita" method="post">
                    <input type="hidden" name="txt_id" id="txt_id">

                    <div class="row">
                        <!-- Asesor Comercial --->
                        <div class="col-3">
                            <div class="form-group">
                                <label for="result_visit">Asesor Comercial </label>

                                <select name="txt_asesora_comercial_edit" style="width:100%" id="txt_asesora_comercial_edit"
                                    class="form-control select2">

                                </select>

                            </div>
                        </div>
                        <!-- Objetivo de la visita -->
                        <div class="col-3">
                            <div class="form-group">
                                <!--- visita comercial ---- Cambiar --- Oportunidad de Negocio --->
                                <label for="result_visit">Objetivo de la visita</label>
                                <select class="select2 form-control" style="width:100%" name="objetivo_visita_edit"
                                    id="objetivo_visita_edit">
                        
                                </select>
                            </div>
                        </div>

                        <!--- Cliente Nuevo o Actual -->
                        <div class="col">
                            <div class="form-group clearfix">
                                <label for="">Cliente Nuevo ?</label>
                                <div class="">
                                    <input type="radio" name="cliente_nuevo_edit" value="1" id="cliente_nuevo_edit"> SI
                                </div>
                                <div class="">
                                    <input type="radio" name="cliente_nuevo_edit" value="0" id="cliente_actual_edit"> NO
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Tipo Cliente</label>
                                <select name="tipo_cliente_edit" id="tipo_cliente_edit" class="form-control select2"
                                    style="width:100%" required="true">
                                
                                </select>
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Tipo PLAN MAESTRO</label>
                                <select name="tipo_plan_maestro_edit" id="tipo_plan_maestro_edit" class="form-control select2"
                                    style="width:100%">
                                    
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="row">
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Documento</label>
                                        <input type="text" name="nit_edit" id="nit_edit" class="form-control" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-gorup">
                                        <label>Nombres Completos</label>
                                        <input type="text" name="nombre_completo_edit" id="nombre_completo_edit"
                                            class="form-control" />
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <label for="telefono_cliente_edit">Telefono del Cliente</label>
                                            <input type="text" name="telefono_cliente_edit" id="telefono_cliente_edit"
                                                class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Nombre de la Obra</label>
                                        <input type="text" name="nombre_obra_edit" id="nombre_obra_edit" class="form-control" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Direccion de la Obra</label>
                                        <input type="text" name="direccion_obra_edit" id="direccion_obra_edit"
                                            class="form-control" value="" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col">
                            <div class="row">
                                <!--  Sede --->
                                <div class="col-2">
                                    <div class="form-group">
                                        <label for="sede">Sede</label>
                                        <select name="txt_sede_edit" id="txt_sede_edit" class="form-control select2 "
                                            style="width:100%">

                                            <option value="1">Ibague</option>
                                            <option value="2">Honda</option>
                                            <?php
                                    // IBAGUE HONDA
                                    //echO $op->select_sede($id_sede); 
                                    ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="form-group">
                                        <label for="">Departamento</label>
                                        <select name="departamento_edit" id="departamento_edit" class="form-control select2"
                                            required="true" style="width:100%">
                                            
                                        </select>
                                    </div>
                                </div>
                                <div class="col-3 ">
                                    <div class="form-group">
                                        <label for="municipio">Municipio</label>
                                        <select name="municipio_edit" id="municipio_edit" class="form-control select2"
                                            required="true" style="width:100%">

                                        </select>
                                    </div>
                                </div>
                                <div class="col-2 ">
                                    <div class="form-group">
                                        <label for="">Zona/Comuna</label>
                                        <select name="comuna_edit" id="comuna_edit" class="form-control select2" required="true"
                                            style="width:100%">

                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="">Barrio</label>
                                        <input type="text" name="barrio_edit" id="barrio_edit" class="form-control"
                                            style="width:100%">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group clearfix">
                                <label for="">Maestro Nuevo ?</label>
                                <div class="">
                                    <input type="radio" name="maestro_nuevo_edit" value="1" id="maestro_nuevo_edit"> SI
                                </div>
                                <div class="">
                                    <input type="radio" name="maestro_nuevo_edit" value="0" id="maestro_actual_edit"> NO
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nombre del Maestro</label>
                                <input type="text" name="nombre_maestro_edit" id="nombre_maestro_edit" class="form-control">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Telefono Celular Maestro</label>
                                <input type="text" name="celular_maestro_edit" id="celular_maestro_edit" class="form-control" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Total M3 Potenciales</label>
                                <input type="text" name="m3_potenciales_edit" id="m3_potenciales_edit" class="form-control" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Fecha Posible Fundida</label>
                                <input type="date" name="fecha_posible_fundida_edit" id="fecha_posible_fundida_edit"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Resultado de la Visita</label>
                                <select name="resultado_edit" id="resultado_edit" class="form-control select2" style="width:100%">
                                 
                                </select>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="">Forma que se contacto con el cliente</label>
                                <select name="contacto_cliente_edit" id="contacto_cliente_edit" class="form-control select2"
                                    style="width:100%">
                                   
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="obs_visit">Observaciones:</label>
                                <input type="text" name="obs_visit_edit" id="obs_visit_edit" class="form-control" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-5">
                            <div class="form-group">
                                <label for="">inicio</label>
                                <input class="form-control" type="text" name="txt_inicio_edit" id="txt_inicio_edit" />
                            </div>
                        </div>
                        <div class="col-5">
                            <div class="form-group">
                                <label for="">fin</label>
                                <input class="form-control" type="text" name="txt_fin_edit" id="txt_fin_edit" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert alert-success alert-dismissible">
                               
                                <h5><span> Aprobado</span></h5>
                                
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            <button type="submit" class="btn btn-primary" id="btnCrear"> Guardar </button>
                        </div>
                        <div class="col">
                            <button type="button" id="btnaprobar" class="btn btn-success"> Aprobar Visita</button>
                        </div>
                    </div>
                </form>

                <hr>
                <hr>
                <form name="form_subir_anexo_edit" id="form_subir_anexo_edit" method="post">
                    <input type="hidden" name="txt_id_edit" id="txt_id_edit">

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="">Nombre del Anexo</label>
                                <input type="text" class="form-control" name="nombre_anexo" id="nombre_anexo">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Subir Imagen</label>
                                <input type="radio" class="form-control tipoarchivo" name="subirtipo"
                                    value="image/x-png,image/jpeg" required checked="">
                            </div>
                        </div>
                        <div class="col-2">
                            <div class="form-group">
                                <label>Subir PDF</label>
                                <input type="radio" class="form-control tipoarchivo" name="subirtipo"
                                    value="application/pdf" required>
                            </div>
                        </div>

                        <div class="col">
                            <div class="form-group">
                                <div>
                                    <input type="file" class="form-control" name="imgfiles" id="imgfiles"
                                        accept="image/x-png,image/jpeg" required="required" />
                                    <label class="" for="imgfiles">Seleccionar Archivo</label>
                                </div>
                                <!-- <input class="form-control" type="file" name="imgfiles2" id="imgfiles2" accept="image/x-png,image/jpeg" disabled="disabled" />
                                    <label class="custom-file-label" for="imgfiles2">Choose file</label> !-->
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" id="btnguardar"> Subir Anexo </button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <table class="table table-striped" id="tabla_anexos_edit">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Nombre del anexo</th>
                                        <th>Archivo</th>
                                        <th>Detalle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">

            </div>


        </div>
    </div>
    <!-- /.modal-content -->
</div>



    


<!----- Fin Modales--->

<?php include '../../../layout/footer/footer3.php' ?>
<script src="calendar.js"> </script>

<script>
var rol_user = <?php echo $rol_user ?>;
if (rol_user == 1) {
    //document.getElementById("btnaprobar").disabled = false;
}


$("#btnaprobar").click(function() {
    var id_event = $("#txt_id").val();
    console.log("clic aprobar");
    console.log(id_event);
    $.ajax({
        url: "php_actualizar_estado.php",
        type: "POST",
        data: {
            task: 1,
            id_event: id_event,

        },
        success: function(response) {
            toastr.success('Aprobado Correctamente');
            location.reload();
        },
        error: function(respuesta) {
            alert(JSON.stringify(respuesta));
        },

    });
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  $(".select2").select2();
  let form_crear_visita = document.querySelector("#form_crear_vitita");

  var calendarEl = document.getElementById("calendar"); // ID = calendar
  //crear calendario
  var calendar = new FullCalendar.Calendar(calendarEl, {
    // Configuracion
    themeSystem: "bootstrap", // Tema del Calendario
    locale: "es", // Lenguaje
    initialView: "timeGridWeek", // Vista Semanal
    timeZone: "America/Bogota",
    droppable: true,
    selectable: true,
    editable: true,
    // Botones de
    headerToolbar: {
      language: "es",
      left: "prev,next,today",
      center: "title",
      right: "dayGridMonth,timeGridWeek,timeGridDay",
    },
    /**
     * Cargar Datos, los eventos del Calendario
     **/
    events: {
      url: "data_calendar.php",
      method: "POST",
      extraParams: {
        custom_param1: "something",
      },
      failure: function () {
        alert("Error al Cargar las Visitas Comerciales");
      },
      //color: 'yellow',   // a non-ajax option
      //textColor: 'black' // a non-ajax option
    },

    /**
     * CREAR EVENTO
     */
    select: function (event) {
      // form_crear_programacion.reset();
      $("#txt_inicio").val(
        moment(event.startStr).format("YYYY-MM-DD HH:mm:ss")
      );
      $("#txt_fin").val(moment(event.endStr).format("YYYY-MM-DD HH:mm:ss"));
      //Ajax
      var formData = new FormData();
      formData.append("task", 1);
      // por si se desea cargar previamente datos en el modal de crear visita comercial
      $.ajax({
        url: "process_data.php", // URL
        type: "POST", // Metodo HTTP
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          $("#txt_asesora_comercial").html(data.select_comercial);

          //toastr.success("Visita Creada correctamente");
        },
        error: function (respuesta) {
          alert(JSON.stringify(respuesta));
        },
      });
      //====================================================================================================================
      $("#modal_crear_evento").modal("show");
    },
    //=======================================================================================================================
    // Accion Click Encima del Evento
    eventClick: function (info) {
      console.log("editar_Evento");

      $.ajax({
        url: "get_data_edit.php",
        type: "POST",
        data: {
          id: info.event.id,
        },
        success: function (data) {
          //form_show_event.id_prog_evento.value = info.event.id;

          $("#modal_editar_evento").modal("show");
          $("#txt_id").val(data.id);
          $("#txt_id_edit").val(data.id);
          //$('#txt_titulo_edit').val(data.titulo);
          $("#txt_asesora_comercial_edit").html(data.select_comercial);
          
          $("#nit_edit").val(data.documento);
          $("#objetivo_visita_edit").html(data.select_objetivo_visita);
          $("#tipo_cliente_edit").html(data.select_tipo_cliente);
          $("#tipo_plan_maestro_edit").html(data.tipo_plan_maestro);
          $("#nombre_completo_edit").val(data.nombre_cliente);
          $("#telefono_cliente_edit").val(data.telefono_cliente);
          $("#nombre_obra_edit").val(data.nombre_obra);
          $("#direccion_obra_edit").val(data.direccion_obra);
          $("#txt_sede_edit").val(data.id_sede);
          $("#departamento_edit").html(data.select_departamento);
          $("#municipio_edit").html(data.select_municipio);
          $("#comuna_edit").html(data.selct_zona);
          $("#barrio_edit").val(data.barrio);
          $("#maestro_nuevo_edit").val(data.maestro_nuevo);
          $("#nombre_maestro_edit").val(data.nombre_maestro);
          $("#celular_maestro").val(data.telefono_maestro);
          $("#m3_potenciales_edit").val(data.metros_potenciales);
          $("#fecha_posible_fundida_edit").val(data.fecha_fundida);
          $("#resultado_edit").html(data.id_resultado_visita);
          $("#contacto_cliente_edit").html(data.id_forma_contacto);
          $("#obs_visit_edit").val(data.observaciones);
          //$("#direccion_obra_edit").val(data.);

          $("#txt_inicio_edit").val(data.inicio);
          $("#txt_fin_edit").val(data.fin);

          if ($.fn.dataTable.isDataTable("#tabla_anexos_edit")) {
            table = $("#tabla_anexos_edit").DataTable();
            table.destroy();
          }
          table = datatable_anexo(data.id);
        },
        error: function (respuesta) {
          alert(JSON.stringify(respuesta));
        },
      });
    },

    //=======================================================================================================================
    // Accion Mover el Evento
    eventDrop: function (info) {
      var form_editar = new FormData();
      form_editar.append("task", 1);
      form_editar.append("id", info.event.id);
      form_editar.append(
        "txt_inicio_edit",
        moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss")
      );
      form_editar.append(
        "txt_fin_edit",
        moment(info.event.endStr).format("YYYY-MM-DD HH:mm:ss")
      );
      editar_event(form_editar, calendar);
    },

    //=======================================================================================================================
    // Accion cambiar el tamaño el Evento
    eventResize: function (info) {
      var form_editar = new FormData();
      form_editar.append("task", 1);
      form_editar.append("id", info.event.id);
      form_editar.append(
        "txt_inicio_edit",
        moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss")
      );
      form_editar.append(
        "txt_fin_edit",
        moment(info.event.endStr).format("YYYY-MM-DD HH:mm:ss")
      );
      console.log(form_editar);
      editar_event(form_editar, calendar);
    },
  });

  /** FIN CALENDARIO */

  calendar.render();
  $("#form_crear_vitita").on("submit", function (e) {
    console.log("guardado");
    e.preventDefault();
    $.ajax({
      url: "crear_visita_comercial.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        //console.log(data);
        if (data.estado) {
          calendar.refetchEvents();
          $("#modal_crear_evento").modal("hide");
          toastr.success("Visita Creada correctamente");
        } else {
          console.log("mal");
        }
        //const datos_errores = Object.values(data.errores);
      },
      error: function (respuesta) {
        alert(JSON.stringify(respuesta));
      },
    });
  });

  /** CREAR  */

  /** EDITAR  MODAL */
  $("#form_editar_visita").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "php_editar_visita_comercial.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        //console.log(data);
        if (data.estado) {
          calendar.refetchEvents();
          $("#modal_editar_evento").modal("hide");
          toastr.success("Visita Editada correctamente");
        } else {
           toastr.info(data.errores);

          console.log("visita cliente guardo mal");
        }
        //const datos_errores = Object.values(data.errores);
      },
      error: function (respuesta) {
        alert(JSON.stringify(respuesta));
      },
    });
  });

  /** EDITAR  MODAL */
  $("#form_subir_anexo_edit").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
      url: "subir_anexo.php",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (data) {
        calendar.refetchEvents();
        //console.log(data);
        if (data.estado) {
          toastr.success("Anexo Cargado  correctamente");
          table.ajax.reload();
        } else {
          console.log("hubo un error");
        }
        //const datos_errores = Object.values(data.errores);
      },
      error: function (respuesta) {
        alert(JSON.stringify(respuesta));
      },
    });
  });

  //////////////////////////////////////////////////////////////////////////////////////////////////////

  function editar_event(form_editar, calendar) {
    $.ajax({
      url: "php_editar_event.php",
      type: "POST",
      data: form_editar,
      processData: false,
      contentType: false,
      dataType: "json",
      //processData: false,
      success: function (response) {
        calendar.refetchEvents();
        if (response.estado) {
          toastr.success("Visita Actualizada Satisfactoriamente");
        }
      },
      error: function (respuesta) {
        alert(JSON.stringify(respuesta));
      },
    });
  }
});

$("#txt_cliente").on("change", function () {
  $.ajax({
    url: "get_data.php",
    type: "POST",
    data: {
      txt_cliente: $("#txt_cliente").val(),
      task: "1",
    },
    success: function (response) {
      $("#txt_obra").html(response.obras);
    },
    error: function (respuesta) {
      alert(JSON.stringify(respuesta));
    },
  });
});

$("#txt_cliente_edit").on("change", function () {
  $.ajax({
    url: "get_data.php",
    type: "POST",
    data: {
      txt_cliente: $("#txt_cliente_edit").val(),
      task: "1",
    },
    success: function (response) {
      $("#txt_obra_edit").html(response.obras);
    },
    error: function (respuesta) {
      alert(JSON.stringify(respuesta));
    },
  });
});

$(".tipoarchivo").change(function () {
  $("#imgfiles").attr("accept", $("input[name=subirtipo]:checked").val());
});

function datatable_anexo(id_visita) {
  var table = $("#tabla_anexos_edit").DataTable({
    paging: false,
    searching: false,
    //"processing": true,
    //"scrollX": true,
    ajax: {
      url: "datatable_anexos.php",
      data: {
        id_visita: id_visita,
      },
      type: "post",
      dataSrc: "",
    },
    order: [[0, "desc"]],
    columns: [
      {
        data: "id",
      },
      {
        data: "nombre_anexo",
      },
      {
        data: "archivo",
      },
      {
        data: null,
        defaultContent:
          "<button class='btn btn-danger btn-sm'> Eliminar </button>",
      },
    ],
    paging: false,
    searching: false,
    //"scrollX": true,
  });
  table
    .on("order.dt search.dt", function () {
      table
        .column(0, {
          search: "applied",
          order: "applied",
        })
        .nodes()
        .each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
    })
    .draw();
  table.ajax.reload();
  return table;
}

$("#tabla_anexos_edit tbody").on("click", "button", function () {
  var data = table.row($(this).parents("tr")).data();
  var id = data["id"];
  Swal.fire({
    title: "",
    text: "",
    icon: "success",
    html: "Esta seguro de eliminar <br>",
    showCancelButton: true,
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: "eliminar_anexo.php",
        type: "POST",
        data: {
          id: id,
        },
        success: function (response) {
          table.ajax.reload();
          toastr.success("exitoso");
        },
        error: function (respuesta) {
          alert(JSON.stringify(respuesta));
        },
      });
    } else {
    }
  });
});
    </script>
</body>

</html>