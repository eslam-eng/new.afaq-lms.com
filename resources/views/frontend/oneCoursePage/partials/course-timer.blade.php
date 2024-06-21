<div class="reservation_time">
    <p id="timerText">
        {{ __('global.few_left_until_the_booking_date') }}
    </p>
    <div class="booking_timer">
        <ul>
            <li>
                <div class="timer_number" id="days">0</div>
                <p class="timer_indicator">{{ __('global.day') }}</p>
            </li>
            <li>
                <div class="timer_number" id="hours">0</div>
                <p class="timer_indicator">{{ __('global.hour') }}</p>
            </li>
            <li>
                <div class="timer_number" id="minutes">0</div>
                <p class="timer_indicator">{{ __('global.minute') }}</p>
            </li>
            <li>
                <div class="timer_number" id="seconds">0</div>
                <p class="timer_indicator">{{ __('global.second') }}</p>
            </li>
        </ul>
    </div>
</div>
