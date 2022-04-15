<?php

namespace App\Services;

use Illuminate\Http\Request;

class VisitService
{
    public static function searchResultString(Request $request, string $location)
    {
        $result = 'Результаты ';
        $sortParameter = '';
        if($location === 'visit'){$sortParameter = 'за сегодняшний день.';}
        if($location === 'pet'){$sortParameter = 'за все время.';}

        if($request->has('visits'))
        {
           $sortParameter = self::filterByDate($request);
        }

        if($request->has('search'))
        {
             $sortParameter = self::filterPrestated($request);
        }

        return $result.$sortParameter;
    }

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

    private static function filterPrestated(Request $request)
    {
        switch ($request->input('search'))
        {
            case 'week':
                return  'за неделю.';

            case 'yesterday':
                return 'за вчера.';

            default:
                return 'за сегодняшний день.';
        }

    }
    private static function filterByDate(Request $request)
    {
        $from = self::dateRevert($request->input('visits.from'));
        $to = self::dateRevert($request->input('visits.to'));
        return $from === $to? "за $from":"с " . $from . " по " . $to;
    }



    private static function dateRevert(string $date)
    {
        return date('d-m-Y', strtotime($date));
    }
}
