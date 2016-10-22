<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    //
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function enrollees(){
        return $this->hasMany('App\Enrollee');
    }

    public function plan(){
        return $this->belongsTo('App\Plan');
    }
}
