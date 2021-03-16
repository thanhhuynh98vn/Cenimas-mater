<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Companys;

/**
 * Class CompanysTransformer.
 *
 * @package namespace App\Transformers;
 */
class CompanysTransformer extends TransformerAbstract
{
    /**
     * Transform the Companys entity.
     *
     * @param \App\Models\Companys $model
     *
     * @return array
     */
    public function transform(Companys $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
