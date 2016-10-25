<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 10/23/16
 * Time: 4:30 PM
 */

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class PlanRepository extends Repository
{
    public function model(){
        return 'App\Plan';
    }
}