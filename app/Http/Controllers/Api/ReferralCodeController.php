<?php

namespace App\Http\Controllers\Api;

use App\Repositories\ReferralCodeRepository;
use Faker\Factory as Faker;
use Hashids\Hashids;
use App\Library\Utilities;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use App\Repositories\ReferralCodeRepository as Code;
use League\Fractal\Resource\Collection;
use App\Transformers\ReferralCodeTransformer;

class ReferralCodeController extends Controller
{
    protected $faker;
    protected $request;
    protected $utility;
    protected $code;
    protected $codeTransformer;
    protected $fractal;

    /**
     * @param Request $request
     * @param Utilities $utilities
     * @param ReferralCodeTransformer $referralCodeTransformer
     * @param Code $referralCodeRepository
     * @param Manager $manager
     */
    public function __construct(Request $request, Utilities $utilities, ReferralCodeTransformer $referralCodeTransformer, Code $referralCodeRepository, Manager $manager, \Faker\Generator $faker){
//        $this->middleware('jwt.auth');
        $this->request = $request;
        $this->utility = $utilities;
        $this->code = $referralCodeRepository;
        $this->codeTransformer = $referralCodeTransformer;
        $this->fractal = $manager;
        $this->faker = $faker;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $collection = new Collection($this->code->all(), $this->codeTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['codes' => $data->toArray()], 200);

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

        $hashIds = new Hashids($this->faker->unique()->company);
        $rand_number = [];
        for($i=0; $i < 5 ; $i++){
            array_push($rand_number, rand(1, 1000000));
        }
        $data = $this->request->all();
        $data['referral_code'] = $hashIds->encode($rand_number);
        $data = $this->code->create($data);
        $item = new Item($data, $this->codeTransformer);
        $data = $this->fractal->createData($item);
        return response()->json(['code' => $data->toArray()], 200);
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

    public function search($code){
        $data = $this->code->findBy('referral_code', $code);
        $collection = new Item($data, $this->codeTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['claims' => $data->toArray()], 200);
    }
}
