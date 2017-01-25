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
        'quiz_id',
        'order',
    ];

    public function choices(){
        return $this->hasMany('App\Choice');
    }

}
