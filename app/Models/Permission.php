<?php

namespace App\Models;

use Zizaco\Entrust\EntrustPermission;


class Permission extends EntrustPermission
{
    public function Permission(){
        return $this->belongsToMany('App\Models\Role');

    }
}
