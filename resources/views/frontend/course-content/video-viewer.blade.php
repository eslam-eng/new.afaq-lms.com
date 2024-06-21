@section('styles')
    @parent
    <link rel="stylesheet" href="/frontend/css/course_page.css">
    <link href="https://vjs.zencdn.net/7.20.3/video-js.css" rel="stylesheet" />
    <style>
        .mini {
            width: 400px !important;
            position: fixed;
            /* left: 0; */
            right: 15px;
            bottom: 15px;
            z-index: 99999;
        }

            position: fixed;
            /* left: 0; */
            right: 0px;
            bottom: 15px;
        }
        .course_content_right_sections .videoProgressBottomInfo{
            margin-bottom: 20px;
        }
        .course_content_right_sections .videoDuration,
        .course_content_right_sections .videoWatchDuration,
        .course_content_right_sections .videoPercentage{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            font-size: 12px;
            font-weight: bold;
        }
    </style>
    <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
    <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->
@endsection
<div class="video_first_container">
    <div id="video-container">
    <video id="my-video-{{ $lecture->id }}{{ $lecture->course_section_id }}" class="vjs-matrix video-js vjs-big-play-centered vjs-16-9 rounded" controls
        preload="auto" poster="MY_VIDEO_POSTER.jpg"
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
    </div>
</div>
<!-- <button id="togglePipButton" onclick="togglePictureInPicture()"> toggle</button> -->
<div class="videoProgressBottomInfo">
    <p id="show_time_ranges-{{ $lecture->id }}{{ $lecture->course_section_id }}"></p>
    <div class="videoDuration" id="video_duration-{{ $lecture->id }}{{ $lecture->course_section_id }}"></div>
    <p id="show_video_duration-{{ $lecture->id }}{{ $lecture->course_section_id }}"></p>
    <div class="videoWatchDuration" id="display_show_video_duration-{{ $lecture->id }}{{ $lecture->course_section_id }}"></div>
    <div class="videoPercentage" id="score_percentage-{{ $lecture->id }}{{ $lecture->course_section_id }}"></div>
</div>


@section('scripts')
    @parent
    <script src="https://vjs.zencdn.net/7.20.3/video.min.js"></script>

    <script>
        var player_{{ $lecture->id }} = videojs('my-video-{{ $lecture->id }}{{ $lecture->course_section_id }}', {
            controls: true,
            playbackRates: [0.5, 1, 1.5, 2],
            controlBar: {
                pictureInPictureToggle: true
            },
            // pictureInPictureToggle: false,
            // loop: true, //play again automatic
            // fluid: false, // fullscreen
            // width: 520,
            // height: 240,
            preload: 'auto'

        }, function onPlayerReady() {
            videojs.log('Your player is ready!');

            // In this context, `this` is the player that was created by Video.js.
            // this.play();

            this.on('play', function() {
                // this.currentTime(15)
            });

            // this.on('pause', function() {
            //  videojs.log(this.currentTime());
            // });

            this.on('ended', function() {
                let total = 0;
                let final_total = '';
                let all = [];
                let display_ranges = ``;
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

                let duration = parseInt(this.duration());
                let success_percentage = parseFloat((all_total / duration) * 100).toFixed(1);
                let display_show_video_duration = ` ${min}m ${sec}s`;
                // videojs.log('all_total', all_total);
                // videojs.log('total', ` ${min}m ${sec}s`);
                // videojs.log('duration', duration);
                // videojs.log('success_percentage', parseFloat(success_percentage).toFixed(1));


                // $('#show_video_duration-{{ $lecture->id }}{{ $lecture->course_section_id }}').html(`<p>show_time_ranges:${all_total} </p>`);
                $('#display_show_video_duration-{{ $lecture->id }}{{ $lecture->course_section_id }}').html(
                    `<span>{{__('global.watch_time')}}:</span><span>${display_show_video_duration}</span>`);
                $('#video_duration-{{ $lecture->id }}{{ $lecture->course_section_id }}').html(`<span>{{__('global.video_duration')}}:</span><span>${duration}</span>`);
                $('#score_percentage-{{ $lecture->id }}{{ $lecture->course_section_id }}').html(`<span>{{__('global.succes_percentage')}}:</span><span>${success_percentage}</span>`);
                // $('#show_time_ranges-{{ $lecture->id }}{{ $lecture->course_section_id }}').html(`<p>show_time_ranges:${display_ranges} </p>`);

                // if(success_percentage > 5){
                //     $('.course_content_right_sections a.active').next().removeClass('disabled')
                // }

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
                        lecture_id: "{{ $lecture->id }}{{ $lecture->course_section_id }}",
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
        });
    </script>
<script>
    const video = document.querySelector("video")
    const videoContainer = document.getElementById("video-container");
    let lastKnownScrollPosition = 0;
    let ticking = false;

    // document.addEventListener('scroll', (e) => {
    //     lastKnownScrollPosition = window.scrollY;
    //     window.requestAnimationFrame(() => {
    //
    //             if(lastKnownScrollPosition > 700 &&  !videoContainer.classList.contains("mini")){
    //                 setTimeout(function(){
    //                     video.classList.add("mini-video");
    //                     // console.log("added");
    //                     videoContainer.classList.add("mini");
    //                 }, 500);
    //
    //
    //             }else if(lastKnownScrollPosition < 800 &&  videoContainer.classList.contains("mini")){
    //                 setTimeout(function(){
    //                     video.classList.remove("mini-video");
    //                     videoContainer.classList.remove("mini");
    //                 }, 500);
    //                 }
    //
    //
    //     });
    // });
</script>
    <script>
        $(document).on('click','.notes-btn',function(){
            var id = $(this).attr('lectureId');
            var time = $(this).attr('time');
            window[`player_${id}`].currentTime(time);
            $(`.current-lec-note-${id}`).html(
                    `<p class="w-100 border-top p-2">${ $(this).text() ?? '' }</p>`);
        });
    </script>
@endsection
