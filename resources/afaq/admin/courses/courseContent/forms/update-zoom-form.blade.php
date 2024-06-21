<form method="POST" action="{{ route('admin.zoom-meetings.update', [$zoomMeeting->id]) }}" enctype="multipart/form-data"
    class="d-flex flex-wrap update-zoom-form"
    data-parsley-validate
    >
    @method('PUT')
    @csrf
    <input type="hidden" name="lecture_type" value="zoom">
    <div class="form-group col-12" style="display: grid;">
        <label class="required" for="accessing">{{ trans('lms.accessing') }}</label>
        <select class="form-control select2 {{ $errors->has('accessing') ? 'is-invalid' : '' }}"
            name="accessing" id="accessing" required  data-parsley-required-message="{{ trans('global.required') }}">
            <option value="" disabled selected>{{ __('lms.select') }}</option>
            <option value="private" {{ $lecture->accessing == 'private' ? 'selected' : '' }}>{{ __('lms.private') }}</option>
            <option value="public" {{ $lecture->accessing == 'public' ? 'selected' : '' }}>{{ __('lms.public') }}</option>
        </select>
        @if ($errors->has('accessing'))
            <div class="invalid-feedback">
                {{ $errors->first('accessing') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.courseQuize.fields.exam_title_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label>{{ trans('cruds.zoomMeeting.fields.meeting_type') }}</label>
        <select class="form-control {{ $errors->has('meeting_type') ? 'is-invalid' : '' }}" name="meeting_type"
            id="meeting_type">
            <option value disabled {{ old('meeting_type', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}</option>
            @foreach (App\Models\ZoomMeeting::MEETING_TYPE_SELECT as $key => $label)
                <option value="{{ $key }}"
                    {{ old('meeting_type', $zoomMeeting->meeting_type) === (string) $key ? 'selected' : '' }}>
                    {{ $label }}</option>
            @endforeach
        </select>
        @if ($errors->has('meeting_type'))
            <div class="invalid-feedback">
                {{ $errors->first('meeting_type') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.type_helper') }}</span>
    </div>


    <div class="form-group col-6">
        <label class="required" for="topic">{{ trans('cruds.zoomMeeting.fields.topic') }}</label>
        <input class="form-control {{ $errors->has('topic') ? 'is-invalid' : '' }}" type="text" name="topic"
            id="topic" value="{{ old('topic', $zoomMeeting->topic) }}" required  data-parsley-required-message="{{ trans('global.required') }}">
        @if ($errors->has('topic'))
            <div class="invalid-feedback">
                {{ $errors->first('topic') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.topic_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label class="required" for="start_time">{{ trans('cruds.zoomMeeting.fields.start_time') }}</label>
        <input class="form-control datetime {{ $errors->has('start_time') ? 'is-invalid' : '' }}" type="datetime-local"
            name="start_time" id="start_time" value="{{ old('start_time', $zoomMeeting->start_time) }}" required  data-parsley-required-message="{{ trans('global.required') }}">
        @if ($errors->has('start_time'))
            <div class="invalid-feedback">
                {{ $errors->first('start_time') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.start_time_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label class="required" for="duration">{{ trans('cruds.zoomMeeting.fields.duration') }}</label>
        <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number" name="duration"
            id="duration" value="{{ old('duration', $zoomMeeting->duration) }}" step="1" required  data-parsley-required-message="{{ trans('global.required') }}">
        @if ($errors->has('duration'))
            <div class="invalid-feedback">
                {{ $errors->first('duration') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.duration_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label for="agenda">{{ trans('cruds.zoomMeeting.fields.agenda') }}</label>
        <textarea class="form-control ckeditor {{ $errors->has('agenda') ? 'is-invalid' : '' }}" name="agenda" id="agenda">{!! old('agenda', $zoomMeeting->agenda) !!}</textarea>
        @if ($errors->has('agenda'))
            <div class="invalid-feedback">
                {{ $errors->first('agenda') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.agenda_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <div class="form-check {{ $errors->has('host_video') ? 'is-invalid' : '' }}">
            <input type="hidden" name="host_video" value="0">
            <input class="form-check-input" type="checkbox" name="host_video" id="host_video" value="1"
                {{ $zoomMeeting->host_video || old('host_video', 0) === 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="host_video">{{ trans('cruds.zoomMeeting.fields.host_video') }}</label>
        </div>
        @if ($errors->has('host_video'))
            <div class="invalid-feedback">
                {{ $errors->first('host_video') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.host_video_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <div class="form-check {{ $errors->has('participant_video') ? 'is-invalid' : '' }}">
            <input type="hidden" name="participant_video" value="0">
            <input class="form-check-input" type="checkbox" name="participant_video" id="participant_video"
                value="1"
                {{ $zoomMeeting->participant_video || old('participant_video', 0) === 1 ? 'checked' : '' }}>
            <label class="form-check-label"
                for="participant_video">{{ trans('cruds.zoomMeeting.fields.participant_video') }}</label>
        </div>
        @if ($errors->has('participant_video'))
            <div class="invalid-feedback">
                {{ $errors->first('participant_video') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.participant_video_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label for="password">{{ trans('cruds.zoomMeeting.fields.password') }}</label>
        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password"
            id="password">
        @if ($errors->has('password'))
            <div class="invalid-feedback">
                {{ $errors->first('password') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.password_helper') }}</span>
    </div>

    <div class="form-group col-6">
        <label>{{ trans('cruds.zoomMeeting.fields.type') }}</label>
        <select class="form-control {{ $errors->has('type') ? 'is-invalid' : '' }}" name="type" id="type">
            <option value disabled {{ old('type', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}</option>
            @foreach (App\Models\ZoomMeeting::TYPE_SELECT as $key => $label)
                <option value="{{ $key }}"
                    {{ old('type', $zoomMeeting->type) === (string) $key ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('type'))
            <div class="invalid-feedback">
                {{ $errors->first('type') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.type_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label>{{ trans('cruds.zoomMeeting.fields.audio') }}</label>
        <select class="form-control {{ $errors->has('audio') ? 'is-invalid' : '' }}" name="audio" id="audio">
            <option value disabled {{ old('audio', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}</option>
            @foreach (App\Models\ZoomMeeting::AUDIO_SELECT as $key => $label)
                <option value="{{ $key }}"
                    {{ old('audio', $zoomMeeting->audio) === (string) $key ? 'selected' : '' }}>{{ $label }}
                </option>
            @endforeach
        </select>
        @if ($errors->has('audio'))
            <div class="invalid-feedback">
                {{ $errors->first('audio') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.audio_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label>{{ trans('cruds.zoomMeeting.fields.auto_recording') }}</label>
        <select class="form-control {{ $errors->has('auto_recording') ? 'is-invalid' : '' }}" name="auto_recording"
            id="auto_recording">
            <option value disabled {{ old('auto_recording', null) === null ? 'selected' : '' }}>
                {{ trans('global.pleaseSelect') }}</option>
            @foreach (App\Models\ZoomMeeting::AUTO_RECORDING_SELECT as $key => $label)
                <option value="{{ $key }}"
                    {{ old('auto_recording', $zoomMeeting->auto_recording) === (string) $key ? 'selected' : '' }}>
                    {{ $label }}</option>
            @endforeach
        </select>
        @if ($errors->has('auto_recording'))
            <div class="invalid-feedback">
                {{ $errors->first('auto_recording') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.auto_recording_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <label for="alternative_hosts">{{ trans('cruds.zoomMeeting.fields.alternative_hosts') }}</label>
        <input class="form-control {{ $errors->has('alternative_hosts') ? 'is-invalid' : '' }}" type="text"
            name="alternative_hosts" id="alternative_hosts"
            value="{{ old('alternative_hosts', $zoomMeeting->alternative_hosts) }}">
        @if ($errors->has('alternative_hosts'))
            <div class="invalid-feedback">
                {{ $errors->first('alternative_hosts') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.alternative_hosts_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <div class="form-check {{ $errors->has('mute_upon_entry') ? 'is-invalid' : '' }}">
            <input type="hidden" name="mute_upon_entry" value="0">
            <input class="form-check-input" type="checkbox" name="mute_upon_entry" id="mute_upon_entry"
                value="1"
                {{ $zoomMeeting->mute_upon_entry || old('mute_upon_entry', 0) === 1 ? 'checked' : '' }}>
            <label class="form-check-label"
                for="mute_upon_entry">{{ trans('cruds.zoomMeeting.fields.mute_upon_entry') }}</label>
        </div>
        @if ($errors->has('mute_upon_entry'))
            <div class="invalid-feedback">
                {{ $errors->first('mute_upon_entry') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.mute_upon_entry_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <div class="form-check {{ $errors->has('watermark') ? 'is-invalid' : '' }}">
            <input type="hidden" name="watermark" value="0">
            <input class="form-check-input" type="checkbox" name="watermark" id="watermark" value="1"
                {{ $zoomMeeting->watermark || old('watermark', 0) === 1 ? 'checked' : '' }}>
            <label class="form-check-label" for="watermark">{{ trans('cruds.zoomMeeting.fields.watermark') }}</label>
        </div>
        @if ($errors->has('watermark'))
            <div class="invalid-feedback">
                {{ $errors->first('watermark') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.watermark_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <div class="form-check {{ $errors->has('waiting_room') ? 'is-invalid' : '' }}">
            <input type="hidden" name="waiting_room" value="0">
            <input class="form-check-input" type="checkbox" name="waiting_room" id="waiting_room" value="1"
                {{ $zoomMeeting->waiting_room || old('waiting_room', 0) === 1 ? 'checked' : '' }}>
            <label class="form-check-label"
                for="waiting_room">{{ trans('cruds.zoomMeeting.fields.waiting_room') }}</label>
        </div>
        @if ($errors->has('waiting_room'))
            <div class="invalid-feedback">
                {{ $errors->first('waiting_room') }}
            </div>
        @endif
        <span class="help-block">{{ trans('cruds.zoomMeeting.fields.waiting_room_helper') }}</span>
    </div>
    <div class="form-group col-6">
        <button class="btn btn-danger zoom-update" modal-div-id="zoomLectureModal" lecture-id="{{ $zoomMeeting->lecture_id }}" type="button">
            {{ trans('global.save') }}
        </button>
    </div>
</form>
