<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HealthInfoRecord extends Model
{
    //
    protected $guarded = ['id'];
    protected $table = 'health_records';

    public function hospital(){
        return $this->belongsTo('App\Hospital');
    }

    public function code()
    {
        return $this->belongsTo('App\ReferralCode');
    }

}
