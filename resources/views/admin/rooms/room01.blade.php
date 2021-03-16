<div class="seatStructure txt-center" style="overflow-x:auto;min-width: 1000px;">
    <table id="seatsBlock" style="direction: rtl; display: flex; justify-content: center;">
        <br>
        <p id="notification"></p>
        <div class="screen">
            <h2 class="wthree">Screen this way</h2>
        </div>
        <tr>
            {{--showcell--}}
            <td>A-J</td>
            @php
                $k = 1;
                $i = 1;
                $space_haystack = (array)explode(',',$spaceRoom->space);
            @endphp
            @while ($k <= $getMaxRows)
                @php
                    $found_space = false;
                @endphp
                @foreach ($space_haystack as $item)

                    @if (intval(substr($item, 1)) == $i)
                        @php
                            $found_space = true;
                            break;
                        @endphp
                    @endif
                @endforeach
                @if (!$found_space)
                    <td>{{$k}}</td>
                    @php
                        $k++;
                    @endphp
                @else
                    <td>&nbsp;</td>
                @endif

                @php
                    $i++;
                @endphp
            @endwhile
        </tr>
        {{--show seat--}}
        @foreach($ajaxShowSeats as $ajaxShowSeat)
            <tr>
                <td>{{$ajaxShowSeat->alphabet}}</td>
                <?php $check = 0; ?>
                @for($j=1;$j<=$ajaxShowSeat->rnumber;$j++)
                    @php
                    $haystack = (array)explode(',',$ajaxShowSeat->space);
                    $space = $ajaxShowSeat->alphabet.$j;
                    $count =count($haystack);
                    @endphp

                        @if(in_array($space, $haystack))

                            @if($check == 0)
                                @if($count == 9)
                                <td></td>
                                @else
                                <td></td>
                                <td></td>
                            @endif
                                <td>
                                    <input type="checkbox" class="seats" name="seats" value="{{$ajaxShowSeat->alphabet}}{{$j}}">
                                </td>
                                @php $check++ @endphp
                            @else
                                <td>
                                    <input type="checkbox" class="seats" name="seats" value="{{$ajaxShowSeat->alphabet}}{{$j}}">
                                </td>
                            @endif
                        @else
                        <td>
                            <input type="checkbox" class="seats" name="seats" value="{{$ajaxShowSeat->alphabet}}{{$j}}">
                        </td>
                        @endif
                @endfor
            </tr>
        @endforeach
        <tr>
            <td>Only row K</td>
            @for($i=1;$i<=$getMaxRows;$i++)
                <td>{{$i}}</td>
            @endfor
        </tr>
    </table>
    <br>
    <button id="back" onclick="backfunc()" style="display: none" >Back</button>
    <button id="confirm" onclick="confirm()">Confirm Selection</button>
    <button id="bookingVip"  onclick="bookingVip()">Booking Vip</button>
    <div id="user"style="display: none">
        <select class="form-control" style="height: 36px;" id="user_id" name="user_id">
            <option>-------Users-------</option>
            @foreach($showUsers as $showUser)
                <option value="{{$showUser->uId}}">{{$showUser->name}}</option>
            @endforeach
        </select>
    </div>
    <button id="set" style="display: none">Set</button>
    <button id="save" onclick="updateTextArea()"   style="display: none">Save</button>

</div>
