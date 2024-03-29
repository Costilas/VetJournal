<?php

namespace App\Models;

use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{

    protected $fillable = ['pet_name', 'owner_id', 'kind_id', 'gender_id', 'birth', 'castration_condition_id'];

    use Filterable;
    use HasFactory;

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function kind()
    {
        return $this->belongsTo(Kind::class);
    }

    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    public function castration()
    {
        return $this->belongsTo(CastrationCondition::class, 'castration_condition_id');
    }

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function birthDate(string $format)
    {
        return Carbon::create($this->birth)->format($format);
    }

    public function countYears()
    {
        return Carbon::parse($this->birth)->diff(now())->format('%y г. %m м.');
    }
}
