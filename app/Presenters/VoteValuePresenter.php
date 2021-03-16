<?php

namespace App\Presenters;

use App\Transformers\VoteValueTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class VoteValuePresenter.
 *
 * @package namespace App\Presenters;
 */
class VoteValuePresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new VoteValueTransformer();
    }
}
