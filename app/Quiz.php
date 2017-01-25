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

    public function quizQuestions(){
        return $this->hasMany('App\Question');
    }

    public function lesson(){
        return $this->belongsTo('App\Lesson');
    }
}
