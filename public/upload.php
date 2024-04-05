<?php

    require_once '../vendor/autoload.php';

    
    use App\FactoryMethod;
    use PhpOffice\PhpWord\Element\Text;
    use PhpOffice\PhpWord\IOFactory;
    use PhpOffice\PhpWord\Settings;

    

    use PhpOffice\PhpWord\TemplateProcessor;


    if(isset($_POST) && isset($_FILES)){
        
        $filename = $_FILES["file"]["name"];
        $pathFiles =  __DIR__ . '/uploads/' ;
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $tmp_file = $_FILES["file"]["tmp_name"];
        
        move_uploaded_file($tmp_file, $pathFiles . basename($filename));

        Settings::setPdfRendererPath(__DIR__ . '/../vendor/dompdf/dompdf');
        Settings::setPdfRendererName("DomPDF");

        $phpWord = IOFactory::load($pathFiles . basename($filename));
        $fileWrite = IOFactory::createWriter($phpWord, "PDF");
        $fileWrite->save(__DIR__ . "/uploads/{$filename}.pdf");
        
        // $content = "";

        // foreach ($phpWord->getSections() as $section) {
        //     $elements = $section->getElements();
            
        //     foreach ($elements as $element) {
        //         if($element instanceof \PhpOffice\PhpWord\Element\TextRun) {
        //             foreach ($element->getElements() as $text) {
        //                 if($text instanceof Text) {
        //                     $content .= $text->getText();
        //                 }
        //             }
        //         } else if ($element instanceof Text) {
        //             echo $content .= $element->getText();
        //         }
        //     }
        // }
        // echo htmlspecialchars($content);
        
        // $formatFile = $_POST["format"];        
        // FactoryMethod::createConvert($formatFile, $filename, $content);
        
    }
