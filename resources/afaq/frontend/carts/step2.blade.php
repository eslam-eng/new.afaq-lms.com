@extends('layouts.front')
@section('title' ,__('lms.carts'))
@section('content')

    {{-- <link rel="stylesheet" href="{{ asset('frontend/css/new_carts.css ')}}"> --}}
    <link href="{{ asset('afaq/assests/css/card-style.css') }}" rel="stylesheet">

    <section class="carts-page the-card-page">

        <div class="col-12 cart-page-lms">
            <div class="col-10 offset-1">
                <div class="afaq-logo d-flex justify-content-center align-items-center">
                    <div class="afaq-img-log">
                        <img src="{{ asset('/afaq/imgs/Group 41932.png') }}" alt="">

                    </div>
                </div>
                <!-- ********************** carts-card************************ -->
                <div class="cart-location">
                    <div class="decript-title Introduction-What-learn ">
                        <div class="icons">
                            <span class="small-icon">
                                <i class="fa-solid fa-circle"></i>
                            </span>
                            <span class="big-icon">
                                <i class="fa-solid fa-circle"></i>
                            </span>
                        </div>
                        <strong>{{ __('global.subscription-payments') }}</strong>
                    </div>
                    <div class="payment-ways">
                        <div class="left-side-payment carts-card">
                            <div class="top-payment-title">
                                {{-- <div class="payment-type d-flex justify-content-start"> --}}
                                {{-- <div class="payment-img bank active"> --}}
                                {{-- <!-- <img src="{{asset('/afaq/imgs/building-columns-solid (1).png')}}" alt=""> --> --}}
                                {{-- <i class="fa-solid fa-landmark"></i> --}}
                                {{-- </div> --}}
                                {{-- <div class="payment-img appel"> --}}
                                {{-- <!-- <img src="{{asset('/afaq/imgs/apple-pay.png')}}" alt=""> --> --}}
                                {{-- <i class="fa-brands fa-apple-pay"></i> --}}
                                {{-- </div> --}}


                                {{-- </div> --}}
                                @php $bank_payment_id = null; @endphp
                                @forelse ($payment_methods as $key => $method)
                                    <form action="{{ url('/' . app()->getLocale() . '/checkout/' . $cart->id) }}"
                                        method="get"
                                        class="payments  {{ $method->name_en == request('method_name') || (request('method_name', null) == null && $method->provider == 'Bank') ? 'selected' : '' }} ">
                                        @csrf
                                        <input class="" type="hidden" name="payment_method"
                                            {{ $key == 0 ? 'checked' : '' }} value="{{ $method->id }}" id="">

                                        @if ($method->provider == 'Bank')
                                            @php $bank_payment_id = $method->id; @endphp
                                            <a
                                                href="{{ route('admin.carts.payment_methods', ['locale' => app()->getLocale()]) }}">
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
                                    <form action="{{ url('/' . app()->getLocale() . '/checkout/' . $cart->id) }}"
                                        method="get" class="payments selected">
                                        @csrf
                                        <input class="" type="radio" name="payment_method" checked value="0"
                                            id="">
                                        <button type="submit" class="w-100 mx-0">
                                            Free
                                        </button>
                                    </form>
                                @endforelse
                            </div>
                            <div class="payment-details-way">
                                @if (request('method_name'))
                                    <div style="direction: ltr;"
                                        class="payment_body d-flex flex-row justify-content-center">
                                        <form
                                            action="{{ config('app.APP_URL') }}/{{ app()->getLocale() }}/checkout/pay/complete?payment_method_id={{ request('payment_method_id') }}"
                                            class="paymentWidgets" data-brands="{{ request('method_name', 'VISA') }}">
                                        </form>

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
                                    <form action="{{ url('/' . app()->getLocale() . '/checkout/' . $cart->id) }}"
                                        method="get" id="sub-from">
                                        @csrf
                                        <div class="payment_body d-flex flex-row">
                                            <div class="bank_image">
                                                <img src="{{ asset('nazil/imgs/riyad_bank.png ') }}" alt="bank logo">
                                            </div>
                                            <div class="bank_number">
                                                <div> <em class="copied-icon" onclick="copyToClipboard('#p3')"><i
                                                            class="fa-regular fa-clone"></i></em>
                                                    {{ __('global.company_name') }}<u
                                                        id="p3">{{ __('global.Company_name') }}</u> </div>
                                                <div> <em class="copied-icon" onclick="copyToClipboard('#p2')"><i
                                                            class="fa-regular fa-clone"></i></em>
                                                    {{ __('global.current_account_number') }}<u
                                                        id="p2">{{ config('app.bank_account_number', '5048833559940') }}</u>
                                                </div>
                                                <div> <em class="copied-icon" onclick="copyToClipboard('#p1')"><i
                                                            class="fa-regular fa-clone"></i></em>
                                                    {{ __('global.unified_account_number') }}<u
                                                        id="p1">{{ config('app.bank_iban_number', 'SA7920000005048833559940') }}</u>
                                                </div>

                                            </div>
                                        </div>

                                        <input class="" type="hidden" name="payment_method"
                                            value="{{ $bank_payment_id }}" id="">

                                        <div class="submit_payment_application">
                                            <div class="check-out-coust" style="z-index: 10000;">
                                                <div class="confirming-btn">
                                                    <button type="button"
                                                        onclick="$('#sub-from').submit();$(this).prop('disabled', true); ">{{ __('global.addsubmit_payment_application') }}</button>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                @endif

                            </div>

                        </div>



                        @if (isset($cart->items) && count($cart->items) > 0)
                            <div class="right-side-payment">
                               
                                <div class="carts-card Total ">
                                    <div class="d-flex justify-content-between">
                                        <span> {{ __('global.total') }}</span>
                                        <em>
                                            @if (isset($item->course->offer))
                                                <del>{{ isset($cart->total) ? $cart->total . ' ' . __('lms.currency') : __('lms.free') }}</del>
                                            @endif
                                            <em>{{ $cart->final_total > 0 ? $cart->final_total : 0 }}
                                                {{ __('global.SAR') }}</em>
                                        </em>
                                    </div>
                                    <span class="vatincluded-"> {{ __('lms.vatincluded') }} </span>

                                </div>
                                <div id="TabbyPromo"></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('frontend/js/new_carts.js') }}"></script>

@endsection
@push('footer-scripts')
    <script src="https://checkout.tabby.ai/tabby-promo.js"></script>
    <script>
        new TabbyPromo({
            selector: '#TabbyPromo', // required, content of tabby Promo Snippet will be placed in element with that selector.
            currency: 'SAR', // required, currency of your product. AED|SAR|KWD|BHD|QAR only supported, with no spaces or lowercase.
            price: '{{ $cart->final_total }}', // required, price or the product. 2 decimals max for AED|SAR|QAR and 3 decimals max for KWD|BHD.
            installmentsCount: 4, // Optional, for non-standard plans.
            lang: '{{app()->getLocale()}}', // Optional, language of snippet and popups, if the property is not set, then it is based on the attribute 'lang' of your html tag.
            source: 'product', // Optional, snippet placement; `product` for product page and `cart` for cart page.
            publicKey: 'pk_test_a5077b26-5e1d-4df4-9d0a-d545302c5dae', // required, store Public Key which identifies your account when communicating with tabby.
            merchantCode: 'afaq' // required
        });
    </script>
@endpush
