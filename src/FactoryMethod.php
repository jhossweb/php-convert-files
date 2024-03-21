<?php

namespace App;

use App\Convert\DOCXConvert;
use App\Convert\PDFConvert;
use UnhandledMatchError;

class FactoryMethod
{
    static function createConvert($format, $filename, $content) {
        try {
            return match ($format) {
                "pdf" => PDFConvert::convert($filename, $content),
                default => UnhandledMatchError::class
            };
        } catch (\UnhandledMatchError $e) {
            echo "Formato no válido: $format";
            echo $e->getMessage();
        }
    }
}