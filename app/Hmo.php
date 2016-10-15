<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hmo extends Model
{
    //
    public function user(){
        return $this->hasMany('App\User');
    }
}
