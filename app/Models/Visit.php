<?php

namespace App\Models;


use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Support\Visit\ParametersFormatter;

class Visit extends Model
{
    use HasFactory,
        Filterable;

    protected $fillable = [
        'pet_id',
        'visit_date',
        'weight',
        'temperature',
        'pre_diagnosis',
        'visit_info',
        'treatment',
        'user_id'
    ];

    public function pet()
    {
        return $this->belongsTo(Pet::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function visitDate()
    {
        return Carbon::create($this->visit_date)->format('d.m.Y / H:i');
    }

    public function temperature(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ParametersFormatter::formatTemperatureForView($value),
            set: fn ($value) => ParametersFormatter::prepareTemperatureForStore($value)
        );
    }

    public function weight(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ParametersFormatter::formatWeightForView($value),
            set: fn ($value) => ParametersFormatter::prepareWeightForStore($value)
        );
    }
}
