<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Cinemas;

/**
 * Class CinemasTransformer.
 *
 * @package namespace App\Transformers;
 */
class CinemasTransformer extends TransformerAbstract
{
    /**
     * Transform the Cinemas entity.
     *
     * @param \App\Models\Cinemas $model
     *
     * @return array
     */
    public function transform(Cinemas $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
