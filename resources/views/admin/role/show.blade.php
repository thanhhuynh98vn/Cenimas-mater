@extends('layouts.master')
@section('pageTitle', 'Show Role')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Show role
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Examples</a></li>
                <li class="active"> Show role</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">

            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="box box-primary">
                        <div class="box-body box-profile">
                            <img class="profile-user-img img-responsive img-circle" src="/adminlte/img/user2-160x160.jpg" alt="User profile picture">

                            <h3 class="profile-username text-center"></h3>

                            <p class="text-muted text-center"></p>

                            <ul class="list-group list-group-unbordered">
                                <li class="list-group-item">
                                    <b>Role</b> <a class="pull-right">{{$role->name}}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Permission</b>
                                    @if(!empty($permissions))

                                    @foreach($permissions as $permissions)
                                        <a class="pull-right">
                                            <label class="label label-success">{{ $permissions->display_name }}</label>
                                        </a> <br>
                                        @endforeach
                                        @endif
                                </li>

                            </ul>

                            <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->

                    <!-- About Me Box -->

                    <!-- /.box -->
                </div>
                <!-- /.col -->

                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>
        <!-- /.content -->
    </div>



@stop