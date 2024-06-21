@extends('frontend.business.layout.main')
@section('content')
    <div class="own-package-text on-web">
        <div class="container">
            <strong>{{ __('afaq.customise_own_package') }}</strong>
            <span> <a href="{{ url(app()->getLocale() . '/customize-now') }}">{{ __('afaq.customise_now') }}</a></span>
        </div>
    </div>
    <section class="own-package-page inner-own-package pxa on-web">
        <div class="container">
            <div class="Ready-To-Start">
                <strong>{{ __('afaq.ready_to_start') }} <a href="">{{ __('afaq.afaq_business') }}</a> </strong>
            </div>
            <div class="table-package pt-5">
                <table class="table-pwn-package">
                    <tr class="table-row">
                        <th>
                            {{-- <div class="work-time">
                                <div class="the-work-time">
                                    <span class="Monthly active" id="Monthly"
                                        onclick="price_monthly()">{{ __('afaq.Monthly') }}</span>
                                    <span class="Yearly " id="Yearly"
                                        onclick="price_yearly()">{{ __('afaq.Yearly') }}</span>
                                </div>
                            </div> --}}
                        </th>
                        @foreach ($BusinessPackages as $k1 => $v1)
                            <th>
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
                                        <!-- Monthly prices -->
                                        <div class="packages-count month">
                                            <div class="packg-amount">
{{--                                                @if ($v1->price_package_month == 0)--}}
{{--                                                    <em class="count-num">--}}
{{--                                                        {{ __('afaq.packages_free') }}</em>--}}
{{--                                                @else--}}
{{--                                                    <em class="count-num">{{ $v1->package_month_price_offers ?? $v1->price_package_month }}</em>--}}
{{--                                                    <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                                    --}}{{-- <em class="count-date">{{ __('afaq.packages/mon') }} </em> --}}
{{--                                                @endif--}}
                                                <em class="count-num">
                                                    {{ __('afaq.request_free_offer') }}</em>
                                            </div>
{{--                                            @if ($v1->package_month_price_offers)--}}
{{--                                                <div class="del-">--}}
{{--                                                    <del>{{ $v1->price_package_month }}</del>--}}
{{--                                                    <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
                                        </div>
                                        <!--Year Price -->
                                        <div class="packages-count year" style="display: none">
                                            <div class="packg-amount">
{{--                                                @if ($v1->price_package_annual == 0)--}}
{{--                                                    <em class="count-num">--}}
{{--                                                        {{ __('afaq.packages_free') }}</em>--}}
{{--                                                @else--}}
{{--                                                    <em class="count-num">{{ $v1->package_annual_price_offers }}</em>--}}
{{--                                                    <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                                    <em class="count-date">{{ __('afaq.packages/year') }} </em>--}}
{{--                                                @endif--}}
                                                <em class="count-num">
                                                    {{ __('afaq.request_free_offer') }}</em>
                                            </div>
{{--                                            @if ($v1->package_annual_price_offers)--}}
{{--                                                <div class="del-">--}}
{{--                                                    <del>{{ $v1->package_annual_price_offers }}</del>--}}
{{--                                                    <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                                </div>--}}
{{--                                            @endif--}}
                                        </div>
                                    </div>
                                </div>


                                {{--        <a href="{{ url(app()->getLocale() . '/business-payment/package_id?package_id=' . $v1->id) }}"> --}}

                                {{--            <button class="for-sec-inner-package-btn">{{ __('afaq.Choose_plan') }}</button> --}}
                                {{--            {{ __('afaq.Try_Now') }} --}}
                                {{--        </a> --}}
{{--                                @if (!auth()->check())--}}
{{--                                    <a href="{{ url(app()->getLocale() . '/new_login') }}">--}}
{{--                                        <button--}}
{{--                                            class="for-sec-inner-package-btn">{{ $v1->price_package_month == 0 ? __('afaq.Try_Now') : __('afaq.Choose_plan') }}</button>--}}
{{--                                        <button class="Choose-plan">{{ __('afaq.customise_now') }}</button>--}}


{{--                                    </a>--}}
{{--                                @else--}}
{{--                                    <a class="go-payment"--}}
{{--                                       data-url="{{ url(app()->getLocale() . '/business-payment/package_id?package_id=' . $v1->id) }}"--}}
{{--                                       href="{{ url(app()->getLocale() . '/business-payment/package_id?package_id=' . $v1->id . '&type=month') }}">--}}

{{--                                        <button--}}
{{--                                            class="for-sec-inner-package-btn">{{ $v1->price_package_month == 0 ? __('afaq.Try_Now') : __('afaq.Choose_plan') }}</button>--}}

                                    <a  href="{{ url(app()->getLocale() . '/customize-now') }}">
                                        <button class="for-sec-inner-package-btn">{{ __('afaq.customise_now') }}</button>

                                    </a>
{{--                                @endif--}}

                            </th>
                        @endforeach

                    </tr>
                    @foreach ($BusinessPackages as $k1 => $v1)
                        @if ($loop->index == 0)
                            @php
                                $keys = array_keys($v1->toArray());
                            @endphp
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
                                        'created_at',
                                        'updated_at',
                                    ]))
                                    <tr class="table-on-col">
                                        <td><span>{{ __('cruds.businessPackage.fields.' . $key) }}</span></td>
                                        @foreach (range(1, count($BusinessPackages)) as $c)
                                            @if ($BusinessPackages[$c - 1][$key] > 1)
                                                <td><span
                                                        class="close-icon icon-table">{{ $BusinessPackages[$c - 1][$key] }}</span>
                                                </td>
                                            @else
                                                @if ($BusinessPackages[$c - 1][$key] == 1)
                                                    <td><span class="right-icon icon-table"><i
                                                                class="fa-solid fa-circle-check"></i></span></td>
                                                @else
                                                    <td><span class="close-icon icon-table"><i
                                                                class="fa-solid fa-circle-xmark"></i></span></td>
                                                @endif
                                            @endif
                                        @endforeach
                                        {{-- <td><span class="close-icon icon-table"><i class="fa-solid fa-circle-xmark"></i></span></td>
                                    <td><span class="close-icon icon-table"><i class="fa-solid fa-circle-xmark"></i></span></td>
                                    <td><span class="right-icon icon-table"><i class="fa-solid fa-circle-check"></i></span></td> --}}
                                    </tr>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                </table>
                <div class="fees-write-text">
                    <span>{{__('afaq.with_event_fees')}}</span>
                </div>
            </div>
        </div>
    </section>
    <!-- ********************* media screen page******************* -->
    <section class="own-package-text-mob on-mob">
        <div class="customise-sec fixed-sec">
            {{-- <div class="container">
                <strong>{{ __('afaq.customise_own_package') }}</strong>
                <span> <a href="{{ url(app()->getLocale() . '/business-contact-us') }}">{{ __('afaq.customise_now') }}</a></span>
            </div> --}}

            <strong class="free-trial"> </strong>
             <div class="try-buy">
{{--                @if (auth()->check())--}}
{{--                    <a href="{{ url(app()->getLocale() . '/business-payment/package_id?package_id=' . $v1->id) }}">--}}

