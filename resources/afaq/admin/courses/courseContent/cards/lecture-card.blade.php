    <div class="lecture-card col-12 d-flex flex-wrap">
        <div class="col-6 d-flex flex-wrap">
            <span class="col-8">
                @switch($lecture->type)
                    @case('quize')
                        <span style="color:green;font-size:1.3rem;">
                            <i class="far fa-question-circle"></i>
                        </span>
                    @break

                    @case('zoom')
                        <span style="color:#0B5CFF;font-size:1.3rem;">
                            <i class="fas fa-video"></i>
                        </span>
                    @break

                    @case('file')
                        <span style="color: #000;font-size:1.3rem;">
                            <i class="fas fa-file"></i>
                        </span>
                    @break
                    @case('video')
                        <span style="color: #BAA293;font-size:1.3rem;">
                            <i class="fas fa-film"></i>
                        </span>
                    @break
                    @case('photo')
                        <span style="color: #72798A;font-size:1.3rem;">
                            <i class="fas fa-image"></i>
                        </span>
                    @break
                    @case('attendance_design')
                        <span style="color: #72798A;font-size:1.3rem;">
                            <i class="fas fa-id-card"></i>
                        </span>
                        @break
                    @default
                @endswitch
                <span class="mx-2">{{ app()->getLocale() == 'en' ? $lecture->title_en : $lecture->title_ar }}</span>
            </span>
            <span class="col-4">{{ __('lms.'.$lecture->accessing) }}</span>
        </div>
        <div class="col-6 col-6 d-flex justify-content-end">
            <div class="btn-group col-md-4 col-sm-6 px-0">
                <button class="btn  btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <div class="dropdown-menu">
                    <!-- Button trigger modal -->
                    <div class="dropdown-item d-flex justify-content-center">
                        {{-- data-target="{{ $lecture->type == 'quize' ? '#updateQuizeLectureModal' : ($lecture->type == 'zoom' ? 'update-zoom-button' : 'update-file-button') }}" --}}
                        <button type="button"
                            class="btn  d-flex justify-content-center {{ $lecture->type == 'quize' ? 'update-quize-button' : ($lecture->type == 'zoom' ? 'update-zoom-button' : 'update-file-button') }}"
                            data-toggle="modal" lecture-id="{{ $lecture->id }}">
                            <bdi>{{ __('global.update') }}
                                <i class="fas fa-edit"></i></bdi>

                        </button>
                    </div>
                    <hr>
                    <div class="dropdown-item d-flex justify-content-center">
                        <button type="button" class="btn d-flex justify-content-center delete-lecture"
                            delete-lecture-id="{{ $lecture->id }}">
                            <bdi>
                                {{ __('global.delete') }} <i class="fas fa-trash-alt"></i>
                            </bdi>
                        </button>
                    </div>
                    @if($lecture->type == 'zoom')
                    <hr>
                        <div class="dropdown-item d-flex justify-content-center">
                            <a type="button" class="btn d-flex justify-content-center"
                                href="{{ $lecture->zoom ? $lecture->zoom->start_url : '#' }}">
                                <bdi>
                                    {{ __('cruds.zoomMeeting.fields.start_url') }}   <i class="fas fa-play"></i>
                                </bdi>
                            </a>
                        </div>
                        @can('zoom_meeting_show')
                        @if($lecture->zoom)
                            <hr>
                            <div class="dropdown-item d-flex justify-content-center">
                                <a type="button" class="btn d-flex justify-content-center"
                                href="{{ route('admin.zoom-meetings.report',  $lecture->zoom->id) }}">
                                    {{trans('global.report')}}
                                </a>
                            </div>
                        @endif
                        @endcan
                    @endif
                    <hr>
                    <div class="dropdown-item d-flex justify-content-center">
                        {{-- data-target="{{ $lecture->type == 'quize' ? '#updateQuizeLectureModal' : ($lecture->type == 'zoom' ? 'update-zoom-button' : 'update-file-button') }}" --}}
                        <button type="button"
                            class="btn  d-flex justify-content-center open-dependon-modal"
                            data-toggle="modal" data-id="{{ $lecture->id }}" data-section-id="{{ $lecture->course_section_id }}">
                            <bdi>{{ __('lms.depends_on_lecture') }}
                                <i class="far fa-code-commit"></i><bdi>

                        </button>
                    </div>
                    @if($lecture->type == 'video')
                    <hr>
                    <div class="dropdown-item d-flex justify-content-center">
                        {{-- data-target="{{ $lecture->type == 'quize' ? '#updateQuizeLectureModal' : ($lecture->type == 'zoom' ? 'update-zoom-button' : 'update-file-button') }}" --}}
                        <button type="button"
                            class="btn  d-flex justify-content-center open-notes-modal"
                            data-toggle="modal" data-id="{{ $lecture->id }}" data-section-id="{{ $lecture->course_section_id }}">
                            <bdi>{{ __('lms.lecutre_notes') }}

                        </button>
                    </div>
                    @endif


{{--                    @can('user_attendance_access')--}}
                    @if($lecture->type == 'attendance_design')
                        <hr>
                        <div class="dropdown-item d-flex justify-content-center">
                            <a type="button" class="btn d-flex justify-content-center"
                               href="{{ route("admin.user-attendances.index",['lecture_id' => $lecture->id]) }}">
                                {{ trans('cruds.userAttendance.title') }}
                            </a>
                        </div>
                    @endif
{{--                    @endcan--}}
                </div>
            </div>
        </div>
    </div>
