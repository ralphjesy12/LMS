<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'subject_id',
        'order',
    ];
}
