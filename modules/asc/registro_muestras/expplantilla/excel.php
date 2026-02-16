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



$abc1 = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z');

$abc2 = array('AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');


$cls_laboratorio = new cls_laboratorio;

$x = 2;

$fecha = $_GET['fecha'];


$spreadsheet = new Spreadsheet();


// Set document properties

$spreadsheet->getProperties()->setCreator('PORTAL CONCRETOL')
    ->setLastModifiedBy('PORTAL CONCRETOL')
    ->setTitle('Informe de Remisiones')
    ->setSubject('Informe de Remisiones')
    ->setDescription('Informe de Remisiones')
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

$spreadsheet->getActiveSheet()->mergeCells('C1:E1');
$spreadsheet->getActiveSheet()->mergeCells('C2:E2');
$spreadsheet->getActiveSheet()->mergeCells('C3:E3');
$spreadsheet->getActiveSheet()->mergeCells('C4:E4');
$spreadsheet->getActiveSheet()->mergeCells('C5:E5');
$spreadsheet->getActiveSheet()->mergeCells('C6:E6');
$spreadsheet->getActiveSheet()->mergeCells('C7:E7');
$spreadsheet->getActiveSheet()->mergeCells('C8:E8');

/*** ENCABEZADO */
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('C1', 'SISTEMA DE GESTIÓN DE LA CALIDAD')
    ->setCellValue('C2', 'ASEGURAMIENTO DE CALIDAD')
    ->setCellValue('C3', 'REGISTRO DE TOMA DE MUESTRAS ENSAYO A COMPRESIÓN O FLEXIÓN')
    ->setCellValue('C4', 'AÑO VIGENCIA 2023')
    ->setCellValue('C6', 'CÓDIGO: ASC-FO-07')
    ->setCellValue('C7', 'VERSIÓN: 09')
    ->setCellValue('C8', 'FECHA: 01-09-2022');





$spreadsheet->getActiveSheet()->mergeCells('A9:I9'); // feCHA
$spreadsheet->getActiveSheet()->mergeCells('A10:A11');
$spreadsheet->getActiveSheet()->mergeCells('B10:B11');
$spreadsheet->getActiveSheet()->mergeCells('C10:C11');
//$spreadsheet->getActiveSheet()->mergeCells('D10:D11');






/*** ENCABEZADO */
$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A10', 'MTRA No.')
    ->setCellValue('B10', 'TOMADA POR')
    ->setCellValue('C10', 'REMISIÓN No.')
    ->setCellValue('D10', 'MIXER')
    ->setCellValue('D11', 'm3')
    ->setCellValue('E10', 'CLIENTE')
    ->setCellValue('E11', 'OBRA')
    ->setCellValue('F10', 'CEMENTANTE')
    ->setCellValue('F11', '(KG/M3)')
    ->setCellValue('G10', 'DISEÑO')
    ->setCellValue('G11', 'HORA DE TOMA')
    ->setCellValue('H10', 'ASENT. (PULG)')
    ->setCellValue('H11', 'TEMP. °C')
    ->setCellValue('I10', 'AIRE (%)')
    ->setCellValue('I11', 'Rend. Vol.');



/*** ENCABEZADO RESULTADOS */
$spreadsheet->getActiveSheet()->mergeCells('J9:L9');  // FECHA R 1 DIA
$spreadsheet->getActiveSheet()->mergeCells('J10:L10'); // R 1 DIA

$spreadsheet->getActiveSheet()->mergeCells('M9:O9');  // FECHA R 3 DIA
$spreadsheet->getActiveSheet()->mergeCells('M10:O10'); // R 3 DIA

$spreadsheet->getActiveSheet()->mergeCells('P9:R9');  // FECHA R 7 DIA
$spreadsheet->getActiveSheet()->mergeCells('P10:R10'); // R 7 DIA

$spreadsheet->getActiveSheet()->mergeCells('S9:U9');  // FECHA R 14 DIA
$spreadsheet->getActiveSheet()->mergeCells('S10:U10'); // R 14 DIA

$spreadsheet->getActiveSheet()->mergeCells('V9:X9');  // FECHA R 28 DIA
$spreadsheet->getActiveSheet()->mergeCells('V10:X10'); // R 28 DIA

$spreadsheet->getActiveSheet()->mergeCells('Y9:AA9');  // FECHA R 56 DIA
$spreadsheet->getActiveSheet()->mergeCells('Y10:AA10'); // R 56 DIA


