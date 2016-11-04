<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/3/16
 * Time: 11:07 PM
 */

namespace App\Transformers;

use App\MedicalRecord;
use League\Fractal\TransformerAbstract;

class MedicalRecordsTransformer extends  TransformerAbstract
{
    public function transform(MedicalRecord $medicalRecord){
        return [
            'id'                    => $medicalRecord->id,
            'enrollee_id'                    => $medicalRecord->enrollee_id,
            'hospital_id'                    => $medicalRecord->hospital_id,
            'description'                    => $medicalRecord->description,
            'referral_code'                    => $medicalRecord->referral_code,
            'drug_list'                    => $medicalRecord->drug_list,
            'disease'                    => $medicalRecord->disease,
            'claims_approval'                    => $medicalRecord->claims_approval,
            'claims_md_approval'                    => $medicalRecord->claims_md_approval,
            'month'                    => $medicalRecord->month,
            'end_date'                    => $medicalRecord->end_date,
            'start_date'                    => $medicalRecord->start_date,
            'con'                    => $medicalRecord->con,
            'cf'                    => $medicalRecord->cf,
            'ir'                    => $medicalRecord->ir,
            'im'                    => $medicalRecord->im,
            'ih'                    => $medicalRecord->ih,
            'is'                    => $medicalRecord->is,
            'rs1'                    => $medicalRecord->rs1,
            'rx2'                    => $medicalRecord->rx2,
            'rx3'                    => $medicalRecord->rx3,
            'refill'                    => $medicalRecord->refill,
            'rec'                    => $medicalRecord->rec,
            'transfer'                    => $medicalRecord->transfer,
            'died'                    => $medicalRecord->died,
            'hospital'                  => $medicalRecord->hospital->name
        ];
    }

}