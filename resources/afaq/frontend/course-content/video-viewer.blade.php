@section('styles')
    @parent
    <link rel="stylesheet" href="/frontend/css/course_page.css">
    <link href="{{ asset('afaq/assests/css/video.css') }}" rel="stylesheet" />
    <style>
        .mini {
            width: 400px !important;

            position: fixed;
            /* left: 0; */
            right: 15px;
            bottom: 15px;
        }
    </style>
    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->
@endsection
@php
if (isset($sect->lectures[$loop->index + 1])) {
    $nextId = $sect->lectures[$loop->index + 1]['id'];
    $sectionId = $sect->id;
    $nextType = $sect->lectures[$loop->index + 1]['type'];
} else {
    if (isset($oneCourse->sections[$loop->parent->index + 1])) {
        $nextId = isset($oneCourse->sections[$loop->parent->index + 1]['lectures'][0]) ? $oneCourse->sections[$loop->parent->index + 1]['lectures'][0]['id'] : null;
        $sectionId = isset($oneCourse->sections[$loop->parent->index + 1]) ? $oneCourse->sections[$loop->parent->index + 1]['id'] : null ;
        $nextType = isset($oneCourse->sections[$loop->parent->index + 1]['lectures'][0]) ? $oneCourse->sections[$loop->parent->index + 1]['lectures'][0]['type'] : null;
    } else {
        $nextId = null;
        $sectionId =null;
        $nextType = null;
    }
}
@endphp
<video id="my-video-{{ $lecture->id }}" data-id="{{ $lecture->id }}"
    class="vjs-matrix video-js vjs-big-play-centered w-100 rounded video-cours" controls preload="auto" width="840"
    height="600"
    data-setup="{
            'liveui': true,
            'breakpoints':{
                'medium':20
            },
            'playbackRates':[0.5, 1, 1.5, 2]}">
    <source src="{{ get_video_to_s3($lecture->file) }}" type="video/mp4" />
    <source src="{{ get_video_to_s3($lecture->file) }}" type="video/webm" />
    <p class="vjs-no-js">
        To view this video please enable JavaScript, and consider upgrading to a
        web browser that
    </p>
</video>
{{-- <button id="togglePipButton" onclick="togglePictureInPicture()"> toggle</button> --}}
<div>
    <p id="show_time_ranges-{{ $lecture->id }}"></p>
    <p id="video_duration-{{ $lecture->id }}"></p>
    <p id="show_video_duration-{{ $lecture->id }}"></p>
    <p id="display_show_video_duration"></p>
    <p id="score_percentage"></p>
</div>


