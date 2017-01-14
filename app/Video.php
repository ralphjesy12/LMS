<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
        'filename',
        'subject_id',
    ];
}
