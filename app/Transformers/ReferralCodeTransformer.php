<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/5/16
 * Time: 11:42 PM
 */

namespace App\Transformers;

use App\ReferralCode;
use League\Fractal\TransformerAbstract;

class ReferralCodeTransformer extends  TransformerAbstract
{
    protected $defaultIncludes = [
        'claims'
    ];
    public function transform(ReferralCode $referralCode){
        return [
            'id'                    => $referralCode->id,
            'referral_code'         => $referralCode->referral_code,
            'hmo_id'                => $referralCode->hmo_id,
            'hospital_id'           => $referralCode->hospital_id,
            'enrollee_id'           => $referralCode->enrollee_id,
            'enrollee_name'         => $referralCode->enrollee->first_name . ", " .$referralCode->enrollee->last_name,
            'hospital_name'         => $referralCode->hospital->name
        ];
    }

    public function includeClaims(ReferralCode $code){
        return $this->collection($code->claimsInfo, new ClaimsInfoTransformer());
    }
}