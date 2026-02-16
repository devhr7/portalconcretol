

$(document).ready(function (e) {
    $("#FormCrearTipoConcreto").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "php_crear.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data.estado);
                if (data.estado) {
                    toastr.success('El producto ha sido guardado correctamente');

                } else {
                    toastr.warning(data.errores);
                }
            },
            error: function (respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
    }));
});

