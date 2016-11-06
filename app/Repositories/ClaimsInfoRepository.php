<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/6/16
 * Time: 12:28 AM
 */

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class ClaimsInfoRepository extends Repository
{
    public function model(){
        return 'App\ClaimsInfoRecord';
    }
}