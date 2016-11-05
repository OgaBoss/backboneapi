<?php
/**
 * Created by PhpStorm.
 * User: adebayooluwadamilola
 * Date: 11/5/16
 * Time: 9:00 PM
 */

namespace App\Transformers;

use App\Band;
use League\Fractal\TransformerAbstract;

class BandTransformer extends TransformerAbstract
{
    public function transform(Band $band){
        return [
            'id' => $band->id,
            'name' => $band->name,
            'description' => $band->description
        ];
    }
}