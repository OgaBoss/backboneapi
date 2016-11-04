<?php

namespace App\Http\Controllers\Api;

use App\MedicalRecord;
use App\Library\Utilities;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Illuminate\Http\Request;
use App\Repositories\EnrolleeRepository as Enrollee;
use App\Transformers\MedicalRecordsTransformer;
use App\Repositories\MedicalRecordRepository;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Item;

class EnrolleeRecordsController extends Controller
{
    protected $enrollee;
    protected $fractal;
    protected $request;
    protected $medicalTransformer;

    public function __construct(Request $request,Enrollee $enrolleeRepository, MedicalRecordsTransformer $medicalRecordsTransformer, Manager$manager){
        $this->middleware('jwt.auth', ['except' => 'storeEnrolleeImage']);
        $this->request = $request;
        $this->medicalTransformer = $medicalRecordsTransformer;
        $this->fractal = $manager;
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
        $collection = new Collection($this->enrollee->find($id)->records, $this->medicalTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['records' => $data->toArray()], 200);

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
