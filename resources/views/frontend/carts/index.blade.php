@extends('layouts.front')
@section('content')
<style>
    .innerheader-nd {
        height: 54vh !important;
    }

    .precemp {
        bottom: 150px;
    }

    @media screen and (max-width: 830px) {
        .precemp {
            bottom: 30px;
        }
    }

    .delete_from_cart {
        position: absolute;
        top: 15px;
        left: 15px;
        color: #D15252;
        font-size: 20px
    }

    .delete_from_cart:hover {
        color: #D15252;
    }

    .ltr .delete_from_cart {
        left: auto;
        right: 15px;
    }

    /* .method{
        width: 150px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: space-between;

    } */
    /* .method img {
        width: 140px;
        height: 40px;
        max-width: 140px;
        min-width: 140px;
        max-height: 40px;
        min-height: 40px;
    } */
    .last-side-cart form.error {
        border-color: #CF5151;
        animation: fadeIn 0.5s linear;
        background-color: #CF5151;
    }

    .last-side-cart form.success {
        border-color: #00B387;
        animation: fadeIn 0.5s linear;
        background-color: #00B387;
    }

    form.promocode.error button {
        background-color: #CF5151;
        animation: fadeIn 0.5s linear;
    }

    form.promocode.success button {
        background-color: #00B387;
        animation: fadeIn 0.5s linear;
    }
    /* terms popup start */
    .all-carts #terms_popup{
        position: fixed;
        top: 0;
        left: 0;
        z-index: 999999999;
        width: 80vw;
        display: none;
        margin-left: 10vw;
        margin-top: 50px;
    }
    .all-carts #terms_popup > div{
        background-color: #fff;
        width: 100%;
        border-radius: 10px;
        padding: 0;
        height: calc(100vh - 95px);
        box-shadow: 0 0 10px #383838;
        overflow-y: scroll;
    }
    #loading_div.hide{
        display: none;
    }
    #loading_div{
        width: 150px;
        margin: 200px auto;
        display: block;
        text-align: center;
    }
    @keyframes loading{
        from {transform: rotateZ(0deg);}
        to {transform: rotateZ(1000deg);}
    }
    .animated{
        animation-name: loading;
        animation-duration: 10s;
    }
    /* terms popup end */
