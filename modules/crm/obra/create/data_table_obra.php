<?php



session_start();

header('Content-Type: application/json');



require '../../../../librerias/autoload.php';

require '../../../../modelos/autoload.php';

require '../../../../vendor/autoload.php';



$php_clases = new php_clases();

$t5_obras = new t5_obras();









// Roles

$id_cliente = intval($_POST['cliente']);

//$id_cliente = 21;



// Roles

//$rol_user = $usuarios->buscar_roles($_SESSION['id_usuario']);

//$modulo_usuarios = array(1);

//$modulo_usuarios =  $permisos->habilitar($modulo_usuarios, $rol_user);

$modulo_usuarios = true;

if ($modulo_usuarios) {

    $data = $t5_obras->data_table_obra_for_cliente($id_cliente);

} else {

    $data = null;

}



print json_encode($data, JSON_UNESCAPED_UNICODE);



