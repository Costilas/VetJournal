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
        $prepared = rtrim(str_replace([',', '.'], '.', $string), ' 0');
        $prepared = ltrim($prepared, ' ');
        if(preg_match('/^0\d\./', $prepared))
        {
            $prepared = ltrim($prepared, ' 0');
            if(str_ends_with($prepared, '.'))
            {
                $prepared = str_replace('.', '', $prepared);
            }
        }

        return $prepared;
    }

    private static function stringToFloat(string $string):float
    {
        return floatval($string);
    }
}
