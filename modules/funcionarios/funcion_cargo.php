<?php

require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$t30_formatos_cargos = new t30_formatos_cargos();
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$id_cargo = 3; //falta variable

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


$nombres_completos = $_GET['nombres'];
$numero_documento = $_GET['documento'];
$area = $_GET['area'];
$cargo = $_GET['cargo'];
$lugar_induccion = $_GET['lugar'];
$fecha_inicio_contrato = $_GET['fecha_inicio'];

switch ($area) {
    case 1:
        $nombre_area = "AGENTE DE SERVICIO";
        break;
    case 2:
        $nombre_area = "GERENCIA";
        break;
    case 3:
        $nombre_area = "GERENCIA ADMINISTRATIVA";
        break;
    case 4:
        $nombre_area = "GERENTE OPERATIVO Y COMERCIAL";
        break;
    default:
        $nombre_area = "";
        break;
}




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// Create new Spreadsheet object
$spreadsheet = new Spreadsheet();

// Set document properties
$spreadsheet->getProperties()->setCreator('Maarten Balliauw');


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('C1', 'GESTIÓN DEL TALENTO HUMANO')
    ->setCellValue('C2', 'FORMATO DE INDUCCION AL CARGO');

$style_titulo = [
    'font' => [
        'bold' => true,
        'name' => 'Arial',
        'size' => 12,
    ],

];
$spreadsheet->getActiveSheet()->getStyle('C1:C2')->applyFromArray($style_titulo);
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// 
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('C3', 'CÓDIGO:  GTH-FO-')
    ->setCellValue('C4', 'VERSIÓN: ')
    ->setCellValue('C5', 'FECHA: ');

$style_titulo2 = [
    'font' => [
        'bold' => true,
        'name' => 'Arial',
        'size' => 9,
    ],
];
$spreadsheet->getActiveSheet()->getStyle('C3:C5')->applyFromArray($style_titulo2);


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// Combinar Celdas
$spreadsheet->getActiveSheet()->mergeCells('A6:C6')
    ->mergeCells('A7:C7')
    ->mergeCells('A8:C8')
    ->mergeCells('A9:C9')
    ->mergeCells('A10:C10');



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A6', 'NOMBRE TRABAJADOR')
    ->setCellValue('A7', 'CARGO A DESEMPEÑAR')
    ->setCellValue('A8', 'AREA DE TRABAJO')
    ->setCellValue('A9', 'LUGAR INDUCCION')
    ->setCellValue('A10', 'FECHA INICIO CONTRATO')
    ->setCellValue('G6', 'Cedúla:');

$style_titulo3 = [
    'font' => [
        'bold' => true,
        'name' => 'Arial',
        'size' => 9,
    ],
];
$spreadsheet->getActiveSheet()->getStyle('A6:A10')->applyFromArray($style_titulo3);




// Combinar Celdas
$spreadsheet->getActiveSheet()->mergeCells('A11:K11');

// Combinar Celdas
$spreadsheet->getActiveSheet()->mergeCells('D6:J6');
$spreadsheet->getActiveSheet()->mergeCells('L6:M6');

$spreadsheet->getActiveSheet()->mergeCells('D7:M7');
$spreadsheet->getActiveSheet()->mergeCells('D8:M8');
$spreadsheet->getActiveSheet()->mergeCells('D9:M9');
$spreadsheet->getActiveSheet()->mergeCells('D10:M10');


$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('K6', "CEDULA");

// Llenar Datos


$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('D6', $nombres_completos)
    ->setCellValue('L6', $numero_documento)
    ->setCellValue('D8', $area)
    ->setCellValue('D7', $nombre_area)
    ->setCellValue('D9', $lugar_induccion)
    ->setCellValue('D10', $fecha_inicio_contrato);







////////////////////////////////////////////////////////////////






$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A11', 'FUNCIONES Y PROHIBICIONES DEL CARGO')
    ->setCellValue('L11', 'FIRMA  CAPACITADOR')
    ->setCellValue('M11', 'FIRMA DEL CAPACITADOR');

$spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(18);
$spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(18);


$style_titulo = [
    'font' => [
        'bold' => true,
        'name' => 'Arial',
        'size' => 11,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],

];
$spreadsheet->getActiveSheet()->getStyle('A11:M11')->applyFromArray($style_titulo);

//////////////////////////////////////////////////////////////////////
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A11', 'FUNCIONES Y PROHIBICIONES DEL CARGO');

$spreadsheet->getActiveSheet()->getRowDimension(11)->setRowHeight(45);
$spreadsheet->getActiveSheet()->getStyle('A11:M11')
    ->getAlignment()->setWrapText(true);



$style_titulo4 = [
    'font' => [
        'bold' => true,
        'name' => 'Arial',
        'size' => 11,
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],

];
$spreadsheet->getActiveSheet()->getStyle('A11:M11')->applyFromArray($style_titulo4);
//////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////

//buscar funciones dependiendo el cargo
$celda_funciones = 12;
$datos_rst = $t30_formatos_cargos->get_funciones($cargo);

foreach ($datos_rst as $datos) {
    $descripcion_funcion = $datos['ct30_descripcion'];
    // Combinar Celdas

    $spreadsheet->getActiveSheet()->mergeCells('A' . $celda_funciones . ':K' . $celda_funciones);
    //imprimir datos

    //autoalturacelda($spreadsheet,$descripcion_funcion,$celda_funciones);

    $spreadsheet->getActiveSheet()->getRowDimension($celda_funciones)->setRowHeight(15);

    // condicional validar estructura definiendo la altura de la fila
    $numero_caractetes = strlen($descripcion_funcion);
    if ($numero_caractetes <= 100) {
        $spreadsheet->getActiveSheet()->getRowDimension($celda_funciones)->setRowHeight(15);
    }
    if ($numero_caractetes <= 200 && $numero_caractetes > 100) {
        $spreadsheet->getActiveSheet()->getRowDimension($celda_funciones)->setRowHeight(30);
    }
    if ($numero_caractetes <= 300 && $numero_caractetes > 200) {
        $spreadsheet->getActiveSheet()->getRowDimension($celda_funciones)->setRowHeight(45);
    }
    if ($numero_caractetes <= 400 && $numero_caractetes > 300) {
        $spreadsheet->getActiveSheet()->getRowDimension($celda_funciones)->setRowHeight(60);
    }
    if ($numero_caractetes <= 500 && $numero_caractetes > 400) {
        $spreadsheet->getActiveSheet()->getRowDimension($celda_funciones)->setRowHeight(75);
    }
    if ($numero_caractetes <= 600 && $numero_caractetes > 500) {
        $spreadsheet->getActiveSheet()->getRowDimension($celda_funciones)->setRowHeight(90);
    }
    if ($numero_caractetes <= 700 && $numero_caractetes > 600) {
        $spreadsheet->getActiveSheet()->getRowDimension($celda_funciones)->setRowHeight(105);
    }

    //////////////////////////////////////////////////////////////////////

    //////////////////////////////////////////////////////////////////////

    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $celda_funciones, $descripcion_funcion);

    $spreadsheet->getActiveSheet()->getStyle('A' . $celda_funciones . ':K' . $celda_funciones)
        ->getAlignment()->setWrapText(true);

    //$spreadsheet->getActiveSheet()->getRowDimension($celda_funciones)->setRowHeight(45);
    $celda_funciones++;
}

//////////////////////////////////////////////////////////////////////

$styleArray5 = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_HAIR,
            'color' => ['argb' => '000000'],
        ],
    ],
];

$spreadsheet->getActiveSheet()->getStyle('A6:M' . ($celda_funciones - 1))->applyFromArray($styleArray5);

////////////////////////////////////////////////////////////////////






// Rename worksheet
$spreadsheet->getActiveSheet()->setTitle('FUNCIONES');

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$spreadsheet->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Funciones.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
//header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header('Pragma: public'); // HTTP/1.0

$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
$writer->save('php://output');
exit;
