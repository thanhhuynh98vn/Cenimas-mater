<?php

namespace App\Models;

use Zizaco\Entrust\EntrustRole;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;

class Role extends EntrustRole implements Transformable
{
    use TransformableTrait;



    protected $fillable = ['name','description','display_name'];

    public function showPermission(){
        $getPer = Permission::all();
        return $getPer;
    }


}
