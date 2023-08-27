<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['theme', 'body', 'status_id'];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function creationDate():string
    {
        return Carbon::create($this->created_at)->format('d.m.Y H:i:s');
    }
}
