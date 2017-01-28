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

    public function subject(){
        return $this->belongsTo('App\Subject');
    }


    public function quiz(){
        return $this->hasOne('App\Quiz');
    }
}
