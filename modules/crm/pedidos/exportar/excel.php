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

$pedidos = new pedidos();

$fecha_ini = $_GET['txt_fecha_ini'];
$fecha_fin = $_GET['txt_fecha_fin'];
$cliente = $pedidos->get_nombre_cliente($_GET['id_cliente']);
$obra = $pedidos->get_nombre_obra($_GET['id_obra']);

$abc1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

$abc2 = array('AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');



if (isset($fecha_ini) && isset($fecha_fin)) {

    // traemos los datos de la consulta
    $datos = $pedidos->excel_productos($cliente, $obra, $fecha_ini, $fecha_fin);
    $datos_pedidos = $pedidos->excel_pedidos($cliente, $obra, $fecha_ini, $fecha_fin);
    $datos_bomba = $pedidos->excel_bomba($cliente, $obra, $fecha_ini, $fecha_fin);
    $datos_servicio = $pedidos->excel_servicio($cliente, $obra, $fecha_ini, $fecha_fin);

    // iniciamos la clase de excel
    $spreadsheet = new Spreadsheet();

    // se define las Propiedades del documento
    $spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')
        ->setLastModifiedBy('PORTAL CONCRETOL')
        ->setTitle('Informe de productos')
        ->setSubject('Informe de productos')
        ->setDescription('Informe de productos')
        ->setKeywords('')
        ->setCategory('');


    $styleArray = [
        'font' => [
            'bold' => true,
        ],

        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => [
                'argb' => 'fdc82f', // encabezado Amarillo
            ],

            'endColor' => [
                'argb' => 'fdc82f',
            ],
        ],
    ];


    $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
    $drawing->setName('Logo Concretol');
    $drawing->setDescription('Logo Concretol');
    $drawing->setPath('../../../../assets/images/logos/LogoConcretol.png'); /* put your path and image here */
    $drawing->setCoordinates('A2');
    $drawing->setOffsetX(110);
    $drawing->setWidth(40);
    $drawing->setHeight(100);
    $drawing->getShadow()->setVisible(true);
    $drawing->getShadow()->setDirection(45);
    $drawing->setWorksheet($spreadsheet->getActiveSheet());


    $styleArraybordes = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => '000'],
            ],
        ],
    ];


    // ENCABEZADO HOJA EXCEL
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('C3', 'PEDIDOS')
        ->setCellValue('C4', 'CODIGO')
        ->setCellValue('C5', 'FECHA DE VENCIMIENTO')
        ->setCellValue('C6', 'ASESORA COMERCIAL');
    $spreadsheet->getActiveSheet()->mergeCells('C3:D3');
    $spreadsheet->getActiveSheet()->getStyle('C3:D3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('C3:D6')->applyFromArray($styleArraybordes);

    $iz1 = 4;
    $iz2 = 5;
    $iz3 = 6;
    if (is_array($datos_pedidos)) {
        foreach ($datos_pedidos as $fila) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('D' . $iz1, $fila['id'])
                ->setCellValue('D' . $iz2, $fila['fecha_vencimiento'])
                ->setCellValue('D' . $iz3, $fila['nombre_asesora']);
        }
        $iz1++;
        $iz2++;
        $iz3++;
    }

    $x = 8;

    // ENCABEZADO PRECIO PRODUCTO
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('B8', 'PRECIO PRODUCTO');
    $spreadsheet->getActiveSheet()->mergeCells('B8:G8');
    $spreadsheet->getActiveSheet()->getStyle('B8:G8')->applyFromArray($styleArray);

    $x1 = $x;

    // FILA ENCABEZADO PRECIO PRODUCTOS
    $x++;

    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('B' . $x, 'NOMBRE CLIENTE')
        ->setCellValue('C' . $x, 'NOMBRE OBRA')
        ->setCellValue('D' . $x, 'CODIGO PRODUCTO')
        ->setCellValue('E' . $x, 'DESCRIPCION')
        ->setCellValue('F' . $x, 'PRECIO')
        ->setCellValue('G' . $x, 'CANTIDAD M3');
    $spreadsheet->getActiveSheet()->getStyle('B' . $x . ':G' . $x)->applyFromArray($styleArray);

    // IMPRIMIR DATOS PRECIOS PRODUCTO
    if (is_array($datos)) {
        foreach ($datos as $fila) {
            $x++;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $x, strtoupper($fila['nombre_cliente']))
                ->setCellValue('C' . $x, $fila['nombre_obra'])
                ->setCellValue('D' . $x, $fila['codigo_producto'])
                ->setCellValue('E' . $x, $fila['nombre_producto'])
                ->setCellValue('F' . $x, $fila['precio_m3'])
                ->setCellValue('G' . $x, $fila['cantidad_m3']);
        }
    }
    $spreadsheet->getActiveSheet()->getStyle('B' . $x1 . ':G' . $x)->applyFromArray($styleArraybordes);

    //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // ENCABEZADO PRECIO BOMBA
    $x = $x + 2;
    $x1 = $x;
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('B' . $x, 'PRECIO BOMBEO');
    $spreadsheet->getActiveSheet()->getStyle('B' . $x . ':G' . $x)->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->mergeCells('B' . $x . ':G' . $x);

    // FILA ENCABEZADO PRECIO BOMBA
    $x++;
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('B' . $x, 'NOMBRE CLIENTE')
        ->setCellValue('C' . $x, 'NOMBRE OBRA')
        ->setCellValue('D' . $x, 'TIPO BOMBA')
        ->setCellValue('E' . $x, 'CANTIDAD MIN')
        ->setCellValue('F' . $x, 'CANTIDAD MAX')
        ->setCellValue('G' . $x, 'PRECIO');
    $spreadsheet->getActiveSheet()->getStyle('B' . $x . ':G' . $x)->applyFromArray($styleArray);

    // IMPRIMIR DATOS PRECIOS BOMBA
    if (is_array($datos_bomba)) {
        foreach ($datos_bomba as $fila) {
            $x++;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $x, strtoupper($fila['nombre_cliente']))
                ->setCellValue('C' . $x, $fila['nombre_obra'])
                ->setCellValue('D' . $x, strtoupper($fila['nombre_tipo_bomba']))
                ->setCellValue('E' . $x, $fila['min_m3'])
                ->setCellValue('F' . $x, $fila['max_m3'])
                ->setCellValue('G' . $x, $fila['precio']);
        }
    }
    $spreadsheet->getActiveSheet()->getStyle('B' . $x1 . ':G' . $x)->applyFromArray($styleArraybordes);


    // ENCABEZADO PRECIO SERVICIOS
    $x = $x + 2;
    $x1 = $x;

    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('B' . $x, 'PRECIO SERVICIOS');
    $spreadsheet->getActiveSheet()->getStyle('B' . $x . ':G' . $x)->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->mergeCells('B' . $x . ':G' . $x);
    // FILA ENCABEZADO PRECIO SERVICIOS
    $x++;
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('B' . $x, 'NOMBRE CLIENTE')
        ->setCellValue('C' . $x, 'NOMBRE OBRA')
        ->setCellValue('D' . $x, 'NOMBRE DEL SERVICIO')
        ->setCellValue('E' . $x, 'PRECIO');

    $spreadsheet->getActiveSheet()->getStyle('B' . $x . ':G' . $x)->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->mergeCells('E' . $x . ':G' . $x);
    // IMPRIMIR DATOS PRECIOS SERVICIOS
    if (is_array($datos_servicio)) {
        foreach ($datos_servicio as $fila) {
            $x++;
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $x, strtoupper($fila['nombre_cliente']))
                ->setCellValue('C' . $x, $fila['nombre_obra'])
                ->setCellValue('D' . $x, strtoupper($fila['nombre_tipo_servicio']))
                ->setCellValue('E' . $x, $fila['precio']);
            $spreadsheet->getActiveSheet()->mergeCells('E' . $x . ':G' . $x);
        }
    }
    $spreadsheet->getActiveSheet()->getStyle('B' . $x1 . ':G' . $x)->applyFromArray($styleArraybordes);


    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Productos');


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



    // Set active sheet index to the first sheet, so Excel opens this as the first sheet

    $spreadsheet->setActiveSheetIndex(0);

    // Redirect output to a client’s web browser (Xlsx)

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="Pedidos.xlsx"');
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
