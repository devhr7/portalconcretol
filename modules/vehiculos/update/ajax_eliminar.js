$(document).ready(function (e) {

    $("#btn-eliminar").click(function () {
        // var id = $("#id").val();


        Swal.fire({
            title: 'Esta Seguro(a) de Eliminar esta placa de Vehiculo?',
            text: "",
            icon: 'danger',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Si Eliminar'
        }).then((result) => {
            if (result.value) {


                $.ajax({
                    url: "eliminar.php",
                    type: "POST",
                    data:
                            {
                                id: id,

                            },
                    success: function (response)
                    {

                        if (response.estado) {

                            Swal.fire(
                                    'La placa del Vehiculo fue eliminada correctamente',
                                    'success'
                                    )
                        } else {
                            console.log("error");

                            toastr.warning(data.errores);
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

             