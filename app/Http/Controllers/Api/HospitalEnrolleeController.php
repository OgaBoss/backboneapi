<?php

namespace App\Http\Controllers\Api;

use App\Enrollee;
use App\Library\Utilities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HospitalEnrolleeController extends Controller
{
    protected $utility;
    protected $enrollee;

    public function __construct(Utilities $utilities, Enrollee $enrollee){
        $this->middleware('jwt.auth');
        $this->utility = $utilities;
        $this->enrollee = $enrollee;
    }

    //Get enrollee Hospital count for an HMO
    public function enrolleeHmoHospitalCount($hospital_id){
        $hmo_id = $this->utility->getCurrentUserHmo();
        $enr = $this->enrollee->where('hmo_id', $hmo_id->id)->where('hospital_id', $hospital_id)->get();
        return response()->json(['count' => count($enr) ], 200);
    }

}
