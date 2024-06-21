@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.pointTypeValue.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.point-type-values.update", [$pointTypeValue->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="point_type_id">{{ trans('cruds.pointTypeValue.fields.point_type') }}</label>
                <select class="form-control select2 {{ $errors->has('point_type') ? 'is-invalid' : '' }}" name="point_type_id" id="point_type_id" required>
                    @foreach($point_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('point_type_id') ? old('point_type_id') : $pointTypeValue->point_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('point_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('point_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointTypeValue.fields.point_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="give_point">{{ trans('cruds.pointTypeValue.fields.give_point') }}</label>
                <input class="form-control {{ $errors->has('give_point') ? 'is-invalid' : '' }}" type="number" name="give_point" id="give_point" value="{{ old('give_point', $pointTypeValue->give_point) }}" step="1" required>
                @if($errors->has('give_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('give_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointTypeValue.fields.give_point_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="get_point">{{ trans('cruds.pointTypeValue.fields.get_point') }}</label>
                <input class="form-control {{ $errors->has('get_point') ? 'is-invalid' : '' }}" type="number" name="get_point" id="get_point" value="{{ old('get_point', $pointTypeValue->get_point) }}" step="1">
                @if($errors->has('get_point'))
                    <div class="invalid-feedback">
                        {{ $errors->first('get_point') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointTypeValue.fields.get_point_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.pointTypeValue.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status" required>
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PointTypeValue::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', $pointTypeValue->status) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.pointTypeValue.fields.status_helper') }}</span>
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