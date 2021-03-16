<?php

namespace App\Repositories\Eloquents;

use App\Models\Role;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\RolesRepository;
use App\Models\Roles;
use App\Validators\RolesValidator;
use Illuminate\Support\Facades\DB;

/**
 * Class RolesRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class RolesRepositoryEloquent extends BaseRepository implements RolesRepository
{
    public function model()
    {
        return Role::class;
    }

    protected $model;

    public function show($id){
        $permissions = DB::table('permissions')
            ->join('permission_role','permissions.id','=','permission_role.permission_id')
            ->where('permission_role.role_id',$id)->select('permissions.name','permissions.id','permissions.display_name')->get();
        return $permissions;
    }

    public function showPermission(){
        return $this->model->showPermission();
    }

    public function rolePermissions($id)
    {
        $rolePermissions = DB::table("permission_role")
            ->where("role_id",$id)
            ->pluck('permission_id')
            ->toArray();
        return $rolePermissions;
    }

    public function deleteRole($id){
      return  DB::table("roles")->where('id',$id)->delete();

    }

    public function deletePermission_role($id){
       return DB::table("permission_role")->where("role_id",$id)->delete();
    }

    public function checkName($name)
    {
       return  Role::select('name')->where('name',$name)->count();

    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
