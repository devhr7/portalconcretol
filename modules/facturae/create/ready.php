<?php
require '../../../include/LibreriasHR.php';

$LibreriasHR = new LibreriasHR();



if(isset($_POST['C_IdTerceros']) && !empty($_POST['C_IdTerceros']) && 
isset($_POST['C_Obras']) && !empty($_POST['C_Obras']) 
){
    $cliente  = $LibreriasHR->HR_Crypt($_POST['C_IdTerceros'],1);
    $obra   = $LibreriasHR->HR_Crypt($_POST['C_Obras'],1);


    echo "<a href='crear_factura_step2.php?cliente=".$cliente."&obra=".$obra."' class='btn btn-block btn-success'> Crear Factura</a>";

}else{
    echo "<a > MAL </a>". $_POST['C_Obras']. "   -   ".$_POST['C_IdTerceros'];
}

