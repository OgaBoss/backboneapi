<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/5/16
 * Time: 12:30 PM
 */

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class NhisTrackerRepository extends  Repository
{
    public function model(){
        return 'App\NhisTracker';
    }
}