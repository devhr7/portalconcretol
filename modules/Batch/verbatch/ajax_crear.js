$(document).ready(function (e) {
    $("#resultado").hide();
    $('#lista').empty();
    //$("#bloque-boton1").hide();
   

    $("#form_generar").on('submit', (function (e) {
        $("#generar").attr("disabled", "disabled");
        $('#lista').empty();
        var ul = document.getElementById("lista");
        //ul.innerHTML = '';
        $(ul).empty();
        e.preventDefault();
        $.ajax({
            url: "php_crear.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
               // $("#generar").attr("disabled", "disabled");


                $("#resultado").show();

                const datos_errores = Object.values(data.errores);
                const datos_exitoso = Object.values(data.exitoso);

                for (let index = 0; index < datos_errores.length; index++) {
                    var element = data.errores[index];
                    var li = document.createElement('li');
                    toastr.warning(data.errores[index]);
                    li.appendChild(document.createTextNode(element));
                    ul.appendChild(li);
                }

                for (let index = 0; index < datos_exitoso.length; index++) {
                    var element2 = data.exitoso[index];
                    toastr.success(data.exitoso[index]);
                    var li = document.createElement('li');
                    li.appendChild(document.createTextNode(element2));
                    ul.appendChild(li);
                }

                if (data.estado) {
                    $("#generar").attr("disabled", "disabled");
                    $('#boton_siguiente').html('<a class="btn btn-block btn-warning" href="../../remisiones/generar_remi/generate.php?id=' + data.ultimo + '  "><i class="fas fa-hand-point-right"></i>  Siguiente</a>');
                }
            },
            error: function (respuesta) {
                alert(JSON.stringify(respuesta));
                console.log(JSON.stringify(respuesta));
                

            },
        });
    }));
});