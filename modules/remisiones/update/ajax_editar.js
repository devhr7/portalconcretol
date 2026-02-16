

    $(document).ready(function (e) {
        $("#F_editar").on('submit', (function (e) {
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
                    
                    const datos_errores = Object.values(data.errores);
                    console.log(datos_errores);
                    if(data.estado){
                        toastr.success('exitoso');
                        
                        
                    }else{
                        for (let index = 0; index < datos_errores.length; index++) {
                                               
                            toastr.warning(data.errores[index]);
                        }              
                    }
                },
                error: function (respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });

