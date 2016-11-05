<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/3/16
 * Time: 11:35 PM
 */

namespace App\Repositories;

use Bosnadev\Repositories\Contracts\RepositoryInterface;
use Bosnadev\Repositories\Eloquent\Repository;

class MedicalRecordRepository extends Repository
{
    public function model(){
        return 'App\MedicalRecord';
    }
}