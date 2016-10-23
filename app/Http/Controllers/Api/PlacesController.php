<?php

namespace App\Http\Controllers\Api;

use App\State;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlacesController extends Controller
{
    protected $request;

    public function __construct(Request $request){
        $this->request = $request;
    }

    public function getState(){
        $state = State::all()->toArray();
        return response()->json(['state' => $state], 200);
    }

    public function getLgs(){
        $state = $this->request->input('state');
        $state = State::find($state);
        $lgs = $state->lga->toArray();

        return response()->json(['lg' => $lgs], 200);
    }
}
