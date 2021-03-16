<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Roles;

/**
 * Class RolesTransformer.
 *
 * @package namespace App\Transformers;
 */
class RolesTransformer extends TransformerAbstract
{
    /**
     * Transform the Roles entity.
     *
     * @param \App\Models\Roles $model
     *
     * @return array
     */
    public function transform(Roles $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
