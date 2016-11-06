<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\HospitalRepository;
use App\Repositories\ClaimsInfoRepository;
use App\Transformers\ClaimsInfoTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
class HospitalClaimsController extends Controller
{
    protected $request;
    protected $claims;
    protected $claimsTransformer;
    protected $hospital;
    protected $fractal;

    public function __construct(Request $request, HospitalRepository $hospitalRepository, ClaimsInfoRepository $claimsInfoRepository, Manager $manager, ClaimsInfoTransformer $claimsInfoTransformer){
        $this->fractal = $manager;
        $this->request = $request;
        $this->claims = $claimsInfoRepository;
        $this->claimsTransformer = $claimsInfoTransformer;
        $this->hospital = $hospitalRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($hospital_id)
    {
        $data = $this->hospital->find($hospital_id)->claimsInfo;
        $collection = new Collection($data, $this->claimsTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['claim_records' => $data->toArray()], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show($hospital_id, $claims_id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
