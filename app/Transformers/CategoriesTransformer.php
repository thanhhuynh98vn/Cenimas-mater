<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Categories;

/**
 * Class CategoriesTransformer.
 *
 * @package namespace App\Transformers;
 */
class CategoriesTransformer extends TransformerAbstract
{
    /**
     * Transform the Categories entity.
     *
     * @param \App\Models\Categories $model
     *
     * @return array
     */
    public function transform(Categories $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
