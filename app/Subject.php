<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $fillable = [
        'title',
        'description',
    ];

    public function lessons(){
        return $this->hasMany('App\Lesson');
    }

    public function exam(){
        return $this->hasOne('App\Exam');
    }
}
