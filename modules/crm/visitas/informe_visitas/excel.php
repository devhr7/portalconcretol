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

$cls_visitas_comerciales = new cls_visitas_comerciales();

//$fecha_ini = '2020-12-01'; // GET dato de la fecha
//$fecha_fin = '2020-12-31';  // GET dato de la fecha

$abc1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

$abc2 = array('AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');



if (isset($_GET['txt_fecha_ini']) && isset($_GET['txt_fecha_fin'])) {

    $fecha_ini = $_GET['txt_fecha_ini'];

    $fecha_fin = $_GET['txt_fecha_fin'];

    // traemos los datos de la consulta
    $datos = $cls_visitas_comerciales->informe_excel_visitas_clientes($fecha_ini, $fecha_fin);

    // iniciamos la clase de excel
    $spreadsheet = new Spreadsheet();

    // se define las Propiedades del documento
    $spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')
        ->setLastModifiedBy('PORTAL CONCRETOL')
        ->setTitle('Informe de las visitas de clientes')
        ->setSubject('Informe de las visitas de clientes')
        ->setDescription('Informe de las visitas de clientes')
        ->setKeywords('')
        ->setCategory('');

    // FILA 1 = NOMBRE DE COLUMNAS
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'CODIGO DE LA VISITA')
        ->setCellValue('B1', 'FECHA PROGRAMADO_INICIO')
        ->setCellValue('C1', 'FECHA PROGRAMADO_FIN')
        ->setCellValue('D1', 'COMERCIAL')
        ->setCellValue('E1', 'OBJETIVO DE VISITA')
        ->setCellValue('F1', 'CLIENTE NUEVO')
        ->setCellValue('G1', 'TIPO CLIENTE')
        ->setCellValue('H1', 'TIPO PLAN MAESTRO')
        ->setCellValue('I1', 'DOCUMENTO')
        ->setCellValue('J1', 'NOMBRE COMPLETO')
        ->setCellValue('K1', 'NOMBRE OBRA')
        ->setCellValue('L1', 'DIRECCION OBRA')
        ->setCellValue('M1', 'TELEFONO CLIENTE')
        ->setCellValue('N1', 'SEDE')
        ->setCellValue('O1', 'DEPARTAMENTO')
        ->setCellValue('P1', 'MUNICIPIO')
        ->setCellValue('Q1', 'ZONA')
        ->setCellValue('R1', 'BARRIO')
        ->setCellValue('S1', 'MAESTRO NUEVO')
        ->setCellValue('T1', 'NOMBRE MAESTRO')
        ->setCellValue('U1', 'TELEFONO MAESTRO')
        ->setCellValue('V1', 'M3 POTENCIALES')
        ->setCellValue('W1', 'FECHA POSIBLE FUNDIDA')
        ->setCellValue('X1', 'RESULTADO VISITA')
        ->setCellValue('Y1', 'FORMA DE CONTACTO')
        ->setCellValue('Z1', 'OBSERVACIONES')
        ->setCellValue('AA1', '')
        ->setCellValue('AB1', '');
        // ->setCellValue('E1', 'DEPARTAMENTO')
        // ->setCellValue('F1', 'MUNICIPIO')
        // ->setCellValue('G1', 'COMUNA')
        // ->setCellValue('H1', 'BARRIO')
        // ->setCellValue('I1', 'NUMERO IDENTIFICACION')
        // ->setCellValue('J1', 'NOMBRES COMPLETOS')
        // ->setCellValue('K1', 'NOMBRE')
        // ->setCellValue('L1', 'APELLIDO')
        // ->setCellValue('M1', 'TELEFONO DEL CLIENTE')
        // ->setCellValue('N1', 'NOMBRE OBRA')
        // ->setCellValue('O1', 'DIRECCION OBRA')
        // ->setCellValue('P1', 'NOMBRE MAESTRO')
        // ->setCellValue('Q1', 'CELULAR MAESTRO')
        // ->setCellValue('R1', 'M3 POTENCIALES')
        // ->setCellValue('S1', 'FECHA POSIBLE FUNDIDA')
        // ->setCellValue('T1', 'RESULTADO')
        // ->setCellValue('U1', 'CONTACTO CLIENTE')
        // ->setCellValue('V1', 'OBSERVACION')
        // ->setCellValue('W1', 'STATUS');
    $x = 2;

    if (is_array($datos)) {
        foreach ($datos as $fila) {

            // nombre de la comercial
            if(!is_null($fila['id_comercial'])){
                $nombre_asesora = $cls_visitas_comerciales->get_nombre_tercero($fila['id_comercial']);

            }else{
                $nombre_asesora = $fila['id_comercial'];
            }

            // nombre de objetivo visita
            if(!is_null($fila['id_objetivo_visita'])){
                $nombre_obj_visita = $cls_visitas_comerciales->get_nombre_objetivo_visita($fila['id_objetivo_visita']);

            }else{
                $nombre_obj_visita = $fila['id_objetivo_visita'];
            }

            // // nombre de objetivo visita
            if(!is_null($fila['clientenuevo'])){
                if(intval($fila['clientenuevo']) == 1){
                    $cliente_nuevo = "CLIENTE NUEVO";
                }else{
                    $cliente_nuevo = "CLIENTE ANTIGUO";
                }
              
            }else{
                $cliente_nuevo = "";
            }

            // TIPO CLIENTE 
            if(!is_null($fila['id_tipo_cliente'])){
                $tipo_cliente = $cls_visitas_comerciales->get_nombre_tipo_cliente($fila['id_tipo_cliente']);

            }else{
                $tipo_cliente = $fila['id_tipo_cliente'];
            }

            // TIPO_PLAN MAESTRO
            if(!is_null($fila['id_tipo_plan_maestro'])){
                $tipo_plan_maestro = $cls_visitas_comerciales->get_nombre_tipo_plan_maestro($fila['id_tipo_plan_maestro']);

            }else{
                $tipo_plan_maestro = $fila['id_tipo_plan_maestro'];
            }

            // SEDE
            if(!is_null($fila['id_sede'])){
                if(intval($fila['id_sede']) == 1){
                    $sede = "Ibague";
                }elseif(intval($fila['id_sede']) == 2){
                    $sede =  "Honda";
                }

            }else{
                $sede = $fila['id_sede'];
            }

            // DEPARTAMENTO
            if(!is_null($fila['id_departamento'])){
                $departamento = $cls_visitas_comerciales->get_nombre_departamento($fila['id_departamento']);

            }else{
                $departamento = $fila['id_departamento'];
            }

            // MUNICIPIO
            if(!is_null($fila['id_municipio'])){
                $municipio = $cls_visitas_comerciales->get_nombre_municipio($fila['id_municipio']);

            }else{
                $municipio = $fila['id_municipio'];
            }

            // ZONA
            if(!is_null($fila['id_zona'])){
                $zona = $cls_visitas_comerciales->get_nombre_zona($fila['id_zona']);

            }else{
                $zona = $fila['id_zona'];
            }


            // MAESTRO NUEVO
            if(!is_null($fila['maestro_nuevo'])){
                if(intval($fila['maestro_nuevo']) == 1){
                    $maestro_nuevo = "MAESTRO NUEVO";
                }elseif(intval($fila['maestro_nuevo']) == 0){
                    $maestro_nuevo = "MAESTRO ANTIGUO";
                }

            }else{
                $zona = $fila['maestro_nuevo'];
            }


            // RESULTADO VISITA
            if(!is_null($fila['id_resultado_visita'])){
                $resultado_visita = $cls_visitas_comerciales->get_nombre_resultado_visita($fila['id_resultado_visita']);

            }else{
                $resultado_visita = $fila['id_zona'];
            }

            // FORMA DE CONTACTO CON EL CLIENTE
            if(!is_null($fila['id_forma_contacto'])){
                $forma_contacto = $cls_visitas_comerciales->get_nombre_contacto($fila['id_forma_contacto']);

            }else{
                $forma_contacto = $fila['id_zona'];
            }
            
            
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $x, $fila['id'])//CODIGO VISITA
                ->setCellValue('B' . $x, $fila['start']) // INICIO 
                ->setCellValue('C' . $x, $fila['end']) // FIN
                ->setCellValue('D' . $x, $nombre_asesora) //COMERCIAL
                ->setCellValue('E' . $x, $nombre_obj_visita) // OBJETIVO
                ->setCellValue('F' . $x, $cliente_nuevo) //CLIENTE NUEVO
                ->setCellValue('G' . $x, $tipo_cliente) // TIPO CLIENTE
                ->setCellValue('H' . $x, $tipo_plan_maestro) // TIPO PLAN MAESTRO
                ->setCellValue('I' . $x, $fila['documento']) // DOCUMENTIO
                ->setCellValue('J' . $x, $fila['nombre_cliente'])  // NOMBRE COMPLETO
                ->setCellValue('K' . $x, $fila['nombre_obra'])
                ->setCellValue('L' . $x, $fila['direccion_obra'])
                ->setCellValue('M' . $x, $fila['telefono_cliente'])
                ->setCellValue('N' . $x, $sede)
                ->setCellValue('O' . $x, $departamento)
                ->setCellValue('P' . $x, $municipio)
                ->setCellValue('Q' . $x, $zona)
                ->setCellValue('R' . $x, $fila['barrio'])
                ->setCellValue('S' . $x, $maestro_nuevo)
                ->setCellValue('T' . $x, $fila['nombre_maestro'])
                ->setCellValue('U' . $x, $fila['telefono_maestro'])
                ->setCellValue('V' . $x, $fila['metros_potenciales'])
                ->setCellValue('W' . $x, $fila['fecha_fundida'])
                ->setCellValue('X' . $x, $resultado_visita)
                ->setCellValue('Y' . $x, $forma_contacto)
                ->setCellValue('Z' . $x, $fila['observaciones']);
            $x++;
        }
    }
    // Rename worksheet

    $spreadsheet->getActiveSheet()->setTitle('Visitas de los clientes');

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
                'argb' => 'DE9D24', // encabezado Amarillo
            ],

            'endColor' => [
                'argb' => 'DE9D24',
            ],

        ],

    ];

    $spreadsheet->getActiveSheet()->getStyle('A1:AJ1')->applyFromArray($styleArray);

    // Set active sheet index to the first sheet, so Excel opens this as the first sheet

    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

    header('Content-Disposition: attachment;filename="VisitasClientes.xlsx"');

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
