<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/5/16
 * Time: 12:28 PM
 */

namespace App\Transformers;

use App\NhisTracker;
use League\Fractal\TransformerAbstract;

class NhisTrackerTransformer extends  TransformerAbstract
{
    public function transform(NhisTracker $nhisTracker){
        return [
            'id' => $nhisTracker->id,
            'name' => $nhisTracker->file_name
        ];
    }
}