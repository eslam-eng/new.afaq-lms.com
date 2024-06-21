@extends('frontend.business.layout.main')
@section('content')

    <section class="payment-page">
        <div class="payment-content">
            <div class="container">
                <div class="inner-img-payment">
{{--                    <img src="imgs/Group 41932.png" alt="">--}}
                    <img src="{{ asset('afaq\business/imgs/Group 41932.png') }}" alt="">
                </div>
                <div class="payment-box">
                    <strong class="title-payment">
                        {{ __('global.subscription-payments') }}
                    </strong>
                    <div class="payment-option">
                        <div class="payment-ways carts-card ">
                            <div class="top-payment-title">
{{--                                <div class="paymet-icon-name selected">--}}
{{--                                    <img src="{{ asset('afaq\business/imgs/building-columns-solid (1).png') }}" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="paymet-icon-name">--}}
{{--                                    <img src="{{ asset('afaq\business/imgs/apple-pay.png') }}" alt="">--}}
{{--                                </div>--}}
{{--                                <div class="paymet-icon-name">--}}
{{--                                    <img src="{{ asset('afaq\business/imgs/Group 42087.png') }}" alt="">--}}
{{--                                </div>--}}

                                @php $bank_payment_id = null; @endphp

                                @forelse ($payment_methods as $key => $method)
                                    <form id="payment-{{$key}}"  action="{{url('/'.app()->getLocale().'/business_checkout/'.$package->id.'?payment_method='.$method->id)}}" method="get" class="paymet-icon-name payments  {{ $method->name_en == request('method_name') || (request('method_name' , null) == null && $method->provider == 'Bank') ? 'selected' : '' }} ">
                                        @csrf
                                        <input class="" type="hidden" name="payment_method" {{ $key == 0 ? 'checked' : '' }} value="{{$method->id}}" id="">
                                        <input class="" type="hidden" name="type" {{ $key == 0 ? 'checked' : '' }} value="{{$type}}" id="">

                                        @if($method->provider == 'Bank')
                                            @php $bank_payment_id = $method->id; @endphp
                                            <a href="{{route('business-payment' , ['locale'=>app()->getLocale(),$package->id])}}" >
                                                <div class="">
                                                    <img src="{{$method->local_image ? $method->local_image->getUrl() : null }}">
                                                </div>
                                            </a>

                                        @else
                                                <div class="" onclick="$('#payment-{{$key}}').submit()">
                                                    <img src="{{$method->local_image ? $method->local_image->getUrl() : null }}">
                                                </div>
                                        @endif

                                    </form>
                                @empty
                                    <form action="{{url('/'.app()->getLocale().'/business_checkout/'.$package->id)}}" method="get" class="payments selected">
                                        @csrf
                                        <input class="" type="radio" name="payment_method" checked value="0" id="">
                                        <button type="submit" class="w-100 mx-0">
                                            Free
                                        </button>
                                    </form>
                                @endforelse
                            </div>
                            <div class="payment-details-way">

{{--                                <form>--}}
{{--                                    <input type="hidden">--}}
{{--                                    <div class="payment_body d-flex flex-row">--}}
{{--                                        <div class="bank_image">--}}
{{--                                            <img src="{{ asset('afaq\business/imgs/riyad_bank.png') }}" alt="">--}}
{{--                                        </div>--}}
{{--                                        <div class="bank_number">--}}
{{--                                            <div> <em class="copied-icon" onclick="copyToClipboard('#p3')"><i--}}
{{--                                                        class="fa-regular fa-clone"></i></em> Company name<em--}}
{{--                                                    id="p3" class="number-acc">Afaq Healthcare Education Company</em> </div>--}}
{{--                                            <div> <em class="copied-icon" onclick="copyToClipboard('#p2')"><i--}}
{{--                                                        class="fa-regular fa-clone"></i></em> Current account--}}
{{--                                                number:<em id="p2" class="number-acc">5048833559940</em> </div>--}}
{{--                                            <div> <em class="copied-icon" onclick="copyToClipboard('#p1')"><i--}}
{{--                                                        class="fa-regular fa-clone"></i></em> Unified account--}}
{{--                                                number:<em id="p1" class="number-acc">SA7920000005048833559940</em> </div>--}}

