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
    protected $defaultIncludes = [
        'dependent',
        'parent'
    ];

    public function transform(Enrollee $enrollee){
        return [
            'enrollee_id' => (int) $enrollee->id,
            'generated_id' => $enrollee->generated_id,
            'first_name' => $enrollee->first_name,
            'last_name' => $enrollee->last_name,
            'image_url' => $enrollee->image_url,
            'phone' => $enrollee->phone,
            'email' => $enrollee->email,
            'lg' => $enrollee->lg,
            'city' => $enrollee->city,
            'state' => $enrollee->state,
            'country' => $enrollee->country,
            'dob' => $enrollee->dob,
            'status' => ($enrollee->staus == 0) ? 'inactive' : 'active',
            'enrollee_type' => $enrollee->enrollee_type
        ];
    }

    public function includeDependent(Enrollee $enrollee){
        if($enrollee->enrollee_type == 'parent'){
            return $this->collection($enrollee->getChild(), new EnrolleeTransformer());
        }else{
            return null;
        }
    }

    public function includeParent(Enrollee $enrollee){
        if($enrollee->enrollee_type == 'child'){
            return $this->collection($enrollee->getParent(), new EnrolleeTransformer());
        }else{
            return null;
        }
    }

}