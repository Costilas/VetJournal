<?php

namespace App\Models;

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

    public function dateFormat()
    {
        return date('d-m-Y h:i:s', strtotime($this->created_at));
    }
}
