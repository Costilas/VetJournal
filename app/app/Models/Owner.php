<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable = ['name', 'patronymic', 'last_name', 'address', 'phone'];

    use HasFactory;

    public function pets() {
        return $this->hasMany(Pet::class);
    }
}
