@extends('layouts.master')
@section('pageTitle', 'Cenimas')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Cinemas
            <small>Admin LTE</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Cinemas</li>
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

                        <button type="button"  class="editor_create btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">New Cinema</button>

                        <div class="modal fade" id="myModal" role="dialog">
                            <form id="FormCinemas" action="{{route('admin.cinemas.create')}}" method="POST">
                                {{csrf_field()}}
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title titleOK">Create cinema</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="usr">Company:</label>
                                                <input type="text" name="name" placeholder="Name" required class="form-control" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Address:</label>
                                                <input type="text" name="address" required placeholder="Address..." class="form-control" id="address">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Phone:</label>
                                                <input type="number" name="phone" required placeholder="Phone..." class="form-control" id="phone">
                                            </div>
                                            <div class="form-group">
                                                <label>Cenimas</label>
                                                <select class="form-control validate[required]" name="parent_id" id="parent_id" >
                                                    @foreach($getCompaies as $getCompay)
                                                    <option value="{{$getCompay->id}}">{{$getCompay->name}}</option>
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
                                   <th>Cinemas</th>
                                   <th>Company</th>
                                   <th>Address</th>
                                   <th>Phone</th>
                                   <th>Option</th>
                               </tr>
                            </thead>
                            <tbody>
                            @foreach($getCinemas as $getCinema)
                                <tr>
                                    <td>{{$getCinema->id}}</td>
                                    <td>{{$getCinema->name}}</td>
                                    <td>
                                        @if(empty($getCinema->parent_id))
                                            {!! "None" !!}
                                        @else
                                            @php
                                                $parent =  $getCinema->parent($getCinema->parent_id)->name;
                                            echo $parent;
                                            @endphp
                                        @endif
                                    </td>
                                    <td>{{$getCinema->address}}</td>
                                    <td>{{$getCinema->phone}}</td>
                                    <td>
                                        <a href="javascript:void (0)" class="" data-toggle="modal" data-target="#myModal-{{$getCinema->id}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a> |
                                        <a href="{{route('admin.cinemas.destroy',$getCinema->id)}}" onclick=" return confirm('Are you sure to delete {{$getCinema->name}}?');" title="Delete">
                                            <i class="fa fa-dropbox"></i>
                                        </a>
                                    </td>
                                </tr>
                                <div class="modal fade" id="myModal-{{$getCinema->id}}" role="dialog">
                                    <form id="FormUpdateCinemas" action="{{route('admin.cinemas.update',$getCinema->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input type="hidden" value="{{$getCinema->id}}" id="id" name="id">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title titleOK">Create cinema</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="usr">Company:</label>
                                                        <input type="text" name="name" value="{{$getCinema->name}}" placeholder="Name" required class="form-control" id="name">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usr">Address:</label>
                                                        <input type="text" name="address" value="{{$getCinema->address}}" required placeholder="Address..." class="form-control" id="address">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usr">Phone:</label>
                                                        <input type="number" name="phone" value="{{$getCinema->phone}}" required placeholder="Phone..." class="form-control" id="phone">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Cenimas</label>
                                                        <select class="form-control validate[required]" name="parent_id" id="parent_id" >
                                                            @foreach($getCompaies as $getCompay)
                                                                @php
                                                                    $selected='';
                                                                    if($getCompay->id==$getCinema->parent_id){
                                                                        $selected='selected="selected"';
                                                                    }
                                                                @endphp

                                                                <option   {{$selected}} value="{{$getCompay->id}}">{{$getCompay->name}}</option>
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