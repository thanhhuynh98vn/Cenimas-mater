@extends('layouts.master')
@section('pageTitle', 'Votes')

@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           Votes
            <small>Admin LTE</small>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Votes</li>
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
                        <button type="button" class="editor_create btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">New Vote</button>
                        @if(!empty($getMonthVotes))
                        @if($getMonthVotes < $now)
                        <a href="{{route('admin.rooms.room1')}}"><button type="button" class="editor_create btn btn-success btn-lg" data-toggle="modal" data-target="#">SEAT SELECTION</button></a>
                        @endif
                        @endif
                        <div class="modal fade" id="myModal" role="dialog">
                            <form id="FormValue" action="{{route('admin.votes.create')}}" method="POST" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title titleOK">Create vote</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="usr">Question:</label>
                                                <input type="text" name="question" placeholder="Question..." required class="form-control" id="question">
                                            </div>
                                            <div class="form-group">
                                                <label>Type</label>
                                                <select class="form-control" name="type" id="type">
                                                    <option value="1">Choice singular</option>
                                                    <option value="2">Choice plural</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Month</label>
                                                <select class="form-control" name="month" id="month">
                                                    <option value="1">January</option>
                                                    <option value="2">February</option>
                                                    <option value="3">March</option>
                                                    <option value="4">April</option>
                                                    <option value="5">May</option>
                                                    <option value="6">June</option>
                                                    <option value="7">July</option>
                                                    <option value="8">August</option>
                                                    <option value="9">September</option>
                                                    <option value="10">October</option>
                                                    <option value="11">November</option>
                                                    <option value="12">December</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Allow update</label>
                                                <select class="form-control" name="allow_update" id="allow_update">
                                                    <option value="1">Yes</option>
                                                    <option value="0">No</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Expiry date vote:</label>
                                                <input type="datetime-local" name="expiry_date" required class="form-control" id="expiry_date">
                                            </div>
                                            <div class="form-group">
                                                <label for="usr">Expiry date ticket:</label>
                                                <input type="datetime-local" name="expiry_date_ticket" required class="form-control" id="expiry_date_ticket">
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
                        <table id="example1" class="loadValue table table-bordered table-striped text-center" >
                            <thead>
                               <tr>
                                   <th>ID</th>
                                   <th>Question</th>
                                   <th>Month</th>
                                   <th>Type</th>
                                   <th>Expiry date vote</th>
                                   <th>Expiry date ticket</th>
                                   <th>Winner film</th>
                                   <th>Allow update</th>
                                   <th>Analytics</th>
                                   <th>Created_at</th>
                                   <th>Option</th>
                               </tr>
                            </thead>
                            <tbody>
                            @foreach($getValues as $getValue)
                                <tr>
                                    <td>{{$getValue->id}}</td>
                                    <td><a href="javascript:void(0)" id="{{$getValue->id}}">{{$getValue->question}}</a></td>
                                    <td>{{$getValue->month}}</td>
                                    <td>@if ($getValue->type == 1)
                                            {{"Choice singular"}}
                                        @else
                                            {{"Choice plular"}}
                                        @endif</td>
                                    <td>{{$getValue->expiry_date}}</td>
                                    <td>{{$getValue->expiry_date_ticket}}</td>
                                    <td>{{optional( $getValue->vote_values)->name}}</td>
                                    <td>
                                        @if($getValue->allow_update == 1)
                                           {{'Yes'}}
                                        @else
                                           {{'No'}}
                                        @endif
                                    </td>
                                    <td>{{optional($getValue->vote_values)->vote_count}}</td>
                                    <td>{{$getValue->created_at}}</td>
                                    <td>
                                        <a href="javascript:void (0)" class="" data-toggle="modal" data-target="#myModal-{{$getValue->id}}" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a> |
                                        <a href="{{route('admin.votes.destroy',$getValue->id)}}" onclick=" return confirm('Are you sure to delete this item?');" title="Delete">
                                            <i class="fa fa-dropbox"></i>
                                        </a>
                                    </td>
                                </tr>

                                <div class="modal fade" id="myModal-{{$getValue->id}}" role="dialog" >
                                    <form id="FormCinemas" action="{{route('admin.votes.update',$getValue->id)}}" method="POST" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <input type="hidden" id="id" name="id" value="{{$getValue->id}}">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title titleOK">Edit votes</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="usr">Question:</label>
                                                        <input type="text" name="question" value="{{$getValue->question}}" placeholder="Question..." required class="form-control" id="question">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Type</label>
                                                        <select class="form-control" name="type" id="type">
                                                            @if($getValue->type == 1)
                                                            <option selected value="1">Choice singular</option>
                                                            <option value="2">Choice plural</option>
                                                                @else
                                                                <option  value="1">Choice singular</option>
                                                                <option selected value="2">Choice plural</option>
                                                                @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Month</label>
                                                        <select class="form-control" name="month" id="month">
                                                            @php
                                                                $months = array(1 => 'January.', 2 => 'February.', 3 => 'March.', 4 => 'April.', 5 => 'May',
                                                                 6 => 'June.', 7 => 'July.', 8 => 'August.', 9 => 'September.',
                                                                  10 => 'October.', 11 => 'November.', 12 => 'December.');
                                                            @endphp
                                                            @foreach($months as $month=>$Value)
                                                                @php
                                                                    $selected='';
                                                                    if($month==$getValue->month){
                                                                        $selected='selected="selected"';
                                                                    }
                                                                @endphp
                                                            <option {{$selected}} value="{{$month}}">{{$Value}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Allow update</label>
                                                        <select class="form-control" name="allow_update" id="allow_update">
                                                            @if($getValue->allow_update == 1)
                                                            <option selected value="1">Yes</option>
                                                            <option value="0">No</option>
                                                                @else
                                                                <option  value="1">Yes</option>
                                                                <option selected value="0">No</option>
                                                                @endif
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usr">Expiry date vote:</label>
                                                        <input type="datetime-local" value="{{date('Y-m-d\TH:i:s',strtotime($getValue->expiry_date))}}" name="expiry_date" required class="form-control" id="expiry_date">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="usr">Expiry date ticket:</label>
                                                        <input type="datetime-local" value="{{date('Y-m-d\TH:i:s',strtotime($getValue->expiry_date_ticket))}}" name="expiry_date_ticket" required class="form-control" id="expiry_date_ticket">
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
                    <div id="ajax"></div>
            </div>
            <!-- /.col -->
        </div>
        {{--<!-- /.row -->--}}
    </section>
    <!-- /.content -->
</div>
@stop