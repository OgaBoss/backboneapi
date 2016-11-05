<?php

namespace App\Http\Controllers\Api;

use App\Library\Utilities;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use App\Transformers\NhisTrackerTransformer;
use App\Repositories\NhisTrackerRepository as Nhis;

class NhisTrackerController extends Controller
{
    protected $request;
    protected $fractal;
    protected $nhisTracker;
    protected $nhisTrackerTransfomer;
    protected $utility;

    public function __construct(Request $request, Manager $manager, NhisTrackerTransformer $nhisTrackerTransformer, Nhis $nhisTrackerRepository, Utilities $utilities)
    {
        $this->middleware('jwt.auth');
        $this->request = $request;
        $this->fractal = $manager;
        $this->nhisTracker = $nhisTrackerRepository;
        $this->nhisTrackerTransfomer = $nhisTrackerTransformer;
        $this->utility = $utilities;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $collection = new Collection($this->utility->getCurrentUserHmo()->nhisTracker, $this->nhisTrackerTransfomer);
        $data = $this->fractal->createData($collection);
        return response()->json(['trackers' => $data->toArray()], 200);
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
