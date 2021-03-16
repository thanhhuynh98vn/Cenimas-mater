<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquents\UserRepositoryEloquent;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\Interfaces\UserRepository;
use App\Validators\UserValidator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Zizaco\Entrust\Entrust;
use Excel;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendReminderEmail;
/**
 * Class UsersController.
 *
 * @package namespace App\Http\Controllers;
 */
class UsersController extends Controller
{

    protected $repository;

    protected $validator;


    public function __construct(UserRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }

    public function uploadExcel(Request $request){

       if (Input::hasFile('users')) {
           $path=Input::file('users')->getRealPath();
           $data= Excel::load($path,function ($reader){})->get()->toArray();
           foreach ($data as $key => $value) {
               $items = [
                   'name'=> $value['name'],
                   'email'=> $value['email'],
                   'password'=> bcrypt(trim($value['password'])),
                   'group'=> $value['group'],
                   'job'=> $value['job'],
                   'phone'=> $value['phone'],
                   'skype'=> $value['skype'],
                   'address'=> $value['address'],
                   'birthday'=> $value['birthday'],
                   'created_at'=> date('Y-m-d H:i:s'),
                   'updated_at'=> date('Y-m-d H:i:s')
               ];
               if (!empty($items)) {
                   $this->repository->create($items);
                   dispatch((new SendReminderEmail((array) $value))->delay('5'));
               }
           }
           return back();
       }
    }

    public function xExportExcel(){
        $export=$this->repository->exportExcel();
        Excel::create('Users',function ($excel) use ($export){
            $excel->sheet('sheet 1',function ($sheet) use ($export){
                $sheet->fromArray($export);
            });
        })->export('xlsx');
    }

    public function cExportExcel(){
        $export=$this->repository->exportExcel();
        Excel::create('Users',function ($excel) use ($export){
            $excel->sheet('sheet 1',function ($sheet) use ($export){
                $sheet->fromArray($export);
            });
        })->export('csv');
    }

    public function index()
    {
        $tasks = $this->repository->all();
        $roles = $this->repository->showRole();
        return view('admin.users.index', compact('tasks','roles'));
    }

    public function store(UserCreateRequest $request)
    {
        $users = [
            'name'=> $request->input('name'),
            'email'=>$request->input('email'),
            'password'=> bcrypt(trim($request->input('password'))),
            'group'=> $request->input('group'),
            'job'=> $request->input('job'),
            'phone'=>  $request->input('phone'),
            'skype'=> $request->input('skype'),
            'address'=> $request->input('address'),
            'birthday'=> $request->input('birthday'),
            'created_at'=> date('Y-m-d H:i:s'),
            'updated_at'=> date('Y-m-d H:i:s')

        ];
        $users = $this->repository->create($users);
        $roles = $request->input('roles');
        $users->attachRoles(array_values($roles));
        $request->session()->flash('msg', ' User created successfully');

        return redirect()->route('admin.users.index');
    }

    public function show($id)
    {
        $getProfile = $this->repository->find($id);
        return view('admin.users.show',['getProfiles'=>$getProfile]);
    }

    public function edit($id)
    {
        $getID = $this->repository->find($id);
        $getID->hasRole('admin');
        $roles=$this->repository->showRole();
        $rolePermissions = $this->repository->rolePermissions($id);
        return view('admin.users.edit',compact('getID','roles','rolePermissions'));
    }

    public function update(UserUpdateRequest $request, $id)
    {
        $old2 = $this->repository->find($id)->password;
        $getOld=$request->old_password;
        if(Hash::check($getOld,$old2 )){
            $user = $this->repository->find($id);
            $user = [
                'name'=> $request->input('name'),
                'password'=> bcrypt(trim($request->input('password'))),
                'group'=> $request->input('group'),
                'job'=> $request->input('job'),
                'phone'=>  $request->input('phone'),
                'skype'=> $request->input('skype'),
                'address'=> $request->input('address'),
                'birthday'=> $request->input('birthday'),
                'updated_at'=> date('Y-m-d H:i:s')
            ];
            $user = $this->repository->update($user,$id);
            $this->repository->deleteUser_role($id);
            $roles = $request->input('roles');
            $user->attachRoles(array_values($roles));
            $request->session()->flash('msg', ' User updated successfully');
            return redirect()->route('admin.users.index');
        }
        else{
            dd('sai password cũ');
        }
    }

    public function destroy($id,Request $request)
    {
        $deleted = $this->repository->delete($id);
        if ($deleted) {
            $request->session()->flash('msg', 'User deleted successfully');
            return redirect()->route('admin.users.index');
        } else {
            $request->session()->flash('msg','User deleted error');
            return redirect()->route('admin.users.index');
        }
    }

    public function AjaxCheckEmail(Request $Request){
        $email = $Request->email;
        $count = $this->repository->checkEmail($email);

        if ($count >0) {
            return json_encode(false);
        } else {
            return json_encode(true);
        }
    }

    public function sentMail(){
        $data=['mail'=>'mrphong678@gmail.com'];
        Mail::send('auth.mailbox', $data, function ($msg) {
            $msg->from('mrphong678@gmail.com','PhongLuuShop');
            $msg->to('mrphong678@gmail.com','Bạn tôi')->subject('Welcome');
        });
        return redirect()->route('admin.users.index');
    }

}
