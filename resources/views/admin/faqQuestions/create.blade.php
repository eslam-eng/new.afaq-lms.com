@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.faqQuestion.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.faq-questions.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.faqQuestion.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="category_id" id="category_id" required>
                    @foreach($categories as $id => $category)
                    <option value="{{ $id }}" {{ old('category_id') == $id ? 'selected' : '' }}>{{ $category }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                <div class="invalid-feedback">
                    {{ $errors->first('category') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.faqQuestion.fields.category_helper') }}</span>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="required" for="question_ar">{{ trans('cruds.faqQuestion.fields.question_ar') }}</label>
                    <textarea class="form-control {{ $errors->has('question_ar') ? 'is-invalid' : '' }}" name="question_ar" id="question_ar" required>{{ old('question_ar') }}</textarea>
                    @if($errors->has('question_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_ar') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.faqQuestion.fields.question_ar_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="question_en">{{ trans('cruds.faqQuestion.fields.question_en') }}</label>
                    <textarea class="form-control {{ $errors->has('question_en') ? 'is-invalid' : '' }}" name="question_en" id="question_en" required>{{ old('question_en') }}</textarea>
                    @if($errors->has('question_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('question_en') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.faqQuestion.fields.question_en_helper') }}</span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label class="required" for="answer_ar">{{ trans('cruds.faqQuestion.fields.answer_ar') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('answer_ar') ? 'is-invalid' : '' }}" name="answer_ar" id="answer_ar" >{{ old('answer_ar') }}</textarea>
                    @if($errors->has('answer_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('answer_ar') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.faqQuestion.fields.answer_ar_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="answer_en">{{ trans('cruds.faqQuestion.fields.answer_en') }}</label>
                    <textarea class="form-control ckeditor {{ $errors->has('answer_en') ? 'is-invalid' : '' }}" name="answer_en" id="answer_en" >{{ old('answer_en') }}</textarea>
                    @if($errors->has('answer_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('answer_en') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.faqQuestion.fields.answer_en_helper') }}</span>
                </div>
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
