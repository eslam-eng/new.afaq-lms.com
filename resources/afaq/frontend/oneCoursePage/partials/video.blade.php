@if ($oneCourse->video)
<div class="course_video">
    <h4>
        {{ __('global.course_video') }}
    </h4>
    <div class="video_play">
        <video controls>
            <source src="{{ $oneCourse->video->url }}" type="video/mp4">
            {{-- <source src="mov_bbb.ogg" type="video/ogg"> --}}
            Your browser does not support HTML video.
        </video>
    </div>
</div>
@endif
