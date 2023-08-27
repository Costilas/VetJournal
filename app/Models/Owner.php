<?php

namespace App\Models;

use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{

    protected $fillable = ['name', 'patronymic', 'last_name', 'address', 'phone', 'additional_phone', 'email'];

    use Filterable;
    use HasFactory;

    public function pets()
    {
        return $this->hasMany(Pet::class);
    }

    public function registerDate()
    {
        return Carbon::create($this->created_at)->format('d-m-Y');
    }
}
