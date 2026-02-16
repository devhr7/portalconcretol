$(document).ready(function (e) {

    // Accion del Boton Submit
    $("#id_boton").on('submit', (function (e) {
        
        // se utiliza para evitar que el navegador ejecute la acción predeterminada del elemento seleccionado
        e.preventDefault(); 

        // Crea la Variable form
        let formData = new FormData(this);
        // Adicionar
        formData.append("var1", "hr");

        var dataF = {
            'var1' : $("#id_campo").val(),
        }

        // ajax-1
        $.ajax({
            url: "login_clientes.php", // URL
            type: "POST", // Metodo HTTP
            //data: formData,
            data: JSON.stringify(formData),
            contentType: false,
            cache: false,
            processData: false,
            success: function (data)
            {
                console.log(data.errores);
                if(data.estado){
                    toastr.success('Inicio de sesion ha sido exitoso');
                    window.location = data.codigo;
                }else{
                    toastr.warning(data.errores);               
                }
            },
            error: function (respuesta) {
                alert(JSON.stringify(respuesta));
            },
        });
         // ajax-0
    }));
     
});

let formData = new FormData();
formData.append('key1', 'value1');
formData.append('key2', 'value2');

// Se listan los pares clave/valor
for(let [name, value] of formData) {
  alert(`${name} = ${value}`); // key1 = value1, luego key2 = value2
}