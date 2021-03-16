@extends('layouts.master')
@section('pageTitle', 'Rooms')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Rooms
            <small>Admin LTE</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Rooms</li>
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

                        <button type="button" class="editor_create btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">New Room</button>

                        <div class="modal fade" id="myModal" role="dialog">
                            <form id="FormRooms" action="{{route('admin.rooms.create')}}" method="POST">
                                {{csrf_field()}}
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title titleOK">Create room</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="usr">Name:</label>
                                                <input type="text" name="name" placeholder="Name.." required class="form-control" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Total number of seats:</label>
                                                <input type="number" name="number" placeholder="Total number of seats..." required class="form-control" id="number">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Space:</label>
                                                <input type="text" name="space" placeholder="Space.." required class="form-control" id="space">
                                            </div>
                                            <div class="form-group">
                                                <label>Cenimas</label>
                                                <select class="form-control validate[required]" name="cinemas_id" id="cinemas_id" >
                                                    @foreach($getCinemas as $getCinema)
                                                        <option value="{{$getCinema->id}}">{{$getCinema->name}}</option>
                                                    @endforeach
                                                </select>
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
                                   <th>Total number of seats</th>
                                   <th>Cinemas</th>
                                   <th>Option</th>
                               </tr>
                            </thead>
                            <tbody>
                            @foreach($getRooms as $getRoom)
                                <tr>
                                    <td>{{$getRoom->rid}}</td>
                                    <td>{{$getRoom->rname}}</td>
                                    <td>{{$getRoom->number}}</td>
                                    <td>{{$getRoom->cname}}</td>
                                    <td>
                                        <a href="javascript:void (0)" class="" data-toggle="modal" data-target="#myModal-{{$getRoom->rid}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a> |
                                        <a href="{{route('admin.rooms.destroy',$getRoom->rid)}}" onclick=" return confirm('Delete company will delete all Cenimas of {{$getRoom->name}} ');" title="Delete">
                                            <i class="fa fa-dropbox"></i>
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="myModal-{{$getRoom->rid}}" role="dialog">
                                    <form id="FormRooms2" action="{{route('admin.rooms.update',$getRoom->rid)}}" method="post">
                                        {{csrf_field()}}
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title titleOK">Edit room</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="usr">Name:</label>
                                                        <input type="text" name="name" placeholder="Name" value="{{$getRoom->rname}}" required class="form-control" id="name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usr">Total number of seats:</label>
                                                        <input type="number" name="number" value="{{$getRoom->number}}" placeholder="Total number of seats..." required class="form-control" id="number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usr">Space:</label>
                                                        <input type="text" name="space" placeholder="Space.." value="{{$getRoom->space}}" required class="form-control" id="space">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Cenimas</label>
                                                        <select class="form-control validate[required]" name="cinemas_id" id="cinemas_id" >
                                                            @foreach($getCinemas as $getCinema)
                                                                @php
                                                                    $selected='';
                                                                    if($getCinema->id==$getRoom->cinemas_id){
                                                                        $selected='selected="selected"';
                                                                    }
                                                                @endphp
                                                                <option value="{{$getCinema->id}}">{{$getCinema->name}}</option>
                                                            @endforeach
                                                        </select>
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