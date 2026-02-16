
$(document).ready(function (e) {

    $("#btn-restablecer").click(function () {
        // var id = $("#id").val();


        Swal.fire({
            title: 'Esta Seguro(a) de restablecer la contraseña?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Si Restablecer'
        }).then((result) => {
            if (result.value) {


                $.ajax({
                    url: "ajax_restablecer_pass.php",
                    type: "POST",
                    data:
                            {
                                id: id,

                            },
                    success: function (response)
                    {

                        if (response.estado) {

                            Swal.fire(
                                    'La contraseña Fue Restablecida Correctamente',
                                    'usuario y contraseña del cliente es mismo numero de identificacion',
                                    'success'
                                    )
                        } else {
                            console.log("error");

                        }

                    },
                    error: function (respuesta) {
                        alert(JSON.stringify(respuesta));
                    },

                });






            }
        })


    });


});

             