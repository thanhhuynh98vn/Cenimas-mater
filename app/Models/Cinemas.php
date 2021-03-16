<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Cinemas.
 *
 * @package namespace App\Models;
 */
class Cinemas extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','parent_id','address','phone'];

    public function Company()
    {
        return $this->hasMany('App\Models\Cinemas','parent_id','id');
    }
    public function parent($id){
        return self::find($id);
    }
}
