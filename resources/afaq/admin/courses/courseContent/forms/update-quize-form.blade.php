<form method="POST"
    action=""
    enctype="multipart/form-data"
    class="d-flex flex-wrap update-quize-form"
    data-parsley-validate
    >
    @method('PUT')
    @csrf
    <input type="hidden" name="lecture_type" value="quize">
    <input type="hidden" name="lecture_id" value="{{ $lecture->id }}">
    <div class="form-group col-12">
        <label class="required" for="exam_title_id">{{ trans('cruds.courseQuize.fields.exam_title') }}</label>
        <select class="form-control select2 {{ $errors->has('exam_title') ? 'is-invalid' : '' }}" name="exam_title_id"
            id="exam_title_id" required  data-parsley-required-message="{{ trans('global.required') }}">
            @foreach ($exam_titles as $id => $entry)
                <option value="{{ $id }}"
                    {{ (old('exam_title_id') ? old('exam_title_id') : $courseQuize->exam_title->id ?? '') == $id ? 'selected' : '' }}>
                    {{ $entry }}</option>
            @endforeach
        </select>
        @if ($errors->has('exam_title'))
            <div class="invalid-feedback">
                {{ $errors->first('exam_title') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.exam_title_helper') }}</span>
    </div>
    <div class="form-group col-6" style="display: grid;">
        <label class="required" for="accessing">{{ trans('lms.accessing') }}</label>
        <select class="form-control select2 {{ $errors->has('accessing') ? 'is-invalid' : '' }}" name="accessing"
            id="accessing" required  data-parsley-required-message="{{ trans('global.required') }}">
            <option value="" disabled selected>{{ __('lms.select') }}</option>
            <option value="private" {{ $lecture->accessing == 'private' ? 'selected' : '' }}>{{ __('lms.private') }}</option>
            <option value="public" {{ $lecture->accessing == 'public' ? 'selected' : '' }}>{{ __('lms.public') }}</option>
        </select>
        @if ($errors->has('accessing'))
            <div class="invalid-feedback">
                {{ $errors->first('accessing') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.exam_title_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label for="repeat_times">{{ __('lms.repeat_times') }}</label>
        <input type="text" name="repeat_times" id="repeat_times" value="{{ $courseQuize->repeat_times }}" class="form-control">
    </div>
    <div class="form-group col-6">
        <label for="title_en">{{ trans('cruds.courseQuize.fields.title_en') }}</label>
        <input class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}" type="text" name="title_en"
            id="title_en" value="{{ old('title_en', $courseQuize->title_en) }}">
        @if ($errors->has('title_en'))
            <div class="invalid-feedback">
                {{ $errors->first('title_en') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.title_en_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label class="required" for="title_ar">{{ trans('cruds.courseQuize.fields.title_ar') }}</label>
        <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar"
            id="title_ar" value="{{ old('title_ar', $courseQuize->title_ar) }}" required  data-parsley-required-message="{{ trans('global.required') }}">
        @if ($errors->has('title_ar'))
            <div class="invalid-feedback">
                {{ $errors->first('title_ar') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.title_ar_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label for="description_en">{{ trans('cruds.courseQuize.fields.description_en') }}</label>
        <textarea class="form-control {{ $errors->has('description_en') ? 'is-invalid' : '' }}" name="description_en"
            id="description_en">{{ old('description_en', $courseQuize->description_en) }}</textarea>
        @if ($errors->has('description_en'))
            <div class="invalid-feedback">
                {{ $errors->first('description_en') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.description_en_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label class="required" for="description_ar">{{ trans('cruds.courseQuize.fields.description_ar') }}</label>
        <textarea class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar"
            id="description_ar" required  data-parsley-required-message="{{ trans('global.required') }}">{{ old('description_ar', $courseQuize->description_ar) }}</textarea>
        @if ($errors->has('description_ar'))
            <div class="invalid-feedback">
                {{ $errors->first('description_ar') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.description_ar_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label for="tips_guidelines">{{ trans('cruds.courseQuize.fields.tips_guidelines') }}</label>
        <textarea class="form-control {{ $errors->has('tips_guidelines') ? 'is-invalid' : '' }}" name="tips_guidelines"
            id="tips_guidelines">{{ old('tips_guidelines', $courseQuize->tips_guidelines) }}</textarea>
        @if ($errors->has('tips_guidelines'))
            <div class="invalid-feedback">
                {{ $errors->first('tips_guidelines') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.tips_guidelines_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label class="required"
            for="success_percentage">{{ trans('cruds.courseQuize.fields.success_percentage') }}</label>
        <input class="form-control {{ $errors->has('success_percentage') ? 'is-invalid' : '' }}" type="number"
            name="success_percentage" id="success_percentage"
            value="{{ old('success_percentage', $courseQuize->success_percentage) }}" step="0.01" required  data-parsley-required-message="{{ trans('global.required') }}">
        @if ($errors->has('success_percentage'))
            <div class="invalid-feedback">
                {{ $errors->first('success_percentage') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.success_percentage_helper') }}</span>
    </div>
    {{-- <div class="form-group col-6">
        <label class="required" for="image">{{ trans('cruds.courseQuize.fields.image') }}</label>
        <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone-{{ $lecture->id }}">
        </div>
        @if ($errors->has('image'))
            <div class="invalid-feedback">
                {{ $errors->first('image') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.image_helper') }}</span>
    </div> --}}
    <div class="form-group col-6">
        <label for="start_at">{{ trans('cruds.courseQuize.fields.start_at') }}</label>
        <input class="form-control datetime {{ $errors->has('start_at') ? 'is-invalid' : '' }}" type="datetime-local"
            name="start_at" id="start_at" value="{{ date('Y-m-d\TH:i', strtotime($courseQuize->start_at)) }}">
        @if ($errors->has('start_at'))
            <div class="invalid-feedback">
                {{ $errors->first('start_at') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.start_at_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label for="end_at">{{ trans('cruds.courseQuize.fields.end_at') }}</label>
        <input class="form-control datetime {{ $errors->has('end_at') ? 'is-invalid' : '' }}" type="datetime-local"
            name="end_at" id="end_at" value="{{ old('end_at', $courseQuize->end_at) }}">
        @if ($errors->has('end_at'))
            <div class="invalid-feedback">
                {{ $errors->first('end_at') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.end_at_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label class="required">{{ trans('cruds.courseQuize.fields.status') }}</label>
        @foreach (App\Models\CourseQuize::STATUS_RADIO as $key => $label)
            <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status"
                    value="{{ $key }}"
                    {{ old('status', $courseQuize->status) === (string) $key ? 'checked' : '' }} required  data-parsley-required-message="{{ trans('global.required') }}">
                <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
            </div>
        @endforeach
        @if ($errors->has('status'))
            <div class="invalid-feedback">
                {{ $errors->first('status') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.status_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <button class="btn btn-success quize-update" type="button" lecture-id ="{{ $lecture->id }}">
            {{ trans('global.save') }}
        </button>
    </div>
</form>