{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                    <input class="" type="hidden" name="payment_method" value="4" id="">--}}

{{--                                    <div class="submit_payment_application">--}}
{{--                                        <div class="check-out-coust" style="z-index: 10000;">--}}
{{--                                            <div class="confirming-btn">--}}
{{--                                                <button type="submit ">Confirm Booking</button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

{{--                                </form>--}}
                                @if(request('method_name'))
                                    <div  style="direction: ltr;" class="payment_body d-flex flex-row justify-content-center">
                                        <form action="{{config('app.APP_URL')}}/{{app()->getLocale()}}/pay_business_checkout/pay/complete?payment_method_id={{request('payment_method_id')}}&package_id={{$package->id}}" class="paymentWidgets" data-brands="{{request('method_name' , 'VISA')}}"></form>

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
                                    <strong class="title-payment">
                                       Please Choose Your Payment method
                                    </strong>
{{--                                    <form action="{{url('/'.app()->getLocale().'/business_checkout/'.$package->id.'?payment_method=4')}}" method="get" id="sub-from">--}}
{{--                                        @csrf--}}
{{--                                        <input class="" type="hidden" name="payment_method" checked value="4" id="">--}}
{{--                                        <input class="" type="hidden" name="type" checked value="{{$type}}" id="">--}}
{{--                                        <div class="payment_body d-flex flex-row">--}}
{{--                                            <div class="bank_image">--}}
{{--                                                <img src="{{ asset('nazil/imgs/riyad_bank.png ')}}" alt="bank logo">--}}
{{--                                            </div>--}}
{{--                                            <div class="bank_number">--}}
{{--                                                <div> <em class="copied-icon" onclick="copyToClipboard('#p3')"><i class="fa-regular fa-clone"></i></em> {{__('global.company_name')}}<u id="p3">{{__('global.Company_name')}}</u> </div>--}}
{{--                                                <div> <em class="copied-icon" onclick="copyToClipboard('#p2')"><i class="fa-regular fa-clone"></i></em> {{__('global.current_account_number')}}<u id="p2">{{config('app.bank_account_number' , '5048833559940')}}</u> </div>--}}
{{--                                                <div> <em class="copied-icon" onclick="copyToClipboard('#p1')"><i class="fa-regular fa-clone"></i></em>  {{__('global.unified_account_number')}}<u id="p1">{{config('app.bank_iban_number' , 'SA7920000005048833559940')}}</u> </div>--}}

{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <input class="" type="hidden" name="payment_method" value="{{$bank_payment_id}}" id="">--}}

{{--                                        <div class="submit_payment_application">--}}
{{--                                            <div class="check-out-coust" style="z-index: 10000;">--}}
{{--                                                <div class="confirming-btn">--}}
{{--                                                    <button type="button" onclick="$('#sub-from').submit();$(this).prop('disabled', true); ">{{__('global.addsubmit_payment_application')}}</button>--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                    </form>--}}
                                @endif
                            </div>
                        </div>
                        <div class="payment-balance">
                            <div class="right-side-payment">
                                <div class="carts-card  balance">
                                    <div class="d-flex justify-content-between">
                                        <span> {{app()->getLocale() == 'en' ? 'My current Package' : 'الباقة الحالية' }}</span>
                                        <em>
                                            {{ app()->getLocale() == 'en' ? ($package->package_name_en ?? '') : ($package->package_name_ar ?? '') }}
{{--                                            20 SR--}}
                                        </em>

                                    </div>
                                </div>
{{--                                {{dd(isset($package->package_month_price_offers))}}--}}
                                <div class="carts-card Total">
                                    <div class="d-flex justify-content-between">
                                        <span> {{__('afaq.total')}}</span>

                                        <em>
                                            @if(isset($package->package_month_price_offers))
                                            <em>{{$type == 'month' ? $amount : ($type == 'year' ? $amount :'')}} {{__('afaq.sar')}}</em>
                                                @else

                                                    <em>{{$type == 'month' ? $amount : ($type == 'year' ? $amount :'')}} {{__('afaq.sar')}}</em>
                                                @endif
                                        </em>

                                    </div>
                                    <small class="d-block text-danger">{{__('lms.vatincluded')}}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
