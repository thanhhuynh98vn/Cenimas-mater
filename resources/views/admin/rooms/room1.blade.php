<!--
	Author: W3layouts
	Author URL: http://w3layouts.com
	License: Creative Commons Attribution 3.0 Unported
	License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Movie Seat Selection </title>
    <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Movie Seat Selection a Responsive Web Template, Bootstrap Web Templates, Flat Web Templates, Android Compatible Web Template, Smartphone Compatible Web Template, Free Webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola Web Design">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->
    <!-- Index-Page-CSS -->
    <link rel="stylesheet" href="/movie/css/style.css" type="text/css" media="all">
    <!-- //Custom-Stylesheet-Links -->
    <!--fonts -->
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
    <!-- //fonts -->
    <style>
        input[type=checkbox].vip:checked:before, input[type=checkbox].vip:before{
            background-color: red;
        }
    </style>
</head>

<body onload="onLoaderFunc()">
    <h1>Movie Seat Selection</h1>

    <div class="container">

        <div class="w3ls-reg">
            <!-- input fields -->
            <div class="inputForm">
                <h2 style="font-size: 30px">{{@$getFimTop->name}}</h2>
                <input type="hidden" name="id_film" value="{{@$getFimTop->id}}">
                <div class="mr_agilemain">
                    <div class="agileits-left">
                        <label> Room </label>
                            <select class="form-control" id="rooms" name="rooms">
                                <option>---Rooms---</option>
                                @foreach($showRooms as $showRoom)
                                <option value="{{$showRoom->id}}">{{$showRoom->name}}</option>
                                @endforeach
                            </select>

                    </div>
                    <div class="agileits-right">
                    </div>
                </div>
                {{--<button onclick="takeData()">Start Selecting</button>--}}
            </div>
            <!-- //input fields -->
            <!-- seat availabilty list -->
            <ul class="seat_w3ls">
                <li class="smallBox greenBox">Selected Seat</li>
                <li class="smallBox redBox">Vip Seat</li>
                <li class="smallBox emptyBox">Empty Seat</li>
            </ul>
            <div>
                <a href="{{route('admin.posts.index')}}"><button>Back to home</button></a>
            </div>
            <!-- seat availabilty list -->
            <!-- seat layout -->
            <div id="no">

            </div>

            <div class="displayerBoxes txt-center" style="overflow-x:auto;">
                <table class="Displaytable w3ls-table" width="100%">
                    <tr>
                        <th id="seat-id" >Number of Seats</th>
                        <th id="sas">Seats</th>
                    </tr>
                    <tr>
                        <td>
                            <textarea rows="3" id="NumberDisplay"></textarea>
                        </td>
                        <td>
                            <textarea rows="3" cols="110"  id="seatsDisplay"></textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <!-- //details after booking displayed here -->
        </div>
    </div>
    <div class="copy-wthree">

    </div>
    <!-- js -->
    <script src="/movie/js/jquery-2.2.3.min.js"></script>
    <!-- //js -->
    <!-- script for seat selection -->
    <script>
        $(document).on('change','#rooms',function () {
            var room_id = $(this).val();
            var film_id = $("input[name='id_film']").val();

            var token=$("input[name='_token']").val();

            $.ajax({
                url: '{{route('admin.rooms.room')}}',
                type: 'POST',
                dataType: 'json',
                data: {"_token":token,room_id: room_id},
            }).done(function(data) {
                    $("#no").html(data.html);

                $.ajax({
                    url: '{{route('admin.rooms.room2')}}',
                    type: 'POST',
                    dataType: 'json',
                    data: {"_token":token,room_id: room_id,film_id:film_id},
                }).done(function(data) {
                    data.forEach( function(element, valua) {
                        $('.seats').each(function(){
                            var te= $(this).val();
                            if ((te == element.name )){
                                $(this).prop('checked',true);
                                if(element.user_id){
                                    $(this).addClass('vip');
                                }
                            }
                        });
                    });
                });
                });
        });

        function updateTextArea() {
            if ($("input:checked").length >0 ) {


                var allNumberVals = [];
                var allSeatsVals = [];

                //Storing in Array
                allNumberVals.push($("input:checked").length);
                $('#seatsBlock :checked').each(function () {
                    allSeatsVals.push($(this).val());
                });

                //Displaying 
                $('#NumberDisplay').val(allNumberVals);
                $('#seatsDisplay').val(allSeatsVals);


                var token=$("input[name='_token']").val();
                var id_film = $("input[name='id_film']").val();
                var room_id = $( "#rooms" ).val();

                $.ajax({
                    url: '{{route('admin.vote_value.bookingSeat')}}',
                    type: 'POST',
                    dataType: 'json',
                    data: {"_token":token, allSeatsVals: allSeatsVals, id_film:id_film, room_id:room_id },
                }).done(function(data) {

                    });
                alert('Done save!');
            } else {
                alert("Please select seats");
            }
        }
        function confirm() {
            $('#save').css('display','inline');
            $('#back').css('display','inline');
            $('#confirm').css('display','none');
            $('#bookingVip').css('display','none');

        }
        function bookingVip() {
            $('#confirm').css('display','none');
            $('#back').css('display','inline');
            $('#set').css('display','inline');
            $('#bookingVip').css('display','none');
            $("input:not(:checked)").prop('disabled', true);
            $('#user').css('display','inline');

            $(document).on('click','.seats',function () {

                if($(this).hasClass('vip')){
                    $(this).removeClass('vip');
                }else {
                    $(this).addClass('vip');
                }
            });
            // $( "[type=checkbox]" ).each(function () {
            //
            //     if ($(this).hasClass('vip')) {
            //         $(this).prop('disabled', true);
            //
            //     }
            // });

        }

        $(document).on('click','#set',function () {
            var user_id =$('#user_id').val();
            var room_id =$('#rooms').val();
            var film_id = $("input[name='id_film']").val();
            var token=$("input[name='_token']").val();
            $("input:not(:checked)").prop('disabled', true);

            var seatVip = [];
            $('input:not(:checked)').each(function () {

                 if ($(this).hasClass('vip')) {
                    seatVip.push($(this).val());
                 }
            });

            $.ajax({
                url: '{{route('admin.vote_value.bookingVip')}}',
                type: 'POST',
                dataType: 'json',
                data: {"_token":token,user_id: user_id,seatVip:seatVip,film_id:film_id,room_id:room_id},
            }).done(function(data) {
                if (data.status == false) {
                    alert('Số lượng ghế set vược quá số lượng user đăng ký');
                }else {
                    alert('Done set!');
                }

            }).fail(function (data) {
                console.log(data.error);
            });

        });
        function backfunc() {
            $('#confirm').css('display','inline');
            $('#back').css('display','none');
            $('#save').css('display','none');
            $('#set').css('display','none');
            $('#bookingVip').css('display','inline');
            $("input:not(:checked)").prop('disabled', false);
            $('#user').css('display','none');
            // $("input:checked").removeClass('vip');
            $(document).on('click','.seats',function () {

                $(this).removeClass('vip');
            });
            $('.vip').prop('disabled', true);
        }
    </script>
    <!-- //script for seat selection -->

</body>

</html>