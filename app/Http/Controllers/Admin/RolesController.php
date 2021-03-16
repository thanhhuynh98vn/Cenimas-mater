<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RoleCreateRequest;
use App\Http\Requests\RoleUpdateRequest;
use App\Http\Requests;
use PhpParser\Node\Expr\New_;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Repositories\Interfaces\RolesRepository;
use App\Validators\RoleValidator;
use App\Models\Role;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Permission;
use Illuminate\Database\Eloquent;



/**
 * Class RolesController.
 *
 * @package namespace App\Http\Controllers;
 */
class RolesController extends Controller
{
    protected $repository;


    protected $validator;


    public function __construct(RolesRepository $repository)
    {
        $this->repository = $repository;

    }

    public function index()
    {
        $roles = $this->repository->all();
        $showPre=$this->repository->showPermission();
        return view('admin.role.role',compact('roles','showPre'));
    }

    public function store(RoleCreateRequest $request)
    {
        $role = [
            'name'=> $request->input('name'),
            'display_name'=> $request->input('display_name'),
            'description'=>  $request->input('description')
        ];
        $role= $this->repository->create($role);
        $pers = $request->input('permissions');
        $role->attachPermissions(array_values($pers));
        $request->session()->flash('msg', ' Role created successfully');
        return redirect()->route('admin.role.role');
    }

    public function show($id)
    {
        $role = $this->repository->find($id);
        $permissions =  $this->repository->show($id);
        return view('admin.role.show',compact('role','permissions'));
    }

    public function edit($id)
    {
        $role = $this->repository->find($id);
        $permissions=$this->repository->showPermission();
        $rolePermissions = $this->repository->rolePermissions($id);
        return view('admin.role.edit',compact('role','permissions','rolePermissions'));

    }

    public function update(Request $request, $id)
    {
        $role = $this->repository->find($id);
        $role = [
            'name'=> $request->input('name'),
            'display_name'=> $request->input('display_name'),
            'description'=>  $request->input('description')
        ];
        $role = $this->repository->update($role,$id);
        $this->repository->deletePermission_role($id);
        $pers = $request->input('permissions');
        $role->attachPermissions(array_values($pers));
        $request->session()->flash('msg', ' Role updated successfully');
        return redirect()->route('admin.role.role');

    }

    public function destroy(Request $request, $id)
    {
        $this->repository->deleteRole($id);
        $request->session()->flash('msg', ' Role deleted successfully');
        return redirect()->route('admin.role.role');

    }

    public function AjaxCheckname(Request $Request){
        $name = $Request->name;
        $count = $this->repository->checkName($name);
        if ($count >0) {
            return json_encode(false);
        } else {
            return json_encode(true);
        }
    }
}
