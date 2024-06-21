@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.userMembership.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.user-memberships.update", [$userMembership->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.userMembership.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $userMembership->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userMembership.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="member_type_id">{{ trans('cruds.userMembership.fields.member_type') }}</label>
                <select class="form-control select2 {{ $errors->has('member_type') ? 'is-invalid' : '' }}" name="member_type_id" id="member_type_id" required>
                    @foreach($member_types as $id => $entry)
                        <option value="{{ $id }}" {{ (old('member_type_id') ? old('member_type_id') : $userMembership->member_type->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('member_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('member_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userMembership.fields.member_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="accreditation_number">{{ trans('cruds.userMembership.fields.accreditation_number') }}</label>
                <input class="form-control {{ $errors->has('accreditation_number') ? 'is-invalid' : '' }}" type="number" name="accreditation_number" id="accreditation_number" value="{{ old('accreditation_number', $userMembership->accreditation_number) }}" step="1" required>
                @if($errors->has('accreditation_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('accreditation_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userMembership.fields.accreditation_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_date">{{ trans('cruds.userMembership.fields.start_date') }}</label>
                <input class="form-control date {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="date" name="start_date" id="start_date" value="{{ old('start_date', $userMembership->start_date) }}" required>
                @if($errors->has('start_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userMembership.fields.start_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="end_date">{{ trans('cruds.userMembership.fields.end_date') }}</label>
                <input class="form-control date {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="date" name="end_date" id="end_date" value="{{ old('end_date', date('Y-m-d',strtotime($userMembership->end_date))) }}" required>
                @if($errors->has('end_date'))
                    <div class="invalid-feedback">
                        {{ $errors->first('end_date') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userMembership.fields.end_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="file">{{ trans('cruds.userMembership.fields.file') }}</label>
                <div class="needsclick dropzone {{ $errors->has('file') ? 'is-invalid' : '' }}" id="file-dropzone">
                </div>
                @if($errors->has('file'))
                    <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userMembership.fields.file_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.userMembership.fields.status') }}</label>
                @foreach(App\Models\UserMembership::STATUS_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('status') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="status_{{ $key }}" name="status" value="{{ $key }}" {{ old('status', $userMembership->status) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="status_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('status'))
                    <div class="invalid-feedback">
                        {{ $errors->first('status') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.userMembership.fields.status_helper') }}</span>
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
    Dropzone.options.fileDropzone = {
    url: '{{ route('admin.user-memberships.storeMedia') }}',
    maxFilesize: 4, // MB
    maxFiles: 1,
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 2
    },
    success: function (file, response) {
      $('form').find('input[name="file"]').remove()
      $('form').append('<input type="hidden" name="file" value="' + response.name + '">')
    },
    removedfile: function (file) {
      file.previewElement.remove()
      if (file.status !== 'error') {
        $('form').find('input[name="file"]').remove()
        this.options.maxFiles = this.options.maxFiles + 1
      }
    },
    init: function () {
@if(isset($userMembership) && $userMembership->file)
      var file = {!! json_encode($userMembership->file) !!}
          this.options.addedfile.call(this, file)
      file.previewElement.classList.add('dz-complete')
      $('form').append('<input type="hidden" name="file" value="' + file.file_name + '">')
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
