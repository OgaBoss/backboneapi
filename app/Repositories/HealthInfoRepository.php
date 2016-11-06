<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/6/16
 * Time: 12:29 AM
 */

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class HealthInfoRepository extends Repository
{
    public function model(){
        return 'App\HealthInfoRecord';
    }
}