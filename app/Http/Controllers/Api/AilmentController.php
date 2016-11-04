<?php

namespace App\Http\Controllers\Api;

use App\Disease;
use App\Library\Utilities;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use App\Transformers\AilmentTransformers;
use League\Fractal\Resource\Collection;
use App\Repositories\AilmentRepository as Ailment;



class AilmentController extends Controller
{
    protected $fractal;
    protected $ailment;
    protected $ailmentTransformer;

    public function __construct(Manager $manager, Ailment $ailmentRepository, AilmentTransformers $ailmentTransformers){
        $this->fractal = $manager;
        $this->ailment = $ailmentRepository;
        $this->ailmentTransformer = $ailmentTransformers;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $collection = new Collection($this->ailment->all()->take(500), $this->ailmentTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['ailments' => $data->toArray()], 200);
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

    public function search($text){
        $data =  Disease::where('short_desc', 'LIKE', '%'.$text.'%')->get();
        $collection = new Collection($data, $this->ailmentTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['ailments' => $data->toArray()], 200);
    }
}
