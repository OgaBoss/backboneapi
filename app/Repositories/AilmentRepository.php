<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/2/16
 * Time: 10:18 PM
 */

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class AilmentRepository extends Repository
{
    public function model(){
        return 'App\Disease';
    }
}