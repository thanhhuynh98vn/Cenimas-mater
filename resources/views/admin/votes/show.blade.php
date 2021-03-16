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
    <link rel="stylesheet" href="{{mix('css/show.css')}}">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition login-page" id="login">
<div class="login-box2">
    <form action="" id="register" data-url="" method="get">
        <div class="login-logo">
                <p>Welcome: <span style="text-transform: uppercase" id="id-user" data-id="{{Auth::user()->id}}"> {{\Illuminate\Support\Facades\Auth::user()->name}}</span></p>
            <p>Expiry date: <span id="demo"></span></p>
        </div>
    </form>
</div>
<div class="container">
    <div class="row" id="myDIV">
        @if(!empty($getFims))
        @foreach($getFims as $getItem)
        <div class="col-md-3 col-sm-6 " >
            <div class="items" data-id="{{$getItem->id}}">
                <div class="chill">
                   <img src="/storage/images/{{$getItem->image}}"  >
                    <div class="item-title">
                        <h4><a href="{{$getItem->link}}" title="Link review"><strong>{{$getItem->name}}</strong></a></h4>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
            @endif
   </div>
    @if(!empty($getMonthVotes->allow_update))
    @if($getMonthVotes->allow_update ==1)
    <button type="submit" id="submit" onclick=" return alert('Successfully');" class="btn btn-success">Done</button>
    @endif
    @endif
    <a href="{{route('admin.posts.index')}}"><button type="button" class="btn btn-success" data-dismiss="modal">Back to home</button></a>

    <div class="row">
        <div class="col-md-12">
            <h2 >Top film vote:</h2>
            @php
                $i=1;
            @endphp
            <table>
                <tr style="color: skyblue">
                    <th>Top</th>
                    <th style="text-align: center">Film</th>
                    <th>Votes</th>
                </tr>
                @foreach($datas as $data)
                    <tr>
                        <td >{{$i++}}:</td>
                        <td style="font-weight: bold;">{{$data->name}}</td>
                        <td>{{$data->vote}}</td>
                    </tr>
                @endforeach
            </table>
        </div>

    </div>
    <div style="height: 200px">

    </div>
</div>

<!-- /.login-box -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD4Sl6BCZ3v4ghoA_ltS1RVCnjTk78J43E&libraries=places"
        async defer></script>
<script src="{{mix('js/app.js')}}"></script>
<script src="{{mix('js/show.js')}}"></script>
<script>

    var getMonth = "{{@$getMonthVotes->expiry_date}}";
    if(getMonth != null){
        var countDownDate = new Date(getMonth).getTime();
        var x = setInterval(function() {

            var now = new Date().getTime();

            var distance = countDownDate - now;
            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            var seconds = Math.floor((distance % (1000 * 60)) / 1000);

            document.getElementById("demo").innerHTML = days + "Ngày " + hours + "Giờ "
                + minutes + "Phút " + seconds + "Giây ";

            if (distance < 0) {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "Time out!";
                $('#submit').css('display','none');
                {{--window.location.href = "{{route('admin.ticket.index')}}";--}}
            }
        }, 1000);
    }
</script>

</body>
</html>


