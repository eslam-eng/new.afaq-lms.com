@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.specialty.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.specialties.update", [$specialty->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name_en">{{ trans('cruds.specialty.fields.name_en') }}</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', $specialty->name_en) }}" required>
                @if($errors->has('name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialty.fields.name_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_ar">{{ trans('cruds.specialty.fields.name_ar') }}</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $specialty->name_ar) }}">
                @if($errors->has('name_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialty.fields.name_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.specialty.fields.show_in_homepage') }}</label>
                <select class="form-control {{ $errors->has('show_in_homepage') ? 'is-invalid' : '' }}" name="show_in_homepage" id="show_in_homepage">
                    <option value disabled {{ old('show_in_homepage', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Specialty::SHOW_IN_HOMEPAGE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('show_in_homepage', $specialty->show_in_homepage) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('show_in_homepage'))
                    <div class="invalid-feedback">
                        {{ $errors->first('show_in_homepage') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialty.fields.show_in_homepage_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="order">{{ trans('cruds.specialty.fields.order') }}</label>
                <input class="form-control {{ $errors->has('order') ? 'is-invalid' : '' }}" type="number" name="order" id="order" value="{{ old('order', $specialty->order) }}" step="1">
                @if($errors->has('order'))
                    <div class="invalid-feedback">
                        {{ $errors->first('order') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.specialty.fields.order_helper') }}</span>
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
