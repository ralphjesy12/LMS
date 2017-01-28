<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $fillable = [
        'user_id',
        'question_id',
        'answer',
    ];

    public function question(){
        return $this->belongsTo('App\Question');
    }
}
