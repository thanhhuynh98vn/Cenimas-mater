<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\RoomType;

/**
 * Class RoomTypeTransformer.
 *
 * @package namespace App\Transformers;
 */
class RoomTypeTransformer extends TransformerAbstract
{
    /**
     * Transform the RoomType entity.
     *
     * @param \App\Models\RoomType $model
     *
     * @return array
     */
    public function transform(RoomType $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
