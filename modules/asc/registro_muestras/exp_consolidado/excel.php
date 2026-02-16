<?php

require '../../../../vendor/autoload.php';
require '../../../../librerias/autoload.php';
require '../../../../modelos/autoload.php';
require '../../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;



$cls_laboratorio = new cls_laboratorio;

$x = 2;
$x1 = 11;

$spreadsheet = new Spreadsheet();


// Set document properties


$spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')
    ->setLastModifiedBy('PORTAL CONCRETOL')
    ->setTitle('Informe de Muestras')
    ->setSubject('Informe de Muestras')
    ->setDescription('Informe de Muestras')
    ->setKeywords('')
    ->setCategory('');



$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setPath('../../../../assets/images/logos/LogoConcretol.png');
$drawing->setHeight(150);
$drawing->setCoordinates('A1');

$drawing->setWorksheet($spreadsheet->getActiveSheet());

// Add some data



/*** ENCABEZADO */
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('C1', 'SISTEMA DE GESTIÓN DE LA CALIDAD')
    ->setCellValue('C2', 'ASEGURAMIENTO DE CALIDAD')
    ->setCellValue('C3', 'BASE DE DATOS DE TOMA DE MUESTRAS')
    ->setCellValue('C4', '')
    ->setCellValue('C6', '')
    ->setCellValue('C7', '')
    ->setCellValue('C8', '');


$spreadsheet->getActiveSheet()->mergeCells('M8:V8'); //Dia 1
$spreadsheet->getActiveSheet()->mergeCells('M9:N9'); //1
$spreadsheet->getActiveSheet()->mergeCells('O9:P9'); //2
$spreadsheet->getActiveSheet()->mergeCells('Q9:R9'); //3
$spreadsheet->getActiveSheet()->mergeCells('S9:T9'); //4

$spreadsheet->getActiveSheet()->mergeCells('W8:AF8'); //Dia 3
$spreadsheet->getActiveSheet()->mergeCells('W9:X9'); //1
$spreadsheet->getActiveSheet()->mergeCells('Y9:Z9'); //2
$spreadsheet->getActiveSheet()->mergeCells('AA9:AB9'); //3
$spreadsheet->getActiveSheet()->mergeCells('AC9:AD9'); //4

$spreadsheet->getActiveSheet()->mergeCells('AG8:AP8'); //Dia 7
$spreadsheet->getActiveSheet()->mergeCells('AG9:AH9'); //1
$spreadsheet->getActiveSheet()->mergeCells('AI9:AJ9'); //2
$spreadsheet->getActiveSheet()->mergeCells('AK9:AL9'); //3
$spreadsheet->getActiveSheet()->mergeCells('AM9:AN9'); //4

$spreadsheet->getActiveSheet()->mergeCells('AQ8:AZ8'); //Dia 14
$spreadsheet->getActiveSheet()->mergeCells('AQ9:AR9'); //1
$spreadsheet->getActiveSheet()->mergeCells('AS9:AT9'); //2
$spreadsheet->getActiveSheet()->mergeCells('AU9:AV9'); //3
$spreadsheet->getActiveSheet()->mergeCells('AW9:AX9'); //4


$spreadsheet->getActiveSheet()->mergeCells('BA8:BJ8'); //Dia 28
$spreadsheet->getActiveSheet()->mergeCells('BA9:BB9'); //1
$spreadsheet->getActiveSheet()->mergeCells('BC9:BD9'); //2
$spreadsheet->getActiveSheet()->mergeCells('BE9:BF9'); //3
$spreadsheet->getActiveSheet()->mergeCells('BG9:BH9'); //4

$spreadsheet->getActiveSheet()->mergeCells('BK8:BT8'); //Dia 56
$spreadsheet->getActiveSheet()->mergeCells('BK9:BL9'); //1
$spreadsheet->getActiveSheet()->mergeCells('BM9:BN9'); //2
$spreadsheet->getActiveSheet()->mergeCells('BO9:BP9'); //3
$spreadsheet->getActiveSheet()->mergeCells('BQ9:BR9'); //4



