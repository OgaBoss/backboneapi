<?php

namespace App\Http\Controllers\Api;

use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use League\Fractal\Resource\Collection;
use App\Transformers\EnrolleeTransformer;
use App\Repositories\EnrolleeRepository as Enrollee;



class EnrolleeController extends Controller
{
    protected $fractal;
    protected $enrollee;
    protected $enrolleeTransformer;

    public function __construct(Enrollee $enrollee, Manager $manager, EnrolleeTransformer $enrolleeTransformer){
        //$this->middleware('jwt.auth');
        $this->fractal = $manager;
        $this->enrollee = $enrollee;
        $this->enrolleeTransformer = $enrolleeTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $collection = new Collection($this->enrollee->all(), $this->enrolleeTransformer);
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
}
