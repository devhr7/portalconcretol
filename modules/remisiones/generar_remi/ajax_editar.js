

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
                    //console.log(data.result);

                    if(data.estado){
                        toastr.success('exitoso');
                        //toastr.success(data.errores);
                        //console.log(data.errores);
                        //console.log(data.result);
                        //location.reload();
                    }else{
                        toastr.warning(data.errores);  
                        //console.log(data.errores);
                        //console.log(data.result);
                    }
                },
                error: function (respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });

