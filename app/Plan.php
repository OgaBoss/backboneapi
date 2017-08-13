<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    //

    protected $guarded = ['id'];

    public function organization(){
        return $this->belongsToMany('App\Organization','organizations_plans' );
    }

    public function enrollee(){
        return $this->hasMany('App\Enrollee');
    }

    public function variation(){
        return $this->belongsTo('App\Plan', 'plan_id');
    }
}
