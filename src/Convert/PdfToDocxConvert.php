<?php

namespace App\Convert;

use Exception;

use App\Interface\IConvert;
use PhpOffice\PhpWord\IOFactory;
use Smalot\PdfParser\Parser;
use PhpOffice\PhpWord\PhpWord;


class PdfToDocxConvert implements IConvert
{
    private static $pathFilesSaved = __DIR__ . '/../../public/uploads/';
    
    function __construct(
        private Parser $parser = new Parser,
        private PhpWord $documentWord = new PhpWord
    )
    {}

    static function convert($filename)
    {
        try {
            $documents = new self(new Parser(), new PhpWord());
            $document = $documents->parser->parseFile(self::$pathFilesSaved . $filename);
            
            // Extrear texto
            $texts = "";
            foreach ($document->getPages() as $index => $page) {
                $texts .= $page->getText();
            }
            
            $section = $documents->documentWord->addSection();
            $section->addText($texts);

            $write = IOFactory::createWriter($documents->documentWord, "Word2007");
            $write->save(self::$pathFilesSaved . $filename . ".docx");

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
            echo "Linea Del Error: " . $e->getLine();
        }   
    }
}