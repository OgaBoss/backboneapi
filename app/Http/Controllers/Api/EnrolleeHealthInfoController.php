<?php

namespace App\Http\Controllers\Api;

use App\ClaimsInfoRecord;
use App\Library\Utilities;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Illuminate\Http\Request;
use App\Transformers\HealthInfoTransformer;
use App\Repositories\HealthInfoRepository;
use App\Repositories\EnrolleeRepository;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Item;

class EnrolleeHealthInfoController extends Controller
{
    protected $health;
    protected $fractal;
    protected $request;
    protected $enrollee;
    protected $healthTransformer;

    public function __construct(Request $request,HealthInfoRepository $healthInfoRepository, HealthInfoTransformer $healthInfoTransformer, Manager $manager, EnrolleeRepository $enrolleeRepository ){
        $this->middleware('jwt.auth', ['except' => 'storeEnrolleeImage']);
        $this->request = $request;
        $this->healthTransformer = $healthInfoTransformer;
        $this->fractal = $manager;
        $this->health = $healthInfoRepository;
        $this->enrollee = $enrolleeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $collection = new Collection($this->enrollee->find($id)->healthInfo, $this->healthTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['health_records' => $data->toArray()], 200);
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
     * @param $enrollee_id
     * @param $health_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($enrollee_id, $health_id)
    {
        //
        $collection = new Item($this->health->find($health_id), $this->healthTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['health_record' => $data->toArray()], 200);
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
     * @param $enrollee_id
     *
     * @param $health_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($enrollee_id, $health_id)
    {
        //
        $data = $this->request->all();

        $return = $this->health->update($data, $health_id);
        if($return == 1){
            return response()->json(['success' => 'HealthInfo data updated'], 200);
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
        //
    }
}
