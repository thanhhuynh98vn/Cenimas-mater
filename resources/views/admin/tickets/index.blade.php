<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Vote Fims {{now()->month}} Month </title>
    <link rel="icon" href="/hello.jpg" type="image/gif" sizes="16x16">

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{mix('css/app.css')}}">
    <link rel="stylesheet" href="{{mix('css/ticket.css')}}">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

</head>

<body class="hold-transition login-page" id="login">
<div class="login-box2">
    <form action="" id="register" data-url="" method="get">
        <div class="login-logo">
                <p>Welcome: <span style="text-transform: uppercase" id="id-user" data-id="{{Auth::user()->id}}"> {{\Illuminate\Support\Facades\Auth::user()->name}}</span></p>
        </div>
    </form>
</div>
<div class="container">
    <!-- Trigger the modal with a button -->
    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Random your ticket</h4>
                </div>
                <div class="modal-body">
                    <form>
                        <button type="button" class="btn btn-primary">Start random</button>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

</div>
<div class="container">
    <div class="row" id="myDIV">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{@$getFimTicket->name}}</h3>
                <h4>{{(date('H:i d/m/Y',strtotime(@$getFimTicket->start_time)))}}</h4>
                <h4>{{@$getFimTicket->address}}</h4>
                <input type="hidden" class="id-film" value="{{@$getFimTicket->id}}">
                <input type="hidden" id="booking-seat" name="booking_seat" value="{{@$getFimTicket->booking_seat}}">
                <h3 style="display:inline;">Total ticket: </h3><H3  style="display:inline;"  class="total"></H3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example1" class="table table-bordered table-striped text-center" >
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full name</th>
                        <th>Ticket</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($listUsers as $listUser)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$listUser->name}}</td>
                            <td  class="id-user" data-id="{{$listUser->id}}">
                                @if(empty($getFimTicket->booking_seat))
                                <input type="text" name="quantity" value=
                                            @if(!empty($listUser->tickets[0]->quantity))
                                               "{{$listUser->tickets[0]->quantity}}"
                                               @else
                                              "{{0}}"
                                               @endif
                                         class="form-control quantity">
                                    @else
                                        <input type="text" name="quantity" readonly value=
                                        @if(!empty($listUser->tickets[0]->quantity))
                                                "{{$listUser->tickets[0]->quantity}}"
                                        @else
                                            "{{0}}"
                                        @endif
                                        class="form-control quantity">
                                        <input type="text" readonly value="">
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
   </div>
    <a href="{{route('admin.posts.index')}}"><button type="button" class="btn btn-success" data-dismiss="modal">Back to home</button></a>

    <div style="height: 200px">

    </div>
</div>

<!-- /.login-box -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4Sl6BCZ3v4ghoA_ltS1RVCnjTk78J43E&libraries=places"
        async defer></script>

<script src="{{mix('js/app.js')}}"></script>
<script src="{{mix('js/ticket.js')}}"></script>
</body>
</html>


