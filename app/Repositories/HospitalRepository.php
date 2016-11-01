<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/1/16
 * Time: 12:17 AM
 */

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class HospitalRepository extends  Repository
{
    public function model(){
        return 'App\Hospital';
    }

}