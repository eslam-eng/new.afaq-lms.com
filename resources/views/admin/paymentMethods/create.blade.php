@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.paymentMethod.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.payment-methods.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name_en">{{ trans('cruds.paymentMethod.fields.name_en') }}</label>
                <input class="form-control {{ $errors->has('name_en') ? 'is-invalid' : '' }}" type="text" name="name_en" id="name_en" value="{{ old('name_en', '') }}" required>
                @if($errors->has('name_en'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_en') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.name_en_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="name_ar">{{ trans('cruds.paymentMethod.fields.name_ar') }}</label>
                <input class="form-control {{ $errors->has('name_ar') ? 'is-invalid' : '' }}" type="text" name="name_ar" id="name_ar" value="{{ old('name_ar', '') }}" required>
                @if($errors->has('name_ar'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name_ar') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.name_ar_helper') }}</span>
            </div>

            <!-- <div class="form-group">
                <label for="provider_image">{{ trans('cruds.paymentMethod.fields.provider_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('provider_image') ? 'is-invalid' : '' }}" id="provider_image-dropzone">
                </div>
                @if($errors->has('provider_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('provider_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.provider_image_helper') }}</span>
            </div> -->
            <div class="form-group">
                <label for="local_image">{{ trans('cruds.paymentMethod.fields.local_image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('local_image') ? 'is-invalid' : '' }}" id="local_image-dropzone">
                </div>
                @if($errors->has('local_image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('local_image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.local_image_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.paymentMethod.fields.provider') }}</label>
                <select class="form-control {{ $errors->has('provider') ? 'is-invalid' : '' }}" name="provider" id="provider">
                    <option value disabled {{ old('provider', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PaymentMethod::PROVIDER_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('provider', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('provider'))
                    <div class="invalid-feedback">
                        {{ $errors->first('provider') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.provider_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="provider_method_id">{{ trans('cruds.paymentMethod.fields.provider_method') }}</label>
                <input class="form-control {{ $errors->has('provider_method_id') ? 'is-invalid' : '' }}" type="number" name="provider_method_id" id="provider_method_id" value="{{ old('provider_method_id', '') }}" step="1">
                @if($errors->has('provider_method_id'))
                    <div class="invalid-feedback">
                        {{ $errors->first('provider_method_id') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.provider_method_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="service_fees">{{ trans('cruds.paymentMethod.fields.service_fees') }}</label>
                <input class="form-control {{ $errors->has('service_fees') ? 'is-invalid' : '' }}" type="number" name="service_fees" id="service_fees" value="{{ old('service_fees', '') }}" step="0.01">
                @if($errors->has('service_fees'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service_fees') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.service_fees_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.paymentMethod.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PaymentMethod::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="mode">{{ trans('cruds.paymentMethod.fields.mode') }}</label>
                <input class="form-control {{ $errors->has('mode') ? 'is-invalid' : '' }}" type="text" name="mode" id="mode" value="{{ old('mode', '') }}">
                @if($errors->has('mode'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mode') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.mode_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.paymentMethod.fields.status') }}</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : '' }}" name="status" id="status">
                    <option value disabled {{ old('status', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\PaymentMethod::STATUS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('status', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.paymentMethod.fields.status_helper') }}</span>
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
    Dropzone.options.providerImageDropzone = {
    url: '{{ route('admin.payment-methods.storeMedia') }}',
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
      $('form').find('input[name="provider_image"]').remove()
      $('form').append('<input type="hidden" name="provider_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="provider_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($paymentMethod) && $paymentMethod->provider_image)
      var file = {!! json_encode($paymentMethod->provider_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="provider_image" value="' + file.file_name + '">')
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
    Dropzone.options.localImageDropzone = {
    url: '{{ route('admin.payment-methods.storeMedia') }}',
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
      $('form').find('input[name="local_image"]').remove()
      $('form').append('<input type="hidden" name="local_image" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="local_image"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($paymentMethod) && $paymentMethod->local_image)
      var file = {!! json_encode($paymentMethod->local_image) !!}
          this.options.addedfile.call(this, file)
      this.options.thumbnail.call(this, file, file.preview ?? file.preview_url)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="local_image" value="' + file.file_name + '">')
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
