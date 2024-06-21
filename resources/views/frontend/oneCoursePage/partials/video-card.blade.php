<div class="row mx-0 border  border-right-0 border-left-0 border-top-0">
    <div class="type_title_parent col-md-6 d-flex p-0">
        <div class="type_title">
            <img src="{{ asset('frontend/icons/film-regular.svg') }}" class="content-icon">
            <bdi>{{ $lecture->title }}</bdi>
            <small class="zoom-small">video</small>
        </div>
    </div>
    @if ($reserved || $lecture->accessing == 'public')
        {{-- <video controls>
            <source src="{{ get_video_to_s3($lecture->file)}}" type="video/mp4">
        </video> --}}

        <a class="open-zoom"
            href="{{ route('one-course-content', ['locale' => app()->getLocale(),'course_id' => $oneCourse->id, 'lecture_id' => $lecture->id , 'section_id' => $lecture->course_section_id]) }}">{{ __('open') }}</a>
    @endif

</div>
