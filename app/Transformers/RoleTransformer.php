<?php

/**
 * Created by PhpStorm.
 * User: OluwadamilolaAdebayo
 * Date: 8/13/16
 * Time: 12:06 AM
 */
namespace App\Transformers;

use App\Role;
use League\Fractal\TransformerAbstract;

class RoleTransformer extends TransformerAbstract{
    public function transform(Role $role)
    {
        return [
            'name' => $role->name
        ];
    }
}