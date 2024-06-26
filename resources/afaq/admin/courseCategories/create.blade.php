@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.courseCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.course-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name_en">{{ trans('cruds.courseCategory.fields.name_en') }}</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', '') }}" required>
                @if($errors->has('name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseCategory.fields.name_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="name_ar">{{ trans('cruds.courseCategory.fields.name_ar') }}</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', '') }}">
                @if($errors->has('name_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.courseCategory.fields.name_ar_helper') }}</span>
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