@extends('layouts.master')
@section('pageTitle', 'Posts')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Post
            <small>Admin LTE</small>
            @if (session('status'))
                <script>

                    function setCookie(key, value) {
                        var expires = new Date();
                        expires.setTime(expires.getTime() + (1 * 24 * 60 * 60 * 1000));
                        document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
                    }

                    function getCookie(key) {
                        var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
                        return keyValue ? keyValue[2] : null;
                    }


                    var getMonth = "{{@$getTimeShowPopup->expiry_date}}";
                    var  getTimeTicket ="{{@$getTimeShowPopup->expiry_date_ticket}}";


                    if(getMonth != null){
                        var countDownDate = new Date(getMonth).getTime();
                        var countDownDateTicket = new Date(getTimeTicket).getTime();
                        var now2 = new Date().getTime();
                        var x = setInterval(function() {

                            var now = new Date().getTime();

                            var distance = countDownDate - now;
                            var distance2 = countDownDateTicket - now2;

                            if (distance > 0) {
                                $('#myModals').modal('show');
                            }
                            else {
                                $('#myModals').modal('hide');
                                if (distance2 > 0){
                                    $('#myModalsTicket').modal('show');
                                }
                                else {
                                    $('#myModalsTicket').modal('hide');
                                    $('.not').on('click',function () {
                                        setCookie('not',1);
                                    });
                                    if(!getCookie('not')){
                                        $('#myModalsRandom').modal('show');
                                    }
                                    else {
                                        $('#myModalsRandom').modal('hide');
                                    }
                                }

                            }


                        }, 1000);
                    }
                    // ticket

                    // clearInterval(x);
                    // $('#myModalsTicket').modal('show');
                    // if(getTimeTicket != null){
                    //     var countDownDateTicket = new Date(getMonth).getTime();
                    //     var y = setInterval(function() {
                    //         var now2 = new Date().getTime();
                    //         var distance2 = countDownDateTicket - now2;
                    //         if (distance2 < 0) {
                    //             clearInterval(y);
                    //             $('.not').on('click',function () {
                    //                 setCookie('not',1);
                    //             });
                    //             if(!getCookie('not')){
                    //                 $('#myModalsRandom').modal('show');
                    //             }
                    //             $('#myModalsTicket').modal('hide');
                    //
                    //
                    //
                    //         }
                    //
                    //     }, 1000);
                    // }
                </script>
            @endif
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Tables</a></li>
            <li class="active">Posts</li>
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
                            <h4>Note!</h4>
                           <p> {{Session::get('msg')}}</p>
                        </div>
                @endif

                    <!-- Trigger the modal with a button -->
                        @permission(('create_post'))
                    <a href="{{route('admin.posts.create')}}" style="color: white; float: right ">
                    <button type="button" class="btn btn-info btn-lg ">
                      New post
                    </button>
                    </a>
                    @endpermission
                </div>
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">All</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table id="example1" class="table table-bordered table-striped text-center" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>View</th>
                                    <th>Tags</th>
                                    <th>Author</th>
                                    <th>Created_at</th>
                                    <th>Updated_at</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($allPosts as $allPost)
                            <tr>
                                <td>{{$allPost->id}}</td>
                                <td>{{$allPost->title}}</td>
                                <td>{{$allPost->slug}}</td>
                                <td>{{$allPost->view}}</td>
                                <td>@foreach($allPost->tags as $tag)
                                        <label class="label label-info">{{ $tag->name }}</label>
                                    @endforeach</td>
                                <td>{{$allPost->users->name}}</td>
                                <td>{{$allPost->created_at}}</td>
                                <td>{{$allPost->updated_at}}</td>
                                <td>
                                    <a href="{{route('admin.posts.show',$allPost->id)}}" title="View">
                                        <i class="fa fa-send"></i>
                                    </a>
                                    @ability('superadmin,editor', 'create_post,editor_post,dell_post')
                                    @if(\Illuminate\Support\Facades\Auth::user()->id == $allPost->author_id || Entrust::hasRole('superadmin') )
                                        |
                                    <a href="{{route('admin.posts.edit',$allPost->id)}}" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a> |
                                    @endif
                                    @endpermission
                                    @permission(('dell_post'))
                                    @if(\Illuminate\Support\Facades\Auth::user()->id == $allPost->author_id ||  Entrust::hasRole('superadmin') )
                                    <a href="{{route('admin.posts.destroy',$allPost->id)}}" onclick=" return confirm('Are you sure to delete this item?');" title="Delete">
                                        <i class="fa fa-dropbox"></i>
                                    </a>
                                        @endif
                                    @endpermission
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
        <!-- /.row -->
    </section>
    <!-- /.content -->

    <div class="modal fade" id="myModals" role="dialog">

            <div class="modal-dialog">
                <div class="modal-content">

                    <div class="modal-body">
                       <h1 style="text-align: center">Would you like to vote for a movie?</h1>
                    </div>
                    <div class="modal-footer" style="text-align: center">
                        <a href="{{route('admin.votes.show')}}"><button type="button" class="btn btn-success BTNSubmit BTNcreate">YES</button></a>
                        <button type="submit" onclick="reloadPage()" class="btn btn-danger no" data-dismiss="modal">NO</button>
                    </div>
                </div>

            </div>

    </div>
    <div class="modal fade" id="myModalsTicket" role="dialog">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <h1 style="text-align: center">Would you like to Booking Ticket for a movie?</h1>
                </div>
                <div class="modal-footer" style="text-align: center">
                    <a href="{{route('admin.ticket.index')}}"><button type="button" class="btn btn-success BTNSubmit BTNcreate">YES</button></a>
                    <button type="submit" onclick="reloadPage()" class="btn btn-danger" data-dismiss="modal">NO</button>
                </div>
            </div>

        </div>

    </div>
    <div class="modal fade" id="myModalsRandom" role="dialog">

        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <h1 style="text-align: center">Would you like to get Ticket?</h1>
                    <h1 style="text-align: center; color: #00e765" id="show-seat"></h1>
                </div>
                <div class="modal-footer" style="text-align: center">
                    <button type="button" onclick="random()" class="btn btn-success ko ">YES</button>
                    <button type="submit" onclick="reloadPage()" class="btn btn-danger not" data-dismiss="modal">NO</button>
                </div>
            </div>

        </div>

    </div>
</div>
<script>
    function reloadPage() {
        location.reload();
    }
    function random() {
        var token=$("input[name='_token']").val();
        $.ajax({
            url: '{{route("admin.votes.random")}}',
            type: 'POST',
            data: {"_token":token},
        }).done(function (data) {
           $('#show-seat').append(data);
           $('.ko').css('display','none');
            $('.not').html('<i> Close');
        });
    }
</script>
@stop