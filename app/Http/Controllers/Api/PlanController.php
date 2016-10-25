<?php

namespace App\Http\Controllers\Api;

use App\Library\Utilities;
use App\Repositories\PlanRepository;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use App\Repositories\HmoRepository;
use League\Fractal\Resource\Collection;
use App\Transformers\PlanTransformer;
use App\Repositories\PlanRepository as Plan;

class PlanController extends Controller
{
    protected $utility;
    protected $fractal;
    protected $plan;
    protected $planTransformer;
    protected $hmo;

    /**
     * @param Manager $manager
     * @param Plan $plan
     * @param PlanTransformer $planTransformer
     * @param Utilities $utilities
     * @param HmoRepository $hmoRepository
     */
    public function __construct(Manager $manager, Plan $plan, PlanTransformer $planTransformer,Utilities $utilities, HmoRepository $hmoRepository){
        $this->middleware('jwt.auth');
        $this->utility = $utilities;
        $this->fractal = $manager;
        $this->plan =  $plan;
        $this->planTransformer = $planTransformer;
        $this->hmo = $hmoRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $collection = new Collection($this->utility->getCurrentUserHmo()->plan, $this->planTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['plans' => $data->toArray()], 200);
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
    public function show($id)
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