</style>
<section class="carts-page">

    <div class="container all-carts">
        <div id="terms_popup">
            <div></div>
        </div>
        <div class="cart-title">
            <h2> {{__('lms.shoppingCart') }}</h2>
        </div>
        @if($cart)
        <div class="row carts-row">
            <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12">
                @if(count($cart->items ?? []) > 0)

                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    @if(request('coupon_not_av'))
                    <div class="alert-danger">
                        {{ __('lms.count_not_av') }}
                    </div>
                    @endif
                    @foreach($cart->items->where('payment_provider','!=','Bank') as $item)
                    @if($item->course)
                    <div class="carts-card top-card d-flex justify-content-between align-items-center">
                        <a class="delete_from_cart" href="{{url('/'.app()->getLocale().'/carts/'.$item->course->id.'/delete')}}">
                            <i class="fa-solid fa-trash-can"></i>
                        </a>
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
                                <div class="d-flex flex-column cart-dic">
                                    <p>
                                        {!! app()->getLocale() == 'en' ? $item->course->introduction_to_course_en ?? '' : $item->course->introduction_to_course_ar ?? '' !!}
                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="last-side-cart d-flex justify-content-evenly flex-column">
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

                                @if($item->coupon_discount)
                                <span class="discount_value">{{__('global.discount_percent')}} : {{ $item->coupon_discount }} {{__('global.SAR')}}</span>
                                @endif
                            </div>


                            @if(isset($item->course_price))
                            <div class="d-flex justify-content-center">
                                <form action="{{url('/'.app()->getLocale().'/cart_item/coupon/apply')}}" method="GET" class="promocode d-flex flex-row w-100 @if($item->coupon_discount) success @endif  @error('coupon_text') error @enderror ">
                                    <input type="text" name="coupon_text" value="{{request('coupon' , $cart->coupon)}}" required placeholder="{{__('lms.enterCoupon')}}">
                                    <input type="hidden" name="item_id" value="{{$item->id}}">
                                    @if($item->coupon_discount)
                                    <a href="{{url('/'.app()->getLocale().'/cart_item/coupon/remove/'.$item->id)}}" class="success">{{__('global.cancel')}}</i></a>
                                    @else
                                    <button type="submit">{{__('lms.apply')}}</button>
                                    @endif
                                </form>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>

                @endif

                @if(count($cart->items ?? []) < 1) <span class="carts-number">
                    <em><strong>{{count($cart->items ?? []) }} </strong>{{__('lms.coursesCart') }}</em>
                    <div class="checkout-carts">
                        <div class="checkout-carts-img">
                            <img src="{{asset('/nazil/imgs/Pngtreevector cartoon cart_825939.png')}}" alt="">
                        </div>
                        <div class="checkout-title">
                            <h5>
                                {{__('lms.empityCart') }}
                            </h5>
                            <a href="{{url('/'.app()->getLocale() . '/all-courses')}}">{{__('frontend.eventandactivities')}}</a>
                        </div>
                    </div>
                    </span>
                    @endif
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
                @if(isset($cart->items) && count($cart->items) > 0)
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <div class="cart-details-total bottom-card carts-card">
                        <div class="total-cost">
                            <h4>{{__('lms.total')}}</h4>
                            @if(isset($item->course->offer) || $cart->coupon_discount)
                            <span class="descound-old-cost">{{ isset($cart->total) ? $cart->total . ' '. __('lms.currency') : __('lms.free') }}</span>
                            @endif
                            @if($cart->wallet)
                                <span class="final-cost p-1">{{ $cart->final_total ? ($cart->final_total > 0 ? $cart->final_total - $cart->wallet_discount : 0) . ' '.  __('lms.currency') :  __('lms.free') }}</span>
                                <span class="terms_and_conditions d-flex flex-row">
                                    <input type="checkbox" checked  name="" onclick="window.location.href='{{ route('admin.use_user_wallet',['locale' => app()->getLocale(),'use_wallet' => 0]) }}'" id="">
                                    <label for="">{{ __('lms.use_wallet') }}</label>
                                </span>
                            @else
                            <span class="final-cost p-1">{{ $cart->final_total ? ($cart->final_total > 0 ? $cart->final_total : 0) . ' '.  __('lms.currency') :  __('lms.free') }}</span>
                            @endif
                            @if(!$cart->wallet)
                                @if (auth()->user()->wallet && auth()->user()->wallet->balance > 0 && $cart->final_total > 0)
                                    <span class="terms_and_conditions d-flex flex-row">
                                        <input type="checkbox" name="" onclick="window.location.href='{{ route('admin.use_user_wallet',['locale' => app()->getLocale(),'use_wallet' => 1]) }}'" id="">
                                        <label for="">{{ __('lms.use_wallet') }}</label>
                                    </span>
                                @endif
                            @endif
                            <div class="terms_and_conditions">
                                <!-- <p>{{__('global.terms_and_conditions')}}</p> -->
                                <div calss="d-flex flex-row">
                                    <input type="checkbox">
                                    <span>{{__('global.agree_to')}}</span>
                                    <label onclick="getPageContent('terms')" class="required open-termis">{{__('global.terms_and_conditions')}}</label>
                                </div>
                            </div>
                            @php
                                if($cart->wallet){
                                    $final_price = $cart->final_total - $cart->wallet_discount;
                                }else{
                                    $final_price = $cart->final_total;
                                }
                            @endphp
                            @if($final_price && $final_price > 0)
                            <!-- payment methods -->
                            <div class="check-out-coust" style="z-index: 10000;">
                                <div class="Checkout" style="text-align: center;">
                                    <a href="{{route('admin.carts.payment_methods' , ['locale' => app()->getLocale()])}}" class="btn btn-primary disabled">{{__('lms.subscribe_now')}}</a>
                                </div>
                            </div>

                            @else

                            <div class="check-out-coust" style="z-index: 10000;">
                                <div class="Checkout" style="text-align: center;">
                                    <a href="{{url('/'.app()->getLocale().'/checkout/'.$cart->id.'?payment_method=0')}}" class="btn btn-primary disabled">{{__('lms.subscribe_now')}}</a>
                                </div>
                            </div>

                            @endif

                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        @endif
    </div>