function calcular_fecha_edad($fecha, $edad)
{
    $dt = new DateTime($fecha);
    $dias_para_sumar = "+" . $edad . " day";
    $nueva_fecha = $dt->modify($dias_para_sumar)->format("Y-m-d");
    $nueva_fecha =  new DateTime($nueva_fecha);
    return $nueva_fecha->format('d-m-Y');
}


$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('J9', calcular_fecha_edad($fecha, 1))
    ->setCellValue('J10', 'R 1 Dia')
    ->setCellValue('J11', 'LECTURA')
    ->setCellValue('K11', '(C/F)')
    ->setCellValue('L11', 'TF');



$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('M9', calcular_fecha_edad($fecha, 3))
    ->setCellValue('M10', 'R 3 Dias')
    ->setCellValue('M11', 'LECTURA')
    ->setCellValue('N11', '(C/F)')
    ->setCellValue('O11', 'TF');

$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('P9', calcular_fecha_edad($fecha, 7))
    ->setCellValue('P10', 'R 7 Dias')
    ->setCellValue('P11', 'LECTURA')
    ->setCellValue('Q11', '(C/F)')
    ->setCellValue('R11', 'TF');


$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('S9', calcular_fecha_edad($fecha, 14))
    ->setCellValue('S10', 'R 14 Dias')
    ->setCellValue('S11', 'LECTURA')
    ->setCellValue('T11', '(C/F)')
    ->setCellValue('U11', 'TF');


$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('V9', calcular_fecha_edad($fecha, 28))
    ->setCellValue('V10', 'R 28 Dias')
    ->setCellValue('V11', 'LECTURA')
    ->setCellValue('W11', '(C/F)')
    ->setCellValue('X11', 'TF');

$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('Y9', calcular_fecha_edad($fecha, 56))
    ->setCellValue('Y10', 'R 56 Dias')
    ->setCellValue('Y11', 'LECTURA')
    ->setCellValue('Z11', '(C/F)')
    ->setCellValue('AA11', 'TF');

$Sombra_fila = [
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'dfdfdf',
        ],
        'endColor' => [
            'argb' => 'dfdfdf',
        ],

    ],
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],

];

/** BORDE RESULTADOS */
$style_border = array(
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '000000'],
        ],
    ],
);


$style_border_2 = array(
    'borders' => [
        'outline' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_MEDIUM,
            'color' => ['argb' => '000000'],
        ],
    ],
);

$style_prog = array(
    'fill' => [
        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
        'startColor' => [
            'argb' => 'ffbaba',
        ],
        'endColor' => [
            'argb' => 'ffbaba',
        ],

    ],
);




$x1 = 12;
$x2 = 15;

$fila = 1;


