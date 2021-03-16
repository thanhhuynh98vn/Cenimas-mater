@extends('layouts.master')
@section('pageTitle', 'Edit Films')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
               Edit film
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active">Edit film</li>
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
                            <li><a href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                        <div class="tab-content">

                            <!-- /.tab-pane -->

                            <div class="active tab-pane" id="settings">
                                <form class="form-horizontal" method="post" action="{{route('admin.vote_value.update',$getFim->id)}}">
                                    {{csrf_field()}}
                                    <input type="hidden" id="id" name="id" value="{{$getFim->id}}">
                                    {{--<input type="hidden" value="{{$idRead}}" id="vote_id" name="vote_id">--}}
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="name" placeholder="Name film..." value="{{$getFim->name}}" required class="form-control" id="name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGroup" class="col-sm-2 control-label">Link</label>

                                        <div class="col-sm-10">
                                            <input type="url" name="link" placeholder="Url film..." value="{{$getFim->link}}" required class="form-control" id="link">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGroup" class="col-sm-2 control-label">Start time</label>

                                        <div class="col-sm-10">
                                            <input type="datetime-local" name="start_time" value="{{date('Y-m-d\TH:i:s',strtotime($getFim->start_time))}}" placeholder="Start time..." required class="form-control" id="start_time">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputGroup" class="col-sm-2 control-label">Address</label>

                                        <div class="col-sm-10">
                                            <input type="text" name="address" placeholder="Address..." value="{{$getFim->address}}" required class="form-control" id="address">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputJob" class="col-sm-2 control-label">Image</label>

                                        <div class="col-sm-10">
                                            <img style="max-width: 300px; max-height: 400px; min-width: 200px; min-height: 300px" src="/storage/images/{{$getFim->image}}">                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputJob" class="col-sm-2 control-label">Image</label>
                                        <div class="col-sm-10">
                                            <input type="file" name="image"  class="form-control" id="image">
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


@stop