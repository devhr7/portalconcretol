<?php

require '../../../vendor/autoload.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;

$novedades = new novedades_despacho();
$php_clases = new php_clases();

$abc1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
$abc2 = array('AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

if (isset($_GET['txt_fecha_ini']) && isset($_GET['txt_fecha_fin'])) {
    $fecha_ini = $_GET['txt_fecha_ini'];
    $fecha_fin = $_GET['txt_fecha_fin'];
    // traemos los datos de la consulta
    $datos = $novedades->informe_novedades_generales_excel($fecha_ini, $fecha_fin);
    // iniciamos la clase de excel
    $spreadsheet = new Spreadsheet();
    // se define las Propiedades del documento
    $spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')
        ->setLastModifiedBy('PORTAL CONCRETOL')
        ->setTitle('Informe de Novedades')
        ->setSubject('Informe de Novedades')
        ->setDescription('Informe de Novedades')
        ->setKeywords('')
        ->setCategory('');
    // FILA 1 = NOMBRE DE COLUMNAS
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'CODIGO DE LA NOVEDAD')
        ->setCellValue('B1', 'FECHA NOVEDAD')
        ->setCellValue('C1', 'TIPO NOVEDAD')
        ->setCellValue('D1', 'AREA AFECTADA NOVEDAD')
        ->setCellValue('E1', 'NOVEDAD')
        ->setCellValue('F1', 'NOMBRE CLIENTE')
        ->setCellValue('G1', 'NOMBRE OBRA')
        ->setCellValue('H1', 'OBSERVACION');
    $x = 2;
    if (is_array($datos)) {
        foreach ($datos as $fila) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $x, $fila['id_novedad'])
                ->setCellValue('B' . $x, $fila['fecha_novedad'])
                ->setCellValue('C' . $x, $fila['tipo_novedad'])
                ->setCellValue('D' . $x, $fila['area_afectada'])
                ->setCellValue('E' . $x, $fila['novedad'])
                ->setCellValue('F' . $x, $fila['nombre_cliente'])
                ->setCellValue('G' . $x, $fila['nombre_obra'])
                ->setCellValue('H' . $x, $fila['observacion']);
            $x++;
        }
    }
    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Novedades Generales');
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
    $styleArray = [
        'font' => [
            'bold' => true,
        ],

        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'argb' => 'DE9D24', // encabezado Amarillo
            ],

            'endColor' => [
                'argb' => 'DE9D24',
            ],
        ],
    ];
    $spreadsheet->getActiveSheet()->getStyle('A1:H1')->applyFromArray($styleArray);
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="InformeNovedadesGenerales.xlsx"');
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
