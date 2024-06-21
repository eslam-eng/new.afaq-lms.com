@php
    $lang = app()->getLocale();
   // $ContentCategory = \App\Models\ContentCategory::get();

    if ($lang == 'ar') {

        $countries = App\Models\Country::select('id', 'country_arName as country', 'country_arNationality as national', 'country_code', 'order')
            ->whereNull('parent_id')
            ->get()
            ->sortBy('order');
    } else {

        $countries = App\Models\Country::select('id', 'country_enName as country', 'country_enNationality as national', 'country_code', 'order')
            ->whereNull('parent_id')
            ->get()
            ->sortBy('order');
    }
@endphp
@extends('frontend.business.layout.main')
@section('title' ,__('lms.complete_profile'))
@section('content')
    <main class="home-page log-in-page">
        <section class="login-page">
            <div class="log-layer">
                <img  src="{{ asset('afaq/business/imgs/bs-backg.png') }}" alt="">
            </div>
            <div class="log-in-form">
                @if ($errors->any())
                    {!! implode('', $errors->all('<div class="alert alert-danger">:message</div>')) !!}
                @endif
                <form method="post" action="{{ url(app()->getLocale() . '/edit_myprofile') }}" id="infoForm"
                      enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="business" id="business" value="2" >

                    <div class="login-main main-body register-page">
                        <div class="close-form">
                            <a href="{{ route('business-home', ['locale' => app()->getLocale()]) }}"><i class="fa-solid fa-xmark"></i></a>
                        </div>
                        <div class="sm-log">
                            <div class="afaq-logo" href="{{ route('business-home', ['locale' => app()->getLocale()]) }}">
                                <img  src="{{ asset('afaq\business/imgs/AFAQ.png') }}" alt="">
                            </div>
                            {{-- <div class="creat-acc-btn">

                                <a href="{{ url(app()->getLocale() . '/new_login') }}">
                                    <span>{{ __('lms.login') }}</span></a>
                            </div> --}}
                        </div>
                        <div class="type-login">
                            <span>{{ __('afaq.complete_account') }}</span>
                            {{-- <div class="type-way">
                                <div class="social-log">
                                    <button class="google-login">
                                        <div class="icon-img">
                                            <img  src="{{ asset('afaq\business/imgs/icon-gr-2.svg') }}"
                                                alt="">
                                        </div>
                                    </button>
                                </div>
                                <span class="w-10-"></span>
                                <div class="social-log">
                                    <button class="google-login">
                                        <div class="icon-img">
                                            <img  src="{{ asset('afaq\business/imgs/icon-gr-1.svg') }}"
                                                alt="">
                                        </div>
                                    </button>
                                </div>
                            </div> --}}
                        </div>
                        <div class="log-form-details">
                            <div class="frst-step active tabes-step">
                                <div class="register-group">
                                    <div class="form-gr ">
                                        {{--                                        <input type="text" placeholder="Main Classification">--}}
                                        <select onchange="get_sub_specialists()" required
                                                id="specialty_id" name="specialty_id" >
                                            @if ($specialists)
                                                @foreach ($specialists as $specialist)
                                                    <option value="{{ $specialist->id }}"
                                                            {{ old('specialty_id', $data->specialty_id) == $specialist->id ? 'selected' : '' }}>
                                                        {{ $specialist->name }}
                                                    </option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                    <div class="form-gr " id="subs" style="display: none;">

                                    </div>


                                    <div class="form-gr ">
{{--                                        <input type="text" placeholder="Health Specialties Authority Number">--}}
                                        <input

                                                type="text" name="occupational_classification_number"
                                                id="occupational_classification_number"
                                                value="{{ old('occupational_classification_number', '') }}"
                                                placeholder="{{ trans('frontend.register.occupational_classification_number') }}" required>
                                    </div>
                                    <div class="form-gr ">
                                    <select

                                            id="nationality_id" name="nationality_id" required>
                                        <option value=""> {{ trans('global.pleaseSelect') }}</option>
                                        @foreach ($countries as $item)
                                            <option value="{{ $item->id }}" data-code="{{ $item->country_code }}"
                                                    {{ $item->id == old('nationality_id', '') ? 'selected' : '' }}>
                                                {{ $item->national }}</option>
                                        @endforeach
                                    </select>
                                    </div>

                                    <div class="termis-condtion">
                                        <input type="checkbox" name="terms" value="{{ old('terms', true) }}" required class="mx-2">
                                        <em>{{ __('lms.Accept') }}
                                            <a href="#" onclick="getPageContent('Terms and Conditions');return false;"  >
                                                {{ __('lms.Terms') }}
                                            </a>
                                            {{ __('lms.and') }}
                                            <a href="#" onclick="getPageContent('Privacy Policy');return false;">
                                                {{ __('lms.PrivacyStatements') }}
                                            </a>
                                        </em>
                                    </div>

                                    <div class="submit-log">
                                        <button     onclick="$('#infoForm').submit()"> {{ __('afaq.Save') }}</button>

                                    </div>
                                </div>

                            </div>
                        </div>


                        <div class="creat-new-acc">
                            <span>{{ __('lms.AlreadyhaveAccount') }}?
                                <a href="{{ url(app()->getLocale() . '/new_login') }}">
                                    {{ __('lms.login') }}</a>
                            </span>
                        </div>


                    </div>

                </form>

            </div>
        </section>
    </main>
@endsection

{{--function get_sub_specialists called in footer scripts--}}
