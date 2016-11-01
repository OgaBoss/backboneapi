<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/1/16
 * Time: 9:15 PM
 */

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class PharmacyRepository extends Repository
{
    public function model(){
        return 'App\Pharmacy';
    }

}