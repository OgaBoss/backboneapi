<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 10/19/16
 * Time: 11:09 PM
 */

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class OrganizationRepository extends Repository
{
    public function model(){
        return 'App\Organization';
    }

}