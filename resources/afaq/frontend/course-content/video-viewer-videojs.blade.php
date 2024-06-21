@section('styles')
@parent
<link rel="stylesheet" href="/frontend/css/course_page.css">
<link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />

<!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
<!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->
@endsection
<video id="my-video" class="video-js w-100 rounded" controls preload="auto" width="640" height="264" poster="MY_VIDEO_POSTER.jpg"
    data-setup="{}">
    <source src="{{ get_video_to_s3($lecture->file) }}" type="video/mp4" />
    <source src="{{ get_video_to_s3($lecture->file) }}" type="video/webm" />
    <p class="vjs-no-js">
        To view this video please enable JavaScript, and consider upgrading to a
        web browser that
        <a href="https://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
    </p>
</video>
@section('scripts')
@parent
<script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>
@endsection
