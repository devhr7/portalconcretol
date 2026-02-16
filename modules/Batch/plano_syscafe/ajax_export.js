$(document).ready(function (e) {
    $("#form_export_plano_txt").on('submit', (function (e) {
        e.preventDefault();
        $.ajax({
            url: "export_txt.php",
            type: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data.rst);
                const drst = Object.values(data.rst);
                const derrores = Object.values(data.errores);
                for (let index = 0; index < drst.length; index++) {
                    toastr.info(data.rst[index]);
                }
                //toastr.info();
                if (data.estado) {
                    toastr.success('se exporto exitosamente');
                } else {
                    for (let index = 0; index < derrores.length; index++) {
                        //var element = data.errores[index];
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