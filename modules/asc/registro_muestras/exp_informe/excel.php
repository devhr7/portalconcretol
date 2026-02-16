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



$cls_laboratorio = new cls_laboratorio;

$x = 5;


$spreadsheet = new Spreadsheet();


// Set document properties


$spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')
    ->setLastModifiedBy('PORTAL CONCRETOL')
    ->setTitle('Informe de Muestras')
    ->setSubject('Informe de Muestras')
    ->setDescription('Informe de Muestras')
    ->setKeywords('')
    ->setCategory('');



$drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
$drawing->setName('Logo');
$drawing->setDescription('Logo');
$drawing->setPath('../../../../assets/images/logos/LogoConcretol.png');
$drawing->setHeight(150);
$drawing->setCoordinates('A1');

$drawing->setWorksheet($spreadsheet->getActiveSheet());

// Add some data



/*** ENCABEZADO */
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('C1', 'SISTEMA DE GESTIÓN DE LA CALIDAD')
    ->setCellValue('C2', 'ASEGURAMIENTO DE CALIDAD')
    ->setCellValue('C3', 'BASE DE DATOS DE TOMA DE MUESTRAS')
    ->setCellValue('C4', '')
    ->setCellValue('C6', '')
    ->setCellValue('C7', '')
    ->setCellValue('C8', '');


$spreadsheet->getActiveSheet()->mergeCells('M8:V8'); //Dia 1
$spreadsheet->getActiveSheet()->mergeCells('M9:N9'); //1
$spreadsheet->getActiveSheet()->mergeCells('O9:P9'); //2
$spreadsheet->getActiveSheet()->mergeCells('Q9:R9'); //3
$spreadsheet->getActiveSheet()->mergeCells('S9:T9'); //4

$spreadsheet->getActiveSheet()->mergeCells('W8:AF8'); //Dia 3
$spreadsheet->getActiveSheet()->mergeCells('W9:X9'); //1
$spreadsheet->getActiveSheet()->mergeCells('Y9:Z9'); //2
$spreadsheet->getActiveSheet()->mergeCells('AA9:AB9'); //3
$spreadsheet->getActiveSheet()->mergeCells('AC9:AD9'); //4

$spreadsheet->getActiveSheet()->mergeCells('AG8:AP8'); //Dia 7
$spreadsheet->getActiveSheet()->mergeCells('AG9:AH9'); //1
$spreadsheet->getActiveSheet()->mergeCells('AI9:AJ9'); //2
$spreadsheet->getActiveSheet()->mergeCells('AK9:AL9'); //3
$spreadsheet->getActiveSheet()->mergeCells('AM9:AN9'); //4

$spreadsheet->getActiveSheet()->mergeCells('AQ8:AZ8'); //Dia 14
$spreadsheet->getActiveSheet()->mergeCells('AQ9:AR9'); //1
$spreadsheet->getActiveSheet()->mergeCells('AS9:AT9'); //2
$spreadsheet->getActiveSheet()->mergeCells('AU9:AV9'); //3
$spreadsheet->getActiveSheet()->mergeCells('AW9:AX9'); //4


$spreadsheet->getActiveSheet()->mergeCells('BA8:BJ8'); //Dia 28
$spreadsheet->getActiveSheet()->mergeCells('BA9:BB9'); //1
$spreadsheet->getActiveSheet()->mergeCells('BC9:BD9'); //2
$spreadsheet->getActiveSheet()->mergeCells('BE9:BF9'); //3
$spreadsheet->getActiveSheet()->mergeCells('BG9:BH9'); //4

$spreadsheet->getActiveSheet()->mergeCells('BK8:BT8'); //Dia 56
$spreadsheet->getActiveSheet()->mergeCells('BK9:BL9'); //1
$spreadsheet->getActiveSheet()->mergeCells('BM9:BN9'); //2
$spreadsheet->getActiveSheet()->mergeCells('BO9:BP9'); //3
$spreadsheet->getActiveSheet()->mergeCells('BQ9:BR9'); //4