{{--                        <button class="buy-now">{{ __('afaq.Try_Now') }}</button>--}}
{{--                    </a>--}}
                    <a  href="{{ url(app()->getLocale() . '/customize-now') }}">
                        <button class="buy-now">{{ __('afaq.customise_now2') }}</button>
                    </a>
{{--                @else--}}
{{--                    <a href="{{ route('new_login') }}">--}}

{{--                        <button class="buy-now">{{ __('afaq.Try_Now') }}</button>--}}
{{--                        <button class="buy-now">{{ __('afaq.customise_now') }}--}}
{{--                        </button>--}}
{{--                    </a>--}}
{{--                @endif--}}
            </div>

        </div>
        <!-- ************end text -->
        <div class="package-table-sec pxa">
            <div class="Ready-To-Start">
                <strong>{{ __('afaq.ready_to_start') }} <a href="">{{ __('afaq.afaq_business') }}</a> </strong>
            </div>
            <div class="fixed-package">
                <div class="work-time">
                    {{-- <div class="the-work-time">
                        <span class="Monthly active" id="Monthly"
                            onclick="price_monthly()">{{ __('afaq.Monthly') }}</span>
                        <span class="Yearly " id="Yearly" onclick="price_yearly()">{{ __('afaq.Yearly') }}</span>
                    </div> --}}
                </div>

                <div class="all-packages-card">
                    @foreach ($BusinessPackages as $k1 => $v1)
                        <div class="all-cards-pk">
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
                @endswitch  all-packages inner-packge">
                                <div class="package-details-title">
                                    <span>
                                        {{ app()->getLocale() == 'en' ? $v1->package_name_en : $v1->package_name_ar }}
                                    </span>
                                    <div class="packages-count month">

