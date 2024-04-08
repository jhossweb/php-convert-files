<?php

    require_once '../vendor/autoload.php';

    use App\FactoryMethod;    
    $factory = new FactoryMethod;
    
    $filename = $_FILES["file"]["name"];
    $tmp_file = $_FILES["file"]["tmp_name"];
    $format = $_POST["format"];
    $pathSaveFaile = __DIR__ . '/uploads/' . $filename;

    move_uploaded_file($tmp_file, $pathSaveFaile);

    $factory->formatToConvert($format, $filename);    

    if($factory) return header("Location: index.php");