<?php

namespace App\Http\Controllers\Api;

use App\Library\Utilities;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use App\Transformers\HospitalTransformer;
use App\Repositories\HospitalRepository as Hospital;

class HospitalController extends Controller
{
    protected $fractal;
    protected $hospital;
    protected $hospitalTransformer;
    protected $request;
    protected $utility;

    public function __construct(HospitalTransformer $hospitalTransformer, Manager $manager, Utilities $utilities, Request $request, Hospital $hospital){
        $this->middleware('jwt.auth');
        $this->fractal = $manager;
        $this->hospital = $hospital;
        $this->request = $request;
        $this->utility = $utilities;
        $this->hospitalTransformer = $hospitalTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get the current logged in HMO Hospital
        $collection = new Collection($this->utility->getCurrentUserHmo()->hospital, $this->hospitalTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['hospitals' => $data->toArray()], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get uniqueID
        $uniqueId = $this->utility->generateUniqueId($this->request->name, $this->request->state, $this->request->email);

        $hospital_data = $this->request->all();
        $hospital_data['generated_id'] = $uniqueId;

        $data = $this->hospital->create($hospital_data);
        if(count($data) == 1){
            $this->attachHmoToHospital($data->id);
            return response()->json(['hospital' => $data->toArray()], 200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $item = new Item($this->hospital->find($id), $this->hospitalTransformer);
        $data = $this->fractal->createData($item);
        return response()->json(['hospital' => $data->toArray()], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = $this->hospital->update($this->request->all(), $id);
        if($data == 1){
            return response()->json(['success' => 'Hospital information updated successfully'], 200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Get Current HMO
        $hmo = $this->utility->getCurrentUserHmo();
        $hmo->hospital()->detach($id);
        return response()->json(['msg' => 'Hospital Deleted'], 200);

    }

    protected function attachHmoToHospital($hospital)
    {
        $hmo = $this->utility->getCurrentUserHmo();
        $hmo->hospital()->attach($hospital);

    }
}