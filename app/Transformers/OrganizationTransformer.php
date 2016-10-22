<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 10/19/16
 * Time: 11:25 PM
 */

namespace App\Transformers;

use App\Organization;
use League\Fractal\TransformerAbstract;

class OrganizationTransformer extends TransformerAbstract
{
    public function transform(Organization $organization){
        return [
            'organization_id' => $organization->id,
            'plan_name' => $organization->plan->name,
            'generated_id' => $organization->generated_id,
            'name' => $organization->name,
            'industry' => $organization->industry,
            'phone' => $organization->phone,
            'email' => $organization->email,
            'street' =>$organization->street_address,
            'lg' => $organization->lg,
            'city' => $organization->city,
            'state' => $organization->state,
            'country' => $organization->country,
            'enrollee_count' => count($organization->enrollees)
        ];
    }
}