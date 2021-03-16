<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Support\Facades\DB;

/**
 * Class Post.
 *
 * @package namespace App\Models;
 */
class Post extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ='posts';
    protected $primaryKey ='id';
    protected $fillable = ['title','description','content','avatar','slug','view','author_id'];

    public function tags()
    {
        return $this->belongsToMany('App\Models\Tag','post_tag','id_post','id_tag');
    }

    public function users(){
        return $this->hasOne('App\Models\User','id','author_id');

    }
}
