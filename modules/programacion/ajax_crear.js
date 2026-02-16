$(document).ready(function() {
    $('#crear_prog').validate({
        rules: {
            txb_linea: {
                required: true,
            },
            txb_fechaprog: {
                required: true,
            },
            txb_codprogramacion: {
                required: true,
            },
        },
        messages: {
            txb_linea: {
                required: "Este campo es Requerido",
            },
            txb_fechaprog: {
                required: "Este campo es Requerido",
            },
            txb_codprogramacion: {
                required: "Este campo es Requerido",
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        },
        submitHandler: function(form) {
            $.ajax({
                url: "crearprog_step1.php",
                type: "POST",
                data: $(form).serialize(),
                cache: false,
                processData: false,
                success: function(data) {
                    toastr.success('Programacion Creada Satisfactoriamente');
                    $("#pageMessage").html(data);
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }
    });
});