<?php

    require_once '../vendor/autoload.php';

    
    use App\FactoryMethod;
    
    if(isset($_POST) && isset($_FILES)){
        
        $filename = $_FILES["file"]["name"];
        $fileExtension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        $tmp_file = $_FILES["file"]["tmp_name"];
        $content = file_get_contents($tmp_file);
        
        $formatFile = $_POST["format"];        
        FactoryMethod::createConvert($formatFile, $filename, $content);
        
    }


