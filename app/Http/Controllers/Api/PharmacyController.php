<?php

namespace App\Http\Controllers\Api;

use App\Library\Utilities;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use App\Transformers\PharmacyTransformers;
use App\Repositories\PharmacyRepository as Pharmacy;

class PharmacyController extends Controller
{
    protected $fractal;
    protected $pharmacy;
    protected $pharmacyTransformers;
    protected $request;
    protected $utility;

    public function __construct(PharmacyTransformers $pharmacyTransformers, Manager $manager, Utilities $utilities, Request $request, Pharmacy $pharmacy){
        $this->middleware('jwt.auth');
        $this->fractal = $manager;
        $this->pharmacy = $pharmacy;
        $this->request = $request;
        $this->utility = $utilities;
        $this->pharmacyTransformers = $pharmacyTransformers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $collection = new Collection($this->utility->getCurrentUserHmo()->pharmacy, $this->pharmacyTransformers);
        $data = $this->fractal->createData($collection);
        return response()->json(['pharmacy' => $data->toArray()], 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $item = new Item($this->pharmacy->find($id), $this->pharmacyTransformers);
        $data = $this->fractal->createData($item);
        return response()->json(['Pharmacy' => $data->toArray()], 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $data = $this->pharmacy->update($this->request->all(), $id);
        if($data == 1){
            return response()->json(['success' => 'Pharmacy information updated successfully'], 200);
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
        $pharmacy = $this->pharmacy->find($id);
        if($pharmacy != null){
            $pharmacy->delete();
            if($this->pharmacy->find($id) == null){
                return response()->json(['msg' => 'Enrollee Deleted'], 200);
            }else{

            }
        }else{
            return response()->json(['error' => 'This hospital does not exist'], 200);
        }
    }
}