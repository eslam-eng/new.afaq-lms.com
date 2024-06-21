@extends('layouts.front')
@section('title' ,__('lms.carts'))
@section('content')
    @php
        $url =url('/' . app()->getLocale() . '/checkout');
        if(request('payment_id')){
            $url = $url.'?payment_id='.request('payment_id');
        }
    @endphp
    <link rel="stylesheet" href="{{ asset('frontend/css/unpaid_invoices.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/new_carts.css ') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css ') }}">
    <link rel="stylesheet" href="{{ asset('afaq/assests/css/footer.css') }}">
    <style>
        .carts-page .payment_header>form.selected {
            background-image: linear-gradient(-90deg, #88BD2F, #2B5744);
            color: #fff;
        }

        .carts-page .payment_header {
            border: solid 2px #2B5744;
        }

        .invoice_grid_area .invoice_my_profile .invoice_content>div.invoice_head>span {
            color: #2B5744;
        }

        .invoice_grid_area .invoice_title_and_price>span:last-of-type {
            color: #2B5744;
        }

        body {
            margin: 0;
        }

        .invoice_grid_area {
            margin: 10px 0 50px 0;
        }

        .Other_courses_lms {
            display: flex;
            flex-wrap: wrap;
        }

        .invoice_grid_area .invoice_my_profile {
            background-color: #fff;
            border-radius: 10px;
            padding: 20px;
            width: 100%;
            display: flex;
            flex-direction: row;
            margin: 10px 0;
            box-shadow: 0px 0px 10px #6d468612;
        }

        img {
            min-width: auto;
        }

        .lang a {
            color: #fff !important;
        }
    </style>
    <div class="br-div px-5" style="">
        <ul class="br-ul">
            <li><a href="#">{{ __('global.unpaid_invoices') }}</a>
            </li>
        </ul>
    </div>
    <section class="carts-page unpaid_invoices">


        <div class="all-carts d-flex flex-row-reverse">
            <div class="right_side_cart_page container w-100">
                <div class="row Other_courses_lms invoice_grid_area">
                    @foreach ($items as $item)
                        <div class="invoice_my_profile">
                            <div class="invoice_content">
                                <div class="invoice_head">
                                    <span>{{ __('lms.invoice_number') }}</span>
                                    <span>{{ __('lms.total') }}</span>
                                    <span>{{ __('lms.payment_method') }}</span>
                                    {{-- <span>{{ __('global.status') }}</span> --}}
                                    <span>{{ __('lms.date') }}</span>
                                </div>
                                <div>
                                    <span scope="row">{{ $item->invoice_id ?? '' }}</span>
                                    <span>
                                        {{ $item->course_price ? $item->course_price . __('lms.currency') : __('lms.free') }}</span>
                                    <span> {{ $item->payment_provider ?? '' }}</span>
                                    {{-- <span> {{ $item->status ? 'true' : 'false' }} </span> --}}
                                    <span> {{ date('h:i:s A', strtotime($item->created_at)) }}</span>
                                </div>
                                <span class="collapse_title" onclick="collapseTitleInvoice(this)">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                                <div class="invoice_title_and_price">
                                    <span>{{ app()->getLocale() == 'en' ? $item->course->name_en ?? '' : $item->course->name_ar ?? '' }}</span>
                                    <span>{{ $item->course_price ? $item->course_price . __('lms.currency') : __('lms.free') }}</span>
                                </div>
                            </div>
                            <div class="invoice_actions">
                                <span class="">{{ __('home.dont_payment') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if ($items && $items->count() > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="payment_header row">

                                @php $bank_payment_id = null; @endphp
                                @forelse ($payment_methods as $key => $method)
                                    <form action="{{ $url }}" method="get"
                                        class="payments  {{ $method->name_en == request('method_name') || (request('method_name', null) == null && $method->provider == 'Bank') ? 'selected' : '' }} col-md-2 px-1 my-2">
                                        @csrf
                                        <input class="" type="hidden" name="payment_method"
                                            {{ $key == 0 ? 'checked' : '' }} value="{{ $method->id }}" id="">
                                        <input class="" type="hidden" name="payment_id" value="{{ $payment_id }}"
                                            id="">

                                        @if ($method->provider == 'Bank')
                                            @php $bank_payment_id = $method->id; @endphp
                                            <a href="{{ route('admin.carts.payment_methods', ['locale' => app()->getLocale()]) }}"
                                                class="w-100 mx-0">
                                                <div>
                                                    <img
                                                        src="{{ $method->local_image ? $method->local_image->getUrl() : null }}">
                                                </div>
                                            </a>
                                        @else
                                            <button type="submit" class="w-100 mx-0">
                                                <div>
                                                    <img
                                                        src="{{ $method->local_image ? $method->local_image->getUrl() : null }}">
                                                </div>
                                            </button>
                                        @endif

                                    </form>

                                @empty
                                    <form action="{{ $url }}" method="get"
                                        class="payments selected">
                                        <input class="" type="hidden" name="payment_id" value="{{ $payment_id }}"
                                            id="">

                                        @csrf
                                        <input class="" type="radio" name="payment_method" checked value="0"
                                            id="">
                                        <button type="submit" class="w-100 mx-0">
                                            Free
                                        </button>
                                    </form>
                                @endforelse

                            </div>

                            @if (request('method_name'))
                                <div dir="ltr" style="direction: ltr;"
                                    class="payment_body d-flex flex-row justify-content-center">
                                    <form
                                        action="{{ config('app.APP_URL') }}/{{ app()->getLocale() }}/checkout/pay/complete?payment_method_id={{ request('payment_method_id') }}&payment_id={{ $payment_id }}"
                                        class="paymentWidgets" data-brands="{{ request('method_name', 'VISA') }}"></form>

                                    <script src="https://code.jquery.com/jquery.js" type="text/javascript"></script>

                                    <script>
                                        var wpwlOptions = {
                                            style: "card",
                                            paymentTarget: "_top",
                                        }
                                    </script>

                                    <script async src="{{ config('app.hyber_pay_url') }}/v1/paymentWidgets.js?checkoutId={{ request('checkoutId') }}">
                                    </script>
                                </div>
                            @else
                                <div class="payment_body d-flex flex-row">
                                    <div class="bank_image">
                                        <img src="{{ asset('nazil/imgs/riyad_bank.png ') }}" alt="bank logo">
                                    </div>
                                    <div class="bank_number">
                                        <div>{{__('global.company_name')}}{{__('global.Company_name')}}</div>

                                        <div>{{ __('global.current_account_number') }}
                                            {{ config('app.bank_account_number', '5048833559940') }}</div>
                                        <div>{{ __('global.unified_account_number') }}
                                            {{ config('app.bank_iban_number', 'SA7920000005048833559940') }}</div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @endif
            </div>
        </div>

    </section>
    <script src="{{ asset('frontend/js/collapse_invoice_title.js') }}"></script>
@endsection
