<?php
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php'; 


$t4_productos = new t4_productos();

$contenido="";
if (isset($_POST['nfilas'])) {

    $nfilas = (int)htmlspecialchars($_POST['nfilas']);
    $php_estado = true;

    $fila = "
    <hr>
    <div class='row'>
    <div class='col'>
        <label>Producto </label>
        <select class='form-control select2' name='txt_producto[]' required>".
                $t4_productos->option_producto_edit() . "
        </select>
    </div>
    <div class='col'>
        <label>Digita Precio del Producto</label>
        <input type='text' class='form-control ' name='txt_precio[]' onkeyup='format(this)' required  />
    </div>
</div>
<hr>
";
}

for ($i = 0; $i < $nfilas; $i++) {
    $contenido .= $fila;
}

$datos = array(
    'estado' => $php_estado,
    'contenido' => $contenido,

);
echo json_encode($datos, JSON_FORCE_OBJECT);
