<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReferralCode extends Model
{
    //
    protected $guarded = ['id'];
    public function hmo(){
        return $this->belongsTo('App\Hmo');
    }

    public function enrollee(){
        return $this->belongsTo('App\Enrollee');
    }

    public function hospital(){
        return $this->belongsTo('App\Hospital');
    }

    public function claimsInfo(){
        return $this->hasMany('App\ClaimsInfoRecord', 'code_id');
    }

    public function healthInfo(){
        return $this->hasMany('App\HealthInfoRecord', 'code_id');
    }
}
