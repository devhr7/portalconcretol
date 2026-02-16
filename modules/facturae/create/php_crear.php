<?php

session_start();
header('Content-Type: application/json');

require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


date_default_timezone_set('America/Bogota');




$general_modelos = new general_modelos();


$t27_factura = new t27_factura();
$t26_remisiones = new t26_remisiones();


$php_estado = false;
$errores = "";
$resultado = "";


if (isset($_POST['valor']) && !empty($_POST['valor']) &&
    isset($_POST['titulo']) && !empty($_POST['titulo']) &&
    isset($_POST['cliente']) && !empty($_POST['cliente']) &&
    isset($_POST['remision']) && !empty($_POST['remision'])
){

    $php_idcliente = htmlspecialchars($_POST["cliente"]);
    $php_idobra = htmlspecialchars($_POST["obra"]);
    //$php_idusuario = $_SESSION["idusuario"];
  
    $php_fecha = "".date("Y-m-d");
    $php_fechatime = "".date("Y-m-d H:i:s");
    //$php_idresponsalbe = $_SESSION["idusuario"];
   
  
    $php_titulo = htmlspecialchars($_POST['titulo']);
    $php_valor = str_replace(".","",htmlspecialchars($_POST['valor']));
  
    //$php_notas = htmlspecialchars($_POST['notas']);
  
    $image = htmlspecialchars($_FILES['imgfactura']['name']);
    $ruta = htmlspecialchars($_FILES['imgfactura']['tmp_name']);
  
    $php_fileexten = strrchr($_FILES['imgfactura']['name'],".");
    $php_serial = strtoupper(substr(hash('sha1', $_FILES['imgfactura']['name'].$php_fechatime),0,40)).$php_fileexten;


    $exist =$general_modelos->existencia('ct27_facturae','ct27_nombre_factura',$php_titulo);

    $id_remision = 1;


    if($exist){
        $carpeta_destino = $_SERVER['DOCUMENT_ROOT'].'/internal/images/facturas/'; 
        $php_tempfoto = ('/internal/images/facturas/'.$php_serial);
        //no es posible htmlspe..
        $php_remisiones = $_POST["remision"];
    
        ///remisiones seleccionadas
        $php_contadorremisiones = count($php_remisiones);

        
        

        $id_usuario =1;
        $result = $t27_factura->insertar_factura($php_titulo,$php_fechatime, $php_tempfoto , $php_valor, $id_remision, $php_idcliente, $php_idobra, $id_usuario);
                                    
if($result>0){
 /////////////// Aqui
 if(isset($_POST["anexo"])){
    $php_anexos = $_POST["anexo"];

    ///remisiones seleccionadas
    $php_contadoranexos = count($php_anexos);

    if($php_contadoranexos >= 1){
        foreach ($php_anexos as $numbera => $id_anexo){ 
            

            if($t27_factura->insertar_factura_anexo($result, $id_anexo)){
                $php_estado = true;
            }else{
        $errores = "hubo un error al guardar las anexos";
                
            }
    
          }
    }
}
    
    
    foreach ($php_remisiones as $number => $idremisiones){ 
        
        $result2 = $t27_factura->insertar_factura_remi($result,$idremisiones);
        

        if($result2){

            $result3 = $t26_remisiones->actualizar_estado_remi_fact($idremisiones,1);

            $php_estado = true;

            $php_movefile = move_uploaded_file($ruta,$carpeta_destino.$php_serial);

        }else{
    $errores = "hubo un error al guardar las remisiones";
            
        }

      }

    
}else{
    $errores = "hubo un error al guardar factura". $result;
}

    }else{
        $errores = "esta factura ya existe en la base de datos";
    }

} else {
    $errores = "faltan campos requeridos";
}

$datos = array(
    'estado' => $php_estado,
    'errores' => $errores,
    'result' => $resultado,
);


echo json_encode($datos, JSON_FORCE_OBJECT);
