<?php
require '../../../../vendor/fpdf182/fpdf.php';
require '../../../../vendor/autoload.php';
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
//require '../../../../librerias/php_clases.php';


$t29_batch = new t29_batch();
$t26_remision = new t26_remisiones();
$php_clases = new php_clases();

//require_once 'estructura_remi.php';

if(isset($_GET['id'])){
    $id_remision = $php_clases->HR_Crypt($_GET['id'],2);            

    //$id_batch = $php_clases->HR_Crypt($_GET['id'],2);            
}
include 'datos_remi.php';


//$pdf = new FPDF('P','mm','letter',true);
///$pdf->AddPage('portrait', array(215.9 , 140), 0);


// 

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


require('rotation.php');

class PDF extends PDF_Rotate
{

function Header(){
    //Put the watermark    
}


function sellos($sello_calidad){

    if($sello_calidad){
        $this->SetFont('Arial', 'B', 18);
        $this->SetTextColor(152, 169, 211 );
        $this->RotatedText(205, 110, 'CONTROL DE CALIDAD ', 90);
        $this->RotatedText(210, 90, 'REVISADO', 90);
    }
}

function estado_anulada($estado)
{

    if ($estado == 10) { // Anulado
        $this->SetFont('Arial', 'B', 90);
        $this->SetTextColor(255, 0, 0);
        $this->RotatedText(50, 130, 'ANULADO', 35);
    }

}


function RotatedText($x, $y, $txt, $angle)
{
	//Text rotated around its origin
	$this->Rotate($angle,$x,$y);
	$this->Text($x,$y,$txt);
	$this->Rotate(0);
}

}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$pdf = new PDF();

$pdf->AddPage('PORTRAIT','letter');
$sello_calidad = true;
$pdf->sellos($sello_calidad);
//$pdf->Header($sello_calidad);

$pdf->SetFont('Arial');
$pdf->SetXY(10, 15);



$pdf->Image('logo_fondo.jpeg', 80, 30, 55, 70, 'JPEG'); // Marca de Agua



//$pdf->RotatedText(35,190,'W a t e r m a r k   d e m o',45);

//lOGO
$pdf->SetXY(10, 15);
$pdf->Image('Logo.jpeg', 5, 3, 25, 30, 'JPEG');

//============================================================================================================
// ENCABEZADO 
//============================================================================================================
$pdf->SetFont('Arial','B',12); //Fuente

$pdf->SetTextColor(119 , 49  , 69);
$pdf->SetXY(80, 5  );
$pdf->Cell(20, 5, 'CONCRE', 0 , 1);

$pdf->SetTextColor(253 , 200  , 47);
$pdf->SetXY(100, 5  );
$pdf->Cell(26, 5, 'TOLIMA S.A.', 0 , 1);
//------------------------------------------------------------------------------------------
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(55, 10  );
$pdf->Cell(100, 5, 'SUMINISTRO DE CONCRETO', 0 , 1,'C');
//------------------------------------------------------------------------------------------
$pdf->SetFont('Arial','',7);
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(55, 17  );
$pdf->Cell(100, 5, 'NIT.900.180.449-9 - Regimen Comun', 0 , 1,'C');
//------------------------------------------------------------------------------------------
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(55, 20  );
$pdf->Cell(100, 5, 'Avda. Mirolindo No. 77-56', 0 , 1,'C');
//------------------------------------------------------------------------------------------
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(55, 23  );
$pdf->Cell(100, 5, 'Tel:268 50 61 - Cels: 317 368 66 41 - 314 230 45 93', 0 , 1,'C');
//------------------------------------------------------------------------------------------
$pdf->SetFillColor(225, 225, 225);
$pdf->SetXY(55, 26  );
$pdf->Cell(100, 5, 'concretolima@gmail.com Ibague - Tolima', 0 , 1,'C');
//------------------------------------------------------------------------------------------
$pdf->SetFont('Arial','B',13);

$pdf->SetXY(160, 8  );
$pdf->Cell(50, 5, 'REMISION  SALIDA', 0 , 1,'C');


