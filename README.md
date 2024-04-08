# Convertidor de Archivos

<p>
    Este es un desarrollo que consiste en la conversión de archivos entre **PDF** a **Word**
    y de **Word** a **PDF**
</p>

<p>
    Para este proyecto usé el patrón `Factory`. Además, PHP provee una manera más elegante para validar información que un if o un swith. Ese método se llama: *match* integrado en sus últimas versiones.
</p>


## Cosas a Tener en cuenta

<p>
    Para desarrollar o hacer uso de este proyecto, debes tener instalada estas extensiones en php

</p>
<ul>
    <li> Tener una versión de PHP 7.1+ </li>
    <li> DOM Extensión </li>
    <li> Json </li>
    <li> XML Parser </li>
    <li> XMLWrite </li>
    <li> Zip </li>
</ul>

<p>
    Para comprobar si tenemos estas extensiones, usemos el método *phpinfo()* de php
</p>

## Obtener el proyecto

<p>
    Para poder hacer uso de este proyecto, es necesario clonar este repositorio. Una vez clonado, lo siguiente es instalar las dependencias con:
</p>

```
composer update
```

## Guardando archivos en el servidor

este código se encuentra el archivo `upload.php`

```
$filename = $_FILES["file"]["name"];
$pathFiles =  __DIR__ . '/uploads/' ;
$tmp_file = $_FILES["file"]["tmp_name"];
move_uploaded_file($tmp_file, $pathFiles . basename($filename));
```


## Clase Factory

<p>
    Esta clase se encarga de escoger qué clase usar, dependiendo del formato elegido.
</p>

```
namespace App;

use App\Convert\PdfToDocxConvert;
use App\Convert\DocxToPdfConvert;
use UnhandledMatchError;

class FactoryMethod
{
    static function formatToConvert($format, $filename) {
        try {
            
            return match ($format) {
                "pdf" => DocxToPdfConvert::convert( $filename),
                "docx" => PdfToDocxConvert::convert($filename),
                default => UnhandledMatchError::class
            };
        } catch (\UnhandledMatchError $e) {
            echo "Formato no válido: $format";
            echo $e->getMessage();
        }
    }
}
```

## Trabajando con archivos .docx

<p>
    Para lograr la conversión correcta de los archivos con extensión **.docx** es algo complicado debido que es un Zip comprimido y, además en un formato XML. Sin embargo, para poder leer el contenido de un archivo word, es necesario usar las librería `phpoffice/phpword` y `tecnickcom/tcpdf`.
</p>


```
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

            if(!$fileWrite) return "No se Convitió";
            return $fileWrite;
            
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage() . "\n";
            echo "Linea Del Error: " . $e->getLine();
        }   
    }
}
```

## Trabajando con archivos .pdf

<p>
    Ahora, para leer archivos pdf, usamos la librería previamente instalada:
</p>

```
 Snamespace App\Convert;

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
 ```