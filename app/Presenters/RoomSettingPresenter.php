<?php

namespace App\Presenters;

use App\Transformers\RoomSettingTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RoomSettingPresenter.
 *
 * @package namespace App\Presenters;
 */
class RoomSettingPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RoomSettingTransformer();
    }
}
