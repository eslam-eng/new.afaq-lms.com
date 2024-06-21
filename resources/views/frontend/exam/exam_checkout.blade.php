@extends('frontend.personalInfos.index')
@section('content')


<style>
    .innerheader-nd {
        height: 50vh !important;
    }

    @media screen and (max-width: 1200px) {
        .innerheader-nd {
            height: 65vh !important;
        }

        .home-page-nd.onregister-page {
            z-index: 1;
            position: relative;
        }
    }

    @media screen and (max-width: 830px) {
        .precemp {
            bottom: 30px;
        }
    }
</style>
<section class="idu-programss blog-page-nd testimony-page">
    <div class="container sit-container ">
        <div class="checkout-card">
            <div class="checkout-side d-flex justify-content-between">
                <div class="checkout-left-side">

                    <div class="checkout-count">
                        <div class="checkout-payment-img">
                            <img src="/nazil/imgs/paymentimg.png" alt="">

                        </div>
                        <div class="checkout-amount">
                            <strong> {{__('lms.exams_details')}} </strong>
                        </div>

                        <div class="checkout-amount-data checkout-amount-details">
                            <div class="checkout-all-details">
                                <div class="checkout-course-details">
                                    <span> {{__('lms.exams')}}</span>
                                    <div class="all-checkout-course d-flex justify-content-between">
                                        <div class="all-checkout-course-name">
                                            <div class="checkout-course-name-img">
                                                <img src="{{isset($exam->image->url) ? $exam->image->url :
'/nazil/imgs/Customer-Service-Jobs-640x480-1-500x479.jpg'}}" alt="">
                                            </div>
                                            <span>
                                                {{app()->getLocale() == 'en' ?  $exam->title_en : $exam->title_ar}}
                                            </span>
                                        </div>
                                        <div class="all-checkout-course-price">
                                            <span>{{$exam->price}} {{__('lms.currency')}}</span>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="checkout-certificate-details ">--}}
                                {{-- <span>الشهادات</span>--}}
                                {{-- <div class="all-checkout-course d-flex justify-content-between">--}}
                                {{-- <div class="all-checkout-course-name ">--}}
                                {{-- <span>--}}
                                {{-- total course amount--}}
                                {{-- </span>--}}
                                {{-- </div>--}}
                                {{-- <div class="all-checkout-course-price">--}}
                                {{-- <span>2000 $</span>--}}
                                {{-- </div>--}}
                                {{-- </div>--}}

                                {{-- </div>--}}
                            </div>
                            <div class="checkout-amount-total">
                                <span>
                                    {{__('lms.total')}}
                                    <em>{{$exam->price}} {{__('lms.currency')}}</em></span>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="checkout-right-side">
                    <div class="checkout-payment">
                        <div class="payment-name d-flex justify-content-between row">
                            @foreach($payment_methods as $key=> $method)
                            <form action="{{url('/'.app()->getLocale().'/checkout')}}" method="get" class=" col-2">
                                @csrf
                                <input class="" type="hidden" name="payment_method" {{ $key == 0 ? 'checked' : '' }} value="{{$method->id}}" id="">
                                <input class="" type="hidden" name="exam_id" value="{{$exam->id}}" id="">

                                <button type="submit" style="background-color: {{ $method->name_en == request('method_name' , $method_name ?? '') ? '#6c4585' : '' }}" class="w-100 m-1">
                                    <div class="payment-img">
                                        <img style="width: 60px;height:70px" class="p-2" src="{{$method->provider_image ?? ($method->local_image ? $method->local_image->getUrl() : null) ?? '' }}" alt="">
                                    </div>
                                </button>
                            </form>
                            @endforeach
                        </div>

                        @if(request('method_name'))
                        <div dir="ltr" style="direction: ltr;" class="payment_body d-flex flex-row justify-content-center">
                            <form action="{{config('app.APP_URL')}}/{{app()->getLocale()}}/checkout_exam_complete/pay/complete?payment_method_id={{request('payment_method_id')}}&exam_id={{$exam->id}}" class="paymentWidgets" data-brands="{{request('method_name' , 'VISA')}}"></form>

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
                        <div class="payment_body d-flex flex-row">
                            <div class="bank_image">
                                <img src="{{ asset('nazil/imgs/riyad_bank.png ')}}" alt="bank logo">
                            </div>
                            <div class="bank_number">
                                <div>{{__('global.current_account_number')}} {{config('app.bank_account_number' , '5048833559940')}}</div>
                                <div>{{__('global.unified_account_number')}} {{config('app.bank_iban_number' , 'SA7920000005048833559940')}}</div>
                            </div>
                        </div>
                        @endif

                    </div>
                </div>
            </div>

        </div>
    </div>
</section>




@endsection
