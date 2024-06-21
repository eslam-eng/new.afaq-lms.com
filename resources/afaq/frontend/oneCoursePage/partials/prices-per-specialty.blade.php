{{-- @if (!$reserved) --}}
{{--    @if (!$oneCourse->has_general_price && count($oneCourse->prices) && !$check_exist) --}}
{{--        <div class="add_to_cart_section"> --}}
{{--            <div class="inner_add_to_cart"> --}}
{{--                <ul> --}}
{{--                    @foreach ($oneCourse->prices as $price) --}}
{{--                        <li --}}
{{--                            class="d-flex flex-row {{ $current_specialty ? ($price->id == $current_specialty->id ? 'hv-card' : '') : '' }}"> --}}
{{--                            <span>{{ app()->getLocale() == 'en' && $price->specialty ? $price->specialty->name_en : $price->specialty->name_ar }}</span> --}}
{{--                            <div> --}}
{{--                                <span>{{ $price->late_price . ' ' . __('lms.SR') }}</span> --}}
{{--                                @if ($today < $early_date) --}}
{{--                                    <span class="on_hover_info">{{ __('lms.to') }} --}}
{{--                                        {{ date('j F', $early_date) }} --}}
{{--                                    </span> --}}
{{--                                    <button onclick="addToCart('redirect')" --}}
{{--                                        {{ $current_specialty ? ($price->id != $current_specialty->id ? 'disabled' : '') : '' }}> --}}
{{--                                        {{ __('global.book_now') }} --}}
{{--                                        {{ $price->early_price . ' ' . __('lms.SR') }} --}}
{{--                                    </button> --}}
{{--                                @endif --}}
{{--                                @if (isset($end_register_date) && $today < $end_register_date && $today > $early_date) --}}
{{--                                    <button onclick="addToCart('redirect')" --}}
{{--                                        {{ $current_specialty ? ($price->id != $current_specialty->id ? 'disabled' : '') : '' }}> --}}
{{--                                        {{ __('global.book_now') }} --}}
{{--                                        {{ $price->late_price . ' ' . __('lms.SR') }} --}}
{{--                                    </button> --}}
{{--                                @endif --}}
{{--                            </div> --}}
{{--                        </li> --}}
{{--                    @endforeach --}}


{{--                </ul> --}}
{{--            </div> --}}
{{--            @if (!empty($check_cart)) --}}
{{--                <button class="add_to_cart_button" onclick="addToCart('open')"> --}}
{{--                    {{ __('global.add_to_cart') }} --}}
{{--                </button> --}}
{{--            @endif --}}
{{--        </div> --}}

{{--    @endif --}}
{{-- @endif --}}

@if (!$reserved)
    @if (!$oneCourse->has_general_price && count($oneCourse->prices) && !$check_exist)
        <div class="Introduction-What-learn">
            <div class="icons">
                <span class="small-icon">
                    <i class="fa-solid fa-circle"></i>
                </span>
                <span class="big-icon">
                    <i class="fa-solid fa-circle"></i>
                </span>
            </div>
            <strong> {{ __('global.bookprice') }} </strong>
        </div>
        <div class="Specialist-table d-flex owl-carousel lms {{ $current_specialty ? 'hv-card' : '' }}">

            @foreach ($oneCourse->prices as $price)
                <div
                    class="Nursing-And-Off box_lms  {{ $current_specialty ? ($price->id == $current_specialty->id ? 'hv-card' : '') : '' }} ">
                    <span>
                        {{ app()->getLocale() == 'en' && $price->specialty ? $price->specialty->name_en : $price->specialty->name_ar }}
                    </span>


                    <del>
                        @if ($today < $early_date)
                            {{ $price->late_price . ' ' . __('lms.SR') }}
                        @endif
                    </del>

                    {{--        {{dd($early_date)}} --}}
                    <div class="new-price-lms">
                        @if ($today < $early_date)
                            <em class="date">Available {{ __('lms.to') }} {{ date('j F', $early_date) }}</em>

                            <span class="new-price-avilable {{ !auth()->check() ? 'active' : '' }} {{  $current_specialty ? ($price->id == $current_specialty->id ? 'active' : '') : ''}} "
                            @if ($current_specialty && $price->id == $current_specialty->id)
                                    onclick="addToCart('redirect')"
                                @else
                                @if (auth()->check())
                                    disabled
                                @else
                                    onclick="addToCart('redirect')" @endif
                                @endif
                        >
                        {{ __('global.book_now') }}
                        {{ $price->early_price . ' ' . __('lms.SR') }}
                        </span>
            @endif
            {{--            <span class="new-price-avilable"> --}}
            {{--                                                Book Now for --}}
            {{--                29$ --}}
            {{--                                            </span> --}}
            @if (isset($end_register_date) && $today < $end_register_date && $today > $early_date)

                <span class="new-price-avilable {{ !auth()->check() ? 'active' : '' }}"
                    @if ($current_specialty && $price->id == $current_specialty->id)
                    onclick="addToCart('redirect')"
                    @else
                     @if (auth()->check())
                     disabled
                     @else
                     onclick="addToCart('redirect')" @endif
                    @endif
            >
            {{ __('global.book_now') }}
            {{ $price->late_price . ' ' . __('lms.SR') }}
            </span>
    @endif
    </div>
    </div>
@endforeach
{{-- @if (!empty($check_cart)) --}}
{{--    <button class="add_to_cart_button" onclick="addToCart('open')"> --}}
{{--        {{ __('global.add_to_cart') }} --}}
{{--    </button> --}}
{{--    @endif --}}
</div>

@endif
@endif
