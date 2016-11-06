<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/6/16
 * Time: 12:31 AM
 */

namespace App\Transformers;

use App\ClaimsInfoRecord;
use League\Fractal\TransformerAbstract;

class ClaimsInfoTransformer extends  TransformerAbstract
{
    public function transform(ClaimsInfoRecord $claims){
        return [
            'referral_code'             => $claims->code->referral_code,
            'procedure'                 => $claims->procedure->name,
            'disease'                   => $claims->disease,
            'claims_approval'           => $claims->claims_approval,
            'claims_md_approval'        => $claims->claims_md_approval,
            'md_approval'               => $claims->md_approval,
            'month'                     => $claims->month,
            'hospital_name'             => $claims->code->hospital->name,
            'band_id'                   => $claims->code->hospital->band_id,
            'band_name'                 => $claims->code->hospital->band->name,
            'prices'                    => $claims->code->hospital->prices->where('procedure_id',$claims->procedure->id)->toArray()
        ];
    }
}