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
    $datos = $novedades->informe_novedades_remisiones_excel($fecha_ini, $fecha_fin);
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
        ->setCellValue('C1', 'CODIGO REMISION')
        ->setCellValue('D1', 'TIPO NOVEDAD')
        ->setCellValue('E1', 'AREA AFECTADA')
        ->setCellValue('F1', 'NOVEDAD')
        ->setCellValue('G1', 'OBSERVACION DE LA NOVEDAD')
        ->setCellValue('H1', 'ESTADO')
        ->setCellValue('I1', 'FISICA')
        ->setCellValue('J1', 'LINEA DESPACHO')
        ->setCellValue('K1', 'NUMERO IDENTIFICACION CLIENTE')
        ->setCellValue('L1', 'NOMBRE DEL CLIENTE')
        ->setCellValue('M1', 'NOMBRE DE LA OBRA')
        ->setCellValue('N1', 'PLACA')
        ->setCellValue('O1', 'NUMERO IDENTIFICACION CONDUCTOR')
        ->setCellValue('P1', 'NOMBRE DEL CONDUCTOR')
        ->setCellValue('Q1', 'SELLO DE SEGURIDAD')
        ->setCellValue('R1', 'CODIGO DEL PRODUCTO')
        ->setCellValue('S1', 'DESCRIPCION DEL PRODUCTO')
        ->setCellValue('T1', 'METROS CUBICOS')
        ->setCellValue('U1', 'ASENTAMIENTO')
        ->setCellValue('V1', 'HORA REMISION')
        ->setCellValue('W1', 'HORA DE SALIDA MIXER DE PLANTA')
        ->setCellValue('X1', 'HORA DE LLEGADA MIXER A OBRA')
        ->setCellValue('Y1', 'HORA DE INICIO DE DESCARGUE')
        ->setCellValue('Z1', 'HORA DE TERMINACION DE DESCARGUE')
        ->setCellValue('AA1', 'HORA DE LLEGADA MIXER EN PLANTA')
        ->setCellValue('AB1', 'DESPACHADOR')
        ->setCellValue('AC1', 'FIRMA CLIENTE')
        ->setCellValue('AD1', 'FECHA FIRMA')
        ->setCellValue('AE1', 'BOMBA')
        ->setCellValue('AF1', 'OPERARIO DE BOMBA')
        ->setCellValue('AG1', 'AUXILIAR BOMBA')
        ->setCellValue('AH1', 'OBSERVACIONES DE LA REMISION');
    $x = 2;

    if (is_array($datos)) {
        foreach ($datos as $fila) {
            if ($fila['ct26_fisica']) {
                $fisica = "FISICA";
            } else {
                $fisica = "VIRTUAL";
            }
            $estado =  $php_clases->estado_remi2($fila['ct26_estado']);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $x, $fila['id_novedad'])
                ->setCellValue('B' . $x, $fila['ct26_fecha_remi'])
                ->setCellValue('C' . $x, $fila['ct26_codigo_remi'])
                ->setCellValue('D' . $x, $fila['tipo_novedad'])
                ->setCellValue('E' . $x, $fila['area_afectada'])
                ->setCellValue('F' . $x, $fila['novedad'])
                ->setCellValue('G' . $x, $fila['observacion'])
                ->setCellValue('H' . $x, $estado)
                ->setCellValue('I' . $x, $fisica)
                ->setCellValue('J' . $x, $fila['ct26_idplanta'])
                ->setCellValue('K' . $x, $fila['ct26_nitcliente'])
                ->setCellValue('L' . $x, $fila['ct26_razon_social'])
                ->setCellValue('M' . $x, $fila['ct26_nombre_obra'])
                ->setCellValue('N' . $x, $fila['ct26_vehiculo'])
                ->setCellValue('O' . $x, $fila['ct26_identificacion_conductor'])
                ->setCellValue('P' . $x, $fila['ct26_nombre_conductor'])
                ->setCellValue('Q' . $x, $fila['ct26_sello'])
                ->setCellValue('R' . $x, $fila['ct26_codigo_producto'])
                ->setCellValue('S' . $x, $fila['ct26_descripcion_producto'])
                ->setCellValue('T' . $x, $fila['ct26_metros'])
                ->setCellValue('U' . $x, $fila['ct26_asentamiento'])
                ->setCellValue('V' . $x, $fila['ct26_hora_remi'])
                ->setCellValue('W' . $x, $fila['ct26_hora_salida_planta'])
                ->setCellValue('X' . $x, $fila['ct26_hora_llegada_obra'])
                ->setCellValue('Y' . $x, $fila['ct26_hora_inicio_descargue'])
                ->setCellValue('Z' . $x, $fila['ct26_hora_terminada_descargue'])
                ->setCellValue('AA' . $x, $fila['ct26_hora_llegada_planta'])
                ->setCellValue('AB' . $x, $fila['ct26_despachador'])
                ->setCellValue('AC' . $x, $fila['ct26_recibido'])
                ->setCellValue('AD' . $x, $fila['ct26_fechaRecibido'])
                ->setCellValue('AE' . $x, $fila['ct26_bomba'])
                ->setCellValue('AF' . $x, $fila['ct26_op_bomba'])
                ->setCellValue('AG' . $x, $fila['ct26_aux_bomba'])
                ->setCellValue('AH' . $x, $fila['ct26_observaciones']);
            $x++;
        }
    }
    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Novedades Remisiones');
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
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('Y')
        ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('Z')
        ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('AA')
        ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('AB')
        ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('AC')
        ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('AD')
        ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('AE')
        ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('AF')
        ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('AG')
        ->setAutoSize(true);
    $spreadsheet->getActiveSheet()
        ->getColumnDimension('AH')
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
    $spreadsheet->getActiveSheet()->getStyle('A1:AH1')->applyFromArray($styleArray);
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="InformeNovedadesRemisiones.xlsx"');
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
