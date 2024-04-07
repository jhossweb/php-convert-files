# Convertidor de Archivos

<p>
    Este es un desarrollo que consiste en la conversión de archivos entre **PDF** a **Word**
    y de **Word** a **PDF**
</p>


## Obtener el proyecto

<p>
    Para poder hacer uso de este proyecto, es necesario clonar este repositorio. Una vez clonado, lo siguiente es instalar las dependencias con:
</p>

```
composer update
```

## Guardando archivos en el servidor

```
$filename = $_FILES["file"]["name"];
$pathFiles =  __DIR__ . '/uploads/' ;
$tmp_file = $_FILES["file"]["tmp_name"];
move_uploaded_file($tmp_file, $pathFiles . basename($filename));
```


## Trabajando con archivos .docx

<p>
    Para lograr la conversión correctame de los archivos con extensión **.docx** es algo complicado debido que es un Zip comprimido y, además en un formato XML. Sin embargo, para poder leer el contenido de un archivo word, es necesario usar las librería `phpoffice/phpword` y `tecnickcom/tcpdf`.
</p>


```
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Settings;

// config
Settings::setPdfRendererPath(__DIR__ . '/../vendor/tecnickcom/tcpdf');
Settings::setPdfRendererName(Settings::PDF_RENDERER_TCPDF);

// Leemos el archivo guardado en el servidor
$phpWord = IOFactory::load($pathFiles . basename($filename));
        
// Conversión y guardado
$fileWrite = IOFactory::createWriter($phpWord, "PDF");
$fileWrite->save(__DIR__ . "/uploads/{$filename}.pdf");
```

## Trabajando con archivos .pdf

<p>
    Ahora, para leer archivos pdf, usamos la librería previamente instalada:
</p>

```
 Smalot\PdfParser\Parser


//Subida al servidor
 $filename = $_FILES["file"]["name"];
 $pathFiles =  __DIR__ . '/uploads/' ;

 $tmp_file = $_FILES["file"]["tmp_name"];
        
 move_uploaded_file($tmp_file, $pathFiles . basename($filename));

 // Uso de la librería           
 $parseador = new Parser;
 $document = $parseador->parseFile($pathFiles . basename($filename));
        
 // Extrear texto
 $texts = "";
 foreach ($document->getPages() as $index => $page) {
     printf("<h1> Página #%02d </h1>", $index + 1);
     var_dump($page->getText());
 }

 // Creando el documento docx
 $documentWord = new PhpWord;
 $section = $documentWord->addSection();
 $section->addText($texts);

 // Escribiendo y guardando datos en el documento docx
 $write = IOFactory::createWriter($documentWord, "Word2007");
 $write->save($pathFiles . $filename . ".docx");
 ```