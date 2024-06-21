@extends('layouts.admin')
@section('content')
<style>
    /*** CUSTOM FILE INPUT STYE ***/
    .wrap-custom-file {
        position: relative;
        display: inline-block;
        width: 150px;
        height: 150px;
        margin: 0 0.5rem 1rem;
        text-align: center;
    }

    .wrap-custom-file input[type="file"] {
        position: absolute;
        top: 0;
        left: 0;
        width: 2px;
        height: 2px;
        overflow: hidden;
        opacity: 0;
    }

    .wrap-custom-file label {
        z-index: 1;
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        width: 100%;
        overflow: hidden;
        padding: 0 0.5rem;
        cursor: pointer;
        background-color: #fff;
        border-radius: 4px;
        -webkit-transition: -webkit-transform 0.4s;
        transition: -webkit-transform 0.4s;
        transition: transform 0.4s;
        transition: transform 0.4s, -webkit-transform 0.4s;
    }

    .wrap-custom-file label span {
        display: block;
        margin-top: 2rem;
        font-size: 1.4rem;
        color: #777;
        -webkit-transition: color 0.4s;
        transition: color 0.4s;
    }

    .wrap-custom-file label .fa {
        position: absolute;
        bottom: 1rem;
        left: 50%;
        -webkit-transform: translatex(-50%);
        transform: translatex(-50%);
        font-size: 1.5rem;
        color: lightcoral;
        -webkit-transition: color 0.4s;
        transition: color 0.4s;
    }

    .wrap-custom-file label:hover {
        -webkit-transform: translateY(-1rem);
        transform: translateY(-1rem);
    }

    .wrap-custom-file label:hover span,
    .wrap-custom-file label:hover .fa {
        color: #333;
    }

    .wrap-custom-file label.file-ok {
        background-size: cover;
        background-position: center;
    }

    .wrap-custom-file label.file-ok span {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 0.3rem;
        font-size: 1.1rem;
        color: #000;
        background-color: rgba(255, 255, 255, 0.7);
    }

    .wrap-custom-file label.file-ok .fa {
        display: none;
    }
