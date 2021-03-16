<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';
    protected $primaryKey ='id';
    protected $fillable = ['user_id','vote_value_id','quantity'];
    public $timestamps = false;


}
