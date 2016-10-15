<?php
/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 8/17/16
 * Time: 9:28 PM
 */


namespace App\Transformers;

use App\Hmo;
use League\Fractal\TransformerAbstract;

class HmoTransformer extends TransformerAbstract {
    public function transform(Hmo $hmo){
        return[
            'hmo_id'        => (int) $hmo->id,
            'email'         => $hmo->email,
            'name'          => $hmo->name,
            'street'        => $hmo->street,
            'city'          => $hmo->city,
            'state'         => $hmo->state,
            'country'       => $hmo->country,
            'phone_office'  => $hmo->phone_office,
            'phone_mobile'  => $hmo->phone_mobile,
            'date_joined'   => $hmo->created_at,
        ];
    }
}