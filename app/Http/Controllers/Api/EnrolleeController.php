<?php

namespace App\Http\Controllers\Api;

use App\Library\Utilities;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use App\Repositories\HmoRepository;
use League\Fractal\Resource\Collection;
use App\Transformers\EnrolleeTransformer;
use App\Repositories\EnrolleeRepository as Enrollee;

class EnrolleeController extends Controller
{
    protected $fractal;
    protected $enrollee;
    protected $enrolleeTransformer;
    protected $request;
    protected $utility;
    protected $hmo;

    public function __construct(Enrollee $enrollee, Manager $manager, EnrolleeTransformer $enrolleeTransformer, Request $request, Utilities $utilities, HmoRepository $hmoRepository){
        $this->middleware('jwt.auth');
        $this->fractal = $manager;
        $this->enrollee = $enrollee;
        $this->enrolleeTransformer = $enrolleeTransformer;
        $this->request = $request;
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
        //Get the current users HMO
        $collection = new Collection($this->getUserHmo()->enrollee, $this->enrolleeTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['enrollees' => $data->toArray()], 200);

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
        $item = new Item($this->enrollee->find($id), $this->enrolleeTransformer);
        $data = $this->fractal->createData($item);
        return response()->json(['enrollee' => $data->toArray()], 200);
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

    public function getChildren($id){
        $enrollee = $this->enrollee->find($id);
        $children = $enrollee->getChild;

        $collection = new Collection($children, $this->enrolleeTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['dependents' => $data->toArray()], 200);

    }

    protected function getUserHmo(){
        $data = $this->utility->getAuthenticatedUser();
        $hmo = $this->hmo->find($data['data']['hmo']['data']['hmo_id']);

        return $hmo;
    }
}
