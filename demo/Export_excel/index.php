<?php
require '../../vendor/autoload.php';
require_once '../../include/conexionPDO.php';


 $PDO = new conexionPDO();
 $con = $PDO->connect();

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator('Concretolima')
    ->setLastModifiedBy('Concretolima')
    ->setTitle('Office 2007 XLSX Test Document')
    ->setSubject('Office 2007 XLSX Test Document')
    ->setDescription('Test document for Office 2007 XLSX, generated using PHP classes.')
    ->setKeywords('office 2007 openxml php')
    ->setCategory('Test result file');




//ENCABEZADO DE LAS COLUMNAS
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A1', 'FECHA')
    ->setCellValue('B1', 'PLACA')
    ->setCellValue('C1', 'AGENTE DE SERVICIO')
    ->setCellValue('D1', 'HORA DE CARGUE')
    ->setCellValue('E1', 'REMISION')
    ->setCellValue('F1', 'FORMULA')
    ->setCellValue('G1', 'CLIENTE')
    ->setCellValue('H1', 'OBRA')
    ->setCellValue('I1', 'M3')
    ->setCellValue('J1', 'HORADE SALIDA EN PLANTA')
    ->setCellValue('K1', 'HORADE LLEGADA EN OBRA')
    ->setCellValue('L1', 'HORADE INICO DESCARGUE')
    ->setCellValue('M1', 'HORADE TERMINADA DESCARGUE');
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Consulta SQL

$fecha_inicio = '2020-07-09 00:00:01';
$fecha_final = '2020-07-09 23:59:59';

$sql = "SELECT * FROM `ct26_remisiones` WHERE `ct26_fecha_remi` BETWEEN :fecha_inicio AND :fecha_final ORDER BY `ct26_remisiones`.`ct26_fecha_remi` ASC ";
$stmt = $con->prepare($sql);
        
$stmt->bindParam(':fecha_inicio',$fecha_inicio, PDO::PARAM_STR);
$stmt->bindParam(':fecha_final',$fecha_final, PDO::PARAM_STR);
        
$result = $stmt->execute();

$filax = 1;

while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $filax ++;          
    
    $fecha = $fila['ct26_fecha_remi'];
             $placa = $fila['ct26_vehiculo'];
             $agente_servicio = $fila['ct26_conductor'];
             $hora_cargue = "";
             $remision = $fila['ct26_codigo_remi'];
             $formula ="";
             $cliente = "";
             $obra = $fila['ct26_idObra'];
             $m3 = "";
             $hora_salida_planta = $fila['ct26_hora_salida_planta'];
             $hora_lleaga_obra = $fila['ct26_hora_llegada_obra'];
             $hora_inicio_descargue = $fila['ct26_hora_inicio_descargue'];
             $hora_terminada_descargue = $fila['ct26_hora_terminada_descargue'];
             //$ = $fila[''];
             
          
             
         


// DATOS DE LAS COLIMNAS
$spreadsheet->setActiveSheetIndex(0)
  ->setCellValue('A'.$filax, $fecha)
  ->setCellValue('B'.$filax, $placa )
  ->setCellValue('C'.$filax, $agente_servicio)
  ->setCellValue('D'.$filax, $hora_cargue)
  ->setCellValue('E'.$filax, $remision)
  ->setCellValue('F'.$filax, $formula)
  ->setCellValue('G'.$filax, $cliente)
  ->setCellValue('H'.$filax, $obra)
  ->setCellValue('I'.$filax, $m3)
  ->setCellValue('J'.$filax, $hora_salida_planta)
  ->setCellValue('K'.$filax, $hora_lleaga_obra)
  ->setCellValue('L'.$filax, $hora_inicio_descargue)
  ->setCellValue('M'.$filax, $hora_terminada_descargue);


}
























// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('Simple');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="01simple.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;