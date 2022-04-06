<?php

namespace App\Models;

use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{

    protected $fillable = ['pet_name', 'owner_id', 'kind_id', 'gender_id', 'birth'];

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

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }

    public function birthDateFormat()
    {
        return date('d.m.Y', strtotime($this->birth));
    }

    public function countYears()
    {
        return round(((((time() - strtotime($this->birth)) / 60) / 60) / 24) / 365, 1);
    }
}
