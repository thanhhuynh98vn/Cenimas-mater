@extends('layouts.master')
@section('pageTitle', 'Setting Rooms')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Setting rooms
            <small>Admin LTE</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Setting Rooms</li>
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

                        <button type="button" class="editor_create btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">New Setting</button>

                        <div class="modal fade" id="myModal" role="dialog">
                            <form id="FormRoomSetting" action="{{route('admin.settingrooms.create')}}" method="POST">
                                {{csrf_field()}}
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title titleOK">Create setting room</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="usr">Name:</label>
                                                <select class="form-control validate[required]" name="alphabet_id" id="alphabet_id" >
                                                    @foreach($showAlphabet as $show)
                                                        <option value="{{$show->id}}">{{$show->alphabet}}</option>
                                                    @endforeach
                                                </select>                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Number of seats:</label>
                                                <input type="number" name="number" placeholder="Number of seats..." required class="form-control" id="number">
                                            </div>
                                            <div class="form-group">
                                                <label>Rooms</label>
                                                <select class="form-control validate[required]" name="room_id" id="room_id" >
                                                    @foreach($showRooms as $showRoom)
                                                    <option value="{{$showRoom->id}}">{{$showRoom->name}}</option>
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
                                   <th>Rooms</th>
                                   <th>Option</th>
                               </tr>
                            </thead>
                            <tbody>
                            @foreach($showIndex as $showIndexs)
                                <tr>
                                    <td>{{$showIndexs->rId}}</td>
                                    <td>{{$showIndexs->alphabet}}</td>
                                    <td>{{$showIndexs->sNumber}}</td>
                                    <td>{{$showIndexs->name}}</td>
                                    <td>
                                        <a href="javascript:void (0)" class="" data-toggle="modal" data-target="#myModal-{{$showIndexs->rId}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a> |
                                        <a href="{{route('admin.settingrooms.destroy',$showIndexs->rId)}}" onclick=" return confirm('Delete settingrooms?');" title="Delete">
                                            <i class="fa fa-dropbox"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal-{{$showIndexs->rId}}" role="dialog">
                                    <form id="FormRoomSettingUpdate" action="{{route('admin.settingrooms.update',$showIndexs->rId)}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" id="id" name="id" value="{{$showIndexs->rId}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title titleOK">Create setting room</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="usr">Name:</label>
                                                        <select class="form-control validate[required]" name="alphabet_id" id="alphabet_id" >
                                                            @foreach($showAlphabet as $show)
                                                                @php
                                                                    $selected='';
                                                                    if($show->id==$showIndexs->alphabet_id){
                                                                        $selected='selected="selected"';
                                                                    }
                                                                @endphp
                                                                <option   {{$selected}} value="{{$show->id}}">{{$show->alphabet}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usr">Number of seats:</label>
                                                        <input type="number" name="number" value="{{$showIndexs->sNumber}}" placeholder="Number of seats..." required class="form-control" id="number">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Rooms</label>
                                                        <select class="form-control validate[required]" name="room_id" id="room_id" >
                                                            @foreach($showRooms as $showRoom)
                                                                @php
                                                                    $selected='';
                                                                    if($showRoom->id==$showIndexs->room_id){
                                                                        $selected='selected="selected"';
                                                                    }
                                                                @endphp
                                                                <option  {{$selected}}  value="{{$showRoom->id}}">{{$showRoom->name}}</option>
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