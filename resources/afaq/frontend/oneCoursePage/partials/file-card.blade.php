
<div class="time-content-details_ d-flex justify-content-between">
    <div class="name-details-cours">
        <img src="{{ asset('afaq/imgs/file-regular (2).png') }}" alt="">
        <span>{{ $lecture->title }}</span>
    </div>
    <div class="section-time-from">
        @if ($reserved || $lecture->accessing == 'public')
        <a class="open-zoom"
            href="{{ route('one-course-content', ['locale' => app()->getLocale(), 'course_id' => $oneCourse->id,'section_id' => $lecture->course_section_id, 'lecture_id' => $lecture->id]) }}">@if(app()->getLocale() == 'en') <i class="fas fa-arrow-right"></i> @else<i class="fas fa-arrow-left"></i> @endif</a>
    @endif
    </div>
</div>
