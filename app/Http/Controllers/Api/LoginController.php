<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\User;
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


    public function __construct(UserTransformer $userTransformer, Manager $manager){
        $this->user = $userTransformer;
        $this->fractal = $manager;
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
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }
        $data = $this->getCurrentUser($user);
        return response()->json(['user_data' => $data], 200);
    }

    protected function getCurrentUser($user){
        $collection = new Item($user, $this->user);
        $data = $this->fractal->createData($collection)->toArray();
        return $data;
    }
}
