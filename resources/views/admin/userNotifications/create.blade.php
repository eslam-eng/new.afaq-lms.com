@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.userNotification.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.user-notifications.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="parent_id">{{ trans('cruds.userNotification.fields.parent') }}</label>
                    <input class="form-control {{ $errors->has('parent_id') ? 'is-invalid' : '' }}" type="number" name="parent_id" id="parent_id" value="{{ old('parent_id', '') }}">
                    @if($errors->has('parent_id'))
                        <div class="invalid-feedback">
                            {{ $errors->first('parent_id') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.parent_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="user_id">{{ trans('cruds.userNotification.fields.user') }}</label>
                    <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                        @foreach($users as $id => $entry)
                            <option value="{{ $id }}" {{ old('user_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
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
                    <input class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" type="text" name="type" id="type" value="{{ old('type', '') }}">
                    @if($errors->has('type'))
                        <div class="invalid-feedback">
                            {{ $errors->first('type') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.type_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="title">{{ trans('cruds.userNotification.fields.title') }}</label>
                    <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                    @if($errors->has('title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="message">{{ trans('cruds.userNotification.fields.message') }}</label>
                    <textarea class="form-control {{ $errors->has('message') ? 'is-invalid' : '' }}" name="message" id="message">{{ old('message') }}</textarea>
                    @if($errors->has('message'))
                        <div class="invalid-feedback">
                            {{ $errors->first('message') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userNotification.fields.message_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="data">{{ trans('cruds.userNotification.fields.data') }}</label>
                    <input class="form-control {{ $errors->has('data') ? 'is-invalid' : '' }}" type="text" name="data" id="data" value="{{ old('data', '') }}">
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
                            <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }}>
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
                            <input class="form-check-input" type="radio" id="read_{{ $key }}" name="read" value="{{ $key }}" {{ old('read', '') === (string) $key ? 'checked' : '' }}>
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
                    <input class="form-control {{ $errors->has('fcm_token') ? 'is-invalid' : '' }}" type="text" name="fcm_token" id="fcm_token" value="{{ old('fcm_token', '') }}">
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
