@extends('frontend.business.layout.main')
@section('content')
    <div class="own-package-text ">
        <div class="container">
            <strong>{{ __('afaq.customise_own_package') }} </strong>
            <span>
                  <a href="{{ url(app()->getLocale() . '/customize-now') }}">{{ __('afaq.customise_now2') }}</a>
            </span>
        </div>
    </div>
    <section class="inner-page pxa inner-pxa">
        <div class="container">
            <div class="Ready-To-Start">
                <strong>{{ __('afaq.ready_to_start') }} <a href="">{{ __('afaq.afaq_business') }}</a> </strong>

            </div>

        </div>

    </section>
    {{-- <div class="work-time busn-details">
        <div class="container">
            <div class="the-work-time">
                <span class="Monthly active" id="Monthly" onclick="price_monthly()">{{ __('afaq.Monthly') }}</span>
                <span class="Yearly " id="Yearly" onclick="price_yearly()">{{ __('afaq.Yearly') }}</span>
            </div>
        </div>
    </div> --}}
    <section class="appropriate-package ">
        <div class="work-type-sec tts">

            <div class="container pk-style">
                <div class="package-row appropriate-package-afaq ">
                    @foreach ($BusinessPackages as $k1 => $v1)
                        <div class="col-package-page">

                            <div
                                class="@switch($loop->index)
                    @case(0)
                        for-sec-inner-package
                        @break
                    @case(1)
                        one-sec-inner-package
                        @break
                    @case(2)
                        two-sec-inner-package
                        @break
                    @case(3)
                        thr-sec-inner-package
                        @break
                    @default
                    one-sec-package
                @endswitch  all-packages inner-packge ">
                                <div class="package-details-title">
                                    <span>
                                        {{ app()->getLocale() == 'en' ? $v1->package_name_en : $v1->package_name_ar }}
                                    </span>
                                    <div class="packages-count month">
                                        <div class="packg-amount">
{{--                                            @if ($v1->price_package_month == 0)--}}
{{--                                                <em class="count-num">--}}
{{--                                                    {{ __('afaq.packages_free') }}</em>--}}
{{--                                            @else--}}
{{--                                                <em class="count-num">{{ $v1->package_month_price_offers ?? $v1->price_package_month }}</em>--}}
{{--                                                <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                                --}}{{-- <em class="count-date">{{ __('afaq.packages/mon') }} </em> --}}
{{--                                            @endif--}}
                                            <em class="count-num">
                                                {{ __('afaq.request_free_offer') }}</em>
                                        </div>
{{--                                        @if ($v1->package_month_price_offers)--}}
{{--                                            <div class="del-">--}}
{{--                                                <del>{{ $v1->price_package_month }}</del>--}}
{{--                                                <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                            </div>--}}
{{--                                        @endif--}}
{{--                                      --}}

                                    </div>

                                    <div class="packages-count year" style="display: none">
                                        <div class="packg-amount">
{{--                                            @if ($v1->price_package_annual == 0)--}}
{{--                                                <em class="count-num">--}}
{{--                                                    {{ __('afaq.packages_free') }}</em>--}}
{{--                                            @else--}}
{{--                                                <em class="count-num">{{ $v1->package_annual_price_offers }}</em>--}}
{{--                                                <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                                --}}{{-- <em class="count-date">{{ __('afaq.packages/year') }} </em> --}}
{{--                                            @endif--}}
{{--                                            @if ($v1->package_annual_price_offers)--}}
{{--                                                <div class="del-">--}}
{{--                                                    <del>{{ $v1->price_package_annual }}</del>--}}
{{--                                                    <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
                                            <em class="count-num">
                                                {{ __('afaq.request_free_offer') }}</em>
                                        </div>

                                    </div>



                                </div>
                                <div class="pal-inner">
                                    <div class="Advantages">
                                        <span>{{__('afaq.advantages')}}</span>
                                    </div>
                                    <div class="he-packages">
                                        {{--                                    @if ($v1->online) --}}
                                        @if ($loop->index == 0)
                                            @php
                                                $keys = array_keys($v1->toArray());
                                            @endphp
                                        @endif
                                        @foreach ($keys as $key)
                                            @if (
                                                !in_array($key, [
                                                    'id',
                                                    'package_name_en',
                                                    'package_name_ar',
                                                    'price_package_annual',
                                                    'package_annual_price_offers',
                                                    'price_package_month',
                                                    'package_month_price_offers',
                                                    'event_number_days',
                                                    'event_number',
                                                    'speakers_number',
                                                    'attendance_trainees_number',
                                                    'remote_trainees_number',
                                                    'created_at',
                                                    'updated_at',
                                                ]))
                                                @if ($BusinessPackages[$k1][$key] == 1)
                                                    <div class="packages-details pt-1 pb-1">
                                                        <em class="package-mark"><i
                                                                class="fa-solid fa-circle-check"></i></em>
                                                        <span
                                                            class="package-type">{{ __('cruds.businessPackage.fields.' . $key) }}</span>

                                                    </div>
                                                @endif
                                            @endif
                                        @endforeach
                                        {{--                                    @endif --}}

                                        {{--                                        @if ($v1->onsite == 1) --}}
                                        {{--                                            <div class="packages-details pt-1 pb-1"> --}}
                                        {{--                                                <span class="package-type">{{ trans('cruds.businessPackage.fields.onsite') }}</span> --}}
                                        {{--                                                <em class="package-mark"><i class="fa-solid fa-circle-check"></i></em> --}}
                                        {{--                                            </div> --}}
                                        {{--                                        @endif --}}


                                        {{--                                        @if ($v1->hybrid == 1) --}}
                                        {{--                                            <div class="packages-details pt-1 pb-1"> --}}
                                        {{--                                                <span class="package-type">{{ trans('cruds.businessPackage.fields.hybrid') }}</span> --}}
                                        {{--                                                <em class="package-mark"><i class="fa-solid fa-circle-check"></i></em> --}}
                                        {{--                                            </div> --}}
                                        {{--                                        @endif --}}
                                    </div>
{{--                                    @if (!auth()->check())--}}
{{--                                        <a href="{{ url(app()->getLocale() . '/new_login') }}">--}}
{{--                                            --}}{{--    <button class="Choose-plan">{{ __('afaq.Choose_plan') }}</button> --}}
{{--                                            <button--}}
{{--                                                class="Choose-plan">{{ $v1->price_package_month == 0 ? __('afaq.Try_Now') : __('afaq.Choose_plan') }}</button>--}}
{{--                                            <button class="Choose-plan">{{ __('afaq.customise_now') }}</button>--}}

{{--                                        </a>--}}
{{--                                    @else--}}
{{--                                        <a class="go-payment"--}}
{{--                                            data-url="{{ url(app()->getLocale() . '/business-payment/package_id?package_id=' . $v1->id) }}"--}}
{{--                                            href="{{ url(app()->getLocale() . '/business-payment/package_id?package_id=' . $v1->id . '&type=month') }}">--}}
                                                <a  href="{{ url(app()->getLocale() . '/customize-now') }}">

        {{--                                            <button--}}
        {{--                                                class="Choose-plan">{{ $v1->price_package_month == 0 ? __('afaq.Try_Now') : __('afaq.Choose_plan') }}</button>--}}
                                                    <button class="Choose-plan">{{ __('afaq.customise_now') }}</button>
                                                </a>
{{--                                    @endif--}}
                                </div>
                            </div>
                        </div>
                    @endforeach



                </div>

                {{-- <div class="some-details-appropriate-package on-web">
                    <label for="">
                        <img src="{{ asset('afaq\business/imgs/circle-exclamation-solid.svg') }}" alt="">
                        {{ __('afaq.packages_VAT') }}
                    </label>
                    <label for="">
                        <img src="{{ asset('afaq\business/imgs/circle-exclamation-solid.svg') }}" alt="">
                        {{__('afaq.packages_prices_valid_until')}}
                    </label>
                </div> --}}
                <div class="all-appropriate-package">
                    <a href="{{ url(app()->getLocale() . '/business-own_package') }}">
                        <span>{{ __('afaq.full_edition_comparison') }}</span>
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </a>
                </div>
                <div class="try-buy mt-2 mb-3">
{{--                    @if (auth()->check())--}}
{{--                        <a href="{{ url(app()->getLocale() . '/business-payment/package_id?package_id=' . 4) }}">--}}

{{--                            <button class="try-now">{{ __('afaq.Try_Now') }}--}}
{{--                            </button>--}}
{{--                        </a>--}}
                        <a  href="{{ url(app()->getLocale() . '/customize-now') }}">
                            <button class="try-now">{{ __('afaq.customise_now2') }}</button>
                        </a>
{{--                    @else--}}
{{--                        <a href="{{ route('new_login') }}">--}}

{{--                            <button class="try-now">{{ __('afaq.Try_Now') }}--}}
{{--                            <button class="try-now">{{ __('afaq.customise_now') }}--}}
{{--                            </button>--}}
{{--                        </a>--}}
{{--                    @endif--}}

                    <span class="w-20-"></span>
                    {{-- <button class="buy-now">
                <a href="{{ url(app()->getLocale() . '/business-payment') }}">
                    {{ __('afaq.Buy_Now') }}</a></button> --}}
                </div>
                {{-- <div class="some-details-appropriate-package on-mob">
                    <label for="">
                        <img src="{{ asset('afaq\business/imgs/circle-exclamation-solid.svg') }}" alt="">
                        {{ __('afaq.packages_VAT') }}
                    </label>
                    <label for="">
                        <img src="{{ asset('afaq\business/imgs/circle-exclamation-solid.svg') }}" alt="">
                        {{ __('afaq.packages_prices_valid_until') }}
                    </label>
                </div> --}}
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        function price_yearly() {
            var payment_url = $('.go-payment').attr('data-url');
            $(".month").hide();
            $(".year").show();

            $('.go-payment').attr('href', payment_url + '&type=year');
        }

        function price_monthly() {
            $(".month").show();

            $(".year").hide();
            var payment_url = $('.go-payment').attr('data-url');
            $('.go-payment').attr('href', payment_url + '&type=month');

        }
    </script>
@endsection
