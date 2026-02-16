

    $(document).ready(function (e) {

       
        /////////////////////////////////////////////////////////////
        $("#buscadorfacturas1").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "ready.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function (data)
                {
                    $("#contenedor_boton").html(data);	

                },
                error: function (respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        $("#crear_factura").on('submit', (function (e) {
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

