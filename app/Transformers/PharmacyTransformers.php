<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/1/16
 * Time: 9:17 PM
 */

namespace App\Transformers;

use App\Pharmacy;
use League\Fractal\TransformerAbstract;

class PharmacyTransformers extends TransformerAbstract
{
    public function transform(Pharmacy $pharmacy){
        return [
            'pharmacy_id' => $pharmacy->id,
            'generated_id' => $pharmacy->generated_id,
            'name' => $pharmacy->name,
            'phone' => $pharmacy->phone,
            'email' => $pharmacy->email,
            'street' =>$pharmacy->street_address,
            'lg' => $pharmacy->lg,
            'city' => $pharmacy->city,
            'state' => $pharmacy->state,
            'country' => $pharmacy->country,
        ];
    }
}