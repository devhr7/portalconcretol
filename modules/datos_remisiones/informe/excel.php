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



$php_clases = new php_clases();

$informes = new informes();

$tiempo_remi = new tiempo_remi();



//$fecha_ini = '2020-12-01'; // GET dato de la fecha

//$fecha_fin = '2020-12-31';  // GET dato de la fecha



$abc1 = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');

$abc2 = array('AA','AB','AC','AD','AE','AF','AG','AH','AI','AJ','AK','AL','AM','AN','AO','AP','AQ','AR','AS','AT','AU','AV','AW','AX','AY','AZ');



if (isset($_GET['txt_fecha_ini']) && isset($_GET['txt_fecha_fin'])) {

    $fecha_ini = $_GET['txt_fecha_ini'];

    $fecha_fin = $_GET['txt_fecha_fin'];





    $datos_remi = $tiempo_remi->get_horas_remi($fecha_ini, $fecha_fin);

    $resultado = $tiempo_remi->actualizar_horas_remi($datos_remi);

    $tiempo_remi->actualizar_conductor($fecha_ini,$fecha_fin);

    

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

        ->setCellValue('B1', 'NUMERO REMISION')

        ->setCellValue('C1', 'ESTADO')

        ->setCellValue('D1', 'FISICA')

        ->setCellValue('E1', 'LINEA DE DESPACHO')

        ->setCellValue('F1', 'NUMERO IDENTIFICACION')

        ->setCellValue('G1', 'CLIENTE')

        ->setCellValue('H1', 'OBRA')

        ->setCellValue('I1', 'PLACA DELA MIXER')

        ->setCellValue('J1', 'IDENTIFICACION CONDUCTOR')

        ->setCellValue('K1', 'CONDUCTOR')

        ->setCellValue('L1', 'SELLO DE SEGURIDAD')

        ->setCellValue('M1', 'CODIGO DEL PRODUCTO')

        ->setCellValue('N1', 'PRODUCTO')

        ->setCellValue('O1', 'METROS CUBICOS')

        ->setCellValue('P1', 'ASENTAMENTO')

        ->setCellValue('Q1', 'HORA REMISION')

        ->setCellValue('R1', 'HORA DE SALIDA MIXER DE PLANTA')

        ->setCellValue('S1', 'HORA DE LLEGADA MIXER A OBRA')

        ->setCellValue('T1', 'HORA DE INICIO DE DESCARGUE')

        ->setCellValue('U1', 'HORA DE TERMINACION DE DESCARGUE')

        ->setCellValue('V1', 'HORA DE LLEGADA MIXER EN PLANTA')

        ->setCellValue('W1', 'DESPACHADOR')

        ->setCellValue('X1', 'FIRMA CLIENTE')

        ->setCellValue('Y1', 'FECHA FIRMA')

        ->setCellValue('Z1', 'OBSERVACIONES')

        ->setCellValue('AA1', 'CICLO VIAJE')

        ->setCellValue('AB1', 'CICLO PLANTA')

        ->setCellValue('AC1', 'CICLO TRANSPORTE')

        ->setCellValue('AD1', 'CICLO DESCARGUE')

        ->setCellValue('AE1', 'CICLO ESPERA EN OBRA')

        ->setCellValue('AF1', 'CICLO OBRA')

        ->setCellValue('AG1', 'BOMBA')
        ->setCellValue('AH1', 'CANT BOMBA')


        ->setCellValue('AI1','OPERARIO DE BOMBA')

        ->setCellValue('AJ1','AUXILIAR BOMBA')

        ->setCellValue('AK1','CONSOLIDADO REMI')

        ->setCellValue('AL1','TIPO HORA PROGRAMADA')

        ->setCellValue('AM1','HORA PROGRAMADA')

        ->setCellValue('AN1','')

        ->setCellValue('AO1','');

   



    $x = 2;

    if (is_array($datos)) {

        foreach ($datos as $fila) {

            $id_remision = $fila['ct26_id_remision'];

            $datos_novedad_remi = $informes->novedades_remi($id_remision);

            $novedades =  "";

            if (is_array($datos_novedad_remi)) {

                foreach ($datos_novedad_remi as $key_nov) {

                    $novedades .= $key_nov['ct44_novedades']." ;";

                }

            }







            $observaciones_cliente = $fila['ct26_observaciones_cli'];

            $observaciones_funcionario = $fila['ct26_observaciones'];

            $observaciones_despachador = $fila['ct26_observaciones_desp'];

            $estado =  $php_clases->estado_remi2($fila['ct26_estado']);

            $tipo_remision = $fila['ct26_fisica'];



            if (is_null($fila['ct26_imagen_remi']) || empty($fila['ct26_imagen_remi'])) {

                $fisica = "VIRTUAL";

            } else {

                $fisica = "FISICA";

            }





            $observaciones = $observaciones_cliente . " ; " . $observaciones_funcionario . " ; " . $observaciones_despachador;





            $spreadsheet->setActiveSheetIndex(0)

                ->setCellValue('A' . $x, $fila['ct26_fecha_remi'])

                ->setCellValue('B' . $x, $fila['ct26_codigo_remi'])

                ->setCellValue('C' . $x, $estado)

                ->setCellValue('D' . $x, $fisica)

                ->setCellValue('E' . $x, $fila['ct26_idplanta'])

                ->setCellValue('F' . $x, $fila['ct26_nitcliente'])

                ->setCellValue('G' . $x, $fila['nombre_cliente'])

                ->setCellValue('H' . $x, $fila['ct26_nombre_obra'])

                ->setCellValue('I' . $x, $fila['ct26_vehiculo'])

                ->setCellValue('J' . $x, $fila['ct26_identificacion_conductor'])



                ->setCellValue('K' . $x, $fila['nombre_conductor'])

                ->setCellValue('L' . $x, $fila['ct26_sello'])

                ->setCellValue('M' . $x, $fila['ct26_codigo_producto'])

                ->setCellValue('N' . $x, $fila['ct26_descripcion_producto'])

                ->setCellValue('O' . $x, $fila['ct26_metros'])

                ->setCellValue('P' . $x, $fila['ct26_asentamiento'])

                ->setCellValue('Q' . $x, $fila['ct26_hora_remi'])

                ->setCellValue('R' . $x, $fila['ct26_hora_salida_planta'])

                ->setCellValue('S' . $x, $fila['ct26_hora_llegada_obra'])

                ->setCellValue('T' . $x, $fila['ct26_hora_inicio_descargue'])

                ->setCellValue('U' . $x, $fila['ct26_hora_terminada_descargue'])

                ->setCellValue('V' . $x, $fila['ct26_hora_llegada_planta'])

                ->setCellValue('W' . $x, $fila['ct26_despachador'])

                ->setCellValue('X' . $x, $fila['ct26_recibido'])

                ->setCellValue('Y' . $x, $fila['ct26_fechaRecibido'])

                ->setCellValue('Z' . $x, $observaciones)

                ->setCellValue('AA' . $x,$fila['tiempo_pedido']) // Tiempo 

                ->setCellValue('AB' . $x,$fila['tiempo_planta']) // Tiempo 

                ->setCellValue('AC' . $x,$fila['tiempo_transporte']) // Tiempo 

                ->setCellValue('AD' . $x,$fila['tiempo_descargue_obra'] )

                ->setCellValue('AE' . $x,$fila['tiempo_espera_obra'] )

                ->setCellValue('AF' . $x,$fila['tiempo_obra'] )

                ->setCellValue('AG' . $x,$fila['ct26_bomba'] )
                ->setCellValue('AH' . $x,$fila['ct26_cant_bomba'] ) // CANTIDAD bOMBEADA


                ->setCellValue('AI' . $x, $fila['ct26_op_bomba'])

                ->setCellValue('AJ' . $x, $fila['ct26_aux_bomba'])

                ->setCellValue('AK' . $x, $fila['consolidado_remi'])
                ->setCellValue('AL' . $x, $fila['tipo_hora_prog'])
                ->setCellValue('AM' . $x, $fila['hora_programada']);



                



                $x++;

        }

    }



    // Rename worksheet

    $spreadsheet->getActiveSheet()->setTitle('Remisiones');





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

        $spreadsheet->getActiveSheet()

        ->getColumnDimension('AI')

        ->setAutoSize(true);

        $spreadsheet->getActiveSheet()

        ->getColumnDimension('AJ')

        ->setAutoSize(true);
        $spreadsheet->getActiveSheet()

        ->getColumnDimension('AK')

        ->setAutoSize(true);
        $spreadsheet->getActiveSheet()

        ->getColumnDimension('AL')

        ->setAutoSize(true);

        $spreadsheet->getActiveSheet()

        ->getColumnDimension('AM')

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



    $spreadsheet->getActiveSheet()->getStyle('Y17')->getNumberFormat()->applyFromArray(

             [

                 'formatCode' => PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_TIME6

             ]

         );



    $spreadsheet->getActiveSheet()->getStyle('A1:AM1')->applyFromArray($styleArray);



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

