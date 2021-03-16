@extends('layouts.master')
@section('pageTitle', 'Companies')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Companies
            <small>Admin LTE</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Companies</li>
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

                        <button type="button" class="editor_create btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">New company</button>

                        <div class="modal fade" id="myModal" role="dialog">
                            <form id="FormCinemas" action="{{route('admin.companies.create')}}" method="POST">
                                {{csrf_field()}}
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title titleOK">Create company</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="usr">Company:</label>
                                                <input type="text" name="name" placeholder="Name" required  class="form-control" id="name">
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
                                   <th>Companies</th>

                                   <th>Option</th>
                               </tr>
                            </thead>
                            <tbody>
                            @foreach($getCompaies as $getCompay)
                                <tr>
                                    <td>{{$getCompay->id}}</td>
                                    <td>{{$getCompay->name}}</td>
                                    <td>
                                        <a href="javascript:void (0)" class="" data-toggle="modal" data-target="#myModal-{{$getCompay->id}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a> |
                                        <a href="{{route('admin.companies.destroy',$getCompay->id)}}" onclick=" return confirm('Delete company will delete all Cenimas of {{$getCompay->name}} ');" title="Delete">
                                            <i class="fa fa-dropbox"></i>
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="myModal-{{$getCompay->id}}" role="dialog">
                                    <form id="FormCinemas" action="{{route('admin.companies.update',$getCompay->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" id="id" name="id" value="{{$getCompay->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title titleOK">Edit company</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="usr">Company:</label>
                                                        <input type="text" name="name" placeholder="Name" value="{{$getCompay->name}}" required class="form-control" id="name">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-default" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-default BTNSubmit BTNcreate">Update</button>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
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


@stop