@extends('layouts.front')
@section('content')

<link rel="stylesheet" href="{{ asset('frontend/css/new_carts.css ')}}">

<div id="submit_payment_popup">
    <div class="submit_popup_body d-flex flex-column">
        <i onclick="closeSumbitPaymentPopup()" class="fa-solid fa-xmark"></i>
        <h4>
            تم ثبيت الطلب
        </h4>
        <p>
            {{__('global.cancel_by_24')}}
        </p>
        <div class="d-flex flex-row justify-content-center">
            <button>
                go to content
            </button>
            <button>
                go to content
            </button>
        </div>
    </div>
</div>
<section class="carts-page">
    <div class="all-carts d-flex flex-row-reverse">
        <div class="right_side_cart_page container">

            <div class="row">
                <div class="col-md-8">
                    <div class="payment_header row">

                        @php $bank_payment_id = null; @endphp
                        @forelse ($payment_methods as $key => $method)
                        <form action="{{url('/'.app()->getLocale().'/checkout/'.$cart->id)}}" method="get" class="payments  {{ $method->name_en == request('method_name') || (request('method_name' , null) == null && $method->provider == 'Bank') ? 'selected' : '' }} col-md-2 px-1 my-2">
                            @csrf
                            <input class="" type="hidden" name="payment_method" {{ $key == 0 ? 'checked' : '' }} value="{{$method->id}}" id="">

                            @if($method->provider == 'Bank')
                            @php $bank_payment_id = $method->id; @endphp
                            <a href="{{route('admin.carts.payment_methods' , ['locale'=>app()->getLocale()])}}" class="w-100 mx-0">
                                <div>
                                    <img src="{{$method->provider_image ?? ($method->local_image ? $method->local_image->getUrl() : null) ?? '' }}">
                                </div>
                            </a>

                            @else
                            <button type="submit" class="w-100 mx-0">
                                <div>
                                    <img src="{{$method->provider_image ?? ($method->local_image ? $method->local_image->getUrl() : null) ?? '' }}">
                                </div>
                            </button>
                            @endif

                        </form>

                        @empty
                        <form action="{{url('/'.app()->getLocale().'/checkout/'.$cart->id)}}" method="get" class="payments selected">
                            @csrf
                            <input class="" type="radio" name="payment_method" checked value="0" id="">
                            <button type="submit" class="w-100 mx-0">
                                Free
                            </button>
                        </form>
                        @endforelse

                    </div>

                    @if(request('method_name'))
                    <div dir="ltr" style="direction: ltr;"  class="payment_body d-flex flex-row justify-content-center">
                        <form action="{{config('app.APP_URL')}}/{{app()->getLocale()}}/checkout/pay/complete?payment_method_id={{request('payment_method_id')}}" class="paymentWidgets" data-brands="{{request('method_name' , 'VISA')}}"></form>

                        <script src="https://code.jquery.com/jquery.js" type="text/javascript"></script>

                        <script>
                            var wpwlOptions = {
                                style: "card",
                                paymentTarget: "_top",
                            }
                        </script>

                        <script async src="{{config('app.hyber_pay_url')}}/v1/paymentWidgets.js?checkoutId={{request('checkoutId')}}"></script>
                    </div>
                    @else

                    <form action="{{url('/'.app()->getLocale().'/checkout/'.$cart->id)}}" method="get">
                        @csrf
                        <div class="payment_body d-flex flex-row">
                            <div class="bank_image">
                                <img src="{{ asset('nazil/imgs/riyad_bank.png ')}}" alt="bank logo">
                            </div>
                            <div class="bank_number">
                                <p>{{__('global.Company_name')}} </p>
                                <div>{{__('global.current_account_number')}} {{config('app.bank_account_number' , '5048833559940')}}</div>
                                <div>{{__('global.unified_account_number')}} {{config('app.bank_iban_number' , 'SA7920000005048833559940')}}</div>
                            </div>
                        </div>

                        <input class="" type="hidden" name="payment_method" value="{{$bank_payment_id}}" id="">

                        <div class="submit_payment_application">
                            <div class="check-out-coust" style="z-index: 10000;">
                                <div class="Checkout">
                                    <button type="submit " class="btn btn-primary ">{{__('global.submit_payment_application')}}</button>
                                </div>
                            </div>

                        </div>

                    </form>
                    @endif

                </div>

                @if(isset($cart->items) && count($cart->items) > 0)

                <div class="col-md-4">
                    <div class="current_balance d-flex">
                        <span>
                            {{__('global.my_current_balance')}}
                        </span>
                        @if($cart->wallet)
                        <span>
                            {{ $cart->final_total ? ($cart->final_total > 0 ? $cart->final_total - $cart->wallet_discount : 0) . ' '.  __('lms.currency') :  __('lms.free') }}
                        </span>
                        @else
                        <span>
                            {{ $cart->final_total ? ($cart->final_total > 0 ? $cart->final_total : 0) . ' '.  __('lms.currency') :  __('lms.free') }}
                        </span>
                        @endif
                    </div>
                    <div class="total_balance d-flex">
                        <span>
                            {{__('global.total')}}
                        </span>
                        <div class="d-flex flex-column">
                            @if(isset($item->course->offer))
                            <del>{{ isset($cart->total) ? $cart->total . ' '. __('lms.currency') : __('lms.free') }}</del>
                            @endif
                            @if($cart->wallet)
                            <span>
                                {{($cart->final_total > 0 ? $cart->final_total - $cart->wallet_discount : 0)}} {{__('global.SAR')}}

                            </span>
                            @else
                            <span>
                                {{($cart->final_total > 0 ? $cart->final_total : 0)}} {{__('global.SAR')}}
                            </span>
                            @endif
                            <span>
                            </span>
                        </div>
                    </div>
                </div>

                @endif

            </div>
        </div>
    </div>
</section>

<script src="{{asset('frontend/js/new_carts.js')}}"></script>
@endsection
