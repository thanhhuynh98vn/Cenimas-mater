<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Vote;

/**
 * Class VoteTransformer.
 *
 * @package namespace App\Transformers;
 */
class VoteTransformer extends TransformerAbstract
{
    /**
     * Transform the Vote entity.
     *
     * @param \App\Models\Vote $model
     *
     * @return array
     */
    public function transform(Vote $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
