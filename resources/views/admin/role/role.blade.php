@extends('layouts.master')
@section('pageTitle', 'Role')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Roles
            <small>Admin LTE</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Roles</li>
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
                            <h4>Note: </h4>
                            <p> {{Session::get('msg')}}</p>
                        </div>
                    @endif
                    <!-- Trigger the modal with a button -->

                        <button type="button" class="editor_create btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">New Role</button>

                        <div class="modal fade" id="myModal" role="dialog">
                            <form id="FormRole" action="{{route('admin.role.create')}}" method="POST">
                                {{csrf_field()}}
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title titleOK">Create Role</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="usr">Name:</label>
                                                <input type="text" name="name" placeholder="Name" required class="form-control" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Display name:</label>
                                                <input type="text" name="display_name" required placeholder="Display name" class="form-control" id="display_name">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Description:</label>
                                               <textarea required placeholder="Description" class="form-control" id="description" name="description" ></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Permissions:</label>
                                                @foreach($showPre as $key=>$permission)
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="permissions[]"  value="{{$permission->id}}">
                                                        {{$permission->display_name}}
                                                    </label>
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
                        <table id="example1" class="table table-bordered table-striped text-center" >
                            <thead>
                               <tr>
                                   <th>ID</th>
                                   <th>Name</th>
                                   <th>Display name</th>
                                   <th>Description</th>
                                   <th>Option</th>
                               </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $task)
                                <tr>
                                    <td>{{$task->id}}</td>
                                    <td>{{$task->name}}</td>
                                    <td>{{$task->display_name}}</td>
                                    <td>{{$task->description}}</td>
                                    <td>
                                        <a href="{{route('admin.role.show',$task->id)}}" title="View">
                                            <i class="fa fa-send"></i>
                                        </a> |
                                        <a href="{{route('admin.role.edit',$task->id)}}"  title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a> |
                                        <a href="{{route('admin.role.destroy',$task->id)}}" onclick=" return confirm('Are you sure to delete this item?');" title="Delete">
                                            <i class="fa fa-dropbox"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        {{--<!-- /.row -->--}}
    </section>
    <!-- /.content -->
</div>
<script>
    $( document ).ready( function () {

        $( "#FormRole" ).validate( {
            ignore: [],
            debug: false,
            rules: {
                name:{
                    required:true,
                    remote: "{{route('admin.role.AjaxCheckName')}}"
                },
                display_name: {
                    required: true,
                },
                description: {
                    required: true,
                },
                'permissions[]': {
                    required: true,
                }
            },
            messages: {
                name:{
                    required: "Name is required",
                    remote:"Name is unique",
                },
                display_name: {
                    required: "Password is required",
                },
                description: {
                    required: "Description is required",
                },
                'permissions[]': {
                    required: "Roles is required",
                }
            },
        });
    });
</script>

@stop