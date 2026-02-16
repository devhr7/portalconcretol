<?php
require '../../vendor/autoload.php';
require '../../librerias/autoload.php';
require '../../modelos/autoload.php';
require '../../vendor/autoload.php';


//use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;

$php_clases = new php_clases();
$t40_votaciones = new t40_votaciones();
//$fecha_ini = '2020-12-01'; // GET dato de la fecha
//$fecha_fin = '2020-12-31';  // GET dato de la fecha




    $datos = $t40_votaciones->informe_votantes();

    $spreadsheet = new Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('VOTANTES CONCRETOL')
        ->setLastModifiedBy('VOTANTES CONCRETOL')
        ->setTitle('VOTANTES CONCRETOL')
        ->setSubject('VOTANTES CONCRETOL')
        ->setDescription('')
        ->setKeywords('')
        ->setCategory('');


    //$spreadsheet->getActiveSheet()->getColumnDimension('A1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('B1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('C1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('D1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('E1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('F1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('G1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('H1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('I1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('J1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('K1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('L1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('M1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('N1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('O1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('P1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('Q1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('R1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('S1')->setAutoSize(true);
    //$spreadsheet->getActiveSheet()->getColumnDimension('T1')->setAutoSize(true);



    // Add some data
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'CEDULA')
        ->setCellValue('B1', 'NOMBRES COMPLETOS')
        ->setCellValue('C1', 'CARGO');
    $x = 2;
    if (is_array($datos)) {
        foreach ($datos as $fila) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $x, $fila['ct42_cedula_votantes'])
                ->setCellValue('B' . $x, $fila['ct42_nombre_votantes'])
                ->setCellValue('C' . $x, $fila['ct42_cargo_votantes']);
                $x++;
        }
    }

    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('VOTANTES');


    $spreadsheet->getActiveSheet()
        ->getColumnDimension('A')
        ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('B')
        ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('C')
        ->setAutoSize(true);

    $styleArray = [
        'font' => [
            'bold' => true,
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


    $spreadsheet->getActiveSheet()->getStyle('A1:C1')->applyFromArray($styleArray);

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="votantes.xlsx"');
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

