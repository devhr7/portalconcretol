$(document).ready(function (e) {
  $(".progress").hide();
  $("#form_crear_op").on("submit", function (e) {
    e.preventDefault();
    $(".progress").show();
    let formData = new FormData(this);
        // Adicionar
        //formData.append("var1", "hr");
    $.ajax({
      xhr: function () {
        //Creamos el xhr
        var xhr = new window.XMLHttpRequest();
        //Añadimos el evento upload
        xhr.upload.addEventListener(
          "progress",
          function (evt) {
            // console.info("paso 1");
            // console.log(evt);

            // console.log("cargando :" + evt.loaded);

            // console.log("total :" + evt.total);

            if (evt.lengthComputable) {

              //El porcentaje completado será lo subido entre el total

              var percentComplete = evt.loaded / evt.total;

              console.log(percentComplete);

              //Actualizamos la barra de JQuery-UI

              //$(".progress-bar").progressbar("value", percentComplete * 100);

              $(".text_progresbar").html(percentComplete * 100 + "%");

              //Actualizamos el div

              $(".progress-bar").css({

                width: percentComplete * 100 + "%",

              });

              if (percentComplete === 1) {

                //$(".progress-bar").addClass("hide");

              }

            }

          },

          false

        );

        xhr.addEventListener(

          "progress",

          function (evt) {

            //console.info("paso 2");

            //console.log(evt);

            //console.log("cargando :" + evt.loaded);

            //console.log("total :" + evt.total);



            if (evt.lengthComputable) {

              var percentComplete = evt.loaded / evt.total;

              //console.log(percentComplete);

              //$(".progress-bar").progressbar("value", percentComplete * 100);

              $(".text_progresbar").html(percentComplete * 100 + "%");

              $(".progress-bar").css({

                width: percentComplete * 100 + "%",

              });

            }

          },

          false

        );

        return xhr;

      },

      url: "php_crear_op.php",

      type: "POST",

      data: formData,

      contentType: false,

      cache: false,

      processData: false,

      success: function (data) {

        console.log(data.post);

        if (data.estado) {
          toastr.success("Guardado Exitoso");
          $('#bq-boton').html(data.boton);
        } else {

          toastr.warning(data.errores);

        }

      },

      error: function (respuesta) {

        alert(JSON.stringify(respuesta));

        console.log(JSON.stringify(respuesta));

        console.log(data);

      },

    });

  });

});

