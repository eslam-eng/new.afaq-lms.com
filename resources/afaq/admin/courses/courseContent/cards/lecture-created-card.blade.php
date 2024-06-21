<div class="lecture-div d-flex flex-wrap"  id="lecture-{{ $lecture->id }}">
    @include('admin.courses.courseContent.cards.lecture-card',['lecture'=> $lecture])
</div>
