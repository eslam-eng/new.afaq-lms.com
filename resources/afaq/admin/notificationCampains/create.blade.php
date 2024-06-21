@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.notificationCampain.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.notification-campains.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="specialty_id">{{ trans('cruds.notificationCampain.fields.specialty') }}</label>
                <select class="form-control select2 {{ $errors->has('specialty') ? 'is-invalid' : '' }}" name="specialty_id" id="specialty_id">
                    @foreach($specialties as $id => $entry)
                        <option value="{{ $id }}" {{ old('specialty_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('specialty'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specialty') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationCampain.fields.specialty_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title_en">{{ trans('cruds.notificationCampain.fields.title_en') }}</label>
                <input class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}" type="text" name="title_en" id="title_en" value="{{ old('title_en', '') }}">
                @if($errors->has('title_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationCampain.fields.title_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="title_ar">{{ trans('cruds.notificationCampain.fields.title_ar') }}</label>
                <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', '') }}">
                @if($errors->has('title_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationCampain.fields.title_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="message_en">{{ trans('cruds.notificationCampain.fields.message_en') }}</label>
                <textarea class="form-control {{ $errors->has('message_en') ? 'is-invalid' : '' }}" name="message_en" id="message_en">{{ old('message_en') }}</textarea>
                @if($errors->has('message_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationCampain.fields.message_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="message_ar">{{ trans('cruds.notificationCampain.fields.message_ar') }}</label>
                <textarea class="form-control {{ $errors->has('message_ar') ? 'is-invalid' : '' }}" name="message_ar" id="message_ar">{{ old('message_ar') }}</textarea>
                @if($errors->has('message_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('message_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationCampain.fields.message_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.notificationCampain.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\NotificationCampain::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationCampain.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="send_at">{{ trans('cruds.notificationCampain.fields.send_at') }}</label>
                <input class="form-control datetime {{ $errors->has('send_at') ? 'is-invalid' : '' }}" type="datetime-local" name="send_at" id="send_at" value="{{ date('Y-m-d\TH:i', strtotime(now())) }}" }}">
                @if($errors->has('send_at'))
                    <div class="invalid-feedback">
                        {{ $errors->first('send_at') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.notificationCampain.fields.send_at_helper') }}</span>
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
