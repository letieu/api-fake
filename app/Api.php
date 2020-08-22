<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Api extends Model
{
    protected $fillable = ['entry','data','method'];

    function user()
    {
        return $this->belongsTo('App\User');
    }
}
