<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

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

    public function answers(){
        return $this->hasManyThrough('App\Answer','App\Question');
    }
}
