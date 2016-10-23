<?php

/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 10/22/16
 * Time: 9:51 PM
 */

namespace App\Library;

use JWTAuth;
use App\User;
use League\Fractal\Manager;
use Illuminate\Http\Request;
use League\Fractal\Resource\Item;
use App\Transformers\UserTransformer;
use League\Fractal\Resource\Collection;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class Utilities
{
    protected $request;
    protected $user;
    protected $fractal;

    /**
     * @param Request $request
     */
    public function __construct(UserTransformer $userTransformer, Request $request, Manager $manager){
        $this->request = $request;
        $this->user = $userTransformer;
        $this->fractal = $manager;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
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
        return $data;
    }


    /**
     * @param $user
     * @return mixed
     */
    protected function getCurrentUser($user){
        $collection = new Item($user, $this->user);
        $data = $this->fractal->createData($collection)->toArray();
        return $data;
    }


}