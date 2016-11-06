<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClaimsInfoRecord extends Model
{
    //
    protected $table = 'procedure_records';
    protected $guarded = ['id'];

    public function code()
    {
        return $this->belongsTo('App\ReferralCode');
    }

    public function procedure()
    {
        return $this->belongsTo('App\Procedure');
    }

}
