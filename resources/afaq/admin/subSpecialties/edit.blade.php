@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.subSpecialty.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sub-specialties.update", [$subSpecialty->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="specialty_id">{{ trans('cruds.subSpecialty.fields.specialty') }}</label>
                <select class="form-control select2 {{ $errors->has('specialty') ? 'is-invalid' : '' }}" name="specialty_id" id="specialty_id" required>
                    @foreach($specialties as $id => $entry)
                        <option value="{{ $id }}" {{ (old('specialty_id') ? old('specialty_id') : $subSpecialty->specialty->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('specialty'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specialty') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subSpecialty.fields.specialty_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name_en">{{ trans('cruds.subSpecialty.fields.name_en') }}</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', $subSpecialty->name_en) }}" required>
                @if($errors->has('name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subSpecialty.fields.name_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_ar">{{ trans('cruds.subSpecialty.fields.name_ar') }}</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', $subSpecialty->name_ar) }}">
                @if($errors->has('name_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.subSpecialty.fields.name_ar_helper') }}</span>
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