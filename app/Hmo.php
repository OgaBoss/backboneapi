<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hmo extends Model
{
    //
    public function user(){
        return $this->hasMany('App\User');
    }

    public function enrollee(){
       return $this->hasMany('App\Enrollee');
    }

    public function organization(){
        return $this->hasMany('App\Organization');
    }

    public function plan(){
        return $this->hasMany('App\Plan');
    }
}
