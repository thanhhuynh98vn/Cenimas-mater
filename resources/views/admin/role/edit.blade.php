@extends('layouts.master')
@section('pageTitle', 'Edit Role')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Update role
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Update role</li>
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

                <!-- /.col -->
                <div class="col-md-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li><a href="#settings" data-toggle="tab">Update role</a></li>
                        </ul>
                        <div class="tab-content">

                            <!-- /.tab-pane -->

                            <div class="active tab-pane" id="settings">
                                <form class="form-horizontal" method="post" action="{{route('admin.role.update',$role->id)}}">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="name" placeholder="Name" readonly value="{{$role->name}}" required class="form-control" id="name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Display name:</label>

                                        <div class="col-sm-10">
                                            <input type="text" value="{{$role->display_name}}" name="display_name" required placeholder="Display name" class="form-control" id="display">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Description:</label>

                                        <div class="col-sm-10">
                                            <textarea required placeholder="Description"class="form-control" name="description" >{{$role->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label  for="inputName" class="col-sm-2 control-label">Permissions:</label>
                                        <div class="col-sm-offset-2 col-sm-10">
                                        @foreach ($permissions as $permission)
                                            <div class="checkbox">
                                                <label>
                                                    <input   type="checkbox"value="{{$permission->id}}"
                                                             {{in_array($permission->id, $rolePermissions) ? "checked" : null}} name="permissions[]">
                                                    {{$permission->display_name}}
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