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

    public function examQuestions(){
        return $this->hasMany('App\Question');
    }

    public function subject(){
        return $this->belongsTo('App\Subject');
    }
}
