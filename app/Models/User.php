<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Prettus\Repository\Traits\TransformableTrait;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Notifications\Notifiable;

/**
 * Class User.
 *
 * @package namespace App\Models;
 */
class User extends  Authenticatable implements Transformable
{
    use TransformableTrait, EntrustUserTrait,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','group','job','phone','skype','address','birthday'];

    public function showRole(){
        $roles = Role::all();
        return $roles;
    }

    public function votes()
    {
        return $this->belongsToMany('App\Models\VoteValue','vote_value_user','user_id','vote_value_id');
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
