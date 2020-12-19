<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function todoitems()
    {
        return $this->hasMany(\App\Models\TodoItem::class);
    }
}
