<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Kalnoy\Nestedset\NodeTrait;
/**
 * Class Categories.
 *
 * @package namespace App\Models;
 */
class Categories extends Model implements Transformable
{
    use TransformableTrait;
    use NodeTrait
;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];

}
