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

    public function prices(){
        return $this->hasMany('App\ProcedureBand', 'band_id', 'band_id');
    }

    public function band(){
        return $this->belongsTo('App\Band');
    }

    public function claimsInfo(){
        return $this->hasManyThrough('App\ClaimsInfoRecord', 'App\ReferralCode', 'hospital_id', 'code_id');
    }

    public function healthInfo(){
        return $this->hasManyThrough('App\HealthInfoRecord','App\ReferralCode', 'hospital_id', 'code_id');
    }
}
