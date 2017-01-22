<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'content',
        'score',
        'type',
        'answer',
        'exam_id',
        'lesson_id',
        'order',
    ];

    public function choices(){
        return $this->hasMany('App\Choice');
    }

}
