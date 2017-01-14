<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'content',
        'subject_id',
        'teacher_id', 
    ];
}
