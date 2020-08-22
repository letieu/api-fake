<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class User extends Model
{

    protected $fillable = [
        'github_id', 'access_token',
    ];


    protected $hidden = [
        'access_token',
    ];

    function apis()
    {
        return $this->hasMany('App\Api');
    }

}
