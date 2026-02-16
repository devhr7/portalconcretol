<?php

session_start();
header('Content-Type: application/json');

require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php'; 

//Se crea un objeto de la clase php_clases y programacion
$php_clases = new php_clases();
$programacion_funcionario = new programacion();


$php_estado = false;
$errores = "";
$resultado = "";
$select_obras ="";
$id_usuario = $_SESSION['id_usuario'];

if ($_POST['task'] == 1){
    $select_cliente  = $programacion_funcionario->option_cliente_edit_cliente($id_usuario);
    $datos = array(
        'select_cliente' => $select_cliente,
    );

}elseif($_POST['task'] == 2){
    $id_cliente = $_POST['cliente'];
    //Buscar el id de la obra filtrandola con el id del cliente.
    $select_obras = $programacion_funcionario->option_obra_edit_cliente($id_cliente, $id_usuario);
    $php_estado = true; 

    $datos = array(
        'estado' => $php_estado,
        'select_obra' => $select_obras,
    
    );
}


echo json_encode($datos, JSON_FORCE_OBJECT);