//$planta = "PLANTA UNO";
$pdf->SetXY(160, 13  );
$pdf->Cell(50, 5, $planta, 0 , 1,'C');


//$num_remi = "00000";
$pdf->SetFont('Arial','B',20);
$pdf->SetTextColor(255 , 0  , 0);
$pdf->SetXY(160, 22  );
$pdf->Cell(50, 5, $num_remi, 0 , 1,'C');

$pdf->estado_anulada($estado);

//========================================

// Primer Cajon

$pdf->Line(7, 33, 205,33); // Linea Superior
$pdf->Line(7, 55, 205,55); // Linea Inferior
$pdf->Line(205, 33, 205,55); //  Linea Derecha
$pdf->Line(7, 33, 7,55); //  Linea Izquierda


//===================================================



$fila1_x1 = 10; //Fecha , Cliente , Obra
$fila2_x2 = 30; // Valores (Fecha, Cliente, Obra)
$fila3_x3 = 120; // Hora , Mixer, Conductor
$fila4_x4 = 140; // Valores (Hora , Mixer, Conductor

$columm1_y1 = 37; // Fecha, Hora
$columm2_y2 = 43; // Valores (Cliente, Mixer)
$columm3_y3 = 49; // Valores (Obra,Conductor)





//=====================================================================
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY($fila1_x1, $columm1_y1  );
$pdf->Cell(15, 3, 'Fecha :', 0 , 1,'L');


$pdf->Line(30, 41, 110,41);

$fecha_remi = $fecha_remision_remi;
//$fecha_remi = 'Viernes, 20 de Septiembre del 2020';

$pdf->SetXY($fila2_x2, $columm1_y1  );
$pdf->Cell(85, 3, $fecha_remi, 0 , 1,'L');


//=====================================================================
$pdf->SetXY($fila1_x1, $columm2_y2  );
$pdf->Cell(15, 3, 'Cliente :', 0 , 1,'L');

$pdf->Line(30, 47, 110,47);

$nombre_cliente = $nombre_cliente_remi;

$pdf->SetXY($fila2_x2, $columm2_y2  );
$pdf->Cell(15, 3, $nombre_cliente, 0 , 1,'L');


//=====================================================================



$pdf->SetXY($fila1_x1, 49  );
$pdf->Cell(15, 3, 'Obra :', 0 , 1,'L');


$pdf->Line(30, 53, 110,53);

//$nombre_obra = "OBRA PRUEBA"; /// variable

$pdf->SetXY($fila2_x2, $columm3_y3  );
$pdf->Cell(15, 3, $nombre_obra, 0 , 1,'L');


//=====================================================================
//===
//=====================================================================

$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY($fila3_x3, $columm1_y1  );
$pdf->Cell(15, 3, 'Hora :', 0 , 1,'L');

//$hora = "00:00";// Variable

$pdf->SetXY($fila4_x4, $columm1_y1  );
$pdf->Cell(15, 3, $hora, 0 , 1,'L');

$pdf->Line(140, 47, 200,47);


//=====================================================================
//===
//=====================================================================


$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY($fila3_x3, $columm2_y2  );
$pdf->Cell(15, 3, 'Mixer :', 0 , 1,'L');

//$placa = "AAA 000"; // Variable

$pdf->SetXY($fila4_x4, $columm2_y2  );
$pdf->Cell(15, 3, $placa, 0 , 1,'L');

$pdf->Line(140, 41, 200,41);

//=====================================================================
//===
//=====================================================================


$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY($fila3_x3, $columm3_y3  );
$pdf->Cell(15, 3, 'Conductor :', 0 , 1,'L');

//$conductor = "NOMBRE DEL CONDUCTOR";

$pdf->SetXY($fila4_x4, $columm3_y3  );
$pdf->Cell(15, 3, $conductor, 0 , 1,'L');

$pdf->Line(140, 53, 200,53);


//=====================================================================
//===
//=====================================================================



$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY(11, 57  );
$pdf->Cell(15, 3, 'PLANTA :', 0 , 1,'L');


//$pdf->Line(32, 61, 110,61);

$pdf->SetFont('Arial','',11);
//$linea_planta = ' LINEA 1';