/*** ENCABEZADO */
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A10', 'MTRA No.')
    ->setCellValue('B10', 'CONSECUTIVO INTERNO')
    ->setCellValue('C10', 'FECHA')
    ->setCellValue('D10', 'TOMADA POR')
    ->setCellValue('E10', 'REMISIÓN No.')
    ->setCellValue('F10', 'CLIENTE')
    ->setCellValue('G10', 'OBRA')
    ->setCellValue('H10', 'COD DISEÑO')
    ->setCellValue('I10', 'DISEÑO')
    ->setCellValue('J10', 'REND VOLUMETRICO')
    ->setCellValue('K10', 'AIRE (%)')
    ->setCellValue('L10', 'CEMENTANTE')

    /** DIA 1 */
    ->setCellValue('M8', 'Dia1')
    ->setCellValue('M9', '1')
    ->setCellValue('M10', 'kn')
    ->setCellValue('N10', 'kg/cm2')
    ->setCellValue('O9', '2')
    ->setCellValue('O10', 'kn')
    ->setCellValue('P10', 'kg/cm2')
    ->setCellValue('Q9', '3')
    ->setCellValue('Q10', 'kn')
    ->setCellValue('R10', 'kg/cm2')
    ->setCellValue('S9', '4')
    ->setCellValue('S10', 'kn')
    ->setCellValue('T10', 'kg/cm2')
    ->setCellValue('U10', '1 DIA (kg/cm2)')
    ->setCellValue('V10', '1 DIA %')

    /** DIA 3 */
    ->setCellValue('W8', 'Dia3')
    ->setCellValue('W9', '1')
    ->setCellValue('W10', 'kn')
    ->setCellValue('X10', 'kg/cm2')
    ->setCellValue('Y9', '2')
    ->setCellValue('Y10', 'kn')
    ->setCellValue('Z10', 'kg/cm2')
    ->setCellValue('AA9', '3')
    ->setCellValue('AA10', 'kn')
    ->setCellValue('AB10', 'kg/cm2')
    ->setCellValue('AC9', '4')
    ->setCellValue('AC10', 'kn')
    ->setCellValue('AD10', 'kg/cm2')
    ->setCellValue('AE10', '3 DIA (kg/cm2)')
    ->setCellValue('AF10', '3 DIA %')


    /** DIA 7 */
    ->setCellValue('AG8', 'Dia7')
    ->setCellValue('AG9', '1')
    ->setCellValue('AG10', 'kn')
    ->setCellValue('AH10', 'kg/cm2')
    ->setCellValue('AI9', '2')
    ->setCellValue('AI10', 'kn')
    ->setCellValue('AJ10', 'kg/cm2')
    ->setCellValue('AK9', '3')
    ->setCellValue('AK10', 'kn')
    ->setCellValue('AL10', 'kg/cm2')
    ->setCellValue('AM9', '4')
    ->setCellValue('AM10', 'kn')
    ->setCellValue('AN10', 'kg/cm2')
    ->setCellValue('AO10', '7 DIA (kg/cm2)')
    ->setCellValue('AP10', '7 DIA %')


    /** DIA 14 */
    ->setCellValue('AQ8', 'Dia14')
    ->setCellValue('AQ9', '1')
    ->setCellValue('AQ10', 'kn')
    ->setCellValue('AR10', 'kg/cm2')
    ->setCellValue('AS9', '2')
    ->setCellValue('AS10', 'kn')
    ->setCellValue('AT10', 'kg/cm2')
    ->setCellValue('AU9', '3')
    ->setCellValue('AU10', 'kn')
    ->setCellValue('AV10', 'kg/cm2')
    ->setCellValue('AW9', '4')
    ->setCellValue('AW10', 'kn')
    ->setCellValue('AX10', 'kg/cm2')
    ->setCellValue('AY10', '14 DIA (kg/cm2)')
    ->setCellValue('AZ10', '14 DIA %')


    /** DIA 28 */
    ->setCellValue('BA8', 'Dia28')
    ->setCellValue('BA9', '1')
    ->setCellValue('BA10', 'kn')
    ->setCellValue('BB10', 'kg/cm2')
    ->setCellValue('BC9', '2')
    ->setCellValue('BC10', 'kn')
    ->setCellValue('BD10', 'kg/cm2')
    ->setCellValue('BE9', '3')
    ->setCellValue('BE10', 'kn')
    ->setCellValue('BF10', 'kg/cm2')
    ->setCellValue('BG9', '4')
    ->setCellValue('BG10', 'kn')
    ->setCellValue('BH10', 'kg/cm2')
    ->setCellValue('BI10', '28 DIA (kg/cm2)')
    ->setCellValue('BJ10', '28 DIA %')


    /** DIA 56 */
    ->setCellValue('BK8', 'Dia56')
    ->setCellValue('BK9', '1')
    ->setCellValue('BK10', 'kn')
    ->setCellValue('BL10', 'kg/cm2')
    ->setCellValue('BM9', '2')
    ->setCellValue('BM10', 'kn')
    ->setCellValue('BN10', 'kg/cm2')
    ->setCellValue('BO9', '3')
    ->setCellValue('BO10', 'kn')
    ->setCellValue('BP10', 'kg/cm2')
    ->setCellValue('BQ9', '4')
    ->setCellValue('BQ10', 'kn')
    ->setCellValue('BR10', 'kg/cm2')
    ->setCellValue('BS10', '56 DIA (kg/cm2)')
    ->setCellValue('BT10', '56 DIA %');



