@extends('frontend.business.layout.main')

@section('content')
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
{{--    <link href="{{ asset('afaq/assests/css/register.css') }}" rel="stylesheet">--}}

        <section class="main-creat-event container">
            <strong>{{ __('afaq.Create_event') }} <em>{{ __('afaq.afaq_usiness') }}</em></strong>
            <p>
                {{ __('afaq.Create_event_details') }}

            </p>
            <form    action="{{ url(app()->getLocale().'/business-special-request') }}" method="post"  enctype="multipart/form-data" >
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        <div class="alert-icon">
                            <i class="flaticon-warning "></i>
                        </div>
                        <div class="alert-text">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div><br />
                @endif
                <div class="event-information">
                    <span class="event-title">

                         {{__('afaq.Event_Information')}}
                    </span>
                    <div class="evnt-info-form">
                        <div class="evnt-details-info">
                            <label class="required" for="event_type_id">{{ trans('cruds.businessSpecialRequest.fields.event_type') }} * <em>({{__('afaq.required')}})</em></label>

                            <select  name="event_type_id" id="event_type_id" required>

                            @foreach($event_types as $id => $entry)
                                    <option value="{{ $id }}" {{ old('event_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                                @endforeach
                            </select>
                            <i class="fa-solid fa-chevron-down"></i>
                            @if($errors->has('event_type'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_type') }}
                                </div>
                            @endif
                        </div>

                        <div class="evnt-details-info">

                            <label  for="number_of_attendees">{{ trans('cruds.businessSpecialRequest.fields.number_of_attendees') }}*<em>({{__('afaq.required')}})</em></label>


                            <input class="fr-number-fild" placeholder="50 - 100"  type="text" name="number_of_attendees" id="number_of_attendees" value="{{ old('number_of_attendees', '') }}" required>

                            <i class="fa-solid fa-user-plus user-"></i>
                            @if($errors->has('number_of_attendees'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('number_of_attendees') }}
                                </div>
                            @endif
                        </div>



                        <div class="evnt-details-info">

                            <label for="event_starting_date">{{ trans('cruds.businessSpecialRequest.fields.event_starting_date') }}*<em>({{__('afaq.required')}})</em></label>
                            <input  type="date" name="event_starting_date" id="event_starting_date" placeholder="50 - 100" value="{{ old('event_starting_date') }}" required>

                            <!-- <i class="fa-regular fa-calendar"></i> -->
                            @if($errors->has('event_starting_date'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('event_starting_date') }}
                                </div>
                            @endif
                        </div>
                        <div class="evnt-details-info textarea-fild">

                            <label  for="details">{{__('afaq.how_help')}} *<em>({{__('afaq.required')}})</em></label>
                            <textarea  name="details" id="details" cols="20" rows="8" required></textarea>
                            @if($errors->has('details'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('details') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <span class="event-title">

                        {{__('afaq.Contact_Information')}}
                    </span>
                    <div class="evnt-info-form fr-last-fild">
                        <div class="evnt-details-info">
                            <label   for="">{{ trans('cruds.businessSpecialRequest.fields.full_name') }}*<em>({{__('afaq.required')}})</em></label>

                            <input  type="text" name="full_name"  id="full_name" minlength="2" maxlength="45" required>
                            @if($errors->has('full_name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('full_name') }}
                                </div>
                            @endif
                        </div>
                        <em></em>
                        <div class="evnt-details-info">

                            <label for="employer">{{ trans('cruds.businessSpecialRequest.fields.employer') }}*<em>({{__('afaq.required')}})</em></label>
                            <input required type="text" name="employer" id="employer"  >
                            @if($errors->has('employer'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('employer') }}
                                </div>
                            @endif
                        </div>
                        <em></em>
                        <div class="evnt-details-info">
                            <label for="job_title">{{ trans('cruds.businessSpecialRequest.fields.job_title') }}*<em>({{__('afaq.required')}})</em></label>
                            <input type="text" required name="job_title" id="job_title"   >
                            @if($errors->has('job_title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('job_title') }}
                                </div>
                            @endif
                        </div>

                        <div class="evnt-details-info">
                            <label  for="phone_number">{{ trans('cruds.businessSpecialRequest.fields.phone_number') }}*<em>({{__('afaq.required')}})</em></label>

                            <input max="9" required type="text" id="mobile_code" name="phone_number[full]" >

                        </div>
                        @if ($errors->has('mobile_code'))
                            <div class="invalid-feedback">
                                {{ $errors->first('mobile_code') }}
                            </div>
                        @endif
                        <em></em>
                        <div class="evnt-details-info">

                            <label for="email_address">{{ trans('frontend.register.Email') }} *<em>({{__('afaq.required')}})</em>
                            </label>
                            <input type="email" name="email_address"
                                   required
                                   placeholder="{{ trans('frontend.register.Email') }}"
                                   value="{{ old('email_address', null) }}">
                        </div>
                    </div>
                </div>
                <div class="accept-termis">
                    <input type="checkbox" name="accept_terms" value="{{ old('accept_terms', true) }}" required>
                    <span class="w-10-"></span>
                    <span>{{ __('lms.Accept') }}
                        <a id="terms" class=" open-termis termos-popup" href="#"
                           onclick="getPageContent('Terms and Conditions');return false;">
                            {{ __('lms.Terms') }}
                        </a>

{{--                                        <div class="modal-Checkout-lms condations-nd">--}}
{{--                                            <div class="close-icons">X</div>--}}
{{--                                            <div class="termis-data"></div>--}}
{{--                                        </div>--}}

                                        {{ __('lms.and') }}
                                        <a id="privacy" class="open-termistwo condation-popup" href="#"
                                           onclick="getPageContent('Privacy Policy');return false;">
                                            {{ __('lms.PrivacyStatements') }}
                                        </a>

{{--                                        <div class="modal-Checkout-lmss condations-nd">--}}
{{--                                            <div class="close-icons">X</div>--}}
{{--                                          --}}
{{--                                            <div class="termis-data"></div>--}}
{{--                                        </div>--}}
                    </span>
                </div>
                <div class="send-btn">
                    <button type="submit">{{__('afaq.Submit')}}</button>
                </div>
            </form>
        </section>

        <div class="termis-popup-window">
    <div class="card-window">
        <div class="close-window">
            <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="body-window"></div>
    </div>
</div>
<div class="condations-popup-window">
    <div class="card-window">
        <div class="close-window">
            <i class="fa-regular fa-circle-xmark"></i>
        </div>
        <div class="body-window"></div>
    </div>
</div>





@endsection
@push('scripts')
    <script>

        function getPageContent(title) {

            if (title) {

                $('.loading_div').addClass('animated')
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/api/v1/page-content/' + title,
                    success: function(data) {
                        @if (app()->getLocale() == 'ar')

                        $('.body-window').html(data.data.page_text_ar ? data.data.page_text_ar :
                            "there is no data check the admin");
                        $('.andcondations-nd').show();
                        @else
                        $('.body-window').html(data.data.page_text ? data.data.page_text :
                            "there is no data check the admin");
                        $('.andcondations-nd').show();
                        @endif
                        $('.loading_div').removeClass('animated');
                    }
                });
            }
        }
    </script>

@endpush
