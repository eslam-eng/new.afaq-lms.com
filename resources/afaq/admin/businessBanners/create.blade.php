@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.businessBanner.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.business-banners.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="title_en">{{ trans('cruds.businessBanner.fields.title_en') }}</label>
                <input class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}" type="text" name="title_en" id="title_en" value="{{ old('title_en', '') }}">
                @if($errors->has('title_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessBanner.fields.title_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title_ar">{{ trans('cruds.businessBanner.fields.title_ar') }}</label>
                <input class="form-control {{ $errors->has('title_ar') ? 'is-invalid' : '' }}" type="text" name="title_ar" id="title_ar" value="{{ old('title_ar', '') }}" required>
                @if($errors->has('title_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessBanner.fields.title_ar_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_en">{{ trans('cruds.businessBanner.fields.description_en') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description_en') ? 'is-invalid' : '' }}" name="description_en" id="description_en">{!! old('description_en') !!}</textarea>
                @if($errors->has('description_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessBanner.fields.description_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description_ar">{{ trans('cruds.businessBanner.fields.description_ar') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('description_ar') ? 'is-invalid' : '' }}" name="description_ar" id="description_ar">{!! old('description_ar') !!}</textarea>
                @if($errors->has('description_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessBanner.fields.description_ar_helper') }}</span>
            </div>
            {{-- <div class="form-group">
                <label for="short_description_en">{{ trans('cruds.businessBanner.fields.short_description_en') }}</label>
                <input class="form-control {{ $errors->has('short_description_en') ? 'is-invalid' : '' }}" type="text" name="short_description_en" id="short_description_en" value="{{ old('short_description_en', '') }}">
                @if($errors->has('short_description_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_description_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessBanner.fields.short_description_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="short_description_ar">{{ trans('cruds.businessBanner.fields.short_description_ar') }}</label>
                <input class="form-control {{ $errors->has('short_description_ar') ? 'is-invalid' : '' }}" type="text" name="short_description_ar" id="short_description_ar" value="{{ old('short_description_ar', '') }}" required>
                @if($errors->has('short_description_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('short_description_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.businessBanner.fields.short_description_ar_helper') }}</span>
            </div> --}}
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
                xhr.open('POST', '{{ route('admin.business-banners.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $businessBanner->id ?? 0 }}');
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

@endsection
