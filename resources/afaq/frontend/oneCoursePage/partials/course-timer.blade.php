{{--<div class="reservation_time">--}}
{{--    <p id="timerText">--}}
{{--        {{ __('global.few_left_until_the_booking_date') }}--}}
{{--    </p>--}}
{{--    <div class="booking_timer">--}}
{{--        <ul>--}}
{{--            <li>--}}
{{--                <div class="timer_number" id="days">0</div>--}}
{{--                <p class="timer_indicator">{{ __('global.day') }}</p>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <div class="timer_number" id="hours">0</div>--}}
{{--                <p class="timer_indicator">{{ __('global.hour') }}</p>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <div class="timer_number" id="minutes">0</div>--}}
{{--                <p class="timer_indicator">{{ __('global.minute') }}</p>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <div class="timer_number" id="seconds">0</div>--}}
{{--                <p class="timer_indicator">{{ __('global.second') }}</p>--}}
{{--            </li>--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--</div>--}}


<div class="col-12">
    <div class="col-10 offset-1">
{{--        @if(strtotime($oneCourse->end_register_date) > strtotime($now))--}}{{--Pending on issue 199 changed to start date--}}
        @if(strtotime($oneCourse->start_date) > strtotime($now))
        <div class="cours-time_ ">
            <span id="timerText">{{__('afaq.course_after')}}</span>
            <div class="sourse-count-live d-flex align-items-center justify-content-center">
                <div class="time-out_">
                    <span id="days">0 </span>
                    <em>{{__('global.day')}}</em>
                </div>
                <div class="time-out_">
                    <span id="hours">0 </span>
                    <em>{{__('global.hour')}}</em>
                </div>
                <div class="time-out_">
                    <span id="minutes"> 0</span>
                    <em>{{__('global.minute')}}</em>
                </div>

            </div>
        </div>
        @endif
        <!-- <p id="demo"></p> -->
    </div>
</div>
