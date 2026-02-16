<?php
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


require 'modelo_prog.php';

$modelo_prog = new modelo_prog();

$php_estado = false;


if(isset($_POST['id_conductor']) && isset($_POST['id_mixer'])  )
{

// =======================================================================================================
    // Task 1 => Select Cliente
  
        $id_conductor = intval($_POST['id_conductor']);
        $id_vehiculo = intval($_POST['id_mixer']);
     
        $option_vehiculo = $modelo_prog->select_vehiculo_edit($id_vehiculo);
        $option_conductor = $modelo_prog->select_conductor($id_conductor);

    

        // Guardar Array
        $datos = array(
            'estado' => $php_estado,
            'option_vehiculo' => $option_vehiculo,
            'option_conductor' => $option_conductor,
        );

    


    
}





echo json_encode($datos, JSON_FORCE_OBJECT);
