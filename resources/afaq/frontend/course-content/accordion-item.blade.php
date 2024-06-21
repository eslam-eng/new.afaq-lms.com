@foreach ($oneCourse->sections as $keySection => $section)
    <div class="accordion-item cours-list-details mb-3 mt-3">
        <h4 class="accordion-header cours-number" id="coll-h-{{ $section->id }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                data-bs-target="#coll-{{ $section->id }}" aria-expanded="false" aria-controls="coll-{{ $section->id }}"
                dir="ltr">
                {{ $section->title }}
            </button>
        </h4>
        <div id="coll-{{ $section->id }}"
            class="accordion-collapse collapse {{ $section_id == $section->id ? 'in show' : '' }} "
            aria-labelledby="coll-h-{{ $section->id }}" data-bs-parent="#accordionPanelsStayOpenExample">
            <div class="accordion-body section-work">
                <div class="list-group" id="list-tab-{{ $section->id }}" role="tablist">
                    @foreach ($section->lectures as $keyLecture => $lecture)
                        @php
                            $quize_repeate_access =
                                $lecture->type == 'quize' &&
                                ($lecture->quize
                                    ->scores()
                                    ->where('user_id', auth()->user()->id)
                                    ->first()
                                    ? ($lecture->quize
                                        ->scores()
                                        ->where('user_id', auth()->user()->id)
                                        ->first()->repeat_times < $lecture->quize->repeat_times
                                        ? true
                                        : false)
                                    : true)
                                    ? true
                                    : false;
                            $depend_access = true;
                            if ($lecture->depends_on_id && $lecture->dependsOn) {
                                switch ($lecture->dependsOn->type) {
                                    case 'quize':
                                        $depend_access = $lecture->dependsOn->quize
                                            ->scores()
                                            ->where('user_id', auth()->user()->id)
                                            ->first()
                                            ? true
                                            : false;
                                        break;
                                    case 'zoom':
                                        $depend_access = $lecture->dependsOn->zoom
                                            ->reports()
                                            ->where('user_id', auth()->user()->id)
                                            ->first()
                                            ? true
                                            : false;
                                        break;
                                    case 'video':
                                        $depend_access = $lecture->dependsOn
                                            ->videoScore()
                                            ->where('user_id', auth()->user()->id)
                                            ->first()
                                            ? true
                                            : false;
                                        break;
                                    default:
                                        $depend_access = true;
                                        # code...
                                        break;
                                }
                            }
                        @endphp

                        @switch($lecture->type)
                            @case('video')
                                @if ($lecture->videoScore->where('user_id', auth()->user()->id)->first() &&
                                    $lecture->videoScore->where('user_id', auth()->user()->id)->first()->score_percentage > 50)
                                    @php $class = 'completed' @endphp
                                @elseif ($lecture->videoScore->where('user_id', auth()->user()->id)->first() &&
                                    $lecture->videoScore->where('user_id', auth()->user()->id)->first()->score_percentage < 50)
                                    @php $class = 'not-completed' @endphp
                                @else
                                    @php $class = '' @endphp
                                @endif
                            @break

                            @case('zoom')
                            @php
                                        $zoom_report = $lecture->zoom ? $lecture->zoom->reports()->where('user_id', auth()->user()->id)->first() : null;
                                    @endphp
                                @if ($zoom_report &&
                                    $zoom_report->join_percentage > 50)
                                    @php $class = 'completed' @endphp
                                @elseif ($zoom_report &&
                                    $zoom_report->join_percentage < 50)
                                    @php $class = 'not-completed' @endphp
                                @else
                                    @php $class = '' @endphp
                                @endif
                            @break

                            @case('quize')
                                @if ($lecture->quize->scores()->where('user_id', auth()->user()->id)->first() &&
                                    $lecture->quize->scores()->where('user_id', auth()->user()->id)->first()->score_percentage > $lecture->quize->success_percentage)
                                    @php $class = 'completed' @endphp
                                @elseif ($lecture->quize->scores()->where('user_id', auth()->user()->id)->first() &&
                                    $lecture->quize->scores()->where('user_id', auth()->user()->id)->first()->score_percentage < $lecture->quize->success_percentage)
                                    @php $class = 'not-completed' @endphp
                                @else
                                    @php $class = '' @endphp
                                @endif
                            @break

                            @default
                                @php
                                    $class = '';
                                @endphp
                        @endswitch

                        <div @if ($lecture->type == 'video') onclick="setVideoNotes('{{ $lecture->id }}')"
                                @else  onclick="removeNotes('{{ $lecture->id }}')" @endif
                            class="list-group-item list-group-item-action cours-section-lms

                                 {{ $lecture->id == $lecture_id ? 'active-section_' : '' }}
                                 @if (!$reserved && $lecture->accessing == 'private') disabled @endif
                                 @if ($lecture->type == 'quize' && !$quize_repeate_access) disabled @endif
                                  @if (!$depend_access) disabled @endif"
                            id="list-{{ $lecture->id }}-list" data-bs-toggle="list" href="#list-{{ $lecture->id }}"
                            role="tab" aria-controls="list-{{ $lecture->id }}">

                            @switch($lecture->type)
                                @case('video')
                                <div class="cours-stutes">
                                    <i class="fa-solid fa-circle-check complte_ {{ $class == 'completed' ? 'active' : '' }}"></i>
                                    <i class="fa-solid fa-circle-check not-compte {{ $class == '' ? 'active' : '' }}"></i>
                                    <i class="fa-solid fa-circle-xmark closed_ {{ $class == 'not-completed' ? 'active' : '' }}"></i>
                                </div>
                                    <div class="cours-img-lms">
                                        <img src="{{ asset('/nazil/imgs/course_image_100-272x161.jpg') }}" alt="">

                                        @if ($lecture->videoScore()->where('user_id', auth()->user()->id)->first())
                                            <span class="about-cours-stutes">
                                                {{ $lecture->videoScore()->where('user_id', auth()->user()->id)->first()->score_percentage }}
                                                % {{ __('global.finished') }}</span>
                                        @endif
                                    </div>
                                    <div class="cours-details-data_lms">
                                        <p>{{ $lecture->title }}</p>
                                    </div>
                                @break

                                @case('photo')
                                    <div class="cours-stutes">
                                        <i class="fa-solid fa-circle-check complte_ {{ $class == 'completed' ? 'active' : '' }}"></i>
                                        <i class="fa-solid fa-circle-check not-compte {{ $class == '' ? 'active' : '' }}"></i>
                                        <i class="fa-solid fa-circle-xmark closed_ {{ $class == 'not-completed' ? 'active' : '' }}"></i>
                                    </div>
                                    <div class="cours-img-lms">
                                        <img src="{{ asset('/nazil/imgs/course_image_100-272x161.jpg') }}" alt="">
                                        {{-- <span class="about-cours-stutes">88% Finish</span> --}}
                                    </div>
                                    <div class="cours-details-data_lms">
                                        <p>{{ $lecture->title }}</p>
                                    </div>
                                @break


                            @break

                            @case('zoom')
                            <div class="cours-stutes">
                                <i class="fa-solid fa-circle-check complte_ {{ $class == 'completed' ? 'active' : '' }}"></i>
                                <i class="fa-solid fa-circle-check not-compte {{ $class == '' ? 'active' : '' }}"></i>
                                <i class="fa-solid fa-circle-xmark closed_ {{ $class == 'not-completed' ? 'active' : '' }}"></i>
                            </div>
                                <div class="cours-img-lms">
                                    <img src="{{ asset('/afaq/content-icons/zoom-icon.png') }}" alt="">
                                    @php
                                        $zoom_report = $lecture->zoom ? $lecture->zoom->reports()->where('user_id', auth()->user()->id)->first() : null;
                                    @endphp
                                    @if ($zoom_report)
                                        <span class="about-cours-stutes">
                                            {{ $zoom_report->join_percentage }}
                                            % {{ __('global.finished') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="cours-details-data_lms">
                                    <p>{{ $lecture->title }}</p>
                                </div>
                            @break

                            @case('quize')
                            <div class="cours-stutes">
                                <i class="fa-solid fa-circle-check complte_ {{ $class == 'completed' ? 'active' : '' }}"></i>
                                <i class="fa-solid fa-circle-check not-compte {{ $class == '' ? 'active' : '' }}"></i>
                                <i class="fa-solid fa-circle-xmark closed_ {{ $class == 'not-completed' ? 'active' : '' }}"></i>
                            </div>
                                <div class="cours-img-lms">
                                    <img src="{{ asset('/afaq/content-icons/file-circle-question.png') }}" alt="">
                                    @if ($lecture->quize->scores()->where('user_id', auth()->user()->id)->first())
                                        <span class="about-cours-stutes">
                                            {{ $lecture->quize->scores()->where('user_id', auth()->user()->id)->first()->score_percentage }}
                                            %
                                            {{ __('global.finished') }}
                                        </span>
                                    @endif
                                </div>
                                <div class="cours-details-data_lms">
                                    <p>{{ $lecture->title }}</p>
                                </div>
                            @break

                            @case('file')
                            <div class="cours-stutes">
                                <i class="fa-solid fa-circle-check complte_ {{ $class == 'completed' ? 'active' : '' }}"></i>
                                <i class="fa-solid fa-circle-check not-compte {{ $class == '' ? 'active' : '' }}"></i>
                                <i class="fa-solid fa-circle-xmark closed_ {{ $class == 'not-completed' ? 'active' : '' }}"></i>
                            </div>
                                <div class="cours-img-lms">
                                    <img src="{{ asset('/afaq/content-icons/file-regular.png') }}" alt="">
                                    {{-- <span class="about-cours-stutes">88% Finish</span> --}}
                                </div>
                                <div class="cours-details-data_lms">
                                    <p>{{ $lecture->title }}</p>
                                </div>
                            @break

                            @default
                        @endswitch
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endforeach
