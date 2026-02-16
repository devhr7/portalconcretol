

    $(document).ready(function (e) {
        $("#F_EditarFacturae").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "php_editar.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    console.log(data.estado);
                    console.log("hola");
                    if(data.estado){
                        toastr.success('exitoso');
                        toastr.success(data.errores);
                        console.log(data.errores);
                        console.log(data.result);
                        //console.log($('#habi_img').val());
                    }else{
                        toastr.warning(data.errores); 
                        console.log(data.result);              
                        console.log(data.errores);
                    }
                },
                error: function (respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });