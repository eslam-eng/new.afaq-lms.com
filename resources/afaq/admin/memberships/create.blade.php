@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.membership.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.memberships.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="membership_type_id">{{ trans('cruds.membership.fields.membership_type') }}</label>
                <select class="form-control select2 {{ $errors->has('membership_type') ? 'is-invalid' : '' }}" name="membership_type_id" id="membership_type_id" required>
                    @foreach($membership_types as $id => $entry)
                        <option value="{{ $id }}" {{ old('membership_type_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('membership_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('membership_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.membership_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.membership.fields.time_type') }}</label>
                <select class="form-control {{ $errors->has('time_type') ? 'is-invalid' : '' }}" name="time_type" id="time_type" required>
                    <option value disabled {{ old('time_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Membership::TIME_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('time_type', '') === (string) $key ? 'selected' : '' }}>{{ trans('cruds.membership.fields.'.$label)  }}</option>
                    @endforeach
                </select>
                @if($errors->has('time_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('time_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.time_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.membership.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', '') }}" step="1" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="link">{{ trans('cruds.membership.fields.link') }}</label>
                <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text" name="link" id="link" value="{{ old('link', '') }}" required>
                @if($errors->has('link'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.membership.fields.link_helper') }}</span>
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
