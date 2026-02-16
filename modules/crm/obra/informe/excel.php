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



$php_clases = new php_clases();

$informes = new informes();





//$fecha_ini = '2020-12-01'; // GET dato de la fecha

//$fecha_fin = '2020-12-31';  // GET dato de la fecha



$abc1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

$abc2 = array('AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');



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
        ->setCellValue('F1', 'TIPO DOCUMENTO')
        ->setCellValue('G1', 'NUMERO IDENTIFICACION')
        ->setCellValue('H1', 'CLIENTE')
        ->setCellValue('I1', 'ASESORA COMERCIAL')
        ->setCellValue('J1', 'SEDE')
        ->setCellValue('K1', 'TIPO CLIENTE')
        ->setCellValue('L1', 'TIPO PLAN MAESTRO')
        ->setCellValue('M1', 'OBRA')
        ->setCellValue('N1', 'DEPARTAMENTO')
        ->setCellValue('O1', 'MUNICIPIO')
        ->setCellValue('P1', 'COMUNA')
        ->setCellValue('Q1', 'BARRIO')
        ->setCellValue('R1', 'SEGMENTO')
        ->setCellValue('S1', 'PLACA DELA MIXER')
        ->setCellValue('T1', 'IDENTIFICACION CONDUCTOR')
        ->setCellValue('U1', 'CONDUCTOR')
        ->setCellValue('V1', 'SELLO DE SEGURIDAD')
        ->setCellValue('W1', 'CODIGO DEL PRODUCTO')
        ->setCellValue('X1', 'PRODUCTO')
        ->setCellValue('Y1', 'METROS CUBICOS')
        ->setCellValue('Z1', 'ASENTAMENTO')
        ->setCellValue('AA1', 'HORA REMISION')
        ->setCellValue('AB1', 'HORA DE SALIDA MIXER DE PLANTA')
        ->setCellValue('AC1', 'HORA DE LLEGADA MIXER A OBRA')
        ->setCellValue('AD1', 'HORA DE INICIO DE DESCARGUE')
        ->setCellValue('AE1', 'HORA DE TERMINACION DE DESCARGUE')
        ->setCellValue('AF1', 'HORA DE LLEGADA MIXER EN PLANTA')
        ->setCellValue('AG1', 'DESPACHADOR')
        ->setCellValue('AH1', 'FIRMA CLIENTE')
        ->setCellValue('AI1', 'FECHA FIRMA')
        ->setCellValue('AJ1', 'OBSERVACIONES')
        ->setCellValue('AK1', 'CICLO VIAJE')
        ->setCellValue('AL1', 'CICLO PLANTA')
        ->setCellValue('AM1', 'CICLO TRANSPORTE')
        ->setCellValue('AN1', 'CICLO DESCARGUE')
        ->setCellValue('AO1', 'CICLO ESPERA EN OBRA')
        ->setCellValue('AP1', 'CICLO OBRA')
        ->setCellValue('AQ1', 'BOMBA')
        ->setCellValue('AR1', 'M3 BOMBA')
        ->setCellValue('AS1', 'OPERARIO DE BOMBA')
        ->setCellValue('AT1', 'AUXILIAR BOMBA')
        ->setCellValue('AU1', 'PLANTAID')
        ->setCellValue('AV1', 'LATITUD')
        ->setCellValue('AW1', 'LONGITUD')
        ->setCellValue('AX1', 'DISTANCIARMI')
        ->setCellValue('AY1', 'DISTANCIARZO')
        ->setCellValue('AZ1', 'DISTANCIARMT')
        ->setCellValue('BA1', 'DISTANCIAHND')
        ->setCellValue('BB1', '');





    $x = 2;

    if (is_array($datos)) {

        foreach ($datos as $fila) {
            $id_remision = $fila['ct26_id_remision'];
            if (is_array($datos_cliente_remi = $informes->get_datos_clientes($fila['ct26_idcliente']))) {
                foreach ($datos_cliente_remi as $key_cli) {
                    $asesora_comercial = $key_cli['ct1_nombre_asesora'];
                    $sede = $key_cli['ct1_nombre_sede'];
                    $tipo_cliente = $key_cli['ct1_nombre_tipo_cliente'];
                    $id_plan_maestro = $key_cli['ct1_tipo_plan_maestro'];
                    $plan_maestro = $informes->get_nombre_tipo_plan_maestro($id_plan_maestro);
                    $tipo_documento = $key_cli['ct1_TipoIdentificacion'];
                }
            } else {
                $asesora_comercial = '';
                $sede = '';
                $tipo_cliente = '';
                $plan_maestro = '';
                $tipo_documento = '';
            }
            if (is_array($datos_obra_remi = $informes->get_datos_obras($fila['ct26_idObra']))) {
                foreach ($datos_obra_remi as $key_obra) {
                    $nombre_obra = $key_obra['ct5_NombreObra'];
                    $departamento = $key_obra['ct5_nombre_departamento'];
                    $ciudad = $key_obra['ct5_nombre_ciudad'];
                    $comuna = $key_obra['ct5_nombre_comuna'];
                    $barrio = $key_obra['ct5_barrio'];
                    $idsegmento = $key_obra['ct5_segmento'];
                    $segmento = $informes->get_nombre_segmento($key_obra['ct5_segmento']);
                    $direccion = $key_obra['ct5_DireccionObra'];
                    $latitud = $key_obra['latitud'];
                    $longitud = $key_obra['longitud'];
                    $distanciaRMI = $key_obra['distanciaRMI'];
                    $distanciaRZO = $key_obra['distanciaRZO'];
                    $distanciaRMT = $key_obra['distanciaRMT'];
                    $distanciaHND = $key_obra['distanciaHND'];
                }
            } else {
                $nombre_obra = '';
                $departamento = '';
                $ciudad = '';
                $comuna = '';
                $barrio = '';
                $segmento = '';
                $direccion = '';
                $latitud = '';
                $longitud = '';
                $distanciaRMI = '';
                $distanciaRZO = '';
                $distanciaRMT = '';
                $distanciaHND = '';
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
           
            if($nombre_producto = $informes->get_nombre_producto($fila['ct26_id_producto'])){

            }else{
                $nombre_producto = $fila['ct26_descripcion_producto'];
                //$nombre_producto = $fila['ct26_id_producto'];
            }

           

            $spreadsheet->setActiveSheetIndex(0)

                ->setCellValue('A' . $x, $fila['ct26_fecha_remi'])
                ->setCellValue('B' . $x, $fila['ct26_codigo_remi'])
                ->setCellValue('C' . $x, $estado)
                ->setCellValue('D' . $x, $fisica)
                ->setCellValue('E' . $x, $fila['ct26_idplanta'])
                ->setCellValue('F' . $x, $tipo_documento)
                ->setCellValue('G' . $x, $fila['ct26_nitcliente'])
                ->setCellValue('H' . $x, $fila['nombre_cliente'])
                ->setCellValue('I' . $x, $asesora_comercial) // ASESORA COMERCIAL'
                ->setCellValue('J' . $x, $sede) // SEDE
                ->setCellValue('K' . $x, $tipo_cliente) // TIPO CLIENTE
                ->setCellValue('L' . $x, $plan_maestro) // TIPO PLAN MAESTRO
                ->setCellValue('M' . $x, $nombre_obra)
                ->setCellValue('N' . $x, $departamento) // DEPARTAMENTO
                ->setCellValue('O' . $x, $ciudad) // MUNICIPIO
                ->setCellValue('P' . $x, $comuna) // COMUNA
                ->setCellValue('Q' . $x, $barrio) // BARRIO
                ->setCellValue('R' . $x, $segmento) // SEGMENTO
                ->setCellValue('S' . $x, $fila['ct26_vehiculo'])
                ->setCellValue('T' . $x, $fila['ct26_identificacion_conductor'])
                ->setCellValue('U' . $x, $fila['nombre_conductor'])
                ->setCellValue('V' . $x, $fila['ct26_sello'])
                ->setCellValue('W' . $x, $fila['ct26_codigo_producto'])
                ->setCellValue('X' . $x, $nombre_producto)
                ->setCellValue('Y' . $x, doubleval($fila['ct26_metros']))
                ->setCellValue('Z' . $x, $fila['ct26_asentamiento'])
                ->setCellValue('AA' . $x, $fila['ct26_hora_remi'])
                ->setCellValue('AB' . $x, $fila['ct26_hora_salida_planta'])
                ->setCellValue('AC' . $x, $fila['ct26_hora_llegada_obra'])
                ->setCellValue('AD' . $x, $fila['ct26_hora_inicio_descargue'])
                ->setCellValue('AE' . $x, $fila['ct26_hora_terminada_descargue'])
                ->setCellValue('AF' . $x, $fila['ct26_hora_llegada_planta'])
                ->setCellValue('AG' . $x, $fila['ct26_despachador'])
                ->setCellValue('AH' . $x, $fila['ct26_recibido'])
                ->setCellValue('AI' . $x, $fila['ct26_fechaRecibido'])
                ->setCellValue('AJ' . $x, $observaciones)
                ->setCellValue('AK' . $x, $fila['tiempo_pedido']) // Tiempo 
                ->setCellValue('AL' . $x, $fila['tiempo_planta']) // Tiempo 
                ->setCellValue('AM' . $x, $fila['tiempo_transporte']) // Tiempo 
                ->setCellValue('AN' . $x, $fila['tiempo_descargue_obra'])
                ->setCellValue('AO' . $x, $fila['tiempo_espera_obra'])
                ->setCellValue('AP' . $x, $fila['tiempo_obra'])
                ->setCellValue('AQ' . $x, $fila['ct26_bomba'])
                ->setCellValue('AR' . $x, $fila['ct26_cant_bomba']) // M3 BOMBA
                ->setCellValue('AS' . $x, $fila['ct26_op_bomba'])
                ->setCellValue('AT' . $x, $fila['ct26_aux_bomba'])
                ->setCellValue('AU' . $x, "")
                ->setCellValue('AV' . $x, $latitud)
                ->setCellValue('AW' . $x, $longitud)
                ->setCellValue('AX' . $x, $distanciaRMI)
                ->setCellValue('AY' . $x, $distanciaRZO)
                ->setCellValue('AZ' . $x, $distanciaRMT)
                ->setCellValue('BA' . $x, $distanciaHND)
                ->setCellValue('BB' . $x, "");

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



    $spreadsheet->getActiveSheet()->getStyle('A1:BA1')->applyFromArray($styleArray);

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
