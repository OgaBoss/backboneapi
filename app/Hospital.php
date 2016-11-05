<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    //
    protected $guarded = ['id'];

    public function enrollees(){
        return $this->hasMany('App\Enrollee');
    }

    public function hmo(){
        return $this->belongsToMany('App\Hmo', 'hmo_hospital');
    }

    public function records(){
        return $this->belongsTo('App\Record');
    }
}
