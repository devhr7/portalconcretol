
    $(document).ready(function (e) {
        $("#F_editar").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    console.log(data.estado);
                    if(data.estado){
                        toastr.success('exitoso');
                        
                    }else{
                        toastr.warning(data.errores);               
                    }
                },
                error: function (respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));
    });

