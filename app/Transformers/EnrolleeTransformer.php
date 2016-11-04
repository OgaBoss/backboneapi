<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 10/17/16
 * Time: 8:37 PM
 */

namespace App\Transformers;

use App\Enrollee;
use League\Fractal\TransformerAbstract;

class EnrolleeTransformer extends TransformerAbstract
{
    public function transform(Enrollee $enrollee){
        return [
            'enrollee_id' => (int) $enrollee->id,
            'generated_id' => $enrollee->generated_id,
            'first_name' => $enrollee->first_name,
            'last_name' => $enrollee->last_name,
            'image_url' => ($enrollee->image_url == '' || $enrollee->image_url == null)   ? null : $enrollee->image_url ,
            'phone' => $enrollee->phone,
            'email' => $enrollee->email,
            'lg' => $enrollee->lg,
            'street' => $enrollee->street_address,
            'city' => $enrollee->city,
            'state' => $enrollee->state,
            'country' => $enrollee->country,
            'dob' => $enrollee->dob,
            'status' => ($enrollee->status == 0) ? 'false' : 'true',
            'enrollee_type' => $enrollee->enrollee_type,
            'plan_name' => $enrollee->plan->name,
            'organization' => $enrollee->organization->name,
            'organization_id' => $enrollee->organization->id,
            'sex' => $enrollee->sex,
            'plan'=> $enrollee->plan->name,
            'primary_hospital' => $enrollee->hospital->name
        ];
    }
}