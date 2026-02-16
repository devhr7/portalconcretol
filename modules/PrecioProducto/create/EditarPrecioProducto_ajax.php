<?php

header('Content-Type: application/json');
session_start();

// --- INCLUIR  ARCHIVOS
include '../../../include/conexion.php'; 

$connection = new conexion();
$connection->connect();


// --- (INCLUIR  ARCHIVOS)
$php_error ="";
if(isset($_POST['Txb_Estado'])&& !empty($_POST['Txb_Estado'])  && isset($_POST['Txb_IdTercero']) && !empty($_POST['Txb_IdTercero']) && isset($_POST['Txb_IdObras']) && !empty($_POST['Txb_IdObras']) && isset($_POST['Txb_IdProducto']) && !empty($_POST['Txb_IdProducto']) && isset($_POST['Txb_Precio']) && !empty($_POST['Txb_Precio']) )    {
/////////////////////////////////////////////////////////////
    $php_msg = "Si hay datos Requeridos";
/////////////////////////////////////////////////////////////
    
  
    
    
    /*
     * POST DATOS EN VARIABLES
     */

    $IdPrecioProducto = $_POST['Txb_IdPrecioProducto'];

    $Txb_Estado = htmlspecialchars($_POST['Txb_Estado']);  // 
    $Txb_IdTercero = htmlspecialchars($_POST['Txb_IdTercero']);  // 
    $Txb_IdObras = htmlspecialchars($_POST['Txb_IdObras']);  // 
    $Txb_IdProducto = htmlspecialchars($_POST['Txb_IdProducto']);  // 
    $Txb_Precio = htmlspecialchars($_POST['Txb_Precio']);  // 
    
    
    //$Txb_ = htmlspecialchars($_POST['Txb_']);  // 
    

    

    
    /*
     * (POST DATOS EN VARIABLES)
     */
    
    $FechaCreacion =  date("Y-m-d"); // Fecha Actual
    
    /*
     *  SE VALIDA SI EXISTE DATOS EN LA TABLA A GUARDAR
     */
    $validarExistencias = true;
    /*
     *  (SE VALIDA SI EXISTE DATOS EN LA TABLA A GUARDAR)
     */
    
    if($validarExistencias){
        $php_msg = "No existen Existencias en la base de datos - Cheke";
        
        //QUERY
        $query = "UPDATE `ct6_precioproductos` SET `ct6_Estado`= ?,`ct6_IdTercero`= ?,`ct6_IdObras`= ?,`ct6_IdProducto`= ?,`ct6_Precio`= ? WHERE `ct6_IdPrecioProducto` = ?";
        $stmt = mysqli_prepare($connection->myconn,$query);
        $stmt->bind_param("iiiidi",$Txb_Estado,$Txb_IdTercero,$Txb_IdObras,$Txb_IdProducto,$Txb_Precio, $IdPrecioProducto);
        
        if ($stmt->execute()) {
            $php_estado = true;
            $php_msg = "Bien";
            $stmt->close();
        }else {
            $php_estado = false;
            $php_error = 3;
            $php_msg = "Este Registro no se Guardo Correctamente";
        }
        
    }else {
        $php_msg = "Este Registro Existe En la Base de Datos";
        $php_estado = false;
        $php_error = 2;
    }
    
}else {
    $php_estado = false;
    $php_error = 1;
    $php_msg = "No hay datos Requeridos";
}    

$datos = array(
    'estado' => $php_estado,
    'error' => $php_error,
    'msg' => $php_msg,
);

$connection->close();

echo json_encode($datos, JSON_FORCE_OBJECT);