/*** ENCABEZADO */
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A10', 'MTRA No.')
    ->setCellValue('B10', 'FECHA MUESTRA')
    ->setCellValue('C10', 'CONSECUTIVO INTERNO')
    ->setCellValue('D10', 'REMISIÓN No.')
    ->setCellValue('E10', 'CLIENTE')
    ->setCellValue('F10', 'OBRA')
    ->setCellValue('G10', 'COD PRODUCTO')
    ->setCellValue('H10', 'PRODUCTO')
    ->setCellValue('I10', 'METROS CUBICOS')
    ->setCellValue('J10', 'PERIODO')
    ->setCellValue('K10', 'PROMEDIO KG/CM2')
    ->setCellValue('L10', 'PORCENTAJE');






if ($stmt_muestras = $cls_laboratorio->GetDataMuestaConsolidadoBDsXLXS($_GET['fecha_ini'], $_GET['fecha_fin'], $_GET['txt_sede'])) {
    while ($row_muestra = $stmt_muestras->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores

        if (!isset($row_muestra['nombre_periodo']) && is_null($row_muestra['nombre_periodo'])) {
            $periodo = "";
        } else {
            $periodo = $row_muestra['nombre_periodo'];
        }

        if (!isset($row_muestra['promediokgcm2']) && is_null($row_muestra['promediokgcm2'])) {
            $promediokgcm2 = "";
        } else {
            $promediokgcm2 = $row_muestra['promediokgcm2'];
        }

        if (!isset($row_muestra['porcentaje']) && is_null($row_muestra['porcentaje'])) {
            $porcentaje = "";
        } else {
            $porcentaje = $row_muestra['porcentaje'];
        }
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $x1, $row_muestra['id']) //  Numero Remision
            ->setCellValue('B' . $x1, $row_muestra['fecha_muestra']) //  Numero Remision
            ->setCellValue('C' . $x1, $row_muestra['consecutivo_interno']) //  Numero Remision
            ->setCellValue('D' . $x1, $row_muestra['cod_remi']) //  Numero Remision
            ->setCellValue('E' . $x1, $row_muestra['cliente']) //  Numero Remision
            ->setCellValue('F' . $x1, $row_muestra['obra']) //  Numero Remision
            ->setCellValue('G' . $x1, $row_muestra['codigo_producto']) //  Numero Remision
            ->setCellValue('H' . $x1, $row_muestra['descripcion_producto']) //  Numero Remision
            ->setCellValue('I' . $x1, $row_muestra['metros_cubicos']) //  Numero Remision
            ->setCellValue('J' . $x1, $periodo) //  Numero Remision
            ->setCellValue('K' . $x1, $promediokgcm2) //  Numero Remision
            ->setCellValue('L' . $x1, $porcentaje) //  Numero Remision

            ->setCellValue('A' . $x1, $row_muestra['id']); //  Numero Remision



        $x1++;
    }
}



$styleArray = [

    'font' => [
        'bold' => true,
        'size' => 10,
    ],

    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
            'color' => ['argb' => '1c100b'],
        ],
    ],

    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'DE9D24',
        ],
        'endColor' => [
            'argb' => 'DE9D24',
        ],

    ],

];

$spreadsheet->getActiveSheet()->getStyle('A10:BT10')->applyFromArray($styleArray);

$spreadsheet->getActiveSheet()->getStyle('M8:BT9')->applyFromArray($styleArray);

$spreadsheet->getActiveSheet()
    ->getColumnDimension('A')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('B')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('C')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('D')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('E')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('F')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('G')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('H')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('I')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('J')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('K')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('L')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('M')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('N')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('O')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('P')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('Q')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('R')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('S')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('T')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('U')
    ->setAutoSize(true);
$spreadsheet->getActiveSheet()
    ->getColumnDimension('V')
    ->setAutoSize(true);

$spreadsheet->getActiveSheet()
    ->getColumnDimension('W')
    ->setAutoSize(true);

$spreadsheet->getActiveSheet()
    ->getColumnDimension('X')
    ->setAutoSize(true);







$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A9', "BASE DE DATOS DE TOMA DE MUESTRAS");



// Set active sheet index to the first sheet, so Excel opens this as the first sheet

$spreadsheet->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Xlsx)

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header('Content-Disposition: attachment;filename="Registro Toma de Muestras.xlsx"');

header('Cache-Control: max-age=0');

// If you're serving to IE 9, then the following may be needed

header('Cache-Control: max-age=1');



// If you're serving to IE over SSL, then the following may be needed

// header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past

header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified

header('Cache-Control: cache, must-revalidate'); // HTTP/1.1

header('Pragma: public'); // HTTP/1.0



$writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

$writer->save('php://output');



exit;
