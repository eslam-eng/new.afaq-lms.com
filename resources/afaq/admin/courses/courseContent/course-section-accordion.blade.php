<div id="accordion">
    @foreach ($sections as $section)
        @include('admin.courses.courseContent.accordion-card')
    @endforeach
</div>
