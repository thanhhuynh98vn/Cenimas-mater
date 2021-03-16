<?php

namespace App\Presenters;

use App\Transformers\CinemasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class CinemasPresenter.
 *
 * @package namespace App\Presenters;
 */
class CinemasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new CinemasTransformer();
    }
}
