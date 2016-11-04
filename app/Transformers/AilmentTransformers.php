<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/2/16
 * Time: 10:08 PM
 */

namespace App\Transformers;

use App\Disease;
use League\Fractal\TransformerAbstract;

class AilmentTransformers extends TransformerAbstract
{
    public function transform(Disease $disease){
        return [
            'id'                    => $disease->id,
            'code'                  => $disease->code,
            'short_description'     => $disease->short_desc
        ];
    }
}