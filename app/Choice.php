<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    //
    protected $fillable = [
        'content',
        'type',
        'question_id',
        'order', 
    ];
}
