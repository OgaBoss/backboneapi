<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollee extends Model
{
    //

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
    public function organizations(){
        return $this->belongsTo('App\Organization');
    }
}
