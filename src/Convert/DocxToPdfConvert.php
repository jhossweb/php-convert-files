<?php

namespace App\Convert;

use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

use App\Interface\IConvert;
use Exception;

class DocxToPdfConvert implements IConvert
{
    
    private static $pathFilesSaved = __DIR__ . '/../../public/uploads/';

    static function convert($filename)
    {
        try {
            Settings::setPdfRendererPath(__DIR__ . '/../../vendor/tecnickcom/tcpdf');
            Settings::setPdfRendererName(Settings::PDF_RENDERER_TCPDF);
            
            $readFile = self::$pathFilesSaved . $filename;
            $phpWord = IOFactory::load($readFile);
            
            $fileWrite = IOFactory::createWriter($phpWord, "PDF");
            $fileWrite->save(self::$pathFilesSaved . $filename . ".pdf");
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
            echo "Linea Del Error: " . $e->getLine();
        }   
    }
}