</style>
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.instructor.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('admin.instructors.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="form-group col-md-6">
                    <label class="required" for="name_ar">{{ trans('cruds.instructor.fields.name_ar') }}</label>
                    <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', '') }}" required>
                    @if ($errors->has('name_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_ar') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.instructor.fields.name_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label class="required" for="name_en">{{ trans('cruds.instructor.fields.name_en') }}</label>
                    <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', '') }}" required>
                    @if ($errors->has('name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_en') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.instructor.fields.name_helper') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label class="required" for="mail">{{ trans('cruds.instructor.fields.mail') }}</label>
                <input class="form-control {{ $errors->has('mail') ? 'is-invalid' : '' }}" type="text" name="mail" id="mail" value="{{ old('mail', '') }}" required>
                @if ($errors->has('mail'))
                <div class="invalid-feedback">
                    {{ $errors->first('mail') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.instructor.fields.mail_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="password">{{ trans('cruds.instructor.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password" required>
                @if ($errors->has('password'))
                <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.instructor.fields.password_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile">{{ trans('cruds.instructor.fields.mobile') }}</label>
                <input class="form-control {{ $errors->has('mobile') ? 'is-invalid' : '' }}" type="text" name="mobile" id="mobile" value="{{ old('mobile', '') }}">
                @if ($errors->has('mobile'))
                <div class="invalid-feedback">
                    {{ $errors->first('mobile') }}
                </div>
                @endif
                <span class="help-block">{{ trans('cruds.instructor.fields.mobile_helper') }}</span>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="bio_ar">{{ trans('cruds.instructor.fields.bio_ar') }}</label>
                    <textarea class="form-control {{ $errors->has('bio_ar') ? 'is-invalid' : '' }}" type="text" name="bio_ar" id="bio_ar" value="{{ old('bio_ar', '') }}"></textarea>
                    @if ($errors->has('bio_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bio_ar') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.instructor.fields.mobile_helper') }}</span>
                </div>
                <div class="form-group col-md-6">
                    <label for="bio_en">{{ trans('cruds.instructor.fields.bio_en') }}</label>
                    <textarea class="form-control {{ $errors->has('bio_en') ? 'is-invalid' : '' }}" type="text" name="bio_en" id="bio_en" value="{{ old('bio_en', '') }}"></textarea>
                    @if ($errors->has('bio_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('bio_en') }}
                    </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.instructor.fields.mobile_helper') }}</span>
                </div>
            </div>
            <div class="form-group">
                <label for="job_title">{{ trans('cruds.instructor.fields.job_title') }}</label>
                <input class="form-control {{ $errors->has('job_title') ? 'is-invalid' : '' }}" type="text" name="job_title" id="job_title" value="{{ old('job_title', '') }}">
                @if($errors->has('job_title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('job_title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instructor.fields.job_title_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="workplace">{{ trans('cruds.instructor.fields.workplace') }}</label>
                <input class="form-control {{ $errors->has('workplace') ? 'is-invalid' : '' }}" type="text" name="workplace" id="workplace" value="{{ old('workplace', '') }}">
                @if($errors->has('workplace'))
                    <div class="invalid-feedback">
                        {{ $errors->first('workplace') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instructor.fields.workplace_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="specialty_id">{{ trans('cruds.instructor.fields.specialization') }}</label>
                <select class="form-control select2 {{ $errors->has('specialization') ? 'is-invalid' : '' }}" name="specialty_id" id="specialty_id">
                    @foreach($specializations as $id => $entry)
                        <option value="{{ $id }}" {{ old('specialty_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('specialization'))
                    <div class="invalid-feedback">
                        {{ $errors->first('specialization') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instructor.fields.specialization_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="twitter_account">{{ trans('cruds.instructor.fields.twitter_account') }}</label>
                <input class="form-control {{ $errors->has('twitter_account') ? 'is-invalid' : '' }}" type="text" name="twitter_account" id="twitter_account" value="{{ old('twitter_account', '') }}">
                @if($errors->has('twitter_account'))
                    <div class="invalid-feedback">
                        {{ $errors->first('twitter_account') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instructor.fields.twitter_account_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.instructor.fields.recent_work') }}</label>
                @foreach(App\Models\Instructor::RECENT_WORK_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('recent_work') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="recent_work_{{ $key }}" name="recent_work" value="{{ $key }}" {{ old('recent_work', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="recent_work_{{ $key }}">{{ __('global.'.$label) }}</label>
                    </div>
                @endforeach
                @if($errors->has('recent_work'))
                    <div class="invalid-feedback">
                        {{ $errors->first('recent_work') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instructor.fields.recent_work_helper') }}</span>
            </div>
{{--            <div class="form-group">--}}
{{--                <label for="resume">{{ trans('cruds.instructor.fields.resume') }}</label>--}}
{{--                <div class="needsclick dropzone {{ $errors->has('resume') ? 'is-invalid' : '' }}" id="resume-dropzone">--}}
{{--                </div>--}}
{{--                @if($errors->has('resume'))--}}
{{--                    <div class="invalid-feedback">--}}
{{--                        {{ $errors->first('resume') }}--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <span class="help-block">{{ trans('cruds.instructor.fields.resume_helper') }}</span>--}}
{{--            </div>--}}
            <div class="form-group wrap-custom-file">
                <label class="required" for="image">{{ trans('cruds.instructor.fields.image') }}</label>
                <input type="file" value="{{ old('image', '') }}" name="image" id="image" accept=".gif, .jpg, .png" />required
                <label for="image">
                    <span>Image</span>
                    <i class="fa fa-plus-circle"></i>
                </label>
                @if ($errors->has('image'))
                <span class="text-danger">{{ $errors->first('image') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.instructor.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.instructor.fields.status') }}</label>
                @foreach(App\Models\Instructor::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', '') === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ __('lms.'.$label) }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.instructor.fields.status_helper') }}</span>
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

<script type="text/javascript">
    $('input[type="file"]').each(function() {
        // Refs
        var $file = $(this),
            $label = $file.next('label'),
            $labelText = $label.find('span'),
            labelDefault = $labelText.text();

        // When a new file is selected
        $file.on('change', function(event) {
            var fileName = $file.val().split('\\').pop(),
                tmppath = URL.createObjectURL(event.target.files[0]);
            //Check successfully selection
            if (fileName) {
                $label
                    .addClass('file-ok')
                    .css('background-image', 'url(' + tmppath + ')');
                $labelText.text(fileName);
            } else {
                $label.removeClass('file-ok');
                $labelText.text(labelDefault);
            }
        });

        // End loop of file input elements
    });
</script>
<script>
    Dropzone.options.resumeDropzone = {
        url: '{{ route('admin.instructors.storeMedia') }}',
        maxFilesize: 3, // MB
        maxFiles: 1,
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        params: {
            size: 3
        },
        success: function (file, response) {
            $('form').find('input[name="resume"]').remove()
            $('form').append('<input type="hidden" name="resume" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="resume"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function () {
            @if(isset($instructor) && $instructor->resume)
            var file = {!! json_encode($instructor->resume) !!}
            this.options.addedfile.call(this, file)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="resume" value="' + file.file_name + '">')
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
