<?php

namespace App\Presenters;

use App\Transformers\DashboardTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DashboardPresenter.
 *
 * @package namespace App\Presenters;
 */
class DashboardPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DashboardTransformer();
    }
}
