<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharmacy extends Model
{
    //
    protected $guarded = ['id'];


    public function hmo(){
        return $this->belongsToMany('App\Hmo', 'hmo_pharmacy');
    }
}