{{--                                        @if ($v1->price_package_month == 0)--}}
{{--                                            <em class="count-num">--}}
{{--                                                {{ __('afaq.packages_free') }}</em>--}}
{{--                                        @else--}}
{{--                                            <em class="count-num">{{ $v1->price_package_month }}</em>--}}
{{--                                            <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                            --}}{{-- <em class="count-date">{{ __('afaq.packages/mon') }} </em> --}}
{{--                                        @endif--}}

                                        <em class="count-num">
                                            {{ __('afaq.request_free_offer') }}</em>
                                    </div>
                                    <div class="packages-count year" style="display: none">
{{--                                        @if ($v1->price_package_annual == 0)--}}
{{--                                            <em class="count-num">--}}
{{--                                                {{ __('afaq.packages_free') }}</em>--}}
{{--                                        @else--}}
{{--                                            <em class="count-num">{{ $v1->package_month_price_offers ?? $v1->price_package_annual }}</em>--}}
{{--                                            <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                            <em class="count-date">{{ __('afaq.packages/year') }} </em>--}}
{{--                                        @endif--}}
                                        <em class="count-num">
                                            {{ __('afaq.request_free_offer') }}</em>
                                    </div>
{{--                                    @if ($v1->package_month_price_offers)--}}
{{--                                        <div class="del-">--}}
{{--                                            <del>{{ $v1->price_package_annual }}</del>--}}
{{--                                            <em class="count-type">{{ __('afaq.sar') }}</em>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
                                </div>

                            </div>
                            @if (!auth()->check())
                                <a href="{{ url(app()->getLocale() . '/new_login') }}">
                                    <button
                                        class="@switch($loop->index)
                                    @case(0)
                                    for-sec-inner-package-btn
                                        @break
                                    @case(1)
                                    one-sec-inner-package-btn
                                        @break
                                    @case(2)
                                    two-sec-inner-package-btn
                                        @break
                                    @case(3)
                                    thr-sec-inner-package-btn
                                        @break
                                    @default
                                    one-sec-inner-package-btn
                                @endswitch  ">

{{--                                        {{ $v1->price_package_month == 0 ? __('afaq.Try_Now') : __('afaq.Choose_plan') }}</button>--}}
                                        {{ __('afaq.customise_now') }}</button>


                                </a>
                            @else
{{--                                <a--}}
{{--                                    href="{{ url(app()->getLocale() . '/business-payment/package_id?package_id=' . $v1->id) }}">--}}
                                <a  href="{{ url(app()->getLocale() . '/customize-now') }}">
                                    <button
                                        class="@switch($loop->index)
                                    @case(0)
                                    for-sec-inner-package-btn
                                        @break
                                    @case(1)
                                    one-sec-inner-package-btn
                                        @break
                                    @case(2)
                                    two-sec-inner-package-btn
                                        @break
                                    @case(3)
                                    thr-sec-inner-package-btn
                                        @break
                                    @default
                                    one-sec-inner-package-btn
                                @endswitch  ">
{{--                                        <!--{{ __('afaq.Choose_plan') }} -->--}}
                                        {{ __('afaq.customise_now') }}
                                    </button>




                                </a>
                            @endif

                        </div>
                        @if ($loop->index == 2)
                        @break
                    @endif
                @endforeach
            </div>

        </div>


        @foreach ($BusinessPackages as $k1 => $v1)
            @if ($loop->index == 0)
                @php
                    $keys = array_keys($v1->toArray());
                @endphp
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
                            'created_at',
                            'updated_at',
                        ]))
                        <div class="tb-package-details pt-1 pb-1">
                            <div class="pack-name">
                                <span>{{ __('cruds.businessPackage.fields.' . $key) }}</span>
                            </div>
                            <div class="pck-active">

                                @foreach (range(1, count($BusinessPackages) - 1) as $c)
                                    @if ($BusinessPackages[$c - 1][$key] > 1)
                                        <div class="activ-mark">
                                            <span
                                                class="close-icon icon-table">{{ $BusinessPackages[$c - 1][$key] }}</span>
                                        </div>
                                        {{--                                    <td><span class="close-icon icon-table">{{ $BusinessPackages[$c-1][$key] }}</span></td> --}}
                                    @else
                                        @if ($BusinessPackages[$c - 1][$key] == 1)
                                            <div class="activ-mark">
                                                <span class="right-icon icon-table"><i
                                                        class="fa-solid fa-circle-check"></i></span>
                                            </div>
                                        @else
                                            <div class="activ-mark">
                                                <span class="close-icon icon-table"><i
                                                        class="fa-solid fa-circle-xmark"></i></span>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>

                        </div>
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>
        <div class="fees-write-text">
            <span>{{__('afaq.with_event_fees')}}</span>
        </div>


    <div class="own-package-text ">
        <div class="container">
            <strong>{{ __('afaq.customise_own_package') }} </strong>
            <span>
                <a
                    href="{{ url(app()->getLocale() . '/customize-now') }}">{{ __('afaq.customise_now') }}</a>
            </span>
        </div>
    </div>
</section>
@endsection
@section('scripts')
{{--<script>--}}
{{--    function price_yearly() {--}}
{{--        $(".month").hide();--}}
{{--        $(".year").show();--}}
{{--        var payment_url = $('.go-payment').attr('data-url');--}}
{{--        $('.go-payment').attr('href', payment_url + '&type=year');--}}
{{--    }--}}

{{--    function price_monthly() {--}}
{{--        $(".month").show();--}}
{{--        $(".year").hide();--}}
{{--        var payment_url = $('.go-payment').attr('data-url');--}}
{{--        $('.go-payment').attr('href', payment_url + '&type=month');--}}
{{--    }--}}
{{--</script>--}}
@endsection
