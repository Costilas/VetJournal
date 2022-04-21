<?php

namespace App\Services;

class VisitService
{
    public static function prepareNumericData(string $string):float
    {
        $prepared = self::stringCleaner($string);

        return self::stringToFloat($prepared);
    }

    private static function stringCleaner(string $string):string
    {
        return trim(str_replace([',', '.'], '.', $string), ' .');
    }

    private static function stringToFloat(string $string):float
    {
        return floatval($string);
    }
}
