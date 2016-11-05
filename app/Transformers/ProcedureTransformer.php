<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/4/16
 * Time: 2:53 PM
 */

namespace App\Transformers;

use App\Procedure;
use League\Fractal\TransformerAbstract;

class ProcedureTransformer extends  TransformerAbstract
{
    public function transform(Procedure $procedure){
        return [
            'id'                    => $procedure->id,
            'name'                  => $procedure->name,
            'description'           => $procedure->description
        ];
    }   
}