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
       return $this->hasMany('App\Enrollee')->where('nhis', 0);
    }

    public function enrolleeNhis(){
        return $this->hasMany('App\Enrollee')->where('nhis', 1);
    }

    public function organization(){
        return $this->hasMany('App\Organization');
    }

    public function plan(){
        return $this->hasMany('App\Plan');
    }

    public function hospital(){
        return $this->belongsToMany('App\Hospital', 'hmo_hospital');
    }

    public function pharmacy(){
        return $this->belongsToMany('App\Pharmacy', 'hmo_pharmacy');
    }

    public function records(){
        return $this->hasMany('App\MedicalRecord');
    }

    public function nhisTracker(){
        return $this->hasMany('App\NhisTracker');
    }

}
