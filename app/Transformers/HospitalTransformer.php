<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 10/31/16
 * Time: 11:46 PM
 */

namespace App\Transformers;

use App\Hospital;
use League\Fractal\TransformerAbstract;

class HospitalTransformer extends TransformerAbstract
{
    public function transform(Hospital $hospital){
        return [
            'hospital_id' => $hospital->id,
            'generated_id' => $hospital->generated_id,
            'name' => $hospital->name,
            'phone' => $hospital->phone,
            'email' => $hospital->email,
            'street' =>$hospital->street_address,
            'lg' => $hospital->lg,
            'city' => $hospital->city,
            'state' => $hospital->state,
            'country' => $hospital->country,
            'enrollee_count' => count($hospital->enrollees),
            'bank' => $hospital->bank,
            'account' => $hospital->account_number
        ];
    }
}