<?php

namespace App\Http\Controllers\Api;

use Hashids\Hashids;
use App\Library\Utilities;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use JD\Cloudder\Facades\Cloudder;
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

    /**
     * @param Enrollee $enrollee
     * @param Manager $manager
     * @param EnrolleeTransformer $enrolleeTransformer
     * @param Request $request
     * @param Utilities $utilities
     * @param HmoRepository $hmoRepository
     */
    public function __construct(Enrollee $enrollee, Manager $manager, EnrolleeTransformer $enrolleeTransformer, Request $request, Utilities $utilities, HmoRepository $hmoRepository){
        $this->middleware('jwt.auth', ['except' => 'storeEnrolleeImage']);
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
        $collection = new Collection($this->utility->getCurrentUserHmo()->enrollee, $this->enrolleeTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['enrollees' => $data->toArray()], 200);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->enrollee->create($this->convertEnrolleeRequestObjectToArray());
        return response()->json(['enrollee' => $data->toArray()], 200);
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $data = $this->enrollee->update($this->request->all(), $id);
        if($data == 1){
            return response()->json(['success' => 'Enrollee data updated'], 200);
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
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
        $enrollee = $this->enrollee->find($id);
        if($enrollee != null){
            $enrollee->delete();
            if($this->enrollee->find($id) == null){
                return response()->json(['msg' => 'Enrollee Deleted'], 200);
            }else{

            }
        }else{
            return response()->json(['error' => 'This enrollee does not exist'], 200);
        }
    }

    public function search($email){
        $item = new Item($this->enrollee->findBy('email', $email), $this->enrolleeTransformer);
        $data = $this->fractal->createData($item);
        return response()->json(['enrollee' => $data->toArray()], 200);

    }

    public function getChildren($id){
        $enrollee = $this->enrollee->find($id);
        $children = $enrollee->getChild;

        $collection = new Collection($children, $this->enrolleeTransformer);
        $data = $this->fractal->createData($collection);
        return response()->json(['dependents' => $data->toArray()], 200);

    }

    public function storeEnrolleeImage($id){
        if($this->request->hasFile('image')){
            $file_size = ($this->request->file('image')->getClientSize()) / 1000;
            if($file_size > 1000){
                return response()->json(['error' => 'Please upload an png, jpeg, jpg file of 1MB or less'], 500);
            }else{
                $url = $this->postEnrolleeImageToCloud();
                $data = $this->enrollee->update(['image_url' => urldecode($url)], $id);
                if($data == 1){
                    return response()->json(['success' => 'Enrollee data updated', 'url' => urldecode($url)], 200);
                }else{
                    return response()->json(['error' => 'Something went wrong'], 500);
                }
            }
        }else{
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }

    protected function convertEnrolleeRequestObjectToArray(){
        $inComing = $this->request;

        return [
            'hmo_id'            => count($inComing->hmo_id) > 0 ? (int)$inComing->hmo_id : null,
            'organization_id'   => count($inComing->organization_id) > 0 ? (int)$inComing->organization_id : null,
            'plan_id'           => count($inComing->plan_id) > 0 ? (int)$inComing->plan_id : null,
            'generated_id'      => $this->generateUniqueId($inComing),
            'first_name'        => count($inComing->first_name) > 0 ? $inComing->first_name : null,
            'last_name'         => count($inComing->last_name) > 0 ? $inComing->last_name : null,
            'phone'             => count($inComing->phone) > 0 ? $inComing->phone : null,
            'email'             => count($inComing->email) > 0 ? $inComing->email : null,
            'lg'                => count($inComing->lg) > 0 ? $inComing->lg : null,
            'state'             => count($inComing->state) > 0 ? $inComing->state : null,
            'country'           => count($inComing->country) > 0 ? $inComing->country : null,
            'sex'               => count($inComing->sex) > 0 ? $inComing->sex : null,
            'city'              => count($inComing->city) > 0 ? $inComing->city : null,
            'street_address'    => count($inComing->street_address) > 0 ? $inComing->street_address : null,
            'dob'               => count($inComing->dob) > 0 ? $inComing->dob : null,
            'status'            => count($inComing->status) > 0 ? $inComing->status : null,
            'enrollee_type'     => count($inComing->enrollee_type) > 0 ? $inComing->enrollee_type : null,
            'image_url'         => count($inComing->image_url) > 0 ? $inComing->image_url : '',
            'hospital_id'       => $inComing->hospital_id,
            'dependent_id'      => count($inComing->dependent_id) > 0 ? $inComing->dependent_id : null
        ];
    }

    protected function generateUniqueId($inComing){
        $hashIds = new Hashids($inComing->email);

        $org = strtoupper(substr($inComing->organization_name, 0,3));
        $state = strtoupper(substr($inComing->state, 0,3));
        $uniqueId = $hashIds->encode(1,2,3);

        return $org.'/'.$state.'/'.$uniqueId;

    }

    protected function postEnrolleeImageToCloud(){
        $extension = $this->request->file('image')->getClientOriginalExtension();
        $fileName = $this->request->email . '.' . $extension;
        $uploaded_file = $this->request->file('image')->move(base_path().'/public/img', $fileName);

        Cloudder::upload($uploaded_file->getPathname(),$this->request->email, ['folder' => 'EnrolleeImages']);
        unlink(base_path().'/public/img/'.$fileName);
        $result = Cloudder::getResult();
        return $result['url'];
    }
}