$pdf->SetXY(35, 57  );
$pdf->Cell(85, 3, $linea_planta, 0 , 1,'L');

//=====================================================================
//===
//=====================================================================



$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY(100, 57  );
$pdf->Cell(15, 3, 'Sello De Seguridad No:', 0 , 1,'L');


//$pdf->Line(32, 61, 110,61);

$pdf->SetFont('Arial','',10);
//$sello = '00000';

$pdf->SetXY(150, 57  );
$pdf->Cell(85, 3, $sello, 0 , 1,'L');





// Segundo Cajon Seguridad

$pdf->Line(150, 56, 205,56); // Linea Superior

$pdf->Line(150, 61, 205,61); // Linea Inferior
$pdf->Line(150, 56, 150,61); //  Linea Derecha
$pdf->Line(205, 56, 205,61); //  Linea Izquierda









//=====================================================================
//===
//=====================================================================




//  Caja Detalle

$pdf->Line(7, 62, 205,62); // Linea Superior
$pdf->Line(7, 84, 205,84); // Linea Inferior
$pdf->Line(205, 62, 205,84); //  Linea Derecha
$pdf->Line(7, 62, 7,84); //  Linea Izquierda


//=====================================================================
//===
//=====================================================================






$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY($fila1_x1, 64  );
$pdf->Cell(15, 3, 'Metros :', 0 , 1,'L');


//$pdf->Line(32, 61, 110,61);

$pdf->SetFont('Arial','',11);
//$metros = '99.99';

$pdf->SetXY($fila2_x2, 64  );
$pdf->Cell(85, 3, $metros, 0 , 1,'L');




//=====================================================================
//===
//=====================================================================






$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY($fila1_x1, 70  );
$pdf->Cell(15, 3, 'Producto :', 0 , 1,'L');


//$pdf->Line(32, 61, 110,61);

$pdf->SetFont('Arial','',10);
//$producto = 'NOMBRE DEL PRODUCTO';



$pdf->SetXY($fila2_x2, 69  );
$pdf->MultiCell(170, 4, $producto . "  -  " .$descripcion_formula, 0, "", false);



//=====================================================================
//===
//=====================================================================






$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY($fila1_x1, 79     );
$pdf->Cell(15, 3, 'Asentamiento :', 0 , 1,'L');


//$pdf->Line(32, 61, 110,61);

$pdf->SetFont('Arial','',11);
//$asentamiento = utf8_decode('9 "+/1');

$pdf->SetXY(40, 79  );
$pdf->Cell(85, 3, $asentamiento, 0 , 1,'L');






//=====================================================================
//===
//=====================================================================
//=====================================================================
//===
//=====================================================================




// 

$pdf->Line(7, 86, 50,86); // Linea Superior
$pdf->Line(7, 97, 50,97); // Linea Inferior
$pdf->Line(50, 86, 50,97); //  Linea Derecha
$pdf->Line(7, 86, 7,97); //  Linea Izquierda




$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY(9, 87     );
$pdf->Cell(39, 3, 'Hora de Salida', 0 , 1,'C');


//$pdf->Line(32, 61, 110,61);

$pdf->SetFont('Arial','',11);
//$hora_salida = utf8_decode('00:00');
//$hora_salida = "";
$pdf->SetXY(9, 92  );
$pdf->Cell(39, 5, $hora_salida, 0, 1,'C');



//=====================================================================
//===
//=====================================================================







$pdf->Line(60, 86, 103,86); // Linea Superior
$pdf->Line(60, 97, 103,97); // Linea Inferior
$pdf->Line(103, 86, 103,97); //  Linea Derecha
$pdf->Line(60, 86, 60,97); //  Linea Izquierda




$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY(62, 87     );
$pdf->Cell(39, 3, 'Hora de llegada', 0 , 1,'C');


//$pdf->Line(32, 61, 110,61);

$pdf->SetFont('Arial','',11);
//$hora_llegada = utf8_decode('00:00');
//$hora_llegada = "";

$pdf->SetXY(62, 92  );
$pdf->Cell(39, 5, $hora_llegada, 0 , 1,'C');






