@extends('layouts.master')
@section('pageTitle', 'Users')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>Admin LTE</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Users</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                    @if(!empty($errors->all()))
                    <div class="callout callout-warning">

                        <h4>Warning!</h4>
                        @foreach ($errors->all() as $message)
                        <p> {{$message}}</p>
                        @endforeach
                    </div>
                    @endif

                <!-- /.box -->
                <div class="container">

                    @if(Session::has('msg'))
                        <div class="callout callout-success">
                            <h4>Note!</h4>
                            <p> {{Session::get('msg')}}</p>
                        </div>
                @endif
                        @role(('superadmin'))

                            <button  class="editor_create btn btn-info btn-lg" data-toggle="modal" data-target="#myUpload">Import Users</button>

                        @endrole
                    <!-- Trigger the modal with a button -->
                        @role(('superadmin'))
                        <button type="button" class="editor_create btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">New User</button>
                        @endrole


                        <div class="modal fade" id="myModal" role="dialog">
                            <form id="FormUser" action="{{route('admin.users.create')}}" method="POST">
                                {{csrf_field()}}
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title titleOK">Create user</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="usr">Name:</label>
                                                <input type="text" name="name" placeholder="Full name" required class="form-control" id="usr">
                                            </div>

                                            <div class="form-group">
                                                <label for="usr">Group:</label>
                                                <input type="text" name="group" placeholder="Group" required class="form-control" id="group">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Job:</label>
                                                <input type="text" name="job" placeholder="Job" required class="form-control" id="job">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Phone:</label>
                                                <input type="number" name="phone" placeholder="Phone" required class="form-control" id="phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Skype:</label>
                                                <input type="text" name="skype" required placeholder="Skype" class="form-control" id="skype">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Address:</label>
                                                <input type="text" name="address" required placeholder="Address" class="form-control" id="address">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Birthday:</label>
                                                <input type="date" name="birthday" required  class="form-control" id="birthday">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Email:</label>
                                                <input type="email" name="email" required placeholder="Email" class="form-control" id="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Password:</label>
                                                <input type="password" name="password" required placeholder="Password" class="form-control" id="password">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Confirm password:</label>
                                                <input type="password" name="passwordre" required placeholder="Confirm Password" class="form-control" id="confirm_password">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Roles:</label>
                                                @foreach($roles as $role=>$value)
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="roles[]"  value="{{$value->id}}">{{$value->display_name}}</label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-default BTNSubmit BTNcreate">Create</button>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
    </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">ALL</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example2" class="table table-bordered table-striped text-center" >
                            <thead>
                               <tr>
                                   <th>ID</th>
                                   <th>Group</th>
                                   <th>Name</th>
                                   <th>Email</th>
                                   <th>Job</th>
                                   <th>Phone</th>
                                   <th>Skype</th>
                                   <th>Address</th>
                                   <th>Birthday</th>
                                   <th>Roles</th>
                                   <th>Option</th>
                               </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $task)
                                <tr>
                                    <td>{{$task->id}}</td>
                                    <td>{{$task->group}}</td>
                                    <td>{{$task->name}}</td>
                                    <td>{{$task->email}}</td>
                                    <td>{{$task->job}}</td>
                                    <td>{{$task->phone}}</td>
                                    <td>{{$task->skype}}</td>
                                    <td>{{$task->address}}</td>
                                    <td>{{$task->birthday}}</td>

                                    <td>  @if(!empty($task->roles))
                                            @foreach($task->roles as $role)
                                                <label class="label label-success">{{ $role->display_name }}</label>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        {{--<a href="{{route('admin.users.show',$task->id)}}" title="Xem">--}}
                                            {{--<i class="fa fa-send"></i>--}}
                                        {{--</a> |--}}
                                        @permission(('edit_user'))
                                        <a href="{{route('admin.users.edit',$task->id)}}" title="Edit">
                                            <i class="fa fa-edit"></i>

                                        </a>
                                        @endpermission
                                        @permission(('dell_user'))
                                        |
                                        <a href="{{route('admin.users.destroy',$task->id)}}" onclick=" return confirm('Are you sure to delete this item?');" title="Delete">
                                            <i class="fa fa-dropbox"></i>
                                        </a>

                                        @endpermission
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                    <!-- /.box-body -->
                </div>
                        <div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Export Users
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li> <a  href="{{route('admin.users.xExport')}}">Export xlsx</a></li>
                                <li> <a  href="{{route('admin.users.cExport')}}">Export csv</a></li>

                            </ul>
                        </div>

                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        {{--<!-- /.row -->--}}
    </section>
    <!-- /.content -->
</div>
<div class="modal fade" id="myUpload" role="dialog">
    <form id="FormRole" action="{{route('admin.users.upload')}}" method="POST" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title titleOK">Create Multi User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="usr">Upload file <small>(csv, xlsx)</small>:</label>
                        <input type="file" name="users"  required class="form-control" id="users">
                    </div>
                    {{--<div class="form-group">--}}
                        {{--<label for="usr">Skip first line for header:</label>--}}
                        {{--<input type="checkbox" name="skip" value="1" id="skip">--}}
                    {{--</div>--}}
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-default BTNSubmit BTNcreate">Import</button>
                </div>
            </div>

        </div>
    </form>
</div>


<script>
    var password = document.getElementById("password")
        , confirm_password = document.getElementById("confirm_password");

    function validatePassword(){
        if(password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Passwords Don't Match");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;
</script>
<script>
    $( document ).ready( function () {

        $( "#FormUser" ).validate( {
            ignore: [],
            debug: false,
            rules: {
                email:{
                    required:true,
                    email:true,
                    remote: "{{route('admin.user.AjaxCheckEmail')}}"
                },
                name: {
                    required: true,
                    minlength:5
                },
                password: {
                    required: true,
                    minlength:6
                },
                passwordre: {
                    required: true,
                },
                'roles[]': {
                    required: true,
                }
            },
            messages: {
                email:{
                    required: "A email is required",
                    email:"Email is not formatted correctly",
                    remote:"A email is unique",
                },
                name:{
                    required: "Name is required",
                    minlength: "Name is minlength is 5",
                },
                password: {
                    required: "Password is required",
                },
                passwordre: {
                    required: "Password confirm is required",
                },
                'roles[]': {
                    required: "Roles is required",
                }
            },
        });
    });
</script>


@stop