$(document).ready(function() {
    $('#form_crear').validate({
        rules: {
            num_ced: {
                required: true,
                digits: true,
                minlength: 3,
                maxlength: 20,
            },
            C_nombre1: {
                required: true,
                minlength: 3,
                maxlength: 100,
            },
            C_nombre2: {
                required: false,
                minlength: 3,
                maxlength: 100,
            },
            C_apellido1: {
                required: true,
                minlength: 3,
                maxlength: 100,
            },
            C_apellido2: {
                required: false,
                minlength: 3,
                maxlength: 100,

            },
            C_Rol: {
                required: true
            },
        },
        messages: {
            num_ced: {
                required: "Este campo es Requerido",
                digits: "Solo Campos numeros puede digitar"
            },
            C_nombre1: {
                required: "Este campo es Requerido",
            },
            C_nombre2: {
                required: "Este campo es Requerido",
            },
            C_apellido1: {
                required: "Este campo es Requerido",
            },
            C_apellido2: {
                required: "Este campo es Requerido",
            },
            C_Rol: {
                required: "Este campo es Requerido",
            },
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
                url: "php_crear.php",
                type: "POST",
                data: $(form).serialize(),
                cache: false,
                processData: false,
                success: function(data) {
                    if (data.estado) {
                        toastr.success('exitoso');
                    } else {
                        toastr.warning(data.errores);
                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }
    });
});