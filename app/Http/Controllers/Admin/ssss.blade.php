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
            @php $i=1; @endphp
            @while ($k <= $getMaxRows)
                @php
                    $sp = (array)explode(',',$ajaxShowSeat->space);
                    $alphabet = $ajaxShowSeat->alphabet.$k;
                @endphp
                    <td>{{$i++}}</td>
            @endwhile
        </tr>
        {{--show seat--}}
        @foreach($ajaxShowSeats as $ajaxShowSeat)
            <tr>
                <td>{{$ajaxShowSeat->alphabet}}</td>
                @php
                    $check = 0;
                    $k = 1; // Seat index value
                    $j = 1; // Cell index
                @endphp

                @while ($k <= $ajaxShowSeat->rnumber)
                    @php
                    $haystack = (array)explode(',',$ajaxShowSeat->space);
                    $space = $ajaxShowSeat->alphabet.$j;
                    $count =count($haystack);
                    @endphp


                    {{-- @for($j=1;$j<=$ajaxShowSeat->rnumber;$j++)
                        @php
                        $haystack = (array)explode(',',$ajaxShowSeat->space);
                        $space = $ajaxShowSeat->alphabet.$j;
                        $count =count($haystack);
                        @endphp --}}


                    @if(in_array($space, $haystack)) {{-- Has space in current cell--}}

                        {{-- Leave empty cell --}}
                        <td></td>

                        {{-- @if($check == 0)
                            @if($count == 9)
                                <td></td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                            <td>
                                <input type="checkbox" class="seats" value="{{$ajaxShowSeat->alphabet}}{{$k}}">
                            </td>
                            @php $check++ @endphp
                        @else
                            <td>
                                <input type="checkbox" class="seats" value="{{$ajaxShowSeat->alphabet}}{{$k}}">
                            </td>
                        @endif --}}

                    @else {{-- Has seat in current cell--}}

                        {{-- Put the seat here with checkbox --}}
                        <td>
                            <input type="checkbox"
                                class="seats"
                                value="{{$ajaxShowSeat->alphabet . $k}}">
                        </td>
                        @php
                            $k++; // increase $k by 1 for the next seat
                        @endphp
                    @endif

                    @php
                        $j++; // increase $j by 1 for the next cell
                    @endphp
                {{-- @endfor --}}
                @endwhile
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
    <button onclick="updateTextArea()">Confirm Selection</button>
</div>