if ($stmt_muestras = $cls_laboratorio->GetDataMuestasXLXS($_GET['fecha'], $_GET['sede'])) {


    $x1 = 12;
    $x2 = 15;

    $fila = 1;

    while ($row_muestra = $stmt_muestras->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores


        if ($fila % 2 == 0) {
            $spreadsheet->getActiveSheet()->getStyle('A' . $x1 . ':AA' . $x2)->applyFromArray($Sombra_fila);
        }

        $spreadsheet->getActiveSheet()->mergeCells('A' . $x1 . ':A' . ($x2));
        $spreadsheet->getActiveSheet()->mergeCells('B' . $x1 . ':B' . ($x2));
        $spreadsheet->getActiveSheet()->mergeCells('C' . $x1 . ':C' . ($x2));

        $spreadsheet->getActiveSheet()->mergeCells('D' . $x1 . ':D' . ($x1 + 1)); // MIXER
        $spreadsheet->getActiveSheet()->mergeCells('D' . ($x2 - 1) . ':D' . ($x2)); // METROS

        $spreadsheet->getActiveSheet()->mergeCells('E' . $x1 . ':E' . ($x1 + 1)); // CLIENTE
        $spreadsheet->getActiveSheet()->mergeCells('E' . ($x2 - 1) . ':E' . ($x2)); // OBRA

        $spreadsheet->getActiveSheet()->mergeCells('F' . $x1 . ':F' . ($x1 + 1)); // CEMENTANTE
        $spreadsheet->getActiveSheet()->mergeCells('F' . ($x2 - 1) . ':F' . ($x2)); // (KG/M3)

        $spreadsheet->getActiveSheet()->mergeCells('G' . $x1 . ':G' . ($x1 + 1)); // DISEÑO
        $spreadsheet->getActiveSheet()->mergeCells('G' . ($x2 - 1) . ':G' . ($x2)); // HORA DE TOMA

        $spreadsheet->getActiveSheet()->mergeCells('H' . $x1 . ':H' . ($x1 + 1)); // ASENT. (PULG)
        $spreadsheet->getActiveSheet()->mergeCells('H' . ($x2 - 1) . ':H' . ($x2)); // TEMP. °C

        $spreadsheet->getActiveSheet()->mergeCells('I' . $x1 . ':I' . ($x1 + 1)); // AIRE (%)
        $spreadsheet->getActiveSheet()->mergeCells('I' . ($x2 - 1) . ':I' . ($x2)); // Rend. Vol.




        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $x1, "[" . $row_muestra['id'] . "] || " . $row_muestra['consecutivo_interno']) // Muestra
            ->setCellValue('B' . $x1, $row_muestra['nombre_responsable']) //  Tomada por
            ->setCellValue('C' . $x1, $row_muestra['cod_remi']) //  Numero Remision

            ->setCellValue('D' . $x1, $row_muestra['placa']) //  MIXER
            ->setCellValue('D' . ($x2 - 1), $row_muestra['metros_cubicos']) //  METROS CUBICOS

            ->setCellValue('E' . $x1, $row_muestra['cliente']) //  CLIENTE
            ->setCellValue('E' . ($x2 - 1), $row_muestra['obra']) //  OBRA

            ->setCellValue('F' . $x1, $row_muestra['nombre_cementante']) //  CEMENTANTE
            ->setCellValue('F' . ($x2 - 1), $row_muestra['cementante_kg']) //  CEMENTANTE KG

            ->setCellValue('G' . $x1, $row_muestra['codigo_producto']) //  CEMENTANTE
            ->setCellValue('G' . ($x2 - 1), $row_muestra['hora_muestra']) //  CEMENTANTE KG

            ->setCellValue('H' . $x1, $row_muestra['asentamiento']) //  CEMENTANTE
            ->setCellValue('H' . ($x2 - 1), $row_muestra['temperatura']) //  CEMENTANTE KG

            ->setCellValue('I' . $x1, $row_muestra['aire']) //  CEMENTANTE
            ->setCellValue('I' . ($x2 - 1), $row_muestra['rend_volumetrico']); //  CEMENTANTE KG


        /** 
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         * RESULTADO DIA 1
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         */
        $num_prog = intval($cls_laboratorio->GetDataProgResultadoMuestasXLXS($row_muestra['id'], 1)); //  Traer Programacion Programacion

        // ESCRIBIR NO FALLA EN LAS CELDAS
        $rst = $x1;
        for ($i = 1; $i < 5; $i++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('J' . $rst, "NF"); // lECTURA
            $rst++;
        }
        // DEJAR EN LIMPIAS LAS CELDAS QUE SI ESTAN PROGRAMADAS
        $rst = $x1;
        for ($i = 1; $i <= $num_prog; $i++) {
            $spreadsheet->getActiveSheet()->getStyle('J' . $rst . ':L' . $rst)->applyFromArray($style_prog);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('J' . $rst, ""); // lECTURA
            $rst++;
        }

        // ESCRIBIR RESULTADOS
        if ($smt_rst = $cls_laboratorio->GetDataResultadoMuestasXLXS($row_muestra['id'], 1)) {
            $x3 = $x1;
            while ($row_rst = $smt_rst->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('J' . $x3, $row_rst['reultadokn']) // lECTURA
                    ->setCellValue('K' . $x3, $row_rst['nombre_tipo_fallo']) // Muestra
                    ->setCellValue('L' . $x3, $row_rst['sub_tipo_fallo']); // Muestra
                $x3++;
            }
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


        /** 
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         * RESULTADO DIA 3
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         */
        $num_prog = intval($cls_laboratorio->GetDataProgResultadoMuestasXLXS($row_muestra['id'], 3)); //  Traer Programacion Programacion

        // ESCRIBIR NO FALLA EN LAS CELDAS
        $rst = $x1;
        for ($i = 1; $i < 5; $i++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('M' . $rst, "NF"); // lECTURA
            $rst++;
        }
        // DEJAR EN LIMPIAS LAS CELDAS QUE SI ESTAN PROGRAMADAS
        $rst = $x1;
        for ($i = 1; $i <= $num_prog; $i++) {
            $spreadsheet->getActiveSheet()->getStyle('M' . $rst . ':O' . $rst)->applyFromArray($style_prog);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('M' . $rst, ""); // lECTURA
            $rst++;
        }

        // ESCRIBIR RESULTADOS
        if ($smt_rst = $cls_laboratorio->GetDataResultadoMuestasXLXS($row_muestra['id'], 3)) {
            $x3 = $x1;
            while ($row_rst = $smt_rst->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('M' . $x3, $row_rst['reultadokn']) // lECTURA
                    ->setCellValue('N' . $x3, $row_rst['nombre_tipo_fallo']) // Muestra
                    ->setCellValue('O' . $x3, $row_rst['sub_tipo_fallo']); // Muestra
                $x3++;
            }
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



        /** 
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         * RESULTADO DIA 7
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         */
        $num_prog = intval($cls_laboratorio->GetDataProgResultadoMuestasXLXS($row_muestra['id'], 7)); //  Traer Programacion Programacion

        // ESCRIBIR NO FALLA EN LAS CELDAS
        $rst = $x1;
        for ($i = 1; $i < 5; $i++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('p' . $rst, "NF"); // lECTURA
            $rst++;
        }
        // DEJAR EN LIMPIAS LAS CELDAS QUE SI ESTAN PROGRAMADAS
        $rst = $x1;
        for ($i = 1; $i <= $num_prog; $i++) {
            $spreadsheet->getActiveSheet()->getStyle('P' . $rst . ':R' . $rst)->applyFromArray($style_prog);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('p' . $rst, ""); // lECTURA
            $rst++;
        }

        // ESCRIBIR RESULTADOS
        if ($smt_rst = $cls_laboratorio->GetDataResultadoMuestasXLXS($row_muestra['id'], 7)) {
            $x3 = $x1;
            while ($row_rst = $smt_rst->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('p' . $x3, $row_rst['reultadokn']) // lECTURA
                    ->setCellValue('Q' . $x3, $row_rst['nombre_tipo_fallo']) // Muestra
                    ->setCellValue('R' . $x3, $row_rst['sub_tipo_fallo']); // Muestra
                $x3++;
            }
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /** 
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         * RESULTADO DIA 14
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         */
        $num_prog = intval($cls_laboratorio->GetDataProgResultadoMuestasXLXS($row_muestra['id'], 14)); //  Traer Programacion Programacion

        // ESCRIBIR NO FALLA EN LAS CELDAS
        $rst = $x1;
        for ($i = 1; $i < 5; $i++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('S' . $rst, "NF"); // lECTURA
            $rst++;
        }
        // DEJAR EN LIMPIAS LAS CELDAS QUE SI ESTAN PROGRAMADAS
        $rst = $x1;
        for ($i = 1; $i <= $num_prog; $i++) {
            $spreadsheet->getActiveSheet()->getStyle('S' . $rst . ':U' . $rst)->applyFromArray($style_prog);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('S' . $rst, ""); // lECTURA
            $rst++;
        }

        // ESCRIBIR RESULTADOS
        if ($smt_rst = $cls_laboratorio->GetDataResultadoMuestasXLXS($row_muestra['id'], 14)) {
            $x3 = $x1;
            while ($row_rst = $smt_rst->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('S' . $x3, $row_rst['reultadokn']) // lECTURA
                    ->setCellValue('T' . $x3, $row_rst['nombre_tipo_fallo']) // Muestra
                    ->setCellValue('U' . $x3, $row_rst['sub_tipo_fallo']); // Muestra
                $x3++;
            }
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /** 
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         * RESULTADO DIA 28
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         */
        $num_prog = intval($cls_laboratorio->GetDataProgResultadoMuestasXLXS($row_muestra['id'], 28)); //  Traer Programacion Programacion

        // ESCRIBIR NO FALLA EN LAS CELDAS
        $rst = $x1;
        
        for ($i = 1; $i < 5; $i++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('V' . $rst, "NF"); // lECTURA
            $rst++;
        }
        // DEJAR EN LIMPIAS LAS CELDAS QUE SI ESTAN PROGRAMADAS
        $rst = $x1;
        for ($i = 1; $i <= $num_prog; $i++) {
            $spreadsheet->getActiveSheet()->getStyle('V' . $rst . ':X' . $rst)->applyFromArray($style_prog);
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('V' . $rst, ""); // lECTURA
            $rst++;
        }

        // ESCRIBIR RESULTADOS
        if ($smt_rst = $cls_laboratorio->GetDataResultadoMuestasXLXS($row_muestra['id'], 28)) {
            $x3 = $x1;
            while ($row_rst = $smt_rst->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('V' . $x3, $row_rst['reultadokn']) // lECTURA
                    ->setCellValue('W' . $x3, $row_rst['nombre_tipo_fallo']) // Muestra
                    ->setCellValue('X' . $x3, $row_rst['sub_tipo_fallo']); // Muestra
                $x3++;
            }
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /** 
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         * RESULTADO DIA 7
         * ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
         */
        $num_prog = intval($cls_laboratorio->GetDataProgResultadoMuestasXLXS($row_muestra['id'], 56)); //  Traer Programacion Programacion

        // ESCRIBIR NO FALLA EN LAS CELDAS
        $rst = $x1;
        for ($i = 1; $i < 5; $i++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('Y' . $rst, "NF"); // lECTURA
            $rst++;
        }
        // DEJAR EN LIMPIAS LAS CELDAS QUE SI ESTAN PROGRAMADAS
        $rst = $x1;
        for ($i = 1; $i <= $num_prog; $i++) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('Y' . $rst, ""); // lECTURA
            $spreadsheet->getActiveSheet()->getStyle('Y' . $rst . ':AA' . $rst)->applyFromArray($style_prog);
            $rst++;
        }

        // ESCRIBIR RESULTADOS
        if ($smt_rst = $cls_laboratorio->GetDataResultadoMuestasXLXS($row_muestra['id'], 56)) {
            $x3 = $x1;
            while ($row_rst = $smt_rst->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('Y' . $x3, $row_rst['reultadokn']) // lECTURA
                    ->setCellValue('Z' . $x3, $row_rst['nombre_tipo_fallo']) // Muestra
                    ->setCellValue('AA' . $x3, $row_rst['sub_tipo_fallo']); // Muestra
                $x3++;
            }
        }
        ///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



        // Dia 56
        if ($smt_rst = $cls_laboratorio->GetDataResultadoMuestasXLXS($row_muestra['id'], 56)) {
            $x3 = $x1;
            while ($row_rst = $smt_rst->fetch(PDO::FETCH_ASSOC)) { // Obtener los datos de los valores
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('Y' . $x3, $row_rst['reultadokn']) // lECTURA
                    ->setCellValue('Z' . $x3, $row_rst['nombre_tipo_fallo']) // Muestra
                    ->setCellValue('AA' . $x3, $row_rst['sub_tipo_fallo']); // Muestra
                $x3++;
            }
        }









        $x1 = $x2 + 1;
        $x2 = $x1 + 3;
        $fila++;
    }
}


$spreadsheet->getActiveSheet()->getStyle('A12:AA' . $x2)->applyFromArray($style_border);






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

$spreadsheet->getActiveSheet()->getStyle('A10:AA11')->applyFromArray($styleArray);

// Todos Los Bordes
$styleArray2 = array(
    'borders' => [
        'allBorders' => [
            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
            'color' => ['argb' => '1c100b'],
        ],
    ],
    'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
    ],
);



$spreadsheet->getActiveSheet()->getStyle('A10:AA' . $x2)->applyFromArray($styleArray2);



//R1
$spreadsheet->getActiveSheet()->getStyle('J9:L' . $x2)->applyFromArray($style_border_2);
$spreadsheet->getActiveSheet()->getStyle('M9:O' . $x2)->applyFromArray($style_border_2);
$spreadsheet->getActiveSheet()->getStyle('P9:R' . $x2)->applyFromArray($style_border_2);
$spreadsheet->getActiveSheet()->getStyle('S9:U' . $x2)->applyFromArray($style_border_2);
$spreadsheet->getActiveSheet()->getStyle('V9:X' . $x2)->applyFromArray($style_border_2);
$spreadsheet->getActiveSheet()->getStyle('Y9:AA' . $x2)->applyFromArray($style_border_2);



$dt = new DateTime($fecha);
$fecha_titulo = $dt->format('d-m-Y');

$spreadsheet->setActiveSheetIndex(0)
    ->setCellValue('A9', "PLANILLA REGISTRO FORMULAS " .  $fecha_titulo);

$spreadsheet->getActiveSheet()->getStyle('A9:I9')->applyFromArray($styleArray);


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
