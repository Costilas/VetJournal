<?php

namespace App\Models;

use App\Services\VisitService;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = ['pet_id', 'visit_date', 'weight', 'temperature', 'pre_diagnosis', 'visit_info', 'user_id'];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function temperatureNormalize(string $temperature):int
    {
        return VisitService::prepareNumericData($temperature)*10;
    }

    public static function weightNormalize(string $temperature):int
    {
        return VisitService::prepareNumericData($temperature)*1000;
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
}
