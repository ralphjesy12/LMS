<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //

    protected $fillable = [
        'user_id',
        'subject_id',
        'grade',
    ];

    public function subject(){
        return $this->hasOne('App\Subject');
    }

    public function student(){
        return $this->belongsTo('App\User');
    }
}
