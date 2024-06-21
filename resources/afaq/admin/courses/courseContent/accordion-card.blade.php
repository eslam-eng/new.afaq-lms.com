<div id="card-{{ $section->id }}">
    <div class="card mb-1">
        <div class="card-header d-flex flex-wrap" id="headingOne-{{ $section->id }}">
            <div class="col-md-8 col-sm-6">
                <h5 class="mb-0 w-100">
                    <button class="btn w-100 align-start card-opener-{{ $section->id }}" data-toggle="collapse"
                        data-target="#collapseOne-{{ $section->id }}" aria-expanded="true" aria-controls="collapseOne">
                        {{ app()->getLocale() == 'en' ? $section->title_en : $section->title_ar }}
                    </button>
                </h5>
            </div>
            <div class="col-md-4 col-sm-4 d-flex flex-wrap">
                <div class="col-md-8 col-sm-6 px-0 d-flex flex-wrap justify-content-end">
                    <button type="button" style="color:#000;" class="btn px-1 normal-button"
                        normal-section-id="{{ $section->id }}" normal-course-id="{{ $section->course_id }}"
                        add-lecture-section-id="{{ $section->id }}" data-toggle="modal"
                        data-target="#normalLectureModal">
                        <i class="fas fa-file"></i>

                    </button>
                    <button type="button"style="color:#0B5CFF;" class="btn px-1 zoom-button"
                        zoom-section-id="{{ $section->id }}" zoom-course-id="{{ $section->course_id }}"
                        add-lecture-section-id="{{ $section->id }}" data-toggle="modal"
                        data-target="#zoomLectureModal">
                        <i class="fas fa-video"></i>
                    </button>
                    <button type="button" style="color:green;" class="btn px-1 quize-button"
                        quize-section-id="{{ $section->id }}" quize-course-id="{{ $section->course_id }}"
                        data-toggle="modal" data-target="#quizeLectureModal">
                        <i class="far fa-question-circle"></i>
                    </button>
                </div>
                <div class="btn-group col-md-4 col-sm-6 px-0">
                    <button class="btn  btn-sm" type="button" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu">
                        <!-- Button trigger modal -->
                        <div class="dropdown-item d-flex justify-content-center">
                            <button type="button" class="btn  d-flex justify-content-center updateSectionButton"
                                course-section-id="{{ $section->id }}"
                                course-section-title-en="{{ $section->title_en }}"
                                course-section-title-ar="{{ $section->title_ar }}" data-toggle="modal"
                                data-target="#exampleModalCenter">
                                <bdi>{{ __('global.update') }}
                                    <i class="fas fa-edit"></i></bdi>

                            </button>
                        </div>
                        <hr>
                        <div class="dropdown-item d-flex justify-content-center">
                            <button type="button" class="btn d-flex justify-content-center delete-section"
                                delete-section-id="{{ $section->id }}">
                                <bdi>
                                    {{ __('global.delete') }} <i class="fas fa-trash-alt"></i>
                                </bdi>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div id="collapseOne-{{ $section->id }}" class="collapse" aria-labelledby="headingOne-{{ $section->id }}"
            data-parent="#accordion">
            <div class="card-body section-card-{{ $section->id }} connectedSortable-{{ $section->id }}"
                id="section-card-{{ $section->id }}">
                @foreach ($section->lectures as $lecture)
                    <div class="lecture-div d-flex flex-wrap" lecture-id="{{ $lecture->id }}"
                        id="lecture-{{ $lecture->id }}">
                        @include('admin.courses.courseContent.cards.lecture-card', ['lecture' => $lecture])
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
