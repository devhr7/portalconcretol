$(document).ready(function (e) {
    $("#form_generar").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "php_crear.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                console.log(data.estado);
                console.log(data.resultado);
                if(data.estado){
                    console.log(data.datos);
                    toastr.success('exitoso');
                    
                }else{
                    toastr.warning('tenemos errores');      
                         
                }
            },
            error: function (respuesta) {
                alert(JSON.stringify(respuesta));
                console.log(JSON.stringify(respuesta));
                console.log(data);
                
            },
        });
    }));
});
