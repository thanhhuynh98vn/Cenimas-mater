<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class RoomSetting.
 *
 * @package namespace App\Models;
 */
class RoomSetting extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'room_settings';
    protected $primaryKey = 'id';
    protected $fillable = ['number','alphabet_id','room_id'];



}
