<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingSeat extends Model
{
    protected $table = 'booking_seat';
    protected $primaryKey = 'id';
    protected $fillable = ['film_id','name','type','seat_number','user_id','room_id'];

    public function VoteValue()
    {
        return $this->belongsTo('App\Models\VoteValue', 'film_id');
    }
}

