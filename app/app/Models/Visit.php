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
        return date('d-m-Y / H:i', strtotime($this->visit_date));
    }
}