//=====================================================================
//===
//=====================================================================












$pdf->Line(113, 86, 153,86); // Linea Superior
$pdf->Line(113, 97, 153,97); // Linea Inferior
$pdf->Line(153, 86, 153,97); //  Linea Derecha
$pdf->Line(113, 86,113,97); //  Linea Izquierda




$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY(115, 87     );
$pdf->Cell(39, 3, 'Hora de Inicio', 0 , 1,'C');


//$pdf->Line(32, 61, 110,61);

$pdf->SetFont('Arial','',11);
//$hora_inicio = utf8_decode('00:00');
//$hora_inicio = "";

$pdf->SetXY(115, 92  );
$pdf->Cell(39, 5, $hora_inicio, 0 , 1,'C');



//=====================================================================
//===
//=====================================================================






$pdf->Line(163, 86, 205,86); // Linea Superior
$pdf->Line(163, 97, 205,97); // Linea Inferior
$pdf->Line(205, 86, 205,97); //  Linea Derecha
$pdf->Line(163, 86, 163,97); //  Linea Izquierda




$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY(165, 87     );
$pdf->Cell(39, 3, 'Hora de Terminada', 0 , 1,'C');


//$pdf->Line(32, 61, 110,61);

$pdf->SetFont('Arial','',11);
//$hora_terminada = utf8_decode('00:00');
//$hora_terminada = "";

$pdf->SetXY(165, 92  );
$pdf->Cell(39, 5, $hora_terminada, 0 , 1,'C');

//=====================================================================
//===
//=====================================================================





//  Caja Detalle

$pdf->Line(7, 99, 205,99); // Linea Superior
$pdf->Line(7, 115, 205,115); // Linea Inferior
$pdf->Line(205, 99, 205,115); //  Linea Derecha
$pdf->Line(7, 99, 7,115); //  Linea Izquierda




$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0 , 0  , 0);
$pdf->SetXY(5, 101     );
$pdf->Cell(39, 3, 'Observaciones', 0 , 1,'C');


//$pdf->Line(32, 61, 110,61);

$pdf->SetFont('Arial','',9);
//$pdf->Ln(1);

$observaciones = utf8_decode($observaciones);

$pdf->SetXY(10, 104  );
$pdf->MultiCell(190, 5, $observaciones, 0, "", false);




$pdf->SetFont('Arial','',11);
$pdf->SetTextColor(0 , 0  , 0);
//$pdf->SetXY(5, 101     );
//$pdf->Cell(39, 3, 'Observaciones', 0 , 1,'C');


//$pdf->Line(32, 61, 110,61);

$pdf->SetFont('Arial','',8);
$text1 = utf8_decode('IMPORTANTE: No garantizamos la resistencia de la mezcla a la cual se le agregue agua, mortero de cemento o adictivos quimicos por parte de la obra. El asentamiento de diseño tiene una tolerancia de una pulgada y el tiempo de manejabilidad es de una hora desde el momento que se llega a obra. La firma de este comprobante por el comprador o su(s) representante(s) indica la mezcla a satisfacion por cubicacion y diseño.');

$pdf->SetXY(7, 116  );

$pdf->MultiCell(198, 3, $text1, 0, "", false);





//=====================================================================
$pdf->SetFont('Arial','',10);
$pdf->SetXY(7, 130  );
$pdf->Cell(25, 5, 'Despachador :', 0 , 1,'L');

$pdf->Line(35,135, 110,135);

$despachador = utf8_decode($despachador);

$pdf->SetXY(35, 131  );
$pdf->Cell(15, 3, $despachador, 0 , 1,'L');


//=====================================================================


//=====================================================================
$pdf->SetFont('Arial','',10);
$pdf->SetXY(115, 130  );
$pdf->Cell(20, 5, 'Recibido :', 0 , 1,'L');

$pdf->Line(135,135, 205,135);


$nombres_recibido = utf8_decode($nombres_recibido);

$pdf->SetXY(135, 130  );
$pdf->Cell(60, 5, $nombres_recibido, 0 , 1,'L');


//=====================================================================












$pdf->Output();