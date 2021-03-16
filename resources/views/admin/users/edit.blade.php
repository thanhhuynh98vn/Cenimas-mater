@extends('layouts.master')
@section('pageTitle', 'Edit User')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                User edit profile
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">User profile</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            @if(!empty($errors->all()))
                <div class="callout callout-warning">

                    <h4>Warning!</h4>
                    @foreach ($errors->all() as $message)
                        <p> {{$message}}</p>
                    @endforeach
                </div>
            @endif
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="/adminlte/img/user2-160x160.jpg" alt="User profile picture">

                            <h3 class="profile-username text-center">{{$getID->name}}</h3>

                            <p class="text-muted text-center">{{$getID->email}}</p>

                            {{--<ul class="list-group list-group-unbordered">--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<b>Followers</b> <a class="pull-right">1,322</a>--}}
                                {{--</li>--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<b>Following</b> <a class="pull-right">543</a>--}}
                                {{--</li>--}}
                                {{--<li class="list-group-item">--}}
                                    {{--<b>Friends</b> <a class="pull-right">13,287</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- About Me Box -->

                    <!-- /.box -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li><a href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                        <div class="tab-content">

                            <!-- /.tab-pane -->

                            <div class="active tab-pane" id="settings">
                                <form class="form-horizontal" method="post" action="{{route('admin.users.update',$getID->id)}}">
                                    {{csrf_field()}}
                                    <input type="hidden" value="{{$getID->id}}" id="id" name="id">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="name" required value="{{$getID->name}}" class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGroup" class="col-sm-2 control-label">Group</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="group" placeholder="Group" value="{{$getID->group}}" required class="form-control" id="group">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputJob" class="col-sm-2 control-label">Job</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="job" placeholder="Job" value="{{$getID->job}}" required class="form-control" id="job">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputJob" class="col-sm-2 control-label">Phone</label>

                                        <div class="col-sm-10">
                                            <input type="number" name="phone" placeholder="Phone" value="{{$getID->phone}}" required class="form-control" id="phone">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputJob" class="col-sm-2 control-label">Skype</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="skype" required value="{{$getID->skype}}" placeholder="Skype" class="form-control" id="skype">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputJob" class="col-sm-2 control-label">Address</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="address" required value="{{$getID->address}}" placeholder="Address" class="form-control" id="address">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputJob" class="col-sm-2 control-label">Birthday</label>

                                        <div class="col-sm-10">
                                            <input type="date" name="birthday" value="{{$getID->birthday}}" required  class="form-control" id="birthday">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-10">
                                            <input type="email" name="email" readonly  required value="{{$getID->email}}" class="form-control" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Old password</label>

                                        <div class="col-sm-10">
                                            <input type="password" required class="form-control" name="old_password" id="inputName" placeholder="Old password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">New Password</label>

                                        <div class="col-sm-10">
                                            <input type="password" required class="form-control" name="password" id="password" placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputSkills" class="col-sm-2 control-label">Confirm password</label>

                                        <div class="col-sm-10">
                                            <input type="password" required class="form-control" id="confirm_password" placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  for="inputName" class="col-sm-2 control-label">Permissions:</label>
                                        <div class="col-sm-offset-2 col-sm-10">
                                            @foreach ($roles as $role)
                                                <div class="checkbox">
                                                    <label>
                                                        <input   type="checkbox"value="{{$role->id}}"
                                                                 {{in_array($role->id, $rolePermissions) ? "checked" : null}} name="roles[]">
                                                        {{$role->display_name}}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>
    @foreach ($errors->all() as $message)
        {{$message}} <br>
    @endforeach
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

@stop