@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.courseQuize.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.course-quizes.store",['course_id' => $course_id]) }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label class="required" for="exam_title_id">{{ trans('cruds.courseQuize.fields.exam_title') }}</label>
                    <select class="form-control select2 {{ $errors->has('exam_title') ? 'is-invalid' : '' }}" name="exam_title_id" id="exam_title_id" required>
                        @foreach($exam_titles as $id => $entry)
                            <option value="{{ $id }}" {{ old('exam_title_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('exam_title'))
                        <div class="invalid-feedback">
                            {{ $errors->first('exam_title') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseQuize.fields.exam_title_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="title_en">{{ trans('cruds.courseQuize.fields.title_en') }}</label>
                    <input class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}" type="text" name="title_en" id="title_en" value="{{ old('title_en', '') }}">
                    @if($errors->has('title_en'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title_en') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseQuize.fields.title_en_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="title_ar">{{ trans('cruds.courseQuize.fields.title_ar') }}</label>
                    <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', '') }}" required>
                    @if($errors->has('title_ar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title_ar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseQuize.fields.title_ar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="description_en">{{ trans('cruds.courseQuize.fields.description_en') }}</label>
                    <textarea class="form-control {{ $errors->has('description_en') ? 'is-invalid' : '' }}" name="description_en" id="description_en">{{ old('description_en') }}</textarea>
                    @if($errors->has('description_en'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description_en') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseQuize.fields.description_en_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="description_ar">{{ trans('cruds.courseQuize.fields.description_ar') }}</label>
                    <textarea class="form-control {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar" id="description_ar" required>{{ old('description_ar') }}</textarea>
                    @if($errors->has('description_ar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('description_ar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseQuize.fields.description_ar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="tips_guidelines">{{ trans('cruds.courseQuize.fields.tips_guidelines') }}</label>
                    <textarea class="form-control {{ $errors->has('tips_guidelines') ? 'is-invalid' : '' }}" name="tips_guidelines" id="tips_guidelines">{{ old('tips_guidelines') }}</textarea>
                    @if($errors->has('tips_guidelines'))
                        <div class="invalid-feedback">
                            {{ $errors->first('tips_guidelines') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseQuize.fields.tips_guidelines_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="success_percentage">{{ trans('cruds.courseQuize.fields.success_percentage') }}</label>
                    <input class="form-control {{ $errors->has('success_percentage') ? 'is-invalid' : '' }}" type="number" name="success_percentage" id="success_percentage" value="{{ old('success_percentage', '') }}" step="0.01" required>
                    @if($errors->has('success_percentage'))
                        <div class="invalid-feedback">
                            {{ $errors->first('success_percentage') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseQuize.fields.success_percentage_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="image">{{ trans('cruds.courseQuize.fields.image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                    </div>
                    @if($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseQuize.fields.image_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="start_at">{{ trans('cruds.courseQuize.fields.start_at') }}</label>
                    <input class="form-control datetime {{ $errors->has('start_at') ? 'is-invalid' : '' }}"  type="datetime-local" value="{{ date('Y-m-d\TH:i', strtotime(now())) }}" name="start_at" id="start_at" >
                    @if($errors->has('start_at'))
                        <div class="invalid-feedback">
                            {{ $errors->first('start_at') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseQuize.fields.start_at_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="end_at">{{ trans('cruds.courseQuize.fields.end_at') }}</label>
                    <input class="form-control datetime {{ $errors->has('end_at') ? 'is-invalid' : '' }}" type="datetime-local" value="{{ date('Y-m-d\TH:i', strtotime(now())) }}" name="end_at" id="end_at" value="{{ old('end_at') }}">
                    @if($errors->has('end_at'))
                        <div class="invalid-feedback">
                            {{ $errors->first('end_at') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseQuize.fields.end_at_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required">{{ trans('cruds.courseQuize.fields.status') }}</label>
                    @foreach(App\Models\CourseQuize::STATUS_RADIO as $key => $label)
                        <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                            <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }} required>
                            <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                        </div>
                    @endforeach
                    @if($errors->has('status'))
                        <div class="invalid-feedback">
                            {{ $errors->first('status') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.courseQuize.fields.status_helper') }}</span>
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

@section('scripts')
    <script>
        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.course-quizes.storeMedia') }}',
            maxFilesize: 4, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function (file, response) {
                $('form').find('input[name="image"]').remove()
                $('form').append('<input type="hidden" name="image" value="' + response.name + '">')
            },
            removedfile: function (file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="image"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            },
            init: function () {
                @if(isset($courseQuize) && $courseQuize->image)
                var file = {!! json_encode($courseQuize->image) !!}
                this.options.addedfile.call(this, file)
                this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                file.previewElement.classList.add('dz-complete')
                $('form').append('<input type="hidden" name="image" value="' + file.file_name + '">')
                this.options.maxFiles = this.options.maxFiles - 1
                @endif
            },
            error: function (file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }

    </script>
@endsection
