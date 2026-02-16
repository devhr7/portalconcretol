
            table.on('order.dt search.dt', function() {
                table.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            table.ajax.reload();
            return table;
        }
        //Tabla de Comparativo de Proveedores
        function datatable_items_cotizaciones(id_item) {
            var table2 = $('#table_item_cotizaciones').DataTable({
                //"processing": true,
                //"scrollX": true,
                "ajax": {
                    "url": "datatable_items_cotizaciones.php",
                    'data': {
                        'id_item': id_item,
                    },
                    'type': 'post',
                    'paging': 'false',
                    
                    "dataSrc": ""
                },
                "order": [
                    [0, 'desc']
                ],
                "columns": [{
                        "data": "id"
                    },
                    {
                        "data": "status" //estatus
                    },

                    {
                        "data": "proveedor" // proveedor
                    },
                    {
                        "data": "precio" // precio
                    },
                    {
                        "data": "botonPDF"
                    },
                    {
                        "data": null,
                        "defaultContent": "<button type='button' class='btn btn-success btn-sm btn1_aprobado'> Aprobado </button><button class='btn btn-warning btn-sm btn2_noaprobado'> <i class='fas fa-edit'></i> No aprobado</button>  <button class='btn btn-danger btn-sm btn3_eliminar_cot'> <i class='fas fa-trash-alt'></i> </button> "
                    }
                ],
                'paging': false,
                'searching': false
                //"scrollX": true,
            });
            table2.on('order.dt search.dt', function() {
                table2.column(0, {
                    search: 'applied',
                    order: 'applied'
                }).nodes().each(function(cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
            table2.ajax.reload();
            return table2;
        }

        //** */
        
        // Visualizar Tabla de Items de Requisiciones
        var id_requisicion = <?php echo $_GET['id'] ?>;
        if ($.fn.dataTable.isDataTable('#table_items')) {
            table_items = $('#table_items').datatable_items();
            table_items.destroy();
        }
        table_items = datatable_items(id_requisicion);
        setInterval(function() {
            table_items.ajax.reload(null, false);
        }, 5000);




        var obtener_data_items = function(tbody, table_items){
            $(tbody).on("click","button.btn_add_precio"),function(){
                var data_items = table_items.row($(this).parents("tr")).data();
                console.log(data_items['id']);
            }
        }



        // Boton Adicionar Precio
        //$('#table_items tbody').on('click', 'button.btn_add_precio', function() {
          //  var data = table.row($(this).parents('tr')).data();
            //var id = data['id'];
            //$("#txt_id_item1").val(id)
            // ABRIR MODAL
           // $("#modal_add_precio").modal("show");
        //});




        // Formulario Adicionar Precio
        $("#form_add_precio").on('submit', (function(e) {
            e.preventDefault();
            $.ajax({
                url: "php_adicionar_precio.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {


                    if (data.estado) {
                        toastr.success('exitoso');

                    } else {

                    }
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                },
            });
        }));

        $('#table_items tbody').on('click', 'button.btn_ver_comparativo', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            $("#spn_item").html(data['nombre_producto']);
            $("#spn_desp").html(data['descripcion']);

            var imagen_item = document.getElementById("imagen_item");
            imagen_item.setAttribute("src", data['file_item']);


            if ($.fn.dataTable.isDataTable('#table_item_cotizaciones')) {
                table2.destroy(); 
            
            }
            table2 = datatable_items_cotizaciones(data['id']);
            
           


        });

        // Editar Item
        $('#table_items tbody').on('click', 'button.btn_editar', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            alert("proximamente");
        });

        // Eliminar Item
        $('#table_items tbody').on('click', 'button.btn_eliminar', function() {
            var data = table.row($(this).parents('tr')).data();
            var id = data['id'];
            $("#id_item_delete").val(data['id']);
            $("#modal_eliminar").modal("show");
        });


        $('#table_item_cotizaciones tbody').on('click', 'button.btn1_aprobado', function() {
            alert("si");
            var data2 = table2.row($(this).parents('tr')).data();
        });

        $('#table_item_cotizaciones tbody').on('click', 'button.btn2_noaprobado', function() {
            alert("NO")
            var data2 = table2.row($(this).parents('tr')).data();
        });

        $('#table_item_cotizaciones tbody').on('click', 'button.btn3_eliminar_cot', function() {
            alert("eliminar");
            var data2 = table2.row($(this).parents('tr')).data();
        });



      
        //btn_eliminar_item

        $("#btn_eliminar_item").click(function() {
            var id = $('#id_item_delete').val();
            $.ajax({
                url: "php_eliminar_item.php",
                type: "POST",
                data: {
                    id: id,
                   },
                success: function(response) {
                    toastr.success("eliminado correctamente");
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                    window.window.location = url;
                },
            });
        });

        $("#btn_eliminar_cotizacion").click(function() {
            var id = $('#id_cotizacion_delete').val();
            $.ajax({
                url: "php_eliminar_item_cotizacion.php",
                type: "POST",
                data: {
                    id: id,
                   },
                success: function(response) {
                    toastr.success("eliminado correctamente");
                },
                error: function(respuesta) {
                    alert(JSON.stringify(respuesta));
                    window.window.location = url;
                },

            });
        });



    });