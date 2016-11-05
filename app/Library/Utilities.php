<?php

/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 10/22/16
 * Time: 9:51 PM
 */

namespace App\Library;


use JWTAuth;
use Hashids\Hashids;
use App\Repositories\HmoRepository as Hmo;
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
    protected $hmo;

    /**
     * @param UserTransformer $userTransformer
     * @param Request $request
     * @param Manager $manager
     * @param Hmo $hmo
     */
    public function __construct(UserTransformer $userTransformer, Request $request, Manager $manager, Hmo $hmo){
        $this->request = $request;
        $this->user = $userTransformer;
        $this->fractal = $manager;
        $this->hmo = $hmo;
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

    public function  getCurrentUserHmo(){
        $data = $this->getAuthenticatedUser();
        $hmo = $this->hmo->find($data['data']['hmo']['data']['hmo_id']);

        return $hmo;
    }

    public function generateUniqueId($org, $state, $email){
        $hashIds = new Hashids($email);

        $org = strtoupper(substr($org, 0,3));
        $state = strtoupper(substr($state, 0,3));
        $uniqueId = $hashIds->encode(1,2,3);

        return $org.'/'.$state.'/'.$uniqueId;
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