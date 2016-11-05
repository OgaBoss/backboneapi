<?php

namespace App\Http\Controllers\Api;

use App\Library\ExcelFileParse;
use App\Enrollee;

use App\Library\Utilities;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Collection;
use App\Transformers\EnrolleeTransformer;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class NhisController extends Controller
{
    protected $request;
    protected $excel;
    protected $utility;
    protected $enrollee;
    protected $enrolleeTransformer;
    protected $fractal;
    protected $file_name;

    public function __construct(Request $request, ExcelFileParse $excelFileParse, Utilities $utilities, Enrollee $enrollee, EnrolleeTransformer $enrolleeTransformer, Manager $manager){
        $this->middleware('jwt.auth', ['except' => 'store']);
        $this->request = $request;
        $this->excel = $excelFileParse;
        $this->utility = $utilities;
        $this->enrollee = $enrollee;
        $this->enrolleeTransformer = $enrolleeTransformer;
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
        $collection = new Collection($this->utility->getCurrentUserHmo()->enrolleeNhis->take(20), $this->enrolleeTransformer);
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
        //dd();

        list($location, $file_name)  = $this->excel->getFile();
        $this->file_name = $file_name;

        Excel::load($location, function($reader) use ($location){
            // Getting all results
            $results = $reader->toArray();

            // 1 Loop through each of the array result
            array_map([$this, 'processNhisUpload'], $results);

            //delete local file
            unlink($location);
        });


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

    protected function processNhisUpload($data){
        //Check for Enrollee in DB
        $enrollee_data = [
            'hmo_id'            => count($data['hmo_id']) > 0 ? (int)$data['hmo_id'] : null,
            'organization_id'   => count($data['organization_id']) > 0 ? (int)$data['organization_id'] : null,
            'plan_id'           => count($data['plan_id']) > 0 ? (int)$data['plan_id'] : null,
            'generated_id'      => $this->utility->generateUniqueId('Eko Hospital', $data['state'], $data['email']),
            'first_name'        => count($data['first_name']) > 0 ? $data['first_name'] : null,
            'last_name'         => count($data['last_name']) > 0 ? $data['last_name'] : null,
            'phone'             => count($data['phone']) > 0 ? $data['phone'] : null,
            'email'             => count($data['email']) > 0 ? $data['email'] : null,
            'lg'                => count($data['lg']) > 0 ? $data['lg'] : null,
            'state'             => count($data['state']) > 0 ? $data['state'] : null,
            'country'           => count($data['country']) > 0 ? $data['country'] : null,
            'sex'               => count($data['sex']) > 0 ? $data['sex'] : null,
            'city'              => count($data['city']) > 0 ? $data['city'] : null,
            'street_address'    => count($data['street_address']) > 0 ? $data['street_address'] : null,
            'dob'               => count($data['dob']) > 0 ? $data['dob'] : null,
            'status'            => count($data['status']) > 0 ? $data['status'] : null,
            'enrollee_type'     => count($data['enrollee_type']) > 0 ? $data['enrollee_type'] : null,
            'image_url'         => count($data['image_url']) > 0 ? $data['image_url'] : '',
            'hospital_id'       => $data['hospital_id'],
            'dependent_id'      => null,
            'nhis'              => 1,
            'nhis_status'       => 'new',
            'file_name'         => $this->file_name
        ];

        $enrollee = $this->enrollee->where('nhis', 1)->where('email', $data['email'])->first();

        if(count($enrollee) == 1) {
            // Update this Enrollee
            $enrollee->nhis_status = 'old';
            $enrollee->save();
        }elseif(count($enrollee) == 0 && $data['nhis'] == 1){
            $this->enrollee->create($enrollee_data);
        }
    }
}
