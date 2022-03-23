<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    use HasFactory;

    protected $fillable = ['pet_name', 'owner_id', 'kind_id', 'gender_id', 'birth'];

    public function owner() {
        return $this->belongsTo(Owner::class);
    }

    public function kind() {
        return $this->belongsTo(Kind::class);
    }

    public function gender() {
        return $this->belongsTo(Gender::class);
    }

    public function visits() {
        return $this->hasMany(Visit::class);
    }
}
