<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 10/23/16
 * Time: 4:26 PM
 */

namespace App\Transformers;

use App\Plan;
use League\Fractal\TransformerAbstract;

class PlanTransformer extends TransformerAbstract
{
    public function transform(Plan $plan){
        return [
            'name' => $plan->name,
            'premium' => $plan->premium,
            'cover' => $plan->cover_limit
        ];
    }
}