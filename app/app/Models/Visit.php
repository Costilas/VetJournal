<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = ['pet_id', 'visit_date', 'weight', 'temperature', 'pre_diagnosis', 'visit_info'];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function dateFormat()
    {
        return date('d.m.Y / H:i', strtotime($this->visit_date));
    }

    public function temperatureFormat():float
    {
        return $this->temperature/10;
    }

    public function weightFormat():float
    {
        return $this->weight/1000;
    }

    public static function temperatureNormalize(string $temperature):int
    {
        return static::sanitizeNumber($temperature)*10;
    }

    public static function weightNormalize(string $temperature):int
    {
        return static::sanitizeNumber($temperature)*1000;
    }

    protected static function sanitizeNumber(string $number):float
    {
        $prepared = rtrim(str_replace([',', '.'], '.', $number), ' 0');
        $prepared = ltrim($prepared, ' ');
        if(preg_match('/^0\d\./', $prepared))
        {
            $prepared = ltrim($prepared, ' 0');
            if(str_ends_with($prepared, '.'))
            {
                $prepared = str_replace('.', '', $prepared);
            }
        }

        return floatval($prepared);
    }
}
