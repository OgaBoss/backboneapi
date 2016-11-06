<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use Hashids\Hashids;
use App\MedicalRecord;
use App\Library\Utilities;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use Illuminate\Http\Request;
use App\Transformers\MedicalRecordsTransformer;
use App\Repositories\MedicalRecordRepository;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Item;

class MedicalRecordController extends Controller
{
    protected $request;
    protected $utility;
    protected $medicalRepository;
    protected $medicalTransformer;
    protected $fractal;

    /**
     * @param Request $request
     * @param Utilities $utilities
     * @param MedicalRecordRepository $medicalRecordRepository
     * @param MedicalRecordsTransformer $medicalRecordsTransformer
     * @param Manager $manager
     */
    public function __construct(Request $request, Utilities $utilities, MedicalRecordRepository $medicalRecordRepository, MedicalRecordsTransformer $medicalRecordsTransformer, Manager$manager){
        $this->middleware('jwt.auth', ['except' => 'storeEnrolleeImage']);
        $this->request = $request;
        $this->utility = $utilities;
        $this->medicalRepository = $medicalRecordRepository;
        $this->medicalTransformer = $medicalRecordsTransformer;
        $this->fractal = $manager;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $collection = new Collection($this->utility->getCurrentUserHmo()->records, $this->medicalTransformer);
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
        $item = new Item($this->medicalRepository->find($id), $this->medicalTransformer);
        $data = $this->fractal->createData($item);
        return response()->json(['record' => $data->toArray()], 200);

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
