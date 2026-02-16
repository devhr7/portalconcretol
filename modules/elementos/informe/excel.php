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

$elementos = new elementos();

//$fecha_ini = '2020-12-01'; // GET dato de la fecha
//$fecha_fin = '2020-12-31';  // GET dato de la fecha

$abc1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

$abc2 = array('AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');



if (isset($_GET['txt_fecha_ini']) && isset($_GET['txt_fecha_fin'])) {

    $fecha_ini = $_GET['txt_fecha_ini'];

    $fecha_fin = $_GET['txt_fecha_fin'];

    // traemos los datos de la consulta
    $datos = $elementos->excel_salidas_epp($fecha_ini, $fecha_fin);

    // iniciamos la clase de excel
    $spreadsheet = new Spreadsheet();

    // se define las Propiedades del documento
    $spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')
        ->setLastModifiedBy('PORTAL CONCRETOL')
        ->setTitle('Informe de Salidas de EPP')
        ->setSubject('Informe de Salidas de EPP')
        ->setDescription('Informe de Salidas de EPP')
        ->setKeywords('')
        ->setCategory('');

    // FILA 1 = NOMBRE DE COLUMNAS
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'CODIDO')
        ->setCellValue('B1', 'TIPO_MOVIMIENTO')
        ->setCellValue('C1', 'FECHA')
        ->setCellValue('D1', 'NOMBRE DEL EMPLEADO')
        ->setCellValue('E1', 'CARGO DEL EMPLEADO')
        ->setCellValue('F1', 'AREA DEL EMPLEADO')
        ->setCellValue('G1', 'ELEMENTO EPP')
        ->setCellValue('H1', 'CANTIDAD')
        ->setCellValue('I1', 'OBSERVACIONES');
    $x = 2;

    if (is_array($datos)) {
        foreach ($datos as $fila) {
            
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $x, $fila['id'])
                ->setCellValue('B' . $x, $fila['nombre_movimiento'])
                ->setCellValue('C' . $x, $fila['fecha'])
                ->setCellValue('D' . $x, $fila['nombre_empleado'])
                ->setCellValue('E' . $x, $fila['nombre_cargo'])
                ->setCellValue('F' . $x, $fila['nombre_area'])
                ->setCellValue('G' . $x, $fila['nombre_elemento_epp'])
                ->setCellValue('H' . $x, $fila['cantidad'])
                ->setCellValue('I' . $x, $fila['observaciones']);
            $x++;
        }
    }
    // Rename worksheet

    $spreadsheet->getActiveSheet()->setTitle('Salida EPP');

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

    header('Content-Disposition: attachment;filename="SalidasEPP.xlsx"');

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
