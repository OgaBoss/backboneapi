<?php

namespace App\Http\Controllers\Api;

use App\Plan;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use App\Transformers\PlanTransformer;
use App\Repositories\OrganizationRepository as Organization;

class OrganizationPlanController extends Controller
{

    protected $fractal;
    protected $organization;
    protected $planTransformer;

    public function __construct(Manager $manager, Organization $organization, PlanTransformer $planTransformer){
        $this->middleware('jwt.auth');
        $this->fractal = $manager;
        $this->organization = $organization;
        $this->planTransformer = $planTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($organization_id)
    {
        //
        $organization = $this->organization->find($organization_id);
        $plans = $organization->plan;


        $collection = new Collection($plans, $this->planTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['plans' => $data->toArray()], 200);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function others($organization_id)
    {
        //
//        $organization = $this->organization->find($organization_id);
//        $plans = $organization->plan->toArray();
//        $newPlans = [] ;
//
//        $others = Plan::all();
//
//        foreach($others->toArray() as $other ){
//            foreach($plans as $plan){
//                if($other['name'] == $plan['name']){
//                    unset($other);
//                };
//            }
//        }
//
//        $collection = new Collection(collect($others), $this->planTransformer);
//        $data = $this->fractal->createData($collection);
//        return response()->json(['plans' => $data->toArray()], 200);

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
