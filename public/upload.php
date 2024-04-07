<?php

    require_once '../vendor/autoload.php';

    
    use App\FactoryMethod;
    use PhpOffice\PhpWord\Element\Text;
    use PhpOffice\PhpWord\IOFactory;
    use PhpOffice\PhpWord\Settings;

    
// Convertir de docx a pdf
    // if(isset($_POST) && isset($_FILES)){
        
    //     $filename = $_FILES["file"]["name"];
    //     $pathFiles =  __DIR__ . '/uploads/' ;
    //     $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    //     $tmp_file = $_FILES["file"]["tmp_name"];
        
    //     move_uploaded_file($tmp_file, $pathFiles . basename($filename));

    //     Settings::setPdfRendererPath(__DIR__ . '/../vendor/tecnickcom/tcpdf');
    //     Settings::setPdfRendererName(Settings::PDF_RENDERER_TCPDF);
        
    //     // Settings::setPdfRendererPath(__DIR__ . '/../vendor/dompdf/dompdf');
    //     //Settings::setPdfRendererName(Settings::PDF_RENDERER_MPDF);

    //     $phpWord = IOFactory::load($pathFiles . basename($filename));
        
    //     $fileWrite = IOFactory::createWriter($phpWord, "PDF");
    //     $fileWrite->save(__DIR__ . "/uploads/{$filename}.pdf");
    // }
    
    
    
    
    // convertir de pdf a docx
    use Smalot\PdfParser\Parser;
    use PhpOffice\PhpWord\PhpWord;

    
    if(isset($_POST) && isset($_FILES)){
        
        $filename = $_FILES["file"]["name"];
        $pathFiles =  __DIR__ . '/uploads/' ;
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $tmp_file = $_FILES["file"]["tmp_name"];
            
        move_uploaded_file($tmp_file, $pathFiles . basename($filename));
            
        $parseador = new Parser;
        $document = $parseador->parseFile($pathFiles . basename($filename));
            
        // Extrear texto
        $texts = "";
        foreach ($document->getPages() as $index => $page) {
            printf("<h1> Página #%02d </h1>", $index + 1);
            var_dump($page->getText());
        }
        $documentWord = new PhpWord;
        $section = $documentWord->addSection();
        $section->addText($texts);

        $write = IOFactory::createWriter($documentWord, "Word2007");
        $write->save($pathFiles . $filename . ".docx");

    }

    // //Extraer Images
    // $imagenes = $document->getObjectsByType('XObject', 'Image');
    // foreach ($imagenes as $imagen) {
    //     printf("<h1>Una imagen</h1><img src=\"data:image/jpg;base64,%s\"/>", base64_encode($imagen->getContent()));
    // }

    //     // echo "<pre>";
    //     // print_r($document->getText());
    //     // echo "</pre>";
    // }
    