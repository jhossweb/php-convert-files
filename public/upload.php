<?php

    require_once '../vendor/autoload.php';

    //use App\Convert\PDFConvert;
    use App\FactoryMethod;
use App\TypesFormat\Format;

    if(isset($_POST) && isset($_FILES)){

        $filename = $_FILES["file"]["name"];
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $tmp_file = $_FILES["file"]["tmp_name"];
        $content = file_get_contents($tmp_file);

        $formatFile = $_POST["format"];
        
        match ($formatFile) {
            "pdf" => FactoryMethod::createConvert(Format::PDF, $filename, $content),
             
        };
        
        // echo $format;
        // switch($formatFile) {
        //     case 'pdf':
        //         return FactoryMethod::createConvert($formatFile, $filename, $content);
        // }



    }
