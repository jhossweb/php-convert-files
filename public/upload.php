<?php

    require_once '../vendor/autoload.php';

    use App\FactoryMethod;    
    $factory = new FactoryMethod;
    
    $filename = $_FILES["file"]["name"];
    $tmp_file = $_FILES["file"]["tmp_name"];
    $format = $_POST["format"];
    $pathSaveFaile = __DIR__ . '/uploads/' . $filename;

    move_uploaded_file($tmp_file, $pathSaveFaile);

    var_dump($factory->formatToConvert($format, $filename));
    
    

  
    
    // convertir de pdf a docx
    // use Smalot\PdfParser\Parser;
    // use PhpOffice\PhpWord\PhpWord;

    
    // if(isset($_POST) && isset($_FILES)){
        
    //     $filename = $_FILES["file"]["name"];
    //     $pathFiles =  __DIR__ . '/uploads/' ;
    //     $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    //     $tmp_file = $_FILES["file"]["tmp_name"];
            
    //     move_uploaded_file($tmp_file, $pathFiles . basename($filename));
            
    //     $parseador = new Parser;
    //     $document = $parseador->parseFile($pathFiles . basename($filename));
            
    //     // Extrear texto
    //     $texts = "";
    //     foreach ($document->getPages() as $index => $page) {
    //         printf("<h1> Página #%02d </h1>", $index + 1);
    //         var_dump($page->getText());
    //     }
    //     $documentWord = new PhpWord;
    //     $section = $documentWord->addSection();
    //     $section->addText($texts);

    //     $write = IOFactory::createWriter($documentWord, "Word2007");
    //     $write->save($pathFiles . $filename . ".docx");

    // }

    // //Extraer Images
    // $imagenes = $document->getObjectsByType('XObject', 'Image');
    // foreach ($imagenes as $imagen) {
    //     printf("<h1>Una imagen</h1><img src=\"data:image/jpg;base64,%s\"/>", base64_encode($imagen->getContent()));
    // }

    //     // echo "<pre>";
    //     // print_r($document->getText());
    //     // echo "</pre>";
    // }
    