<?php

namespace App;

use App\Convert\DOCXConvert;
use App\Convert\PDFConvert;
use App\TypesFormat\Format;

class FactoryMethod 
{
    static function createConvert (Format $format, $filename, $content) {
        
        if($format === Format::PDF) {
            return PDFConvert::convert($filename, $content);
        }
    }
}