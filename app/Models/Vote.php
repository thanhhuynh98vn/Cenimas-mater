<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Models\VoteValue;

/**
 * Class Vote.
 *
 * @package namespace App\Models;
 */
class Vote extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['question','type','expiry_date','winner_id','allow_update','analytics','month','expiry_date_ticket'];
    public function vote_values()
    {
        return $this->hasMany(VoteValue::class);
    }

}
