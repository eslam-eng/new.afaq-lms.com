@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.businessPackage.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" class="row" action="{{ route("admin.business-packages.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group col-xl-6 col-lg-6 col-md-12">
                <label class="required" for="package_name_en">{{ trans('cruds.businessPackage.fields.package_name_en') }}</label>
                <input class="form-control {{ $errors->has('package_name_en') ? 'is-invalid' : '' }}" type="text" name="package_name_en" id="package_name_en" value="{{ old('package_name_en', '') }}" required>
                @if($errors->has('package_name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_name_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.package_name_en_helper') }}</span>
            </div>
            <div class="form-group col-xl-6 col-lg-6 col-md-12">
                <label class="required" for="package_name_ar">{{ trans('cruds.businessPackage.fields.package_name_ar') }}</label>
                <input class="form-control {{ $errors->has('package_name_ar') ? 'is-invalid' : '' }}" type="text" name="package_name_ar" id="package_name_ar" value="{{ old('package_name_ar', '') }}" required>
                @if($errors->has('package_name_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_name_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.package_name_ar_helper') }}</span>
            </div>

            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('online') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="online" value="0">
                    <input class="form-check-input" type="checkbox" name="online" id="online" value="1" {{ old('online', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="online">{{ trans('cruds.businessPackage.fields.online') }}</label>
                </div>
                @if($errors->has('online'))
                    <div class="invalid-feedback">
                        {{ $errors->first('online') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.online_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('hybrid') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="hybrid" value="0">
                    <input class="form-check-input" type="checkbox" name="hybrid" id="hybrid" value="1" {{ old('hybrid', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="hybrid">{{ trans('cruds.businessPackage.fields.hybrid') }}</label>
                </div>
                @if($errors->has('hybrid'))
                    <div class="invalid-feedback">
                        {{ $errors->first('hybrid') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.hybrid_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('onsite') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="onsite" value="0">
                    <input class="form-check-input" type="checkbox" name="onsite" id="onsite" value="1" {{ old('onsite', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="onsite">{{ trans('cruds.businessPackage.fields.onsite') }}</label>
                </div>
                @if($errors->has('onsite'))
                    <div class="invalid-feedback">
                        {{ $errors->first('onsite') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.onsite_helper') }}</span>
            </div>

            {{-- <div class="form-group col-xl-6 col-lg-6 col-md-12">
                <label for="price_package_annual">{{ trans('cruds.businessPackage.fields.price_package_annual') }}</label>
                <input class="form-control {{ $errors->has('price_package_annual') ? 'is-invalid' : '' }}" type="text" name="price_package_annual" id="price_package_annual" value="{{ old('price_package_annual', '') }}">
                @if($errors->has('price_package_annual'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price_package_annual') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.price_package_annual_helper') }}</span>
            </div> --}}
            {{-- <div class="form-group col-xl-6 col-lg-6 col-md-12">
                <label for="package_annual_price_offers">{{ trans('cruds.businessPackage.fields.package_annual_price_offers') }}</label>
                <input class="form-control {{ $errors->has('package_annual_price_offers') ? 'is-invalid' : '' }}" type="text" name="package_annual_price_offers" id="package_annual_price_offers" value="{{ old('package_annual_price_offers', '') }}">
                @if($errors->has('package_annual_price_offers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_annual_price_offers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.package_annual_price_offers_helper') }}</span>
            </div> --}}
            <div class="form-group col-xl-6 col-lg-6 col-md-12">
                <label class="required" for="price_package_month">{{ trans('cruds.businessPackage.fields.price_package_month') }}</label>
                <input class="form-control {{ $errors->has('price_package_month') ? 'is-invalid' : '' }}" type="text" name="price_package_month" id="price_package_month" value="{{ old('price_package_month', '') }}" required>
                @if($errors->has('price_package_month'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price_package_month') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.price_package_month_helper') }}</span>
            </div>
            <div class="form-group col-xl-6 col-lg-6 col-md-12">
                <label for="package_month_price_offers">{{ trans('cruds.businessPackage.fields.package_month_price_offers') }}</label>
                <input class="form-control {{ $errors->has('package_month_price_offers') ? 'is-invalid' : '' }}" type="text" name="package_month_price_offers" id="package_month_price_offers" value="{{ old('package_month_price_offers', '') }}">
                @if($errors->has('package_month_price_offers'))
                    <div class="invalid-feedback">
                        {{ $errors->first('package_month_price_offers') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.package_month_price_offers_helper') }}</span>
            </div>
            <div class="form-group col-xl-6 col-lg-6 col-md-12 ">
            <div class="row">
                <div class="form-group col-xl-6 col-lg-6 col-md-12">
                    <label for="event_number">{{ trans('cruds.businessPackage.fields.event_number') }}</label>
                    <input class="form-control {{ $errors->has('event_number') ? 'is-invalid' : '' }}" type="text" name="event_number" id="event_number" value="{{ old('event_number', '') }}" step="1">
                    @if($errors->has('event_number'))
                        <div class="invalid-feedback">
                            {{ $errors->first('event_number') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.businessPackage.fields.event_number_helper') }}</span>
                </div>
                <div class="form-group col-xl-6 col-lg-6 col-md-12">
                    <label for="event_number_days">{{ trans('cruds.businessPackage.fields.event_number_days') }}</label>
                    <input class="form-control {{ $errors->has('event_number_days') ? 'is-invalid' : '' }}" type="text" name="event_number_days" id="event_number_days" value="{{ old('event_number_days', '') }}" step="1">
                    @if($errors->has('event_number_days'))
                        <div class="invalid-feedback">
                            {{ $errors->first('event_number_days') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.businessPackage.fields.event_number_days_helper') }}</span>
                </div>
            </div>
            </div>

            <div class="form-group col-xl-6 col-lg-6 col-md-12">
                <label class="required" for="speakers_number">{{ trans('cruds.businessPackage.fields.speakers_number') }}</label>
                <input class="form-control {{ $errors->has('speakers_number') ? 'is-invalid' : '' }}" type="text" name="speakers_number" id="speakers_number" value="{{ old('speakers_number', '') }}" step="1" required>
                @if($errors->has('speakers_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('speakers_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.speakers_number_helper') }}</span>
            </div>
            <div class="form-group col-xl-6 col-lg-6 col-md-12">
                <label for="attendance_trainees_number">{{ trans('cruds.businessPackage.fields.attendance_trainees_number') }}</label>
                <input class="form-control {{ $errors->has('attendance_trainees_number') ? 'is-invalid' : '' }}" type="number" name="attendance_trainees_number" id="attendance_trainees_number" value="{{ old('attendance_trainees_number', '') }}" step="1">
                @if($errors->has('attendance_trainees_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendance_trainees_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.attendance_trainees_number_helper') }}</span>
            </div>
            <div class="form-group col-xl-6 col-lg-6 col-md-12">
                <label for="remote_trainees_number">{{ trans('cruds.businessPackage.fields.remote_trainees_number') }}</label>
                <input class="form-control {{ $errors->has('remote_trainees_number') ? 'is-invalid' : '' }}" type="number" name="remote_trainees_number" id="remote_trainees_number" value="{{ old('remote_trainees_number', '') }}" step="1">
                @if($errors->has('remote_trainees_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('remote_trainees_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.remote_trainees_number_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('electronic_registration_system') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="electronic_registration_system" value="0">
                    <input class="form-check-input" type="checkbox" name="electronic_registration_system" id="electronic_registration_system" value="1" {{ old('electronic_registration_system', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="electronic_registration_system">{{ trans('cruds.businessPackage.fields.electronic_registration_system') }}</label>
                </div>
                @if($errors->has('electronic_registration_system'))
                    <div class="invalid-feedback">
                        {{ $errors->first('electronic_registration_system') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.electronic_registration_system_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('e_certificate') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="e_certificate" value="0">
                    <input class="form-check-input" type="checkbox" name="e_certificate" id="e_certificate" value="1" {{ old('e_certificate', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="e_certificate">{{ trans('cruds.businessPackage.fields.e_certificate') }}</label>
                </div>
                @if($errors->has('e_certificate'))
                    <div class="invalid-feedback">
                        {{ $errors->first('e_certificate') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.e_certificate_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('customize_event_with_host_identity') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="customize_event_with_host_identity" value="0">
                    <input class="form-check-input" type="checkbox" name="customize_event_with_host_identity" id="customize_event_with_host_identity" value="1" {{ old('customize_event_with_host_identity', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="customize_event_with_host_identity">{{ trans('cruds.businessPackage.fields.customize_event_with_host_identity') }}</label>
                </div>
                @if($errors->has('customize_event_with_host_identity'))
                    <div class="invalid-feedback">
                        {{ $errors->first('customize_event_with_host_identity') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.customize_event_with_host_identity_helper') }}</span>
            </div>
{{--            <div class="form-group col-xl-4 col-lg-4 col-md-12">--}}
{{--                <label>{{ trans('cruds.businessPackage.fields.digital_marketing_event') }}</label>--}}
{{--                <select class="form-control {{ $errors->has('digital_marketing_event') ? 'is-invalid' : '' }}" name="digital_marketing_event" id="digital_marketing_event">--}}
{{--                    <option value disabled {{ old('digital_marketing_event', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>--}}
{{--                    @foreach(App\Models\BusinessPackage::DIGITAL_MARKETING_EVENT_SELECT as $key => $label)--}}
{{--                        <option value="{{ $key }}" {{ old('digital_marketing_event', '') === (string) $key ? 'selected' : '' }}> {{ trans('afaq.'.$label)  }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                @if($errors->has('digital_marketing_event'))--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('digital_marketing_event') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <span class="help-block">{{ trans('cruds.businessPackage.fields.digital_marketing_event_helper') }}</span>--}}
{{--            </div>--}}

            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('digital_marketing_event') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="digital_marketing_event" value="0">
                    <input class="form-check-input" type="checkbox" name="digital_marketing_event" id="digital_marketing_event" value="1" {{ old('digital_marketing_event', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="digital_marketing_event">{{ trans('cruds.businessPackage.fields.digital_marketing_event') }}</label>
                </div>
                @if($errors->has('digital_marketing_event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('digital_marketing_event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.digital_marketing_event_helper') }}</span>
            </div>

            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('event_fees') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="event_fees" value="0">
                    <input class="form-check-input" type="checkbox" name="event_fees" id="event_fees" value="1" {{ old('event_fees', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="event_fees">{{ trans('cruds.businessPackage.fields.event_fees') }}</label>
                </div>
                @if($errors->has('event_fees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_fees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.event_fees_helper') }}</span>
            </div>


            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('advertising_afaq_core') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="advertising_afaq_core" value="0">
                    <input class="form-check-input" type="checkbox" name="advertising_afaq_core" id="advertising_afaq_core" value="1" {{ old('advertising_afaq_core', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="advertising_afaq_core">{{ trans('cruds.businessPackage.fields.advertising_afaq_core') }}</label>
                </div>
                @if($errors->has('advertising_afaq_core'))
                    <div class="invalid-feedback">
                        {{ $errors->first('advertising_afaq_core') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.advertising_afaq_core_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('quality_control_inquiries') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="quality_control_inquiries" value="0">
                    <input class="form-check-input" type="checkbox" name="quality_control_inquiries" id="quality_control_inquiries" value="1" {{ old('quality_control_inquiries', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="quality_control_inquiries">{{ trans('cruds.businessPackage.fields.quality_control_inquiries') }}</label>
                </div>
                @if($errors->has('quality_control_inquiries'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quality_control_inquiries') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.quality_control_inquiries_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('help_center_customer_response') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="help_center_customer_response" value="0">
                    <input class="form-check-input" type="checkbox" name="help_center_customer_response" id="help_center_customer_response" value="1" {{ old('help_center_customer_response', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="help_center_customer_response">{{ trans('cruds.businessPackage.fields.help_center_customer_response') }}</label>
                </div>
                @if($errors->has('help_center_customer_response'))
                    <div class="invalid-feedback">
                        {{ $errors->first('help_center_customer_response') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.help_center_customer_response_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('technical_support') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="technical_support" value="0">
                    <input class="form-check-input" type="checkbox" name="technical_support" id="technical_support" value="1" {{ old('technical_support', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="technical_support">{{ trans('cruds.businessPackage.fields.technical_support') }}</label>
                </div>
                @if($errors->has('technical_support'))
                    <div class="invalid-feedback">
                        {{ $errors->first('technical_support') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.technical_support_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('event_accreditation') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="event_accreditation" value="0">
                    <input class="form-check-input" type="checkbox" name="event_accreditation" id="event_accreditation" value="1" {{ old('event_accreditation', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="event_accreditation">{{ trans('cruds.businessPackage.fields.event_accreditation') }}</label>
                </div>
                @if($errors->has('event_accreditation'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_accreditation') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.event_accreditation_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('event_free_collection') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="event_free_collection" value="0">
                    <input class="form-check-input" type="checkbox" name="event_free_collection" id="event_free_collection" value="1" {{ old('event_free_collection', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="event_free_collection">{{ trans('cruds.businessPackage.fields.event_free_collection') }}</label>
                </div>
                @if($errors->has('event_free_collection'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_free_collection') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.event_free_collection_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('e_certificate_speaker') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="e_certificate_speaker" value="0">
                    <input class="form-check-input" type="checkbox" name="e_certificate_speaker" id="e_certificate_speaker" value="1" {{ old('e_certificate_speaker', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="e_certificate_speaker">{{ trans('cruds.businessPackage.fields.e_certificate_speaker') }}</label>
                </div>
                @if($errors->has('e_certificate_speaker'))
                    <div class="invalid-feedback">
                        {{ $errors->first('e_certificate_speaker') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.e_certificate_speaker_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('two_email_trainees') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="two_email_trainees" value="0">
                    <input class="form-check-input" type="checkbox" name="two_email_trainees" id="two_email_trainees" value="1" {{ old('two_email_trainees', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="two_email_trainees">{{ trans('cruds.businessPackage.fields.two_email_trainees') }}</label>
                </div>
                @if($errors->has('two_email_trainees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('two_email_trainees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.two_email_trainees_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('target_groups_mails') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="target_groups_mails" value="0">
                    <input class="form-check-input" type="checkbox" name="target_groups_mails" id="target_groups_mails" value="1" {{ old('target_groups_mails', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="target_groups_mails">{{ trans('cruds.businessPackage.fields.target_groups_mails') }}</label>
                </div>
                @if($errors->has('target_groups_mails'))
                    <div class="invalid-feedback">
                        {{ $errors->first('target_groups_mails') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.target_groups_mails_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('electronic_testing_system') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="electronic_testing_system" value="0">
                    <input class="form-check-input" type="checkbox" name="electronic_testing_system" id="electronic_testing_system" value="1" {{ old('electronic_testing_system', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="electronic_testing_system">{{ trans('cruds.businessPackage.fields.electronic_testing_system') }}</label>
                </div>
                @if($errors->has('electronic_testing_system'))
                    <div class="invalid-feedback">
                        {{ $errors->first('electronic_testing_system') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.electronic_testing_system_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('effectiveness_rating_system') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="effectiveness_rating_system" value="0">
                    <input class="form-check-input" type="checkbox" name="effectiveness_rating_system" id="effectiveness_rating_system" value="1" {{ old('effectiveness_rating_system', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="effectiveness_rating_system">{{ trans('cruds.businessPackage.fields.effectiveness_rating_system') }}</label>
                </div>
                @if($errors->has('effectiveness_rating_system'))
                    <div class="invalid-feedback">
                        {{ $errors->first('effectiveness_rating_system') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.effectiveness_rating_system_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('discount_free_coupon') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="discount_free_coupon" value="0">
                    <input class="form-check-input" type="checkbox" name="discount_free_coupon" id="discount_free_coupon" value="1" {{ old('discount_free_coupon', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="discount_free_coupon">{{ trans('cruds.businessPackage.fields.discount_free_coupon') }}</label>
                </div>
                @if($errors->has('discount_free_coupon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('discount_free_coupon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.discount_free_coupon_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('event_reports') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="event_reports" value="0">
                    <input class="form-check-input" type="checkbox" name="event_reports" id="event_reports" value="1" {{ old('event_reports', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="event_reports">{{ trans('cruds.businessPackage.fields.event_reports') }}</label>
                </div>
                @if($errors->has('event_reports'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_reports') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.event_reports_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('attendance_absence_qr_system') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="attendance_absence_qr_system" value="0">
                    <input class="form-check-input" type="checkbox" name="attendance_absence_qr_system" id="attendance_absence_qr_system" value="1" {{ old('attendance_absence_qr_system', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="attendance_absence_qr_system">{{ trans('cruds.businessPackage.fields.attendance_absence_qr_system') }}</label>
                </div>
                @if($errors->has('attendance_absence_qr_system'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attendance_absence_qr_system') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.attendance_absence_qr_system_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('printable_id_card') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="printable_id_card" value="0">
                    <input class="form-check-input" type="checkbox" name="printable_id_card" id="printable_id_card" value="1" {{ old('printable_id_card', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="printable_id_card">{{ trans('cruds.businessPackage.fields.printable_id_card') }}</label>
                </div>
                @if($errors->has('printable_id_card'))
                    <div class="invalid-feedback">
                        {{ $errors->first('printable_id_card') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.printable_id_card_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('conference_workshops_attendance') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="conference_workshops_attendance" value="0">
                    <input class="form-check-input" type="checkbox" name="conference_workshops_attendance" id="conference_workshops_attendance" value="1" {{ old('conference_workshops_attendance', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="conference_workshops_attendance">{{ trans('cruds.businessPackage.fields.conference_workshops_attendance') }}</label>
                </div>
                @if($errors->has('conference_workshops_attendance'))
                    <div class="invalid-feedback">
                        {{ $errors->first('conference_workshops_attendance') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.conference_workshops_attendance_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('send_messages_event_participants') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="send_messages_event_participants" value="0">
                    <input class="form-check-input" type="checkbox" name="send_messages_event_participants" id="send_messages_event_participants" value="1" {{ old('send_messages_event_participants', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="send_messages_event_participants">{{ trans('cruds.businessPackage.fields.send_messages_event_participants') }}</label>
                </div>
                @if($errors->has('send_messages_event_participants'))
                    <div class="invalid-feedback">
                        {{ $errors->first('send_messages_event_participants') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.send_messages_event_participants_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('event_notification_mobile') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="event_notification_mobile" value="0">
                    <input class="form-check-input" type="checkbox" name="event_notification_mobile" id="event_notification_mobile" value="1" {{ old('event_notification_mobile', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="event_notification_mobile">{{ trans('cruds.businessPackage.fields.event_notification_mobile') }}</label>
                </div>
                @if($errors->has('event_notification_mobile'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_notification_mobile') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.event_notification_mobile_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('fixed_advertising_banner') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="fixed_advertising_banner" value="0">
                    <input class="form-check-input" type="checkbox" name="fixed_advertising_banner" id="fixed_advertising_banner" value="1" {{ old('fixed_advertising_banner', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="fixed_advertising_banner">{{ trans('cruds.businessPackage.fields.fixed_advertising_banner') }}</label>
                </div>
                @if($errors->has('fixed_advertising_banner'))
                    <div class="invalid-feedback">
                        {{ $errors->first('fixed_advertising_banner') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.fixed_advertising_banner_helper') }}</span>
            </div>
            <div class="form-group col-xl-4 col-lg-4 col-md-12">
                <div class="form-check {{ $errors->has('responsible_employee_manage_event') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="responsible_employee_manage_event" value="0">
                    <input class="form-check-input" type="checkbox" name="responsible_employee_manage_event" id="responsible_employee_manage_event" value="1" {{ old('responsible_employee_manage_event', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="responsible_employee_manage_event">{{ trans('cruds.businessPackage.fields.responsible_employee_manage_event') }}</label>
                </div>
                @if($errors->has('responsible_employee_manage_event'))
                    <div class="invalid-feedback">
                        {{ $errors->first('responsible_employee_manage_event') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessPackage.fields.responsible_employee_manage_event_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
