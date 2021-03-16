<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\VoteValue;

/**
 * Class VoteValueTransformer.
 *
 * @package namespace App\Transformers;
 */
class VoteValueTransformer extends TransformerAbstract
{
    /**
     * Transform the VoteValue entity.
     *
     * @param \App\Models\VoteValue $model
     *
     * @return array
     */
    public function transform(VoteValue $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
