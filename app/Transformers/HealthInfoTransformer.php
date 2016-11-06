<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/6/16
 * Time: 12:31 AM
 */

namespace App\Transformers;

use App\HealthInfoRecord;
use League\Fractal\TransformerAbstract;

class HealthInfoTransformer extends  TransformerAbstract
{
    public function transform(HealthInfoRecord $healthInfoRecord){
        return [
            'id'                        => $healthInfoRecord->id,
            'referral_code'             => $healthInfoRecord->code->referral_code,
            'hospital'                  => $healthInfoRecord->code->hospital->name,
            'disease'                   => $healthInfoRecord->disease,
            'claims_approval'           => $healthInfoRecord->claims_approval,
            'claims_md_approval'        => $healthInfoRecord->claims_md_approval,
            'month'                     => $healthInfoRecord->month,
            'md_approval'               => $healthInfoRecord->md_approval,
            'end_date'                  => $healthInfoRecord->end_date,
            'start_date'                => $healthInfoRecord->start_date,
            'con'                       => $healthInfoRecord->con,
            'cf'                        => $healthInfoRecord->cf,
            'ir'                        => $healthInfoRecord->ir,
            'im'                        => $healthInfoRecord->im,
            'ih'                        => $healthInfoRecord->ih,
            'is'                        => $healthInfoRecord->is,
            'rs1'                       => $healthInfoRecord->rs1,
            'rx2'                       => $healthInfoRecord->rx2,
            'rx3'                       => $healthInfoRecord->rx3,
            'refill'                    => $healthInfoRecord->refill,
            'rec'                       => $healthInfoRecord->rec,
            'transfer'                  => $healthInfoRecord->transfer,
            'died'                      => $healthInfoRecord->died,
        ];
    }
}