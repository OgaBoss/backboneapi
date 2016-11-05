<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    //
    protected $guarded = ['id'];

    public function procedure(){
        return $this->belongsToMany('App\Procedure', 'record_procedures','record_id','procedure_id');
    }

    public function hospital(){
        return $this->belongsTo('App\Hospital');
    }

}
