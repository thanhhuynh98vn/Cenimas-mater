<?php

namespace App\Repositories\Eloquents;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\Interfaces\UserRepository;
use App\Models\User;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\DB;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace App\Repositories\Eloquents;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }
    protected $model;
    /**
    * Specify Validator class name
    *
    * @return mixed
    */
//    public function all($columns = array('*'))
//    {
//        return parent::all();
//    }

    public function showRole()
    {
        return $this->model->showRole();
    }

    public function rolePermissions($id)
    {
        $rolePermissions = DB::table("role_user")
            ->where("user_id",$id)
            ->pluck('role_id')
            ->toArray();
        return $rolePermissions;
    }

    public function deleteUser_role($id)
    {
      return  DB::table('role_user')->where('user_id',$id)->delete();
    }

    public function checkEmail($email)
    {
        return User::select('email')->whereEmail($email)->count();
    }

    public function exportExcel()
    {
       return User::select('name','email','group','job','phone','skype','address','birthday')->get();

    }

    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
