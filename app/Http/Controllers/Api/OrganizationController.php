<?php

namespace App\Http\Controllers\Api;

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

    /**
     * @param Organization $organization
     * @param Manager $manager
     * @param OrganizationTransformer $organizationTransformer
     * @param Utilities $utilities
     * @param HmoRepository $hmoRepository
     */
    public function __construct(Organization $organization, Manager $manager, OrganizationTransformer $organizationTransformer, Utilities $utilities, HmoRepository $hmoRepository){
        $this->middleware('jwt.auth');
        $this->fractal = $manager;
        $this->organization = $organization;
        $this->organizationTransformer = $organizationTransformer;
        $this->utility = $utilities;
        $this->hmo = $hmoRepository;
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

    protected function getUserHmo(){
        $data = $this->utility->getAuthenticatedUser();
        $hmo = $this->hmo->find($data['data']['hmo']['data']['hmo_id']);

        return $hmo;
    }
}
