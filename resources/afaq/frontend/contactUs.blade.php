@extends('layouts.front')
<link rel="stylesheet" href="{{ asset('afaq/assests/css/contact-us-style.css') }}">
@section('title' ,__('afaq.contact-us'))
@section('content')

<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<div class="br-div px-5">
    <ul class="br-ul">
        <li><a href="{{ route('site-home',['locale'=>app()->getLocale()]) }}">{{ __('lms.homepage') }}</a> /</li>
        <li><a href="{{ route('all-courses',['locale'=>app()->getLocale()]) }}">{{ __('frontend.Contact-Us') }}</a> </li>
    </ul>
</div>
<section class="idu-programss contact-us-page pg-content">
    @if(Session::has('success'))
        <div class="alert alert-success">
            {{Session::get('success')}}
        </div>
    @endif
    @if(Session::has('fail'))
        <div class="alert alert-danger">
            {{Session::get('fail')}}
        </div>
    @endif
    <div class="col-12 all-page-details_lms" style="padding-top: 200px;">
        <div class="col-10 offset-1">
            <div class="afaq-logo d-flex justify-content-center align-items-center">
                <div class="afaq-img-log">
                    <img src="{{ asset('afaq/imgs/Group 41932.png') }}" alt="">
                    <span class="contact-us-title">{{ __('frontend.Contact-Us') }}</span>
                </div>
            </div>
            <div class="fake-height"></div>
            <div class="contact-us-quistion">
                <strong>{{ __('afaq.Technical_educational') }}</strong>
                <p>{{ __('afaq.Technical_educational_1') }}</p>
                <p>{{ __('afaq.Technical_educational_2') }}</p>
            </div>
            <div class="contact-us-quistion">
                <strong>{{ __('afaq.Technical_educational_3') }}</strong>
                <p>{{ __('afaq.Technical_educational_4') }}</p>
                <p>{{ __('afaq.Technical_educational_5') }}</p>
                <p>{{ __('afaq.Technical_educational_6') }}</p>
                <p>{{ __('afaq.Technical_educational_7') }}</p>
            </div>
            <div class="contact-us-quistion">
                <strong>{{ __('afaq.Technical_educational_8') }}</strong>
                <p>{{ __('afaq.Technical_educational_9') }}</p>
                <p>{{ __('afaq.Technical_educational_10') }}</p>
                <p>{{ __('afaq.Technical_educational_11') }}</p>
                <p>{{ __('afaq.Technical_educational_12') }}</p>
            </div>
            <div class="Technical-Support-afaq">
                <h3>{{ __('afaq.Technical_educational_13') }}</h3>
                <div class="contact-us-quistion">
                    <strong>{{ __('afaq.Technical_educational_14') }}</strong>
                    <p>{{ __('afaq.Technical_educational_15') }}</p>
                    <p>{{ __('afaq.Technical_educational_16') }}</p>
                    <p>{{ __('afaq.Technical_educational_17') }}</p>
                    <p>{{ __('afaq.Technical_educational_18') }}</p>
                </div>
            </div>
            <div class="contact-us-quistion">
                <strong>{{ __('afaq.Technical_educational_19') }} <a href="tel:920035377">920035377</a> </strong>
            </div>
            <div class="Technical-Support-afaq">
                <h3>{{ __('afaq.Contact_Information') }}</h3>
                <div class="d-flex align-items-center details-location">
                    <span>
                        <i class="fa-solid fa-location-dot"></i>
                        <em>{{ __('afaq.Contact_Information_1') }}</em>
                    </span>
                    <span>
                        <i class="fa-solid fa-envelope"></i>
                        <em>{{ __('afaq.Contact_Information_2') }}</em>
                    </span>
                    <span>
                        <i class="fa-solid fa-phone"></i>
                        <em>920035377</em>
                    </span>
                </div>
            </div>
            <div class="contact-form">

                <div class="Technical-Support-afaq">
                    <h3>{{ __('afaq.personal_info') }} </h3>
                </div>
                <form action="{{ route('enquiry_create') }}" method="post" >
                    @csrf
                    <div class="d-flex align-items-center justify-content-between forms-wrap">
                        <div class="text-name-form">
                            <label  for="name"> {{__('contact.name')}}*<em>({{__('afaq.required')}})</em></label>
                            <input  type="text" class="form-control" id="name" name="name" placeholder="{{__('contact.name')}}" minlength="2" maxlength="45" required="required" >

                        </div>
                        <div class="text-name-form">
                            <label   for="email">{{__('contact.email')}} *<em>({{__('afaq.required')}})</em></label>
                            <input type="email"  id="email" name="email" placeholder="{{__('contact.email')}}" required>

                        </div>
                        <div class="text-name-form">
                            <label for="phone">{{__('contact.phone')}}*<em>({{__('afaq.required')}})</em></label>
                            <input id="phone" name="phone_number[full]" type="tel" required>
{{--                            <span id="valid-msg" class="hide">{{__('contact.valid')}}</span>--}}
{{--                            <span id="error-msg" class="hide">{{__('contact.invalid')}}</span>--}}
                        </div>
                    </div>
                    <div class="text-area-card">
                        <label  for="cmessage">{{__('contact.your_meassage')}} *<em>({{__('afaq.required')}})</em></label>
                        <textarea required  id="cmessage" name="message" placeholder="{{__('contact.your_meassage')}}" rows="10" ></textarea>

                    </div>

{{--                    <div class="termis-condation">--}}
{{--                        <input type="checkbox">--}}
{{--                        <label>Accept Terms and Privacy Statements</label>--}}
{{--                    </div>--}}
                    <div class="send-btn mt-3">
                        <button type="submit" name="submit"   id="submit"> {{__('contact.send')}}
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection

