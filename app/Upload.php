<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    //

    protected $fillable = [
        'lesson_id',
        'type',
        'path',
        'description',
    ];
}
