<?php

namespace App\Presenters;

use App\Transformers\RoomTypeTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RoomTypePresenter.
 *
 * @package namespace App\Presenters;
 */
class RoomTypePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoomTypeTransformer();
    }
}
