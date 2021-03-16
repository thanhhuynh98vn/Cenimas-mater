<?php

namespace App\Presenters;

use App\Transformers\RolesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class RolesPresenter.
 *
 * @package namespace App\Presenters;
 */
class RolesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new RolesTransformer();
    }
}
