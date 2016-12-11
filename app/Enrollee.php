<?php

namespace App;

use \Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enrollee extends Model
{
    use SoftDeletes;


    /**
     * @var array
     */
    protected $dates = ['deleted_at'];
    //

    protected $guarded = ['id'];
    /**
     * @param $value
     */

    public function setDependentIdAttribute($value){
        $this->attributes['dependent_id'] = $value ?: null;
    }

    /**
     * @return mixed
     */
    public function getParent(){
        return $this->where('id', $this->dependent_id)->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function getChild(){
        return $this->hasMany('App\Enrollee', 'dependent_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function organization(){
        return $this->belongsTo('App\Organization');
    }

    public function plan(){
        return $this->belongsTo('App\Plan');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function hospital(){
        return $this->belongsTo('App\Hospital');
    }

    public function claimsInfo(){
        return $this->hasManyThrough('App\ClaimsInfoRecord', 'App\ReferralCode', 'enrollee_id', 'code_id')->where('month', Request::input('month') ?  Request::input('month') : date('M') );
    }

    public function healthInfo(){
        return $this->hasManyThrough('App\HealthInfoRecord','App\ReferralCode', 'enrollee_id', 'code_id')->where('month', Request::input('month') ?  Request::input('month') : date('M') );
    }
}
