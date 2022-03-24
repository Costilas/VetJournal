<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = ['pet_id', 'visit_date', 'weight', 'pre_diagnosis', 'visit_info'];

    public function pet() {
        return $this->belongsTo(Pet::class);
    }

    public function dateFormat()
    {
        return date('d-m-Y', strtotime($this->visit_date));
    }
}
