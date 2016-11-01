<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //
    public function organization(){
        return $this->belongsToMany('App\Organization','organizations_plans' );
    }

    public function enrollee(){
        return $this->hasMany('App\Enrollee');
    }
}
