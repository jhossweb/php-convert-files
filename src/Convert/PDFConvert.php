<?php

namespace App\Convert;

use App\Interface\IConvert;
use Dompdf\Dompdf;

class PDFConvert implements IConvert
{
    static function convert($filename, $content)
    {
        $pdf = new Dompdf;
        $pdf->loadHtml($content);
        $pdf->setPaper("letter");
        $pdf->render();
        $pdf->stream("{$filename}.pdf", ["Attachment" => true]);
    }
}