<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Dashboard;

/**
 * Class DashboardTransformer.
 *
 * @package namespace App\Transformers;
 */
class DashboardTransformer extends TransformerAbstract
{
    /**
     * Transform the Dashboard entity.
     *
     * @param \App\Models\Dashboard $model
     *
     * @return array
     */
    public function transform(Dashboard $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
