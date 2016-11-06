<?php

namespace App\Http\Controllers\Api;

use App\ClaimsInfoRecord;
use App\Library\Utilities;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Illuminate\Http\Request;
use App\Transformers\ClaimsInfoTransformer;
use App\Repositories\ClaimsInfoRepository;
use App\Repositories\EnrolleeRepository;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Item;

class EnrolleeClaimsInfoController extends Controller
{
    protected $claims;
    protected $fractal;
    protected $request;
    protected $enrollee;
    protected $claimsTransformer;

    public function __construct(Request $request,ClaimsInfoRepository $claimsInfoRepository, ClaimsInfoTransformer $claimsInfoTransformer, Manager $manager, EnrolleeRepository $enrolleeRepository ){
        $this->middleware('jwt.auth');
        $this->request = $request;
        $this->claimsTransformer = $claimsInfoTransformer;
        $this->fractal = $manager;
        $this->claims = $claimsInfoRepository;
        $this->enrollee = $enrolleeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $collection = new Collection($this->enrollee->find($id)->claimsInfo, $this->claimsTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['claims_records' => $data->toArray()], 200);
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
