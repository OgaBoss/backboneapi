<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 10/17/16
 * Time: 9:14 PM
 */

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class EnrolleeRepository extends Repository
{
    public function model(){
        return 'App\Enrollee';
    }
}