$x1 = 11;



if ($stmt_muestras = $cls_laboratorio->GetDataMuestaBDsXLXS( $_POST['fecha_ini'],$_POST['fecha_fin'],$_POST['sede'], isset($_POST['txt_cliente']) ? $_POST['txt_cliente'] : 0)) { // Consulta para obtener los datos de las muestras
   
    while ($row_muestra = $stmt_muestras->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $x1, $row_muestra['id']) //  Numero Remision
            ->setCellValue('B' . $x1, $row_muestra['consecutivo_interno']) //  Numero Remision
            ->setCellValue('C' . $x1, $row_muestra['fecha_muestra']) //  Numero Remision
            ->setCellValue('D' . $x1, $row_muestra['nombre_responsable']) //  Numero Remision
            ->setCellValue('E' . $x1, $row_muestra['cod_remi']) //  Numero Remision
            ->setCellValue('F' . $x1, $row_muestra['cliente']) //  Numero Remision
            ->setCellValue('G' . $x1, $row_muestra['obra']) //  Numero Remision
            ->setCellValue('H' . $x1, $row_muestra['codigo_producto']) //  Numero Remision
            ->setCellValue('I' . $x1, $row_muestra['descripcion_producto']) //  Numero Remision
            ->setCellValue('J' . $x1, $row_muestra['rend_volumetrico'])
            ->setCellValue('K' . $x1, $row_muestra['aire'])
            ->setCellValue('L' . $x1, $row_muestra['cementante_kg']);




        /*********************************************************************************************
         * DIA 1
         */

        $dia = 1;
        if (is_array($datosrstdia = $cls_laboratorio->resultado_diaXLXS($row_muestra['id'], $dia))) {
            $letrakn = ['M', 'O', 'Q', 'S'];
            $letrakg = ['N', 'P', 'R', 'T'];
            $y = 0;
            foreach ($datosrstdia as $key) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letrakn[$y] . $x1, $key['reultadokn']) //  Numero Remision
                    ->setCellValue($letrakg[$y] . $x1, $key['kgcm2']); //  Numero Remision
                $y++;
            }
        }
        $datosrst = $cls_laboratorio->resultado_consolidadoXLXS($row_muestra['id'], $dia);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('U' . $x1, $datosrst['promediokgcm2']) //  Numero Remision
            ->setCellValue('V' . $x1, $datosrst['porcentaje']); //  Numero Remision


        /*********************************************************************************************
         * DIA 3
         */

        $dia = 3;
        if (is_array($datosrstdia = $cls_laboratorio->resultado_diaXLXS($row_muestra['id'], $dia))) {
            $letrakn = ['W', 'Y', 'AA', 'AC'];
            $letrakg = ['X', 'Z', 'AB', 'AD'];
            $y = 0;
            foreach ($datosrstdia as $key) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letrakn[$y] . $x1, $key['reultadokn']) //  Numero Remision
                    ->setCellValue($letrakg[$y] . $x1, $key['kgcm2']); //  Numero Remision
                $y++;
            }
        }
        $datosrst = $cls_laboratorio->resultado_consolidadoXLXS($row_muestra['id'], $dia);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('AE' . $x1, $datosrst['promediokgcm2']) //  Numero Remision
            ->setCellValue('AF' . $x1, $datosrst['porcentaje']); //  Numero Remision

        /*********************************************************************************************
         * DIA 7
         */

        $dia = 7;
        if (is_array($datosrstdia = $cls_laboratorio->resultado_diaXLXS($row_muestra['id'], $dia))) {
            $letrakn = ['AG', 'AI', 'AK', 'AM'];
            $letrakg = ['AH', 'AJ', 'AL', 'AN'];
            $y = 0;
            foreach ($datosrstdia as $key) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letrakn[$y] . $x1, $key['reultadokn']) //  Numero Remision
                    ->setCellValue($letrakg[$y] . $x1, $key['kgcm2']); //  Numero Remision
                $y++;
            }
        }
        $datosrst = $cls_laboratorio->resultado_consolidadoXLXS($row_muestra['id'], $dia);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('AO' . $x1, $datosrst['promediokgcm2']) //  Numero Remision
            ->setCellValue('AP' . $x1, $datosrst['porcentaje']); //  Numero Remision


        /*********************************************************************************************
         * DIA 14
         */

        $dia = 14;
        if (is_array($datosrstdia = $cls_laboratorio->resultado_diaXLXS($row_muestra['id'], $dia))) {
            $letrakn = ['AQ', 'AS', 'AU', 'AW'];
            $letrakg = ['AR', 'AT', 'AV', 'AX'];
            $y = 0;
            foreach ($datosrstdia as $key) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letrakn[$y] . $x1, $key['reultadokn']) //  Numero Remision
                    ->setCellValue($letrakg[$y] . $x1, $key['kgcm2']); //  Numero Remision
                $y++;
            }
        }
        $datosrst = $cls_laboratorio->resultado_consolidadoXLXS($row_muestra['id'], $dia);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('AY' . $x1, $datosrst['promediokgcm2']) //  Numero Remision
            ->setCellValue('AZ' . $x1, $datosrst['porcentaje']); //  Numero Remision


        /*********************************************************************************************
         * DIA 28
         */

        $dia = 28;
        if (is_array($datosrstdia = $cls_laboratorio->resultado_diaXLXS($row_muestra['id'], $dia))) {
            $letrakn = ['BA', 'BC', 'BE', 'BG'];
            $letrakg = ['BB', 'BD', 'BF', 'BH'];
            $y = 0;
            foreach ($datosrstdia as $key) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letrakn[$y] . $x1, $key['reultadokn']) //  Numero Remision
                    ->setCellValue($letrakg[$y] . $x1, $key['kgcm2']); //  Numero Remision
                $y++;
            }
        }
        $datosrst = $cls_laboratorio->resultado_consolidadoXLXS($row_muestra['id'], $dia);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('BI' . $x1, $datosrst['promediokgcm2']) //  Numero Remision
            ->setCellValue('BJ' . $x1, $datosrst['porcentaje']); //  Numero Remision

        /*********************************************************************************************
         * DIA 56
         */

        $dia = 56;
        if (is_array($datosrstdia = $cls_laboratorio->resultado_diaXLXS($row_muestra['id'], $dia))) {
            $letrakn = ['BK', 'BM', 'BO', 'BQ'];
            $letrakg = ['BL', 'BN', 'BP', 'BR'];
            $y = 0;
            foreach ($datosrstdia as $key) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue($letrakn[$y] . $x1, $key['reultadokn']) //  Numero Remision
                    ->setCellValue($letrakg[$y] . $x1, $key['kgcm2']); //  Numero Remision
                $y++;
            }
        }
        $datosrst = $cls_laboratorio->resultado_consolidadoXLXS($row_muestra['id'], $dia);
        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('BS' . $x1, $datosrst['promediokgcm2']) //  Numero Remision
            ->setCellValue('BT' . $x1, $datosrst['porcentaje']); //  Numero Remision


        /////////////////////////////////////////////////////////////////////////////////////////////////////////////


        $x1++;
    }
}



$styleArray = [

    'font' => [
        'bold' => true,
        'size' => 10,
    ],

    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
            'color' => ['argb' => '1c100b'],
        ],
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

$spreadsheet->getActiveSheet()->getStyle('A10:BT10')->applyFromArray($styleArray);

$spreadsheet->getActiveSheet()->getStyle('M8:BT9')->applyFromArray($styleArray);

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







$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A9', "BASE DE DATOS DE TOMA DE MUESTRAS");



// Set active sheet index to the first sheet, so Excel opens this as the first sheet

$spreadsheet->setActiveSheetIndex(0);



// Redirect output to a client’s web browser (Xlsx)

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

header('Content-Disposition: attachment;filename="Registro Toma de Muestras.xlsx"');

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
