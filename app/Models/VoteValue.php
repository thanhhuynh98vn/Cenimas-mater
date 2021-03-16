<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class VoteValue.
 *
 * @package namespace App\Models;
 */
class VoteValue extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table ='vote_value';
    protected $primaryKey = 'id';
    protected $fillable = ['name','link','image','vote_id','address','start_time'];

    public function users()
    {
        return $this->belongsToMany('App\Models\User','vote_value_user','vote_value_id','user_id');
    }

    public function bookingSeat(){
        return $this->hasMany('App\Models\BookingSeat','film_id','');
    }
}
