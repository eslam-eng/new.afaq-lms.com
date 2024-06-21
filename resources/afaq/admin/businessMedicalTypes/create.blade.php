@extends('layouts.admin')
@section('content')

    <div class="card">
        <div class="card-header">
            {{ trans('global.create') }} {{ trans('cruds.businessMedicalType.title_singular') }}
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.business-medical-types.store") }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="medical_header_en">{{ trans('cruds.businessMedicalType.fields.medical_header_en') }}</label>
                    <input class="form-control {{ $errors->has('medical_header_en') ? 'is-invalid' : '' }}" type="text" name="medical_header_en" id="medical_header_en" value="{{ old('medical_header_en', '') }}">
                    @if($errors->has('medical_header_en'))
                        <div class="invalid-feedback">
                            {{ $errors->first('medical_header_en') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.businessMedicalType.fields.medical_header_en_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="medical_header_ar">{{ trans('cruds.businessMedicalType.fields.medical_header_ar') }}</label>
                    <input class="form-control {{ $errors->has('medical_header_ar') ? 'is-invalid' : '' }}" type="text" name="medical_header_ar" id="medical_header_ar" value="{{ old('medical_header_ar', '') }}">
                    @if($errors->has('medical_header_ar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('medical_header_ar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.businessMedicalType.fields.medical_header_ar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="title_en">{{ trans('cruds.businessMedicalType.fields.title_en') }}</label>
                    <input class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}" type="text" name="title_en" id="title_en" value="{{ old('title_en', '') }}" required>
                    @if($errors->has('title_en'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title_en') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.businessMedicalType.fields.title_en_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="title_ar">{{ trans('cruds.businessMedicalType.fields.title_ar') }}</label>
                    <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', '') }}" required>
                    @if($errors->has('title_ar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('title_ar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.businessMedicalType.fields.title_ar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="short_description_en">{{ trans('cruds.businessMedicalType.fields.short_description_en') }}</label>
                    <input class="form-control {{ $errors->has('short_description_en') ? 'is-invalid' : '' }}" type="text" name="short_description_en" id="short_description_en" value="{{ old('short_description_en', '') }}">
                    @if($errors->has('short_description_en'))
                        <div class="invalid-feedback">
                            {{ $errors->first('short_description_en') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.businessMedicalType.fields.short_description_en_helper') }}</span>
                </div>
                <div class="form-group">
                    <label class="required" for="short_description_ar">{{ trans('cruds.businessMedicalType.fields.short_description_ar') }}</label>
                    <input class="form-control {{ $errors->has('short_description_ar') ? 'is-invalid' : '' }}" type="text" name="short_description_ar" id="short_description_ar" value="{{ old('short_description_ar', '') }}" required>
                    @if($errors->has('short_description_ar'))
                        <div class="invalid-feedback">
                            {{ $errors->first('short_description_ar') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.businessMedicalType.fields.short_description_ar_helper') }}</span>
                </div>
                <div class="form-group">
                    <label for="image">{{ trans('cruds.businessMedicalType.fields.image') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                    </div>
                    @if($errors->has('image'))
                        <div class="invalid-feedback">
                            {{ $errors->first('image') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.businessMedicalType.fields.image_helper') }}</span>
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
        var uploadedImageMap = {}
        Dropzone.options.imageDropzone = {
            url: '{{ route('admin.business-medical-types.storeMedia') }}',
            maxFilesize: 5, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
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
                $('form').append('<input type="hidden" name="image[]" value="' + response.name + '">')
                uploadedImageMap[file.name] = response.name
            },
            removedfile: function (file) {
                console.log(file)
                file.previewElement.remove()
                var name = ''
                if (typeof file.file_name !== 'undefined') {
                    name = file.file_name
                } else {
                    name = uploadedImageMap[file.name]
                }
                $('form').find('input[name="image[]"][value="' + name + '"]').remove()
            },
            init: function () {
                @if(isset($businessMedicalType) && $businessMedicalType->image)
                var files = {!! json_encode($businessMedicalType->image) !!}
                for (var i in files) {
                    var file = files[i]
                    this.options.addedfile.call(this, file)
                    this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
                    file.previewElement.classList.add('dz-complete')
                    $('form').append('<input type="hidden" name="image[]" value="' + file.file_name + '">')
                }
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
