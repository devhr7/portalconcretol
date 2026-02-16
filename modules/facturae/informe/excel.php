<?php
require '../../../vendor/autoload.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


//use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;

$t27_factura = new t27_factura();
$php_clases = new php_clases();
$informes = new informes();

$result_estado_facturae = $t27_factura->selectfactura_remi();
//$fecha_ini = '2020-12-01'; // GET dato de la fecha
//$fecha_fin = '2020-12-31';  // GET dato de la fecha

$abc1 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
$abc2 = array('AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');

if (isset($_GET['txt_fecha_ini']) && isset($_GET['txt_fecha_fin'])) {
    $fecha_ini = $_GET['txt_fecha_ini'];
    $fecha_fin = $_GET['txt_fecha_fin'];


    $datos = $informes->informe_fact($fecha_ini, $fecha_fin);


    $spreadsheet = new Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')
        ->setLastModifiedBy('PORTAL CONCRETOL')
        ->setTitle('Informe de Fatura')
        ->setSubject('Informe de Fatura')
        ->setDescription('Informe de Fatura')
        ->setKeywords('')
        ->setCategory('');


    // Add some data
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'FECHA SUBIDA DE LA FACTURA')
        ->setCellValue('B1', 'NUMERO FACTURA')
        ->setCellValue('C1', 'NUMERO REMISION');
        

        

    $x = 2;
    if (is_array($datos)) {
        foreach ($datos as $fila) {

            $fecha_factura = $fila['ct27_fecha_subda'];
            $numero_factura = $fila['ct27_nombre_factura'];
            $numero_remision = $fila['ct26_codigo_remi'];
           
        

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $x, $fecha_factura)
                ->setCellValue('B' . $x, $numero_factura)
                ->setCellValue('C' . $x, $numero_remision);
                

                

                $x++;
        }
    }

    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Factura');


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
    header('Content-Disposition: attachment;filename="Factura.xlsx"');
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
} else {

    header('location: index.php');
}
