@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.iconTextDe.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.icon-text-des.update", [$iconTextDe->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="text_en">{{ trans('cruds.iconTextDe.fields.text_en') }}</label>
                <input class="form-control {{ $errors->has('text_en') ? 'is-invalid' : '' }}" type="text" name="text_en" id="text_en" value="{{ old('text_en', $iconTextDe->text_en) }}" required>
                @if($errors->has('text_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('text_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.iconTextDe.fields.text_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="text_ar">{{ trans('cruds.iconTextDe.fields.text_ar') }}</label>
                <input class="form-control {{ $errors->has('text_ar') ? 'is-invalid' : '' }}" type="text" name="text_ar" id="text_ar" value="{{ old('text_ar', $iconTextDe->text_ar) }}" required>
                @if($errors->has('text_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('text_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.iconTextDe.fields.text_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_en">{{ trans('cruds.iconTextDe.fields.description_en') }}</label>
                <textarea class="form-control  {{ $errors->has('description_en') ? 'is-invalid' : '' }}" name="description_en" id="description_en">{!! old('description_en', $iconTextDe->description_en) !!}</textarea>
                @if($errors->has('description_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.iconTextDe.fields.description_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_ar">{{ trans('cruds.iconTextDe.fields.description_ar') }}</label>
                <textarea class="form-control  {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar" id="description_ar">{!! old('description_ar', $iconTextDe->description_ar) !!}</textarea>
                @if($errors->has('description_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.iconTextDe.fields.description_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="link_en">{{ trans('cruds.iconTextDe.fields.link_en') }}</label>
                <input class="form-control {{ $errors->has('link_en') ? 'is-invalid' : '' }}" type="text" name="link_en" id="link_en" value="{{ old('link_en', $iconTextDe->link_en) }}" required>
                @if($errors->has('link_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.iconTextDe.fields.link_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="link_ar">{{ trans('cruds.iconTextDe.fields.link_ar') }}</label>
                <input class="form-control {{ $errors->has('link_ar') ? 'is-invalid' : '' }}" type="text" name="link_ar" id="link_ar" value="{{ old('link_ar', $iconTextDe->link_ar) }}" required>
                @if($errors->has('link_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('link_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.iconTextDe.fields.link_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="icon">{{ trans('cruds.iconTextDe.fields.icon') }}</label>
                <div class="needsclick dropzone {{ $errors->has('icon') ? 'is-invalid' : '' }}" id="icon-dropzone">
                </div>
                @if($errors->has('icon'))
                    <div class="invalid-feedback">
                        {{ $errors->first('icon') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.iconTextDe.fields.icon_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.icon-text-des.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $iconTextDe->id ?? 0 }}');
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
    Dropzone.options.iconDropzone = {
    url: '{{ route('admin.icon-text-des.storeMedia') }}',
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
      $('form').find('input[name="icon"]').remove()
      $('form').append('<input type="hidden" name="icon" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="icon"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($iconTextDe) && $iconTextDe->icon)
      var file = {!! json_encode($iconTextDe->icon) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="icon" value="' + file.file_name + '">')
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
