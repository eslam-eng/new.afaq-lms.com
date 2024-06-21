@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.zoomMeeting.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.zoom-meetings.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>{{ trans('cruds.zoomMeeting.fields.type') }}</label>
                <select class="form-control {{ $errors->has('meeting_type') ? 'is-invalid' : '' }}" name="meeting_type" id="meeting_type">
                    <option value disabled {{ old('meeting_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ZoomMeeting::MEETING_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('meeting_type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('meeting_type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('meeting_type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.type_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="course_id">{{ trans('cruds.zoomMeeting.fields.course') }}</label>
                <select class="form-control select2 {{ $errors->has('course') ? 'is-invalid' : '' }}" name="course_id" id="course_id" required>
                    @foreach($courses as $id => $entry)
                        <option value="{{ $id }}" {{ old('course_id') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('course'))
                    <div class="invalid-feedback">
                        {{ $errors->first('course') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.course_helper') }}</span>
            </div>

            <div class="form-group">
                <label class="required" for="topic">{{ trans('cruds.zoomMeeting.fields.topic') }}</label>
                <input class="form-control {{ $errors->has('topic') ? 'is-invalid' : '' }}" type="text" name="topic" id="topic" required  value="{{ old('topic', '') }}">
                @if($errors->has('topic'))
                    <div class="invalid-feedback">
                        {{ $errors->first('topic') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.topic_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="start_time">{{ trans('cruds.zoomMeeting.fields.start_time') }}</label>
                <input class="form-control datetime {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="datetime-local" value="{{ date('Y-m-d\TH:i', strtotime(now())) }}" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                @if($errors->has('start_time'))
                    <div class="invalid-feedback">
                        {{ $errors->first('start_time') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.start_time_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="duration">{{ trans('cruds.zoomMeeting.fields.duration') }}</label>
                <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number" name="duration" id="duration" value="{{ old('duration', '') }}" step="1" required>
                @if($errors->has('duration'))
                    <div class="invalid-feedback">
                        {{ $errors->first('duration') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.duration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="agenda">{{ trans('cruds.zoomMeeting.fields.agenda') }}</label>
                <textarea class="form-control ckeditor {{ $errors->has('agenda') ? 'is-invalid' : '' }}" name="agenda" id="agenda">{!! old('agenda') !!}</textarea>
                @if($errors->has('agenda'))
                    <div class="invalid-feedback">
                        {{ $errors->first('agenda') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.agenda_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('host_video') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="host_video" value="0">
                    <input class="form-check-input" type="checkbox" name="host_video" id="host_video" value="1" {{ old('host_video', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="host_video">{{ trans('cruds.zoomMeeting.fields.host_video') }}</label>
                </div>
                @if($errors->has('host_video'))
                    <div class="invalid-feedback">
                        {{ $errors->first('host_video') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.host_video_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('participant_video') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="participant_video" value="0">
                    <input class="form-check-input" type="checkbox" name="participant_video" id="participant_video" value="1" {{ old('participant_video', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="participant_video">{{ trans('cruds.zoomMeeting.fields.participant_video') }}</label>
                </div>
                @if($errors->has('participant_video'))
                    <div class="invalid-feedback">
                        {{ $errors->first('participant_video') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.participant_video_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="password">{{ trans('cruds.zoomMeeting.fields.password') }}</label>
                <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" id="password">
                @if($errors->has('password'))
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.password_helper') }}</span>
            </div>

            <div class="form-group">
                <label>{{ trans('cruds.zoomMeeting.fields.type') }}</label>
                <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
                    <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ZoomMeeting::TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('type', '') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('type'))
                    <div class="invalid-feedback">
                        {{ $errors->first('type') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.type_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.zoomMeeting.fields.audio') }}</label>
                <select class="form-control {{ $errors->has('audio') ? 'is-invalid' : '' }}" name="audio" id="audio">
                    <option value disabled {{ old('audio', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ZoomMeeting::AUDIO_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('audio', 'both') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('audio'))
                    <div class="invalid-feedback">
                        {{ $errors->first('audio') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.audio_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.zoomMeeting.fields.auto_recording') }}</label>
                <select class="form-control {{ $errors->has('auto_recording') ? 'is-invalid' : '' }}" name="auto_recording" id="auto_recording">
                    <option value disabled {{ old('auto_recording', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\ZoomMeeting::AUTO_RECORDING_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('auto_recording', 'cloud') === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('auto_recording'))
                    <div class="invalid-feedback">
                        {{ $errors->first('auto_recording') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.auto_recording_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="alternative_hosts">{{ trans('cruds.zoomMeeting.fields.alternative_hosts') }}</label>
                <input class="form-control {{ $errors->has('alternative_hosts') ? 'is-invalid' : '' }}" type="text" name="alternative_hosts" id="alternative_hosts" value="{{ old('alternative_hosts', '') }}">
                @if($errors->has('alternative_hosts'))
                    <div class="invalid-feedback">
                        {{ $errors->first('alternative_hosts') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.alternative_hosts_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('mute_upon_entry') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="mute_upon_entry" value="0">
                    <input class="form-check-input" type="checkbox" name="mute_upon_entry" id="mute_upon_entry" value="1" {{ old('mute_upon_entry', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="mute_upon_entry">{{ trans('cruds.zoomMeeting.fields.mute_upon_entry') }}</label>
                </div>
                @if($errors->has('mute_upon_entry'))
                    <div class="invalid-feedback">
                        {{ $errors->first('mute_upon_entry') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.mute_upon_entry_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('watermark') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="watermark" value="0">
                    <input class="form-check-input" type="checkbox" name="watermark" id="watermark" value="1" {{ old('watermark', 0) == 1 ? 'checked' : '' }}>
                    <label class="form-check-label" for="watermark">{{ trans('cruds.zoomMeeting.fields.watermark') }}</label>
                </div>
                @if($errors->has('watermark'))
                    <div class="invalid-feedback">
                        {{ $errors->first('watermark') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.watermark_helper') }}</span>
            </div>
            <div class="form-group">
                <div class="form-check {{ $errors->has('waiting_room') ? 'is-invalid' : '' }}">
                    <input type="hidden" name="waiting_room" value="0">
                    <input class="form-check-input" type="checkbox" name="waiting_room" id="waiting_room" value="1" {{ old('waiting_room', 0) == 1 || old('waiting_room') === null ? 'checked' : '' }}>
                    <label class="form-check-label" for="waiting_room">{{ trans('cruds.zoomMeeting.fields.waiting_room') }}</label>
                </div>
                @if($errors->has('waiting_room'))
                    <div class="invalid-feedback">
                        {{ $errors->first('waiting_room') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.zoomMeeting.fields.waiting_room_helper') }}</span>
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
                xhr.open('POST', '{{ route('admin.zoom-meetings.storeCKEditorImages') }}', true);
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
                data.append('crud_id', '{{ $zoomMeeting->id ?? 0 }}');
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
