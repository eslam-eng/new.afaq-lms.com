@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.ticket.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.tickets.update", [$ticket->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="user_id">{{ trans('cruds.ticket.fields.user') }}</label>
                <select class="form-control select2 {{ $errors->has('user') ? 'is-invalid' : '' }}" name="user_id" id="user_id" required>
                    @foreach($users as $id => $entry)
                        <option value="{{ $id }}" {{ (old('user_id') ? old('user_id') : $ticket->user->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('user'))
                    <div class="invalid-feedback">
                        {{ $errors->first('user') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.user_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="email_id">{{ trans('cruds.ticket.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="text" name="email" id="email" value="{{ old('email', $ticket->email) }}" >

            @if($errors->has('email'))
                    <div class="invalid-feedback">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="title">{{ trans('cruds.ticket.fields.title') }}</label>
                <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', $ticket->title) }}" >
                @if($errors->has('title'))
                    <div class="invalid-feedback">
                        {{ $errors->first('title') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.title_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="category_id">{{ trans('cruds.ticket.fields.category') }}</label>
                <select class="form-control select2 {{ $errors->has('category') ? 'is-invalid' : '' }}" name="ticket_category_id" id="ticket_category_id" >
                    @foreach($categories as $id => $entry)
                        <option value="{{ $id }}" {{ (old('ticket_category_id') ? old('category_id') : $ticket->ticket_category->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('category'))
                    <div class="invalid-feedback">
                        {{ $errors->first('category') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.category_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="replies_number">{{ trans('cruds.ticket.fields.replies_number') }}</label>
                <input class="form-control {{ $errors->has('replies_number') ? 'is-invalid' : '' }}" type="number" name="replies_number" id="replies_number" value="{{ old('replies_number', $ticket->replies_number) }}" step="1">
                @if($errors->has('replies_number'))
                    <div class="invalid-feedback">
                        {{ $errors->first('replies_number') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.replies_number_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.ticket.fields.statues') }}</label>
                <select class="form-control {{ $errors->has('statues') ? 'is-invalid' : '' }}" name="statues" id="statues">
                    <option value disabled {{ old('statues', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Ticket::STATUES_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('statues', $ticket->statues) === (string) $key ? 'selected' : '' }}>{{ trans('cruds.ticket.fields.'.$label)  }}</option>
                    @endforeach
                </select>
                @if($errors->has('statues'))
                    <div class="invalid-feedback">
                        {{ $errors->first('statues') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.statues_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="description">{{ trans('cruds.ticket.fields.description') }}</label>
                <textarea class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}" name="description" id="description">{{ old('description', $ticket->description) }}</textarea>
                @if($errors->has('description'))
                    <div class="invalid-feedback">
                        {{ $errors->first('description') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.description_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="image">{{ trans('cruds.ticket.fields.image') }}</label>
                <div class="needsclick dropzone {{ $errors->has('image') ? 'is-invalid' : '' }}" id="image-dropzone">
                </div>
                @if($errors->has('image'))
                    <div class="invalid-feedback">
                        {{ $errors->first('image') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.ticket.fields.image_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required">{{ trans('cruds.blog.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type" required>
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Ticket::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', $blog->type) === (string) $key ? 'selected' : '' }}>{{ trans('afaq.'.$label)  }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.blog.fields.type_helper') }}</span>
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
    url: '{{ route('admin.tickets.storeMedia') }}',
    maxFilesize: 2, // MB
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
@if(isset($ticket) && $ticket->image)
      var file = {!! json_encode($ticket->image) !!}
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
