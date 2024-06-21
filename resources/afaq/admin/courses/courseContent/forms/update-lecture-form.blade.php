<form action="" id="updateSectionLecture" class="update-normal-form" method="post" data-parsley-validate>
    @csrf
    @method('put')
    <div class="row">
        <div class="form-group col-12">
            <label for="type">{{ __('lms.type') }}</label>
            <select type="text" name="lecture_type" id="type-up" class="form-control type-up type-check" required  data-parsley-required-message="{{ trans('global.required') }}">
                <option value="" disabled selected>{{ __('lms.select') }}</option>
                @foreach (['video', 'photo', 'file','attendance_design'] as $type)
                    <option value="{{ $type }}" {{ $lecture->type == $type ? 'selected' : '' }}>
                        {{ __('lms.' . $type) }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group col-6" style="display: grid;">
            <label class="required" for="accessing">{{ trans('lms.accessing') }}</label>
            <select class="form-control select2 {{ $errors->has('accessing') ? 'is-invalid' : '' }}" name="accessing"
                id="accessing" required  data-parsley-required-message="{{ trans('global.required') }}">
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
            <label for="duration">{{ __('cruds.zoomMeeting.fields.duration') }}</label>
            <input type="text" name="duration" id="duration" value="{{ $lecture->duration }}" class="form-control">
        </div>
        <div class="form-group col-6">
            <label for="update_title_en">{{ __('cruds.exam.fields.title_en') }}</label>
            <input type="text" name="title_en" value="{{ $lecture->title_en }}" id="update_title_en"
                class="form-control" required  data-parsley-required-message="{{ trans('global.required') }}">
        </div>
        <div class="form-group col-6">
            <label for="update_title_ar">{{ __('cruds.exam.fields.title_ar') }}</label>
            <input type="text" name="title_ar" value="{{ $lecture->title_ar }}" id="update_title_ar"
                class="form-control" required  data-parsley-required-message="{{ trans('global.required') }}">
        </div>
        <div class="form-group col-12">
            <label for="short_description_en">{{ __('cruds.course.fields.short_description_en') }}</label>
            <textarea type="text" name="short_description_en" id="short_description_en" class="form-control">{{ $lecture->short_description_en }}</textarea>
        </div>
        <div class="form-group col-12">
            <label for="short_description_ar">{{ __('cruds.course.fields.short_description_ar') }}</label>
            <textarea type="text" name="short_description_ar" id="short_description_ar" class="form-control">{{ $lecture->short_description_ar }}</textarea>
        </div>

        <div class="form-group col-12">
            <input type="file" name="file" id="lecture_attachment" onchange="uploadFile('lecture_attachment','{{ route('admin.courses.course-section-lectures.storeMedia') }}','file','lectureStatus','lectureLoading','lectureProgressBar','{{ csrf_token() }}',$('#type-up').val())"><br>
            <input type="hidden" name="attachment" id="attachment-id-up" value="{{ $lecture->attachment ? $lecture->attachment->url : $lecture->file }}">
            <progress id="lectureProgressBar" value="0" max="100" style="width:100%;margin-top: 1rem;height: 20px;"></progress>
            <h3 id="lectureStatus"></h3>
            <p id="lectureLoading"></p>
            @if($lecture->attachment)
                <a href="{{ $lecture->attachment->url }}">{{ __('global.view_file') }}</a>
            @else
            <a href="{{ get_video_to_s3($lecture->file) }}">{{ __('global.view_file') }}</a>
            @endif
        </div>
        <div class="col-12 form-group my-auto">
            <label for=""></label>
            <button type="button" class="btn btn-success normal-update" {{$lecture->type != 'attendance_design' ? ($lecture->attachment || $lecture->file ? '':'disabled') : ''}}  lecture-id="{{ $lecture->id }}">
                {{ __('global.save') }}
            </button>
        </div>
    </div>
</form>
