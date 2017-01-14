<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    //
    protected $fillable = [
        'title',
        'lesson_id',
        'description',
        'order', 
    ];
}
