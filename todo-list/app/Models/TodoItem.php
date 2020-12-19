<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodoItem extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function todo()
    {
        return $this->belongsTo(\App\Models\Todo::class);
    }
}
