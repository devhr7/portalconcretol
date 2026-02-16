$(document).ready(function (e) {
    $("#resultado").hide();
    $('#lista').empty();

    $("#form_anular_batch").on('submit', (function (e) {
    
        e.preventDefault();
        $.ajax({
            url: "php_anular.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                location.reload();
               console.log(data.phperror);

            },
            error: function (respuesta) {
                alert(JSON.stringify(respuesta));
                console.log(JSON.stringify(respuesta));
                console.log(data);

            },
        });
    }));
});