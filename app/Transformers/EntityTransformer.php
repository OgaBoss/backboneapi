<?php
/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 8/13/16
 * Time: 12:06 AM
 */
namespace App\Transformers;

use App\Entity;
use League\Fractal\TransformerAbstract;

class EntityTransformer extends TransformerAbstract{
    public function transform(Entity $entity)
    {
        return [
            'name' => $entity->name
        ];
    }
}