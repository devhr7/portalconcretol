<?php session_start();
header('Content-Type: application/json');

$id_cliente1 = $_SESSION['id_cliente1'];

require '../../../../includes/conexion.php';
//require '../../../../includes/LibreriasHR.php';

$conexion_bd = new conexion();
$conexion_bd->connect();

//$LibreriasHR = new LibreriasHR();


if(isset($_POST['C_NumeroID'])&&isset($_POST['C_nombres']) &&isset($_POST['C_Usuario']) ){
    
    
    $C_NumeroID = htmlspecialchars($_POST['C_NumeroID']);
    $C_nombres = htmlspecialchars($_POST['C_nombres']);
    $C_Apellidos = htmlspecialchars($_POST['C_Apellidos']);
    $C_Usuario = htmlspecialchars($_POST['C_Usuario']);
    $C_Pass = md5($C_NumeroID);
    $razonSocial = $C_nombres ." ".$C_Apellidos;
    $estado = 1;
    $rol = 102;
    $TipoTercero = 3;
    
     $sql = "INSERT INTO `ct1_terceros`( `ct1_Estado`, ct1_TipoTercero,`ct1_NumeroIdentificacion`, `ct1_RazonSocial`, `ct1_Nombre1`,  `ct1_Apellido1`, `ct1_id_cliente1`, `ct1_usuario`, `ct1_pass`, `ct1_rol`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conexion_bd->myconn, $sql);
        $stmt->bind_param("iissssissi", $estado,$TipoTercero,$C_NumeroID,$razonSocial,$C_nombres,$C_Apellidos,$id_cliente1,$C_Usuario,$C_Pass,$rol);

            if ($stmt->execute()) {
                
                $php_estado= 1;
            } else {
                 $php_estado = 3;
            }
            
    
    
}else{
    $php_estado = 2;
}



$datos = array(
    'estado' => $php_estado,
    
);


echo json_encode($datos, JSON_FORCE_OBJECT);

    
    
    //$ = htmlspecialchars($_POST['']);



