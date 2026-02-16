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

$t5_obras = new t5_obras();

$abc1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

$abc2 = array('AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');



if (isset($_GET['txt_fecha_ini']) && isset($_GET['txt_fecha_fin'])) {

    $fecha_ini = $_GET['txt_fecha_ini'];
    $fecha_fin = $_GET['txt_fecha_fin'];
    // traemos los datos de la consulta
    $datos = $t5_obras->informe_excel($fecha_ini, $fecha_fin);
    // iniciamos la clase de excel
    $spreadsheet = new Spreadsheet();
    // se define las Propiedades del documento
    $spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')
        ->setLastModifiedBy('PORTAL CONCRETOL')
        ->setTitle('Informe de obras')
        ->setSubject('Informe de obras')
        ->setDescription('Informe de obras')
        ->setKeywords('')
        ->setCategory('');
    // FILA 1 = NOMBRE DE COLUMNAS
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Metros cúbicos de mezcla de concreto')
        ->setCellValue('A2', 'DEPARTAMENTO')
        ->setCellValue('B2', 'VIVIENDA')
        ->setCellValue('E2', 'OBRAS CIVILES')
        ->setCellValue('L2', 'EDIFICACION')
        ->setCellValue('M2', 'OTROS')
        ->setCellValue('N2', 'TOTAL');

       


            // FILA 1 = NOMBRE DE COLUMNAS
    $spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('B3', 'VIS')
    ->setCellValue('C3', 'NO VIS')
    ->setCellValue('D3', 'TOTAL')
    ->setCellValue('E3', 'Grupo 530201')
    ->setCellValue('F3', 'Grupo 530202')
    ->setCellValue('G3', 'Grupo 530203')
    ->setCellValue('H3', 'Grupo 530204')
    ->setCellValue('I3', 'Grupo 530205')
    ->setCellValue('J3', 'No identificado')
    ->setCellValue('K3', 'TOTAL');

    $spreadsheet->getActiveSheet()->mergeCells('A1:N1');
    $spreadsheet->getActiveSheet()->mergeCells('A2:A3');
    $spreadsheet->getActiveSheet()->mergeCells('B2:D2');
    $spreadsheet->getActiveSheet()->mergeCells('E2:K2');
    $spreadsheet->getActiveSheet()->mergeCells('L2:L3');
    $spreadsheet->getActiveSheet()->mergeCells('M2:M3');
    $spreadsheet->getActiveSheet()->mergeCells('N2:N3');
    
    $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A4', 'TOLIMA');

    $letras = ['B','C','D','F','G','H','I','J','K','L','M','N'];
    $x=0;

    foreach ($datos as $fila) {
        $id_segmento = intval($fila['id_segmento']);
        if($id_segmento == 1 ){ // Vivienda de interés social (VIS) ( < 135 SMLMV )
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B4' , $fila['metros']);
        }elseif($id_segmento == 2){ // Vivienda diferente de interés social (NO VIS) - ( > 135 SMLMV )
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C4' , $fila['metros']);
        }elseif($id_segmento == 10){ // 530201 Carreteras, calles, vías férreas y pistas de aterrizaje, 
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('E4' , $fila['metros']);
        }elseif($id_segmento == 11){ // 530202 Puertos, canales, presas, sistemas de riego y otras obras 
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('F4' , $fila['metros']);
        }elseif($id_segmento == 12){ // 530203 Tuberías para la conducción de gas a larga distancia, líneas de comunicación y cables de poder, tuberías y cables locales y obras conexas.
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('G4' , $fila['metros']);
        }elseif($id_segmento == 13){  // 530204 Construcciones en minas y plantas industriales
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('H4' , $fila['metros']);
        }elseif($id_segmento == 14){ // 530205 Construcciones deportivas al aire libre, otras obras de ingeniería civil
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('I4' , $fila['metros']);
        }elseif($id_segmento == 20){ // EDIFICACIONES - bodegas, edificaciones comerciales, edificaciones industriales, oficinas, hoteles, edificaciones para administración pública, centros sociales y/o recreacionales, entre otros.
            $spreadsheet->setActiveSheetIndex(0) 
            ->setCellValue('L4' , $fila['metros']);
        }elseif($id_segmento == 30){ // OTROS - aquellos despachos de los cuales no es posible identificar su destino o uso. Entre ellos: mayoristas, intermediarios, comercializadores, distribuidores, transformadores (prefabricados), etc.
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('M4' , $fila['metros']);
        }

    }


    // Rename worksheet
    $spreadsheet->getActiveSheet()->setTitle('Informe de obras');
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

    $styleArray = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
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
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
                'color' => ['argb' => '7B7B7B'],
            ],
        ]
       
    ];
    $styleArray2 = [
        
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        ],
       
    ];


    $spreadsheet->getActiveSheet()->getStyle('A2:N3')->applyFromArray($styleArray);
    $spreadsheet->getActiveSheet()->getStyle('A1:N4')->applyFromArray($styleArray2);
    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $spreadsheet->setActiveSheetIndex(0);
    // Redirect output to a client’s web browser (Xlsx)
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="InformeObras.xlsx"');
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
