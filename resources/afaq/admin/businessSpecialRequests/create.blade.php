@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.businessSpecialRequest.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.business-special-requests.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="event_type_id">{{ trans('cruds.businessSpecialRequest.fields.event_type') }}</label>
                <select class="form-control select2 {{ $errors->has('event_type') ? 'is-invalid' : '' }}" name="event_type_id" id="event_type_id" required>
                    @foreach($event_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('event_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('event_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessSpecialRequest.fields.event_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="number_of_attendees">{{ trans('cruds.businessSpecialRequest.fields.number_of_attendees') }}</label>
                <input class="form-control {{ $errors->has('number_of_attendees') ? 'is-invalid' : '' }}" type="text" name="number_of_attendees" id="number_of_attendees" value="{{ old('number_of_attendees', '') }}" required>
                @if($errors->has('number_of_attendees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('number_of_attendees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessSpecialRequest.fields.number_of_attendees_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="event_starting_date">{{ trans('cruds.businessSpecialRequest.fields.event_starting_date') }}</label>
                <input class="form-control date {{ $errors->has('event_starting_date') ? 'is-invalid' : '' }}" type="date" name="event_starting_date" id="event_starting_date" value="{{ old('event_starting_date') }}" required>
                @if($errors->has('event_starting_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('event_starting_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessSpecialRequest.fields.event_starting_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="details">{{ trans('cruds.businessSpecialRequest.fields.details') }}</label>
                <textarea class="form-control {{ $errors->has('details') ? 'is-invalid' : '' }}" name="details" id="details" required>{{ old('details') }}</textarea>
                @if($errors->has('details'))
                    <div class="invalid-feedback">
                        {{ $errors->first('details') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessSpecialRequest.fields.details_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="full_name">{{ trans('cruds.businessSpecialRequest.fields.full_name') }}</label>
                <input class="form-control {{ $errors->has('full_name') ? 'is-invalid' : '' }}" type="text" name="full_name" id="full_name" value="{{ old('full_name', '') }}" required>
                @if($errors->has('full_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('full_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessSpecialRequest.fields.full_name_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="employer">{{ trans('cruds.businessSpecialRequest.fields.employer') }}</label>
                <input class="form-control {{ $errors->has('employer') ? 'is-invalid' : '' }}" type="text" name="employer" id="employer" value="{{ old('employer', '') }}">
                @if($errors->has('employer'))
                    <div class="invalid-feedback">
                        {{ $errors->first('employer') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessSpecialRequest.fields.employer_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="job_title">{{ trans('cruds.businessSpecialRequest.fields.job_title') }}</label>
                <input class="form-control {{ $errors->has('job_title') ? 'is-invalid' : '' }}" type="text" name="job_title" id="job_title" value="{{ old('job_title', '') }}">
                @if($errors->has('job_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessSpecialRequest.fields.job_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="phone_number">{{ trans('cruds.businessSpecialRequest.fields.phone_number') }}</label>
                <input class="form-control {{ $errors->has('phone_number') ? 'is-invalid' : '' }}" type="text" name="phone_number" id="phone_number" value="{{ old('phone_number', '') }}" required>
                @if($errors->has('phone_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('phone_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessSpecialRequest.fields.phone_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email_address">{{ trans('cruds.businessSpecialRequest.fields.email_address') }}</label>
                <input class="form-control {{ $errors->has('email_address') ? 'is-invalid' : '' }}" type="email" name="email_address" id="email_address" value="{{ old('email_address') }}" required>
                @if($errors->has('email_address'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email_address') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessSpecialRequest.fields.email_address_helper') }}</span>
            </div>
{{--            <div class="form-group">--}}
{{--                <label class="required">{{ trans('cruds.businessSpecialRequest.fields.accept_terms') }}</label>--}}
{{--                @foreach(App\Models\BusinessSpecialRequest::ACCEPT_TERMS_RADIO as $key => $label)--}}
{{--                    <div class="form-check {{ $errors->has('accept_terms') ? 'is-invalid' : '' }}">--}}
{{--                        <input class="form-check-input" type="radio" id="accept_terms_{{ $key }}" name="accept_terms" value="{{ $key }}" {{ old('accept_terms', '') === (string) $key ? 'checked' : '' }} required>--}}
{{--                        <label class="form-check-label" for="accept_terms_{{ $key }}">{{ $label }}</label>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--                @if($errors->has('accept_terms'))--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('accept_terms') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <span class="help-block">{{ trans('cruds.businessSpecialRequest.fields.accept_terms_helper') }}</span>--}}
{{--            </div>--}}
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
