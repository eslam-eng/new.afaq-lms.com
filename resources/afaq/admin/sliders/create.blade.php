@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.slider.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.sliders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="title_en">{{ trans('cruds.slider.fields.title_en') }}</label>
                <input class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}" type="text" name="title_en" id="title_en" value="{{ old('title_en', '') }}" required>
                @if($errors->has('title_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.title_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title_ar">{{ trans('cruds.slider.fields.title_ar') }}</label>
                <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', '') }}" required>
                @if($errors->has('title_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.title_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_en">{{ trans('cruds.slider.fields.description_en') }}</label>
                <textarea class="form-control  {{ $errors->has('description_en') ? 'is-invalid' : '' }}" name="description_en" id="description_en">{!! old('description_en') !!}</textarea>
                @if($errors->has('description_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.description_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_ar">{{ trans('cruds.slider.fields.description_ar') }}</label>
                <textarea class="form-control  {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar" id="description_ar">{!! old('description_ar') !!}</textarea>
                @if($errors->has('description_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.description_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.slider.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="image_ar">{{ trans('cruds.slider.fields.image_ar') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image_ar') ? 'is-invalid' : '' }}" id="image_ar-dropzone">
                </div>
                @if($errors->has('image_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.image_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile_image_en">{{ trans('cruds.slider.fields.mobile_image_en') }}</label>
                <div class="needsclick dropzone {{ $errors->has('mobile_image_en') ? 'is-invalid' : '' }}" id="mobile_image_en-dropzone">
                </div>
                @if($errors->has('mobile_image_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mobile_image_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.mobile_image_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mobile_image_ar">{{ trans('cruds.slider.fields.mobile_image_ar') }}</label>
                <div class="needsclick dropzone {{ $errors->has('mobile_image_ar') ? 'is-invalid' : '' }}" id="mobile_image_ar-dropzone">
                </div>
                @if($errors->has('mobile_image_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mobile_image_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.slider.fields.mobile_image_ar_helper') }}</span>
            </div>
            
            <div class="row col-12">
                <div class="form-group col-4">
                    <label class="required label-waves-effect required" style="position:relative; top:0;"
                        for="type">{{ trans('cruds.course.fields.course_accreditation') }}</label>
                    <i>*</i>
                    <select class="form-control select2" name="type" id="type"
                        required data-parsley-errors-container="#type" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                        onchange="getBannerInputs($(this).val())">
                        <option value="" disabled selected></option>
                                <option value="course"> Course</option>
                                <option value="search"> Course_type</option>
                            
                    </select>
                    <div id="banner_type"></div>
                </div>
                <div class="form-group col-4 courses-hidden-section"  style="display:none !important;">
                    <label class="required label-waves-effect required" style="position:relative; top:0;"
                        for="course_id">{{ trans('cruds.course.fields.course') }}</label>
                    <i>*</i>
                    <select class="form-control select2" name="course_id" id="course_id" style="width: 70%;"
                        required data-parsley-errors-container="#course_id" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}"
                        >
                        <option value="" disabled selected></option>
                        @foreach ($courses as $id => $name)
                        
                        <option value="{{$id}}">{{$name}}</option>   
                        @endforeach
                            
                    </select>
                    <div id="banner_type"></div>
                </div>
               

                <div class="col-8  banner-type-hidden-section  row mx-0 p-0" style="display:none !important;">
                    <div class="form-group col-6">
                        <label class="required label-waves-effect" style="position:relative; top:0;"
                            for="type_id_for_search">{{ trans('cruds.course.fields.banner') }}</label>
                        <i>*</i>
                        <select class="form-control select2" name="type_id_for_search" id="type_id_for_search" style="width: 70%;" required data-parsley-errors-container="#type_id_for_search" data-parsley-group="step-1" data-parsley-required-message="{{ trans('global.required') }}">
                        <option value="" disabled selected></option>
                        @foreach ($quickAccess as $id => $title)
                            <option value="{{$id}}">{{$title}}</option>   
                        @endforeach
                    </select>
                    </div>
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

@section('scripts')
<script>
    $(document).ready(function () {
  function SimpleUploadAdapter(editor) {
    editor.plugins.get('FileRepository').createUploadAdapter = function(loader) {
      return {
        upload: function() {
          return loader.file
            .then(function (file) {
              return new Promise(function(resolve, reject) {
                // Init request
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '{{ route('admin.sliders.storeCKEditorImages') }}', true);
                xhr.setRequestHeader('x-csrf-token', window._token);
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.responseType = 'json';

                // Init listeners
                var genericErrorText = `Couldn't upload file: ${ file.name }.`;
                xhr.addEventListener('error', function() { reject(genericErrorText) });
                xhr.addEventListener('abort', function() { reject() });
                xhr.addEventListener('load', function() {
                  var response = xhr.response;

                  if (!response || xhr.status !== 201) {
                    return reject(response && response.message ? `${genericErrorText}\n${xhr.status} ${response.message}` : `${genericErrorText}\n ${xhr.status} ${xhr.statusText}`);
                  }

                  $('form').append('<input type="hidden" name="ck-media[]" value="' + response.id + '">');

                  resolve({ default: response.url });
                });

                if (xhr.upload) {
                  xhr.upload.addEventListener('progress', function(e) {
                    if (e.lengthComputable) {
                      loader.uploadTotal = e.total;
                      loader.uploaded = e.loaded;
                    }
                  });
                }

                // Send request
                var data = new FormData();
                data.append('upload', file);
                data.append('crud_id', '{{ $slider->id ?? 0 }}');
                xhr.send(data);
              });
            })
        }
      };
    }
  }

  var allEditors = document.querySelectorAll('.ckeditor');
  for (var i = 0; i < allEditors.length; ++i) {
    ClassicEditor.create(
      allEditors[i], {
        extraPlugins: [SimpleUploadAdapter]
      }
    );
  }
});
</script>

<script>
    Dropzone.options.imageDropzone = {
    url: '{{ route('admin.sliders.storeMedia') }}',
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
@if(isset($slider) && $slider->image)
      var file = {!! json_encode($slider->image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
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
<script>
    Dropzone.options.imageArDropzone = {
    url: '{{ route('admin.sliders.storeMedia') }}',
    maxFilesize: 4, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 4,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').find('input[name="image_ar"]').remove()
      $('form').append('<input type="hidden" name="image_ar" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="image_ar"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($slider) && $slider->image_ar)
      var file = {!! json_encode($slider->image_ar) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="image_ar" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.mobileImageEnDropzone = {
        url: '{{ route('admin.sliders.storeMedia') }}',
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
            $('form').find('input[name="mobile_image_en"]').remove()
            $('form').append('<input type="hidden" name="mobile_image_en" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="mobile_image_en"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function () {
            @if(isset($slider) && $slider->mobile_image_en)
            var file = {!! json_encode($slider->mobile_image_en) !!}
            this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="mobile_image_en" value="' + file.file_name + '">')
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
<script>
    Dropzone.options.mobileImageArDropzone = {
        url: '{{ route('admin.sliders.storeMedia') }}',
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
            $('form').find('input[name="mobile_image_ar"]').remove()
            $('form').append('<input type="hidden" name="mobile_image_ar" value="' + response.name + '">')
        },
        removedfile: function (file) {
            file.previewElement.remove()
            if (file.status !== 'error') {
                $('form').find('input[name="mobile_image_ar"]').remove()
                this.options.maxFiles = this.options.maxFiles + 1
            }
        },
        init: function () {
            @if(isset($slider) && $slider->mobile_image_ar)
            var file = {!! json_encode($slider->mobile_image_ar) !!}
            this.options.addedfile.call(this, file)
            this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
            file.previewElement.classList.add('dz-complete')
            $('form').append('<input type="hidden" name="mobile_image_ar" value="' + file.file_name + '">')
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

    function getBannerInputs(value) {
        if (value == 'course') {
            $('.banner-type-hidden-section').hide();
            $('.courses-hidden-section').show();                
            $('#course_id').prop('required', true);
            $('#type_id_for_search').prop('required', false);
            $('#type_id_for_search').val('');
        } else {
            $('.courses-hidden-section').hide();
            $('.banner-type-hidden-section').show();
            $('#type_id_for_search').prop('required', true);
            $('#course_id').prop('required', false);
            $('#course_id').val('');
        }
    }

</script>
@endsection
