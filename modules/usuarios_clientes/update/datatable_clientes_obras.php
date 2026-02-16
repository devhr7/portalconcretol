<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';
//SE CREA UN OBJETO DE LA CLASE USUARIOS_CLIENTES
$pedidos = new pedidos();
$usuarios_clientes = new usuarios_clientes();
//SE HACE UNA VALIDACION DE QUE EL PEDIDO EXISTA
if (isset($_POST['id_usuario']) && !empty($_POST['id_usuario'])) {
     //TRAE TODOS LOS DATOS DE LOS PRODUCTOS FILTRANDOLOS POR EL ID DEL USUARIO
    $data = $usuarios_clientes->get_clientes_obras($_POST['id_usuario']);
} else {
    //DE LO CONTRARIO DEVUELVE UN FALSO
    $data = false;
}

//print json_encode($datos, JSON_FORCE_OBJECT);
print json_encode($data, JSON_UNESCAPED_UNICODE);
