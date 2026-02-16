document.addEventListener("DOMContentLoaded", function () {
  let form_crear_programacion = document.querySelector("#form_crear_programacion");
  let form_show_event = document.querySelector("#form_mostrar_programacion");
  let aceptar_programacion = document.querySelector("#form_confirmar_programacion");
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
    // Cargar Datos, los eventos del Calendario
    events: {
      url: "data_calendar.php",
      method: "POST",
      extraParams: {
        custom_param1: "something",
      },
      failure: function () {
        alert("Error al Cargar las programaciones");
      },
      //color: 'yellow',   // a non-ajax option
      //textColor: 'black' // a non-ajax option
    },

    // datos eventos
    //clik dia
    //=======================================================================================================================
    // Crear Eventos
    select: function (event) {
      console.log("Crear programacion");
      form_crear_programacion.reset();
      $("#txtInicio").val(moment(event.startStr).format("YYYY-MM-DD HH:mm:ss"));
      $("#txtFin").val(moment(event.endStr).format("YYYY-MM-DD HH:mm:ss"));
      //Ajax
      var formData = new FormData();
      formData.append("task", 1);
      $.ajax({
        url: "load_data.php", // URL
        type: "POST", // Metodo HTTP
        //data: formData,
        data: formData,
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
          $("#cbxCliente").html(data.select_cliente);
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
      console.log("Click Evento");
      $.ajax({
        url: "get_data_edit.php",
        type: "POST",
        data: {
          id: info.event.id,
        },
        success: function (data) {
          form_show_event.id_prog_evento.value = info.event.id;
          console.log(info.event);
          $("#cbxClienteEditar").html(data.select_cliente);
          $("#cbxObraEditar").html(data.select_obra);
          $("#cbxProductoEditar").html(data.select_producto);
          $("#cbxPedidoEditar").html(data.select_pedidos);
          $("#cbxTipoDescargueEditar").html(data.select_tipo_descargue);
          $("#cbxFrecuenciaEditar").html(data.select_frecuencia);
          form_show_event.txtCantEditar.value = data.cantidad;
          form_show_event.txtElementosEditar.value = data.elementos;
          form_show_event.txtInicioEditar.value = data.inicio;
          form_show_event.txtFinEditar.value = data.fin;
          form_show_event.txtObservacionesEditar.value = data.observaciones;
          form_show_event.txtMetrosEditar.value = data.metros;
          if (data.requiere_bomba == 1) {
            $("#chkRequiereBombaEditar").prop("checked", true);
          }
          $("#modal_show_evento").modal("show");
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
      form_editar.append("txtInicio", moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss"));
      form_editar.append("txtFin", moment(info.event.endStr).format("YYYY-MM-DD HH:mm:ss"));
      editar_event(form_editar, calendar);
    },

    //=======================================================================================================================
    // Accion cambiar el tamaño el Evento
    eventResize: function (info) {
      var form_editar = new FormData();
      form_editar.append("task", 1);
      form_editar.append("id", info.event.id);
      form_editar.append("txtInicio", moment(info.event.startStr).format("YYYY-MM-DD HH:mm:ss"));
      form_editar.append("txtFin", moment(info.event.endStr).format("YYYY-MM-DD HH:mm:ss"));
      console.log(form_editar);
      editar_event(form_editar, calendar);
    },
  });

  calendar.render();
  // Boton Actualizar Evento
  document.getElementById("btnEliminar").addEventListener("click", function () {
    const datos_form = new FormData(form_show_event);
    var form_editar = new FormData();
    Swal.fire({
      title: "Esta seguro que desea eliminar",
      showDenyButton: true,
      showCancelButton: true,
      confirmButtonText: "Si eliminar",
      denyButtonText: `No, Salir`,
      confirmButtonColor: "#d33",
      cancelButtonColor: "#3085d6",
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        form_editar.append("task", 3); // eliminar
        form_editar.append("id", form_show_event.id_prog_evento.value);
        editar_event(form_editar, calendar);
        $("#modal_show_evento").modal("hide");
      } else if (result.isDenied) {
      }
    });
  });

  calendar.render();
  // Boton Actualizar Evento btnCargarProgramacion
  document
    .getElementById("btnConfirmarProgramacion")
    .addEventListener("click", function () {
      const datos_form = new FormData(aceptar_programacion);
      var form_editar = new FormData();
      Swal.fire({
        title: "¿Esta seguro que desea confirmar y cargar la programacion diaria?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Si enviar",
        denyButtonText: `No, Salir`,
        confirmButtonColor: "#298a00",
        cancelButtonColor: "#3085d6",
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          form_editar.append("task", 4); // actualizar
          form_editar.append("id", form_show_event.id_prog_evento.value);
          editar_event(form_editar, calendar);
          $("#modal_show_evento").modal("hide");
        } else if (result.isDenied) {
        }
      });
    });

  calendar.render();
  // Boton Actualizar Evento
  document
    .getElementById("btnHabilitarCliente")
    .addEventListener("click", function () {
      const datos_form = new FormData(aceptar_programacion);
      var form_editar = new FormData();
      Swal.fire({
        title:
          "¿Esta seguro que desea habilitar al cliente para modificar la programacion?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Si enviar",
        denyButtonText: `No, Salir`,
        confirmButtonColor: "#298a00",
        cancelButtonColor: "#3085d6",
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          form_editar.append("task", 5); // actualizar
          form_editar.append("id", form_show_event.id_prog_evento.value);
          editar_event(form_editar, calendar);
          $("#modal_show_evento").modal("hide");
        } else if (result.isDenied) {
        }
      });
    });

  calendar.render();
  // Boton Actualizar Evento btnCargarProgramacion
  document
    .getElementById("btnCargarTodaProgramacion")
    .addEventListener("click", function () {
      const datos_form = new FormData(aceptar_programacion);
      var form_editar = new FormData();
      Swal.fire({
        title: "¿Esta seguro que desea confirmar y cargar todas las programaciones diarias?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Si enviar",
        denyButtonText: `No, Salir`,
        confirmButtonColor: "#298a00",
        cancelButtonColor: "#3085d6",
      }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {
          form_editar.append("task", 6); // actualizar
          form_editar.append("id", form_show_event.id_prog_evento.value);
          editar_event(form_editar, calendar);
          $("#modal_show_evento").modal("hide");
        } else if (result.isDenied) {
        }
      });
    });

  function editar_event(form_editar, calendar) {
    $.ajax({
      url: "php_editar_prog_semanal.php",
      type: "POST",
      data: form_editar,
      processData: false,
      contentType: false,
      dataType: "json",
      //processData: false,
      success: function (response) {
        calendar.refetchEvents();
        if (response.task == 1 && response.estado) {
          toastr.success("Programacion Actualizada Satisfactoriamente");
        } else if (response.task == 2 && response.estado) {
          toastr.success("Programacion Actualizada Satisfactoriamente");
        } else if (response.task == 3 && response.estado) {
          toastr.success("Programacion eliminada Satisfactoriamente");
        } else if (response.task == 4 && response.estado) {
          toastr.success("Programacion confirmada correctamente");
          $("#modal_confirmar_programacion").modal("hide");
        } else if (response.task == 5 && response.estado) {
          toastr.success("El cliente ya puede modificar la programacion");
        } else if (response.task == 6 && response.estado) {
          toastr.success("Programaciones confirmadas y enviadas a la programacion diaria");
          $("#modal_cargar_programacion").modal("hide");
        } else {
          toastr.warning(response.errores);
          $("#modal_confirmar_programacion").modal("hide");
        }
      },
      error: function (respuesta) {
        alert(JSON.stringify(respuesta));
      },
    });
  }
});
