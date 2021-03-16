<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\RoomSetting;

/**
 * Class RoomSettingTransformer.
 *
 * @package namespace App\Transformers;
 */
class RoomSettingTransformer extends TransformerAbstract
{
    /**
     * Transform the RoomSetting entity.
     *
     * @param \App\Models\RoomSetting $model
     *
     * @return array
     */
    public function transform(RoomSetting $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