</section>

<div class="modal-Checkout-lms condations-nd">
    <span id="loading_div" style="color:#fff;">
        <img src="{{ asset('/nazil/imgs/gear_loading.svg') }}" alt="loading..">
    </span>
</div>
<div class="sna-Checkout-data">
    <div class="all-termis-andcondations">
        <div class="close-option">
            <span class="close-option-btn"><i class="fas fa-times-circle"></i></span>
        </div>
        <div class="andcondations-nd p5">
            @if(auth()->user()->last_membership)
            @if(auth()->user()->last_membership->status || auth()->user()->last_membership->end_date <= date('Y-m-d')) <h3>{{__('lms.renew_subscription')}}</h3>
                @else
                <h3>{{__('lms.admin_approval')}}</h3>
                @endif
                <div class="member-onlogin-stm ">
                    <form method="post" action="{{url(app()->getLocale().'/add_mymembers')}}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="user_member_id" value="{{ auth()->user()->last_membership->id}}">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 hide">
                                <em class="our-work-onprofile">{{__('lms.member_name')}}</em>
                                <span class="details-work-onprofile">{{app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</span>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="required" for="accreditation_number">{{__('lms.member_number')}}</label>
                                    <input class="form-control {{ $errors->has('accreditation_number') ? 'is-invalid' : '' }}" type="number" name="accreditation_number" id="accreditation_number" value="{{ old('accreditation_number', auth()->user()->last_membership->accreditation_number ?? '') }}" placeholder="{{__('lms.member_number')}}" required>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="required" for="start_date">{{__('lms.member_date')}}</label>
                                    <input class="form-control " type="date" name="start_date" value="{{old('start_date' , auth()->user()->last_membership->start_date ? date('Y-m-d' ,strtotime(auth()->user()->last_membership->start_date)) : '')}}" id="start_date" placeholder="2021, Nov 22" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="required" for="end_date">{{__('lms.member_end_date')}}</label>
                                    <input class="form-control " type="date" name="end_date" value="{{old('end_date' , auth()->user()->last_membership->end_date ? date('Y-m-d' ,strtotime(auth()->user()->last_membership->end_date)) : '')}}" id="end_date" placeholder="2021, Nov 22" required>
                                </div>
                            </div>
                        </div>
                        <div class="chose-file-lms d-flex justify-content-start mt-5">
                            <div class="stm-chose-">
                                <em class="our-work-onprofile"> {{__('lms.upload_document')}}</em>
                            </div>
                            <div style="width: 60px;"></div>
                            <div class="stm-chose-filename">
                                <div class="wrap">
                                    <div class="file">
                                        <div class="file__input" id="file__input">
                                            <input class="file__input--file required" id="file" type="file" name="file" required />
                                            <label class="file__input--label" for="file" data-text-btn="Upload"><i class="fas fa-file-download"></i>{{__('lms.upload')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(auth()->user()->last_membership->file)
                        <div class="lms-after-chose-file mt-5">
                            <a target="_blank" href="{{auth()->user()->last_membership->file->url ?? '#'}}">
                                <div class="d-flex justify-content-between stm-filechosen">
                                    <span class="file-name-lms"><i class="far fa-file-pdf"></i>{{auth()->user()->last_membership->file->file_name}} </span>
                                    <!-- <button class="delate-name-lms">مسح<i class="fas fa-trash-alt"></i></button> -->
                                </div>
                            </a>
                        </div>
                        @endif
                        <div class="sae-btn-lms-stm">
                            <button type="submit">{{__('lms.Save')}}</button>
                            <div style="width: 50px;"></div>
                            <div class="submit-now">
                                {{__('lms.not_now')}}
                                <a href="{{url(app()->getLocale().'/membership')}}">{{__('lms.active_now')}}</a>
                            </div>


                        </div>
                    </form>
                </div>
                @else
                <h3>{{__('lms.select_member_info')}}</h3>
                <div class="member-onlogout-stm ">
                    <form method="post" action="{{url(app()->getLocale().'/add_mymembers')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <em class="our-work-onprofile">{{__('lms.member_name')}}</em>
                                <span class="details-work-onprofile">{{app()->getLocale() == 'en' ? auth()->user()->full_name_en : auth()->user()->full_name_ar }}</span>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="required" for="accreditation_number">{{__('lms.member_number')}}</label>
                                    <input class="form-control {{ $errors->has('accreditation_number') ? 'is-invalid' : '' }}" type="text" name="accreditation_number" id="accreditation_number" value="{{ old('accreditation_number', '') }}" placeholder="{{__('lms.member_number')}}" required>

                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="required" for="start_date">{{__('lms.member_date')}}</label>
                                    <input class="form-control " type="date" name="start_date" id="start_date" placeholder="2021, Nov 22" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label class="required" for="end_date">{{__('lms.member_end_date')}}</label>
                                    <input class="form-control " type="date" name="end_date" id="end_date" placeholder="2021, Nov 22" required>
                                </div>
                            </div>
                        </div>
                        <div class="chose-file-lms d-flex justify-content-start mt-5">
                            <div class="stm-chose-">
                                <em class="our-work-onprofile"> {{__('lms.upload_document')}}</em>
                            </div>
                            <div style="width: 60px;"></div>
                            <div class="stm-chose-filename">
                                <div class="wrap">

                                    <div class="file">
                                        <div class="file__input" id="file__input">
                                            <input class="file__input--file required" id="file" type="file" name="file" required />
                                            <label class="file__input--label" for="file" data-text-btn="Upload"><i class="fas fa-file-download"></i>{{__('lms.upload')}}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="sae-btn-lms-stm">
                            <button>{{__('lms.Save')}}</button>
                            <div style="width: 50px;"></div>
                            <div class="submit-now">
                                {{__('lms.not_now')}}
                                <a href="{{url(app()->getLocale().'/membership')}}">{{__('lms.active_now')}}</a>
                            </div>
                        </div>
                    </form>
                </div>
                @endif
        </div>
    </div>
</div>

<script>
    $('#loading_div').addClass('hide');
    $('.terms_and_conditions input').change(function() {
        if ($(this).is(':checked')) {
            $('.Checkout a').removeClass('disabled');
        } else {
            $('.Checkout a').addClass('disabled');

        }
    })
    // $('.terms_and_conditions input').is(':checked').function(){

    //     console.log('hi')
    // }
    function getPageContent(title) {
        if (title) {
            $('#loading_div').removeClass('hide')
            $('#loading_div').addClass('animated')
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/api/v1/page-content/' + title,
                success: function(data) {
                    @if(app()->getLocale() == 'ar')
                        $('#terms_popup > div').html(data.data.page_text_ar?data.data.page_text_ar:"there is no data check the admin");
                        $('#terms_popup').show();
                    @else
                        $('#terms_popup > div').html(data.data.page_text?data.data.page_text:"there is no data check the admin");
                        $('#terms_popup').show();
                    @endif
                    $('#loading_div').addClass('hide');
                    $('#loading_div').removeClass('animated');
                }
            });
        }
    }
    $('.modal-Checkout-lms.condations-nd').click(function(){
        $('#terms_popup').hide();
    })
</script>
@endsection
