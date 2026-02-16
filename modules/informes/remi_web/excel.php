<?php
require '../../../vendor/autoload.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


//use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;


$informes = new informes();
//$fecha_ini = '2020-12-01'; // GET dato de la fecha
//$fecha_fin = '2020-12-31';  // GET dato de la fecha


if (isset($_GET['txt_fecha_ini']) && isset($_GET['txt_fecha_fin'])) {
    $fecha_ini = $_GET['txt_fecha_ini'];
    $fecha_fin = $_GET['txt_fecha_fin'];


    $datos = $informes->informe_remi($fecha_ini, $fecha_fin);

    $spreadsheet = new Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')
        ->setLastModifiedBy('PORTAL CONCRETOL')
        ->setTitle('Informe de Remisiones')
        ->setSubject('Informe de Remisiones')
        ->setDescription('Informe de Remisiones')
        ->setKeywords('')
        ->setCategory('');

    // Add some data
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'FECHA REMISION')
        ->setCellValue('B1', 'NUMERO REMISION')
        ->setCellValue('C1', 'LINEA DE DESPACHO')
        ->setCellValue('D1', 'CLIENTE')
        ->setCellValue('E1', 'OBRA')
        ->setCellValue('F1', 'HORA REMISION')
        ->setCellValue('G1', 'PLACA DELA MIXER')
        ->setCellValue('H1', 'CONDUCTOR')
        ->setCellValue('I1', 'SELLO DE SEGURIDAD')
        ->setCellValue('J1', 'PRODUCTO')
        ->setCellValue('K1', 'METROS CUBICOS')
        ->setCellValue('L1', 'ASENTAMENTO')
        ->setCellValue('M1', 'HORA DE SALIDA MIXER DE PLANTA')
        ->setCellValue('N1', 'HORA DE LLEGADA MIXER A OBRA')
        ->setCellValue('O1', 'HORA DE INICIO DE DESCARGUE')
        ->setCellValue('P1', 'HORA DE TERMINACION DE DESCARGUE')
        ->setCellValue('Q1', 'OBSERVACIONES')
        ->setCellValue('R1', 'DESPACHADOR')
        ->setCellValue('S1', 'FIRMA CLIENTE')
        ->setCellValue('T1', 'FECHA FIRMA');

    $x = 2;
    if (is_array($datos)) {
        foreach ($datos as $fila) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $x, $fila['ct26_fecha_remi'])
                ->setCellValue('B' . $x, $fila['ct26_codigo_remi'])
                ->setCellValue('C' . $x, $fila['ct26_idplanta'])
                ->setCellValue('D' . $x, $fila['ct26_razon_social'])
                ->setCellValue('E' . $x, $fila['ct26_nombre_obra'])
                ->setCellValue('F' . $x, $fila['ct26_hora_remi'])
                ->setCellValue('G' . $x, $fila['ct26_vehiculo'])
                ->setCellValue('H' . $x, $fila['ct26_nombre_conductor'])
                ->setCellValue('I' . $x, $fila['ct26_sello'])
                ->setCellValue('J' . $x, $fila['ct26_descripcion_producto'])
                ->setCellValue('K' . $x, $fila['ct26_metros'])
                ->setCellValue('L' . $x, $fila['ct26_asentamiento'])
                ->setCellValue('M' . $x, $fila['ct26_hora_salida_planta'])
                ->setCellValue('N' . $x, $fila['ct26_hora_llegada_obra'])
                ->setCellValue('O' . $x, $fila['ct26_hora_inicio_descargue'])
                ->setCellValue('P' . $x, $fila['ct26_hora_terminada_descargue'])
                ->setCellValue('Q' . $x, $fila['ct26_nombre_conductor'])
                ->setCellValue('R' . $x, $fila['ct26_despachador'])
                ->setCellValue('S' . $x, $fila['ct26_recibido'])
                ->setCellValue('T' . $x, $fila['ct26_fechaRecibido']);
            $x++;
        }
    }

    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Remisiones');

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Remisiones.xlsx"');
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
