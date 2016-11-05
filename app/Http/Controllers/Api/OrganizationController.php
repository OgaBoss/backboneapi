<?php

namespace App\Http\Controllers\Api;

use Hashids\Hashids;
use App\OrganizationPlan;
use App\Library\Utilities;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use App\Repositories\HmoRepository;
use League\Fractal\Resource\Collection;
use App\Transformers\OrganizationTransformer;
use App\Repositories\OrganizationRepository as Organization;

class OrganizationController extends Controller
{

    protected $fractal;
    protected $organization;
    protected $organizationTransformer;
    protected $utility;
    protected $hmo;
    protected $request;

    /**
     * @param Organization $organization
     * @param Manager $manager
     * @param OrganizationTransformer $organizationTransformer
     * @param Utilities $utilities
     * @param HmoRepository $hmoRepository
     */
    public function __construct(Organization $organization, Manager $manager, OrganizationTransformer $organizationTransformer, Utilities $utilities, HmoRepository $hmoRepository, Request $request){
        $this->middleware('jwt.auth');
        $this->fractal = $manager;
        $this->organization = $organization;
        $this->organizationTransformer = $organizationTransformer;
        $this->utility = $utilities;
        $this->hmo = $hmoRepository;
        $this->request =$request;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $collection = new Collection($this->getUserHmo()->organization, $this->organizationTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['organizations' => $data->toArray()], 200);

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
        $data = $this->organization->create($this->convertOrganizationRequestToArray());
        if(count($data) > 0){
            //Attach Plans
            $this->attachPlanToOrganization($data->id);
            return response()->json(['organization' => $data->toArray()], 200);
        }else{

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
        $item = new Item($this->organization->find($id), $this->organizationTransformer);
        $data = $this->fractal->createData($item);
        return response()->json(['organization' => $data->toArray()], 200);
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
        $plan_ids = $this->request->plan_ids;
        $organization_update = $this->request->all();
        unset($organization_update['plan_ids']);
        $data = $this->organization->update($organization_update, $id);

        $this->attachPlanToOrganizationUpdate($id, $plan_ids);

        if($data == 1){
            return response()->json(['success' => 'Organization data successfully updated'], 200);
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

    protected function getUserHmo(){
        $data = $this->utility->getAuthenticatedUser();
        $hmo = $this->hmo->find($data['data']['hmo']['data']['hmo_id']);

        return $hmo;
    }

    protected function convertOrganizationRequestToArray(){
        $inComing = $this->request;

        return [
            'hmo_id' => (int)$inComing->hmo_id,
            'city' => $inComing->city,
            'email' => $inComing->email,
            'name' => $inComing->name,
            'phone' => $inComing->phone,
            'state' => $inComing->state,
            'lg' => $inComing->lg,
            'industry' => '',
            'street_address' => $inComing->address,
            'generated_id' => $this->generateUniqueId($inComing),
            'country' => 'Nigeria'
        ];
    }

    protected function generateUniqueId($inComing){
        $hashIds = new Hashids($inComing->email);

        $org = strtoupper(substr($inComing->name, 0,3));
        $state = strtoupper(substr($inComing->state, 0,3));
        $uniqueId = $hashIds->encode(1,2,3);

        return $org.'/'.$state.'/'.$uniqueId;

    }

    protected function attachPlanToOrganization($id){
        $inComing = $this->request;
        $plan = $inComing->plan;
        $plan = explode(',', $plan);
        $organization  =  $this->organization->find($id);
        return $organization->plan()->attach($plan);
    }

    protected function attachPlanToOrganizationUpdate($id, $plan_ids){
        $plans = explode(',', $plan_ids);
        $organization  =  $this->organization->find($id);

        foreach($plans as $plan){
            $check = OrganizationPlan::where('plan_id',$plan)->where('organization_id', $id)->get();
            if(count($check) == 0){
                $organization->plan()->attach($plan);
            }
        }
    }
}
