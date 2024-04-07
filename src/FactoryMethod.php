<?php

namespace App;

use App\Convert\DOCXConvert;
use App\Convert\DocxToPdfConvert;
use UnhandledMatchError;

class FactoryMethod
{
    static function formatToConvert($format, $filename) {
        try {
            
            return match ($format) {
                "pdf" => DocxToPdfConvert::convert( $filename),
                default => UnhandledMatchError::class
            };
        } catch (\UnhandledMatchError $e) {
            echo "Formato no válido: $format";
            echo $e->getMessage();
        }
    }
}