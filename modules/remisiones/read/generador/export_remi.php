<?php

require_once '../../../vendor/autoload.php';


use Spipu\Html2Pdf\Html2Pdf;


try {
    ob_start();
    include 'plantilla_remi.php';
    
    
    $content = ob_get_clean();

    $html2pdf = new Html2Pdf('P', 'A4', 'es', 'true' , 'UTF-8');
    
    $html2pdf->writeHTML($content);
    $html2pdf->output('example00.pdf');
    
} catch (Html2PdfException $e) {
    $html2pdf->clean();

    $formatter = new ExceptionFormatter($e);
    echo $formatter->getHtmlMessage();
}
