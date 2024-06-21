@if (!$reserved)
    @if (!$oneCourse->has_general_price && count($oneCourse->prices) && !$check_exist)
        <div class="add_to_cart_section">
            <div class="inner_add_to_cart">
                <ul>
                    @foreach ($oneCourse->prices as $price)
                        <li
                            class="d-flex flex-row {{ $current_specialty ? ($price->id == $current_specialty->id ? 'hv-card' : '') : '' }}">
                            <span>{{ app()->getLocale() == 'en' && $price->specialty ? $price->specialty->name_en : $price->specialty->name_ar }}</span>
                            <div>
                                <span>{{ $price->late_price . ' ' . __('lms.SR') }}</span>
                                @if ($today < $early_date)
                                    <span class="on_hover_info">{{ __('lms.to') }}
                                        {{ date('j F', $early_date) }}
                                    </span>
                                    <button onclick="addToCart('redirect')"
                                        {{ $current_specialty ? ($price->id != $current_specialty->id ? 'disabled' : '') : 'disabled' }}>
                                        {{ __('global.book_now') }}
                                        {{ $price->early_price . ' ' . __('lms.SR') }}
                                    </button>
                                @endif
                                @if (isset($end_register_date) && $today < $end_register_date && $today > $early_date)
                                    <button onclick="addToCart('redirect')"
                                        {{ $current_specialty ? ($price->id != $current_specialty->id ? 'disabled' : '') : 'disabled' }}>
                                        {{ __('global.book_now') }}
                                        {{ $price->late_price . ' ' . __('lms.SR') }}
                                    </button>
                                @endif
                            </div>
                        </li>
                    @endforeach


                </ul>
            </div>
            @if (empty($check_cart) && $current_specialty)
                <button class="add_to_cart_button" onclick="addToCart('open')">
                    {{ __('global.add_to_cart') }}
                </button>
            @endif
        </div>
        {{-- @elseif(auth()->check())
                <div class="offer-type offer-type-nd col-2 p-1 mt-2">
                    <a href="{{url(app()->getLocale() . '/my_invoices')}}">
                        <strong>{{ __('lms.goto_invoices') }}</strong>
                    </a>

                </div> --}}
    @endif
@endif
