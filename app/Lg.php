<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lg extends Model
{
    //
    protected $guarded = ['id'];
    protected $table = 'lgs';


    /**
     * @return \Illum inate\Database\Eloquent\Relations\BelongsTo
     */
    public function state(){
        return $this->belongsTo('App\State');
    }
}
