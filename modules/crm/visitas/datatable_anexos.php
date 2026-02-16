<?php



session_start();

header('Content-Type: application/json');



require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';



$cls_visitas_comerciales = new cls_visitas_comerciales();

//$id_cliente = 21;



// Roles

//$rol_user = $usuarios->buscar_roles($_SESSION['id_usuario']);

//$modulo_usuarios = array(1);

//$modulo_usuarios =  $permisos->habilitar($modulo_usuarios, $rol_user);



$id_visitas = $_POST['id_visita'];
$data = $cls_visitas_comerciales->data_table_oanexos($id_visitas);




print json_encode($data, JSON_UNESCAPED_UNICODE);



