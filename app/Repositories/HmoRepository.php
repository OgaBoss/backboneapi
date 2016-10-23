<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 10/22/16
 * Time: 10:15 PM
 */

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class HmoRepository extends Repository
{
    public function model(){
        return 'App\Hmo';
    }
}