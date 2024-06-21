@extends('layouts.front')
@section('content')

<link rel="stylesheet" href="{{ asset('frontend/css/unpaid_invoices.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/css/new_carts.css ')}}">
<link rel="stylesheet" href="{{ asset('frontend/css/style.css ')}}">
<link rel="stylesheet" href="{{ asset('frontend/css/footer.css ')}}">

<section class="carts-page unpaid_invoices">
    <div>
        <h3>{{__('global.unpaid_invoices')}}</h3>
    </div>


    @php $fawater = $cart->items->where('payment_provider' ,'Bank'); @endphp
    @if(isset($fawater) && $fawater && count($fawater) > 0)
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
        <div class="cart-title">
            <h2>فواتير غير مسددة</h2>
        </div>
        @foreach($fawater as $item)
        @if($item->course)
        <div class="carts-card d-flex justify-content-between align-items-center">

            <div class="first-side-cart">
                <div class="carts-img">
                    <a href="{{url('/'.app()->getLocale().'/one-courses/'.$item->course->id)}}">
                        <img src="{{ isset($item->course->image->url) ? $item->course->image->url : asset('/nazil/imgs/Customer-Service-Jobs-640x480-1-500x479.jpg') }}" alt="{{isset($item->course->image_title_en) ? $item->course->image_title_en : '' }}">
                    </a>
                </div>
                <div class="cart-details">
                    <!-- <span>{{ app()->getLocale() == 'en' ? ($item->course->category->name_en ?? '') : ($item->course->category->name_ar ?? '') }}</span> -->
                    <a href="{{url('/'.app()->getLocale().'/one-courses/'.$item->course->id)}}">
                        <h2>{{ app()->getLocale() == 'en' ? ($item->course->name_en ?? '') : ($item->course->name_ar ?? '') }}</h2>
                    </a>
                    <div class="courses-time-online">
                        <!-- <div class="courses-online">
                                        <i class="fas fa-signal"></i>
                                        <span> {{ isset($item->course->course_place) ? __('lms.'.$item->course->course_place) : '' }} </span>
                                    </div> -->
                        <div class="courses-online">
                            <i class="far fa-clock"></i>
                            <span> {{ isset($item->course->lecture_hours) ? $item->course->lecture_hours. ' '.  __('lms.hours') : '' }} </span>
                        </div>
                    </div>
                    <span>{{__('global.breif')}}</span>
                    <p>
                        {!! app()->getLocale() == 'en' ? substr($item->course->introduction_to_course_en,0,230) ?? '' : substr($item->course->introduction_to_course_ar,0,230) ?? '' !!}
                    </p>
                </div>
            </div>
            <div class="last-side-cart">
                <div class="d-flex justify-content-center flex-column">
                    @if(!$item->coupon_discount || isset($item->course->offer))
                    <div class="count-cours-cart">
                        @if(!$item->coupon_discount)
                        <span class="new-price-cart">{{ $item->course_price ? $item->course_price .  __('lms.currency') : __('lms.free') }}</span>
                        @endif
                        @if(isset($item->course->offer))
                        <span class="lsat-price-cart">{{$item->course->offer . __('lms.currency') }}</span>
                        @endif
                    </div>
                    @endif
                </div>

                <div class="d-flex justify-content-center">

                    @if($item->coupon_discount)
                    <div class="discount">
                        <ul>
                            <li class="alert alert-success"><strong>السعر بعد الخصم : </strong> {{$item->course_price}} </li>
                            <div class="delete-discount">
                                <li class="alert alert-danger"><strong> الخصم : </strong> {{$item->coupon_discount}} </li>
                                <li class="delete-icon">
                                    <a href="{{url('/'.app()->getLocale().'/cart_item/coupon/remove/'.$item->id)}}"><i class="fa-solid fa-trash-can"></i></a>
                                </li>
                            </div>
                        </ul>
                    </div>
                    @endif

                </div>

            </div>
        </div>
        @endif
        @endforeach

        <div>
            <p>اسم المؤسسة : مؤسسة نزيل الوطنية للتجارة </p>
            <p>رقم الحساب الجاري: {{config('app.bank_account_number' , '5048833559940')}}</p>

            <p>رقم الحساب الأيبان IBAN: {{config('app.bank_iban_number' , 'SA7920000005048833559940')}}</p>
        </div>
    </div>
    @endif

    <div class="Other_courses_lms invoice_grid_area">
        <div class="invoice_my_profile">
            <div class="invoice_content">
                <div class="invoice_head">
                    <span>{{ __('lms.invoice_number') }}</span>
                    <span>{{ __('lms.total') }}</span>
                    <span>{{ __('lms.payment_method') }}</span>
                    <span>{{ __('global.status') }}</span>
                    <span>{{ __('lms.date') }}</span>
                    <!-- <span class="invoice_web_action">{{ __('global.action') }}</span>
                    <span class="invoice_web_action">{{ __('lms.cancel') }}</span> -->
                </div>
                <div>
                    <span scope="row">12</span>
                    <span> 500</span>
                    <span>cai bank</span>
                    <span>{{('lms.invoice_wait_approveal') }}
                    </span>
                    <span>08:00:00</span>
                </div>
                <span class="collapse_title" onclick="collapseTitleInvoice(this)">
                    <i class="fa-solid fa-chevron-down"></i>
                </span>
                <div class="invoice_title_and_price">
                    <span>الدليل الكامل لمدرسة التمريض لطلاب مرحلة ما قبل التمريض</span>
                    <span>299 ل.س</span>
                </div>
            </div>
            <div class="invoice_actions">
                <form class="invoice_web_button" action="{{ url('/') .'/'.app()->getLocale(). '/checkout/banktransfer/confirm' }}">
                    <input type="hidden" name="invoice_id" value="transaction">
                    <button type="submit" class="button_confirm_payment">
                        {{ __('lms.confirm_payment') }}</button>
                </form>
                <button class="print_invoice_button">{{__('global.print_invoice')}}</button>
                <button class="invoice_cancel_button">{{__('global.cancel')}}</button>
            </div>
        </div>
    </div>
</section>
<script src="{{ asset('frontend/js/collapse_invoice_title.js') }}"></script>
@endsection
