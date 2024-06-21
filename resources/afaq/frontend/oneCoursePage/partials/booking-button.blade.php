<div class="flex_booking_button">
    @if (!$reserved)
        <button onclick="addToCart('redirect')">
            {{ __('global.book_now') }}
            @if ($oneCourse->today_price)
                {{ $oneCourse->today_price . ' ' . __('lms.SR') }}
            @elseif($oneCourse->has_general_price && $oneCourse->price > 0)
                {{ $oneCourse->price . ' ' . __('lms.SR') }}
            @elseif(count($oneCourse->prices) && !$oneCourse->has_general_price)
                {{ __('lms.different_prices') }}
            @else
                {{ __('lms.free') }}
            @endif
        </button>
    @else
        <button onclick="$('#course_content-tab').click()">
            {{ __('global.go_course_detials') }} </button>
    @endif
</div>
