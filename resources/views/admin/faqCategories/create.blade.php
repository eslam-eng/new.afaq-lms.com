@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.faqCategory.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.faq-categories.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="category_ar">{{ trans('cruds.faqCategory.fields.category_ar') }}</label>
                <input class="form-control {{ $errors->has('category_ar') ? 'is-invalid' : '' }}" type="text" name="category_ar" id="category_ar" value="{{ old('category_ar', '') }}" required>
                @if($errors->has('category_ar'))
                <div class="invalid-feedback">
                    {{ $errors->first('category_ar') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqCategory.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_en">{{ trans('cruds.faqCategory.fields.category_en') }}</label>
                <input class="form-control {{ $errors->has('category_en') ? 'is-invalid' : '' }}" type="text" name="category_en" id="category_en" value="{{ old('category_en', '') }}" required>
                @if($errors->has('category_en'))
                <div class="invalid-feedback">
                    {{ $errors->first('category_en') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqCategory.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.notificationCampain.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\FaqCategory::TYPE_SELECT as $key => $label)
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
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
