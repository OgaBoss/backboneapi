<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\User;
use App\Library\Utilities;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Http\Controllers\Controller;
use App\Transformers\UserTransformer;
use League\Fractal\Resource\Collection;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class LoginController extends Controller
{
    //
    protected $user;
    protected $fractal;
    protected $utility;

    /**
     * @param UserTransformer $userTransformer
     * @param Manager $manager
     * @param Utilities $utilities
     */
    public function __construct(UserTransformer $userTransformer, Manager $manager, Utilities $utilities){
        $this->user = $userTransformer;
        $this->fractal = $manager;
        $this->utility = $utilities;
    }

    public function authenticate(Request $request){
        // Get user credentials from the request
        $credentials =  $request->only('email', 'password');

        try{
            if(!$token = JWTAuth::attempt($credentials)){
                return response()->json(['error' => 'Invalid Credentials'], 401);
            }
        }catch (JWTException $e){
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(compact('token'));

    }

    public function getAuthenticatedUser(){
        return response()->json(['user_data' => $this->utility->getAuthenticatedUser()], 200);
    }
}
