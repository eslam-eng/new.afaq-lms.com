@extends('layouts.front')
@section('content')

    <link rel="stylesheet" href="{{ asset('frontend/css/unpaid_invoices.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/new_carts.css ') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css ') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/footer.css ') }}">

    <section class="carts-page unpaid_invoices">
        <div>
            <h3>{{ __('global.unpaid_invoices') }}</h3>
        </div>

        <div class="all-carts d-flex flex-row-reverse">
            <div class="right_side_cart_page container">
                <div class="row Other_courses_lms invoice_grid_area">
                    @foreach ($items as $item)
                        <div class="invoice_my_profile">
                            <div class="invoice_content">
                                <div class="invoice_head">
                                    <span>{{ __('lms.invoice_number') }}</span>
                                    <span>{{ __('lms.total') }}</span>
                                    <span>{{ __('lms.payment_method') }}</span>
                                    <span>{{ __('global.status') }}</span>
                                    <span>{{ __('lms.date') }}</span>
                                </div>
                                <div>
                                    <span scope="row">{{ $item->payment_number ?? '' }}</span>
                                    <span>
                                        {{ $item->final_price ? $item->final_price . __('lms.currency') : __('lms.free') }}</span>
                                    <span> {{ $item->payment_provider ?? '' }}</span>
                                    <span> {{ $item->status ? 'true' : 'false' }} </span>
                                    <span> {{ date('h:i:s A', strtotime($item->created_at)) }}</span>
                                </div>
                                <span class="collapse_title" onclick="collapseTitleInvoice(this)">
                                    <i class="fa-solid fa-chevron-down"></i>
                                </span>
                                <div class="invoice_title_and_price">
                                    <span>{{ app()->getLocale() == 'en' ? $item->course_name_en ?? '' : $item->course_name_ar ?? '' }}</span>
                                    <span>{{ $item->final_price ? $item->final_price . __('lms.currency') : __('lms.free') }}</span>
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
                                    <form action="{{ url('/' . app()->getLocale() . '/checkout') }}" method="get"
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
                                                        src="{{$method->provider_image ?? ($method->local_image ? $method->local_image->getUrl() : null) ?? '' }}">
                                                </div>
                                            </a>
                                        @else
                                            <button type="submit" class="w-100 mx-0">
                                                <div>
                                                    <img
                                                        src="{{$method->provider_image ?? ($method->local_image ? $method->local_image->getUrl() : null) ?? '' }}">
                                                </div>
                                            </button>
                                        @endif

                                    </form>

                                @empty
                                    <form action="{{ url('/' . app()->getLocale() . '/checkout') }}" method="get"
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
{{--            @endif--}}
        </div>

    </section>
    <script src="{{ asset('frontend/js/collapse_invoice_title.js') }}"></script>
@endsection
