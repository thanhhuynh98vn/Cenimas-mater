@extends('layouts.master')
@section('pageTitle', 'Dashboard')

@section('content')


    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard

            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Info boxes -->
            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-aqua"><i class="fa fa-file-movie-o"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Film Top</span>
                            <span class="info-box-number">{{@$show->name}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-red"><i class="fa fa-circle-o-notch"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total vote</span>
                            <span class="info-box-number">{{@$show->vote}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix visible-sm-block"></div>

                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-green"><i class="fa fa-creative-commons"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total ticker</span>
                            <span class="info-box-number">{{@$totalTicker}} / {{@$total}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-yellow"><i class="fa fa-home"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Start Film</span>
                            <span class="info-box-number">{{@$show->start_time}}</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->


            <!-- /.row -->
        </section>
        <div class="box box-info">
            <div class="box-header with-border">
                <h3 class="box-title">Users and Ticket</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table no-margin">
                        <thead>
                        <tr>
                            <th>User name</th>
                            <th>Ticket</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(!empty($list_id))

                        @foreach($list_id as $key=> $list)

                        <tr>
                            <td>{{$key}}</td>
                            <td>{{ implode(", ", $list)}}</td>
                        </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">

            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /.content -->
    </div>



@stop