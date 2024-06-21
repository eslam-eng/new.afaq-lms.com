<div id="section-cours-time-data mt-4">
    @if ($oneCourse->sections()->count())
        @foreach ($oneCourse->sections as $section)
            <div class="lms-afaq">
                <div class="course-time-head" id="heading-{{ $section->id }}"
                    onclick="collaseTabs('collapse-{{ $section->id }}')" style="cursor: pointer;">
                    <div class="content_header_text d-flex">
                        <div>
                            <span class="type_header_icon">
                                <i class="fa-solid fa-circle-plus"></i>
                            </span>
                            {{-- <span class="type_header_icon hide_icon">
                                <i class="fa-solid fa-circle-minus"></i>
                            </span> --}}
                            <span class="m-2">
                                {{ app()->getLocale() == 'en' ? $section->title_en : $section->title_ar }}
                            </span>
                        </div>
                        {{-- <span>
                                        {{ date('Y-m-d', strtotime($key)) }}
                                    </span> --}}
                    </div>
                </div>

                <div id="collapse-{{ $section->id }}" class="{{ $collapse_config ? 'collapsed' : 'collapse' }} "
                    aria-labelledby="heading-{{ $section->id }}" data-parent="#accordion" >
                    <div class="card-body">
                        @foreach ($section->lectures as $lecture)
                            @if ($lecture->type == 'zoom')
                                @include('frontend.oneCoursePage.partials.zoom-card', [
                                    'lecture' => $lecture,
                                ])
                            @elseif($lecture->type == 'quize')
                                @include('frontend.oneCoursePage.partials.quize-card', [
                                    'lecture' => $lecture,
                                ])
                            @elseif($lecture->type == 'video')
                                @include('frontend.oneCoursePage.partials.video-card', [
                                    'lecture' => $lecture,
                                ])
                            @elseif($lecture->type == 'file')
                                @include('frontend.oneCoursePage.partials.file-card', [
                                    'lecture' => $lecture,
                                ])
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>


