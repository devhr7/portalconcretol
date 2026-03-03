<?php
require '../../../vendor/autoload.php';
require '../../../librerias/autoload.php';
require '../../../modelos/autoload.php';
require '../../../vendor/autoload.php';


use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Settings;
use PhpOffice\PhpSpreadsheet\CachedObjectStorageFactory;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Style;


$modelo_batch = new modelo_batch();
$php_clases = new php_clases();


//$fecha_ini = '2020-12-01'; // GET dato de la fecha
//$fecha_fin = '2020-12-31';  // GET dato de la fecha

$abc1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');
$abc2 = array('AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

if (isset($_GET['txt_fecha_ini']) && isset($_GET['txt_fecha_fin'])) {
    ini_set('memory_limit', '512M');
    set_time_limit(0);

    $cacheMethod = CachedObjectStorageFactory::cache_to_phpTemp;
    $cacheSettings = ['memoryCacheSize' => '32MB'];
    Settings::setCacheStorageMethod($cacheMethod, $cacheSettings);

    $fecha_ini = $_GET['txt_fecha_ini'];
    $fecha_fin = $_GET['txt_fecha_fin'];


    $datos_batch = $modelo_batch->select_batches_informe($fecha_ini, $fecha_fin);

    // se Crea el Excel
    $spreadsheet = new Spreadsheet();

    // Set document properties
    $spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')
        ->setLastModifiedBy('PORTAL CONCRETOL')
        ->setTitle('Informe de Consumo Materia Prima')
        ->setSubject('Informe de Consumo Materia Prima')
        ->setDescription('Informe de Consumo Materia Prima')
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
        ->setCellValue('A1', 'FECHA REMISION')
        ->setCellValue('B1', 'HORA REMISION')
        ->setCellValue('C1', 'ESTADO')

        ->setCellValue('D1', 'LINEA DE DESPACHO')
        ->setCellValue('E1', 'DESPACHADOR')
        ->setCellValue('F1', 'REMISION')
        ->setCellValue('G1', 'CODIGO PRODUCTO')
        ->setCellValue('H1', 'DESCRIPCION DEL PRODUCTO')
        ->setCellValue('I1', 'METROS')

        ->setCellValue('J1', 'IDENTIFICACION CLIENTE')
        ->setCellValue('K1', 'NOMBRE CLIENTE')
        ->setCellValue('L1', 'OBRA')

        ->setCellValue('M1', 'NOMBRE AGREGADO 1')
        ->setCellValue('N1', 'TEORICO AGREGADO 1')
        ->setCellValue('O1', 'REAL AGREGADO 1')

        ->setCellValue('P1', 'NOMBRE AGREGADO 2')
        ->setCellValue('Q1', 'TEORICO AGREGADO 2')
        ->setCellValue('R1', 'REAL AGREGADO 2')

        ->setCellValue('S1', 'NOMBRE AGREGADO 3')
        ->setCellValue('T1', 'TEORICO AGREGADO 3')
        ->setCellValue('U1', 'REAL AGREGADO 3')

        ->setCellValue('V1', 'NOMBRE AGREGADO 4')
        ->setCellValue('W1', 'TEORICO AGREGADO 4')
        ->setCellValue('X1', 'REAL AGREGADO 4')


        ->setCellValue('Y1', 'NOMBRE CEMENTO 1')
        ->setCellValue('Z1', 'TEORICO CEMENTO 1')
        ->setCellValue('AA1', 'REAL CEMENTO 1')

        ->setCellValue('AB1', 'NOMBRE CEMENTO 2')
        ->setCellValue('AC1', 'TEORICO CEMENTO 2')
        ->setCellValue('AD1', 'REAL CEMENTO 2')

        ->setCellValue('AE1', 'NOMBRE CEMENTO 3')
        ->setCellValue('AF1', 'TEORICO CEMENTO 3')
        ->setCellValue('AG1', 'REAL CEMENTO 3')

        ->setCellValue('AH1', 'NOMBRE ADICTIVO 1')
        ->setCellValue('AI1', 'TEORICO ADICTIVO 1')
        ->setCellValue('AJ1', 'REAL ADICTIVO 1')

        ->setCellValue('AK1', 'NOMBRE ADICTIVO 2')
        ->setCellValue('AL1', 'TEORICO ADICTIVO 2')
        ->setCellValue('AM1', 'REAL ADICTIVO 2')

        ->setCellValue('AN1', 'NOMBRE ADICTIVO 3')
        ->setCellValue('AO1', 'TEORICO ADICTIVO 3')
        ->setCellValue('AP1', 'REAL ADICTIVO 3')

        ->setCellValue('AQ1', 'NOMBRE ADICTIVO 4')
        ->setCellValue('AR1', 'TEORICO ADICTIVO 4')
        ->setCellValue('AS1', 'REAL ADICTIVO 4')

        ->setCellValue('AT1', 'NOMBRE AGUA')
        ->setCellValue('AU1', 'TEORICO AGUA')
        ->setCellValue('AV1', 'REAL AGUA')

        ->setCellValue('AW1', 'BOMBA')
        ->setCellValue('AX1', 'OPERADOR BOMBA')
        ->setCellValue('AY1', 'AUX BOMBA')

        ->setCellValue('AZ1', 'OBSERVACIONES')
        ->setCellValue('BA1', 'NOVEDADES DE LA REMISION')
        ->setCellValue('BB1', 'RAZON DE LA ANULACION')
        ->setCellValue('BC1', '');

    $x = 2;
    if (is_array($datos_batch)) {
        foreach ($datos_batch as $fila) {
            // $id_remision = $fila['ct26_id_remision'];

            $novedades = "";

            $estado =  $php_clases->estado_remi2($fila['estado']);

            if (is_array($datos_novedad_remi = $modelo_batch->novedades_remi($fila['id_remision']))) {
                foreach ($datos_novedad_remi as $key_nov) {
                    $novedades .= $key_nov['ct44_novedades'] . " ;";
                }
            } else {
                $novedades = "";
            }


            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $x, $fila['fecha'])
                ->setCellValue('B' . $x, $fila['hora'])
                ->setCellValue('C' . $x, $estado)

                ->setCellValue('D' . $x, $fila['planta'])
                ->setCellValue('E' . $x, $fila['despachador']) // DESPACHADOR
                ->setCellValue('F' . $x, $fila['remision'])
                ->setCellValue('G' . $x, $fila['codigo_formula'])
                ->setCellValue('H' . $x, $fila['descripcion_formula'])
                ->setCellValue('I' . $x, $fila['metros'])

                ->setCellValue('J' . $x, $fila['numero_identificacion'])
                ->setCellValue('K' . $x, $fila['nombre_cliente'])
                ->setCellValue('L' . $x, $fila['nombreObra'])

                ->setCellValue('M' . $x, $fila['n_agregado1'])
                ->setCellValue('N' . $x, $fila['t_agregado1'])
                ->setCellValue('O' . $x, $fila['r_agregado1'])

                ->setCellValue('P' . $x, $fila['n_agregado2'])
                ->setCellValue('Q' . $x, $fila['t_agregado2'])
                ->setCellValue('R' . $x, $fila['r_agregado2'])

                ->setCellValue('S' . $x, $fila['n_agregado3'])
                ->setCellValue('T' . $x, $fila['t_agregado3'])
                ->setCellValue('U' . $x, $fila['r_agregado3'])

                ->setCellValue('V' . $x, $fila['n_agregado4'])
                ->setCellValue('W' . $x, $fila['t_agregado4'])
                ->setCellValue('X' . $x, $fila['r_agregado4'])

                ->setCellValue('Y' . $x, $fila['n_cemento1'])
                ->setCellValue('Z' . $x, $fila['t_cemento1'])
                ->setCellValue('AA' . $x, $fila['r_cemento1'])

                ->setCellValue('AB' . $x, $fila['n_cemento2'])
                ->setCellValue('AC' . $x, $fila['t_cemento2'])
                ->setCellValue('AD' . $x, $fila['r_cemento2'])

                ->setCellValue('AE' . $x, $fila['n_cemento3'])
                ->setCellValue('AF' . $x, $fila['t_cemento3'])
                ->setCellValue('AG' . $x, $fila['r_cemento3'])

                ->setCellValue('AH' . $x, $fila['n_adictivo1'])
                ->setCellValue('AI' . $x, $fila['t_adictivo1'])
                ->setCellValue('AJ' . $x, $fila['r_adictivo1'])

                ->setCellValue('AK' . $x, $fila['n_adictivo2'])
                ->setCellValue('AL' . $x, $fila['t_adictivo2'])
                ->setCellValue('AM' . $x, $fila['r_adictivo2'])

                ->setCellValue('AN' . $x, $fila['n_adictivo3'])
                ->setCellValue('AO' . $x, $fila['t_adictivo3'])
                ->setCellValue('AP' . $x, $fila['r_adictivo3'])

                ->setCellValue('AQ' . $x, $fila['n_adictivo4'])
                ->setCellValue('AR' . $x, $fila['t_adictivo4'])
                ->setCellValue('AS' . $x, $fila['r_adictivo4'])

                ->setCellValue('AT' . $x, $fila['n_agua'])
                ->setCellValue('AU' . $x, $fila['t_agua'])
                ->setCellValue('AV' . $x, $fila['r_agua'])

                ->setCellValue('AW' . $x, $fila['nombre_bomba']) // BOMBA
                ->setCellValue('AX' . $x, $fila['op_bomba']) // OP
                ->setCellValue('AY' . $x, $fila['aux_bomba']) // AUX

                ->setCellValue('AZ' . $x, $fila['obs'] . ' ; ' . $fila['obs_desp'] . ' ; ' . $fila['obs_cli'] . ' ; ')  //Observaciones




                ->setCellValue('BA' . $x, $novedades) // Novedades
                ->setCellValue('BB' . $x, '') // Razon de la Anulacion
                ->setCellValue('BC' . $x, '');



            $x++;
        }
    }



    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Consumo Materia Prima');
    foreach (range('A', 'Z') as $col) {
        $spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(18);
    }
    foreach (['AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ', 'BA', 'BB'] as $col) {
        $spreadsheet->getActiveSheet()->getColumnDimension($col)->setWidth(18);
    }
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



    $spreadsheet->getActiveSheet()->getStyle('A1:BB1')->applyFromArray($styleArray);

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="ConsumoMateriaPrima.xlsx"');
    header('Cache-Control: max-age=0');
    // If you're serving to IE 9, then the following may be needed
    header('Cache-Control: max-age=1');

    // If you're serving to IE over SSL, then the following may be needed
    // header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
    header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    header('Pragma: public'); // HTTP/1.0

    $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    $writer->setPreCalculateFormulas(false);
    $writer->save('php://output');

    $spreadsheet->disconnectWorksheets();
    unset($writer, $spreadsheet, $datos_batch);

    exit;
} else {

    header('location: index.php');
}