@section('scripts')
    @parent
    <script>
        var videoPlaying = null;
        var video_score = @json($lecture->videoScore()
                                    ->where('user_id', auth()->user()->id)
                                    ->first());
        var lecid = "{{ $lecture->id }}";
        window[`player_${lecid}`] = videojs('my-video-{{ $lecture->id }}', {
            controls: true,
            playbackRates: [0.5, 1, 1.5, 2],
            // pictureInPictureToggle: false,
            // loop: true, //play again automatic
            // fluid: false, // fullscreen
            width: 520,
            height: 520,
            preload: 'auto'

        }, function onPlayerReady() {
            videojs.log('Your player is ready!');

            // In this context, `this` is the player that was created by Video.js.
            // this.play();

            this.on('play', function() {

                if (videoPlaying && videoPlaying != this) {
                    videoPlaying.pause();
                }
                videoPlaying = this
            });

            this.on('pause', function() {
                let total = 0;
                let final_total = '';
                let all = [];
                let display_ranges = ``;
                console.log('here');
                for (let index = 0; index < this.played().length; index++) {
                    videojs.log('start', this.played().start(index));
                    videojs.log('end', this.played().end(index));
                    let start = this.played().start(index);
                    let end = this.played().end(index);
                    total += (end - start);
                    all[index] = {
                        start: parseInt(start),
                        end: parseInt(end)
                    }
                    console.log('here-' + index);

                    display_ranges += `start: ${parseInt(start)} - end: ${parseInt(end)} | `
                }
                let all_total = parseInt(total);

                let d = total;
                d = d % (3600);

                let min = parseInt(d / 60);
                d = d % (60);

                let sec = parseInt(d);

                if (sec < 10) {
                    sec = `0${sec}`;
                }
                if (min < 10) {
                    min = `0${min}`;
                }

                console.log(this.duration());
                let duration = parseInt(this.duration());
                let success_percentage = parseFloat((all_total / duration) * 100).toFixed(1);
                let display_show_video_duration = ` ${min}m ${sec}s`;
                // videojs.log('all_total', all_total);
                // videojs.log('total', ` ${min}m ${sec}s`);
                // videojs.log('duration', duration);
                // videojs.log('success_percentage', parseFloat(success_percentage).toFixed(1));


                // $('#show_video_duration').html(`<p>show_time_ranges:${all_total} </p>`);
                // $('#display_show_video_duration').html(
                //     `<p>display_show_video_duration:${display_show_video_duration} </p>`);
                // $('#video_duration').html(`<p>duration:${duration} </p>`);
                // $('#score_percentage').html(`<p>success_percentage:${success_percentage} </p>`);
                // $('#show_time_ranges').html(`<p>show_time_ranges:${display_ranges} </p>`);

                $.ajax({
                    url: "{{ route('one-course-video-result', [$lecture->id, 'locale' => app()->getLocale()]) }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        show_video_duration: all_total,
                        display_show_video_duration: display_show_video_duration,
                        video_duration: duration,
                        score_percentage: success_percentage,
                        show_time_ranges: all,
                        lecture_id: "{{ $lecture->id }}",
                        course_id: "{{ $lecture->course_id }}"
                    },
                    cache: false,
                    success: function(data) {
                        console.log(data);
                    },
                    error: function() {},
                    complete: function() {},
                });

            });

            this.on('ended', function() {
                let total = 0;
                let final_total = '';
                let all = [];
                let display_ranges = ``;
                console.log('here');
                for (let index = 0; index < this.played().length; index++) {
                    videojs.log('start', this.played().start(index));
                    videojs.log('end', this.played().end(index));
                    let start = this.played().start(index);
                    let end = this.played().end(index);
                    total += (end - start);
                    all[index] = {
                        start: parseInt(start),
                        end: parseInt(end)
                    }
                    console.log('here-' + index);

                    display_ranges += `start: ${parseInt(start)} - end: ${parseInt(end)} | `
                }
                let all_total = parseInt(total);

                let d = total;
                d = d % (3600);

                let min = parseInt(d / 60);
                d = d % (60);

                let sec = parseInt(d);

                if (sec < 10) {
                    sec = `0${sec}`;
                }
                if (min < 10) {
                    min = `0${min}`;
                }

                console.log(this.duration());
                let duration = parseInt(this.duration());
                let success_percentage = parseFloat((all_total / duration) * 100).toFixed(1);
                let display_show_video_duration = ` ${min}m ${sec}s`;
                // videojs.log('all_total', all_total);
                // videojs.log('total', ` ${min}m ${sec}s`);
                // videojs.log('duration', duration);
                // videojs.log('success_percentage', parseFloat(success_percentage).toFixed(1));


                // $('#show_video_duration').html(`<p>show_time_ranges:${all_total} </p>`);
                // $('#display_show_video_duration').html(
                //     `<p>display_show_video_duration:${display_show_video_duration} </p>`);
                // $('#video_duration').html(`<p>duration:${duration} </p>`);
                // $('#score_percentage').html(`<p>success_percentage:${success_percentage} </p>`);
                // $('#show_time_ranges').html(`<p>show_time_ranges:${display_ranges} </p>`);

                $.ajax({
                    url: "{{ route('one-course-video-result', [$lecture->id, 'locale' => app()->getLocale()]) }}",
                    type: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        show_video_duration: all_total,
                        display_show_video_duration: display_show_video_duration,
                        video_duration: duration,
                        score_percentage: success_percentage,
                        show_time_ranges: all,
                        lecture_id: "{{ $lecture->id }}",
                        course_id: "{{ $lecture->course_id }}"
                    },
                    cache: false,
                    success: function(data) {
                        @if($nextId)
                            window.location.href = "{{route('one-course-content',['locale' => app()->getLocale(),'course_id' => $oneCourse->id,'section_id' => $sectionId,'lecture_id' => $nextId])}}"
                        @endif
                    },
                    error: function() {},
                    complete: function() {},
                });

            });
        });
        //here
        window[`player_${lecid}`].controlBar.progressControl.disable();
        if(video_score){
            window[`player_${lecid}`].currentTime(video_score ? video_score.show_video_duration : 0);
        }

    </script>
    <script>
        const video = document.querySelector("video")
        const videoContainer = document.getElementById("video-container");

        function togglePictureInPicture() {
            if (document.pictureInPictureElement) {
                document.exitPictureInPicture();
            } else if (document.pictureInPictureEnabled) {
                video.requestPictureInPicture();
            }
        }
        let lastKnownScrollPosition = 0;
        let ticking = false;

        document.addEventListener('scroll', (e) => {
            lastKnownScrollPosition = window.scrollY;
            window.requestAnimationFrame(() => {

                if (lastKnownScrollPosition > 800 && !videoContainer.classList.contains("mini")) {
                    setTimeout(function() {
                        video.classList.add("mini");
                        // console.log("added");
                        videoContainer.classList.add("mini");
                    }, 500);


                } else if (lastKnownScrollPosition < 800 && videoContainer.classList.contains("mini")) {
                    setTimeout(function() {
                        video.classList.remove("mini");
                        videoContainer.classList.remove("mini");
                    }, 500);
                }


            });
        });
    </script>
    <script>
        $(document).on('click', '.notes-btn', function() {
            var id = $(this).attr('lectureId');
            var time = $(this).attr('time');
            window[`player_${id}`].currentTime(time);
            $(`.current-lec-note-${id}`).html(
                `<p class="w-100 border-top p-2">${ $(this).text() ?? '' }</p>`);
        });
    </script>
@endsection
