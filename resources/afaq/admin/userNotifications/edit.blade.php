@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.edit') }} {{ trans('cruds.userNotification.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.user-notifications.update", [$userNotification->id]) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="parent">{{ trans('cruds.userNotification.fields.parent') }}</label>
                    <input class="form-control {{ $errors->has('parent') ? 'is-invalid' : '' }}" type="text" name="parent" id="parent" value="{{ old('parent', $userNotification->parent) }}">
                    @if($errors->has('parent'))
                        <div class="invalid-feedback">
                            {{ $errors->first('parent') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.parent_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="user_id">{{ trans('cruds.userNotification.fields.user') }}</label>
                    <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                        @foreach($users as $id => $entry)
                            <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $userNotification->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('user'))
                        <div class="invalid-feedback">
                            {{ $errors->first('user') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.user_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="type">{{ trans('cruds.userNotification.fields.type') }}</label>
                    <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', $userNotification->type) }}">
                    @if($errors->has('type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.type_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="title_en">{{ trans('cruds.userNotification.fields.title_en') }}</label>
                    <input class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}" type="text" name="title_en" id="title_en" value="{{ old('title_en', $userNotification->title_en) }}">
                    @if($errors->has('title_en'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title_en') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.title_en_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="title_ar">{{ trans('cruds.userNotification.fields.title_ar') }}</label>
                    <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', $userNotification->title_ar) }}">
                    @if($errors->has('title_ar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title_ar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.title_ar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="message_en">{{ trans('cruds.userNotification.fields.message_en') }}</label>
                    <textarea class="form-control {{ $errors->has('message_en') ? 'is-invalid' : '' }}" name="message_en" id="message_en">{{ old('message_en', $userNotification->message_en) }}</textarea>
                    @if($errors->has('message_en'))
                        <div class="invalid-feedback">
                            {{ $errors->first('message_en') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.message_en_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="message_ar">{{ trans('cruds.userNotification.fields.message_ar') }}</label>
                    <textarea class="form-control {{ $errors->has('message_ar') ? 'is-invalid' : '' }}" name="message_ar" id="message_ar">{{ old('message_ar', $userNotification->message_ar) }}</textarea>
                    @if($errors->has('message_ar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('message_ar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.message_ar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="data">{{ trans('cruds.userNotification.fields.data') }}</label>
                    <input class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}" type="text" name="data" id="data" value="{{ old('data', $userNotification->data) }}">
                    @if($errors->has('data'))
                        <div class="invalid-feedback">
                            {{ $errors->first('data') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.data_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.userNotification.fields.status') }}</label>
                    @foreach(App\Models\UserNotification::STATUS_RADIO as $key => $label)
                        <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $userNotification->status) === (string) $key ? 'checked' : '' }}>
                            <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                        </div>
                    @endforeach
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.status_helper') }}</span>
                </div>
                <div class="form-group">
                    <label>{{ trans('cruds.userNotification.fields.read') }}</label>
                    @foreach(App\Models\UserNotification::READ_RADIO as $key => $label)
                        <div class="form-check {{ $errors->has('read') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="read_{{ $key }}" name="read" value="{{ $key }}" {{ old('read', $userNotification->read) === (string) $key ? 'checked' : '' }}>
                            <label class="form-check-label" for="read_{{ $key }}">{{ $label }}</label>
                        </div>
                    @endforeach
                    @if($errors->has('read'))
                        <div class="invalid-feedback">
                            {{ $errors->first('read') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.read_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="fcm_token">{{ trans('cruds.userNotification.fields.fcm_token') }}</label>
                    <input class="form-control {{ $errors->has('fcm_token') ? 'is-invalid' : '' }}" type="text" name="fcm_token" id="fcm_token" value="{{ old('fcm_token', $userNotification->fcm_token) }}">
                    @if($errors->has('fcm_token'))
                        <div class="invalid-feedback">
                            {{ $errors->first('fcm_token') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.fcm_token_helper') }}</span>
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
