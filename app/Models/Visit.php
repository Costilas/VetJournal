<?php

namespace App\Models;

use App\Services\Visit\VisitService;
use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = ['pet_id', 'visit_date', 'weight', 'temperature', 'pre_diagnosis', 'visit_info', 'treatment', 'user_id'];

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

    public static function weightNormalize(string $weight):int
    {
        return VisitService::prepareNumericData($weight)*1000;
    }

    public function visitDate()
    {
        return Carbon::create($this->visit_date)->format('d.m.Y / H:i');
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
