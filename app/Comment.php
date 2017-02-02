<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'user_id',
        'type',
        'content',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
