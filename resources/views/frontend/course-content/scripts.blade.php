<script>
    var answers = ["A", "C", "B"],
        tot = answers.length;

    function getCheckedValue(radioName) {
        var radios = document.getElementsByName(radioName); // Get radio group by-name
        for (var y = 0; y < radios.length; y++)
            if (radios[y].checked) return radios[y].value; // return the checked value
    }

    function getScore() {
        var score = 0;
        for (var i = 0; i < tot; i++)
            if (getCheckedValue("question" + i) === answers[i]) score += 1; // increment only
        return score;
    }

    function returnScore() {
        document.getElementById("myresults").innerHTML =
            "Your score is " + getScore() + "/" + tot;
    }
</script>

@section('scripts')
    @parent
    <script>
        function zoomTimer(endDate, id, join_url, container_id) {
            //		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");
            var date = new Date();
            var now = date.toLocaleString('en-US', {
                timeZone: 'Asia/Riyadh',
            });
            var endTime = new Date(endDate);
            endTime = (Date.parse(endTime) / 1000);
            now = (Date.parse(now) / 1000);
            var dateOver = (now + (15 * 60));
            var reserved = "{{ $reserved }}";

            var timeLeft = endTime - now;

            if (endTime <= dateOver) {
                if (reserved == '1') {
                    $(`.open-${container_id}-${id}`).show();
                }
            }

            if (timeLeft > 0) {
                var days = Math.floor(timeLeft / 86400);
                var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600)) / 60);
                var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

                if (hours < "10") {
                    hours = "0" + hours;
                }
                if (minutes < "10") {
                    minutes = "0" + minutes;
                }
                if (seconds < "10") {
                    seconds = "0" + seconds;
                }

                $(`#${container_id}-days-${id}`).html(days);
                $(`#${container_id}-hours-${id}`).html(hours);
                $(`#${container_id}-minutes-${id}`).html(minutes);
                $(`#${container_id}-seconds-${id}`).html(seconds);
            } else {
                $(`#${container_id}-container-${id}`).hide();
                if (reserved == '1') {
                    // $(`#open-${container_id}-${id}`).show();
                    // $(`.waiting-button-${container_id}-${id}`).hide();
                }
            }

        }

        @if ($oneCourse->sections()->count())
            @foreach ($oneCourse->sections as $k => $section)
                @foreach ($section->lectures as $kk => $lecture)
                    @if ($lecture->type == 'zoom' && $lecture->zoom)
                        @if (strtotime($lecture->zoom->start_time) > strtotime($now))
                            setInterval(function() {
                                zoomTimer("{{ date('Y-m-d H:i:s', strtotime($lecture->zoom->start_time)) }}",
                                    "{{ $lecture->zoom->id }}", "{{ $lecture->zoom->join_url }}", "zoom")
                            }, 1000);
                        @endif
                    @elseif ($lecture->type == 'quize' && $lecture->quize)
                        @if (strtotime($lecture->quize->start_at) > strtotime($now))
                            setInterval(function() {
                                zoomTimer("{{ date('Y-m-d H:i:s', strtotime($lecture->quize->start_at)) }}",
                                    "{{ $lecture->quize->id }}", "{{ $lecture->quize->join_url }}", "quize")
                            }, 1000);
                        @endif
                    @elseif ($lecture->type == 'video' || $lecture->type == 'quize' || $lecture->type == 'zoom')
                        setVideoNotes("{{ $lecture_id }}")
                    @endif
                @endforeach
            @endforeach
        @endif
    </script>
@endsection


<script>
    var videoleactures = @json($all_videos);

    function setVideoNotes(lecture_id) {
        var notes = videoleactures.filter(function(lec) {
            return lec.id == lecture_id;
        })[0];

        if (notes.course_notes.length) {
            $('#left-notes').attr('class', 'col-xl-3 order-xl-1 order-2')
            $('#right-notes').attr('class', 'col-xl-9 order-xl-2 order-1')
            $('#left-notes').show()

            console.log(notes.course_notes.length);

            $('.render-notes').empty();
            $.each(notes.course_notes, function(key, value) {
                $('.render-notes').append(`

                    <div class="notes_section notes-btn" lectureId="${lecture_id}" time="${value.in_time}">
                                <div class="notes_section_image">
                                    <img src="{{ asset('/nazil/imgs/course_image_100-272x161.jpg') }}" alt="">
                                </div>

                                <p>${ value.note ?? '' }</p>


                            </div>`);

            });
        } else {
            $('#left-notes').hide()
            $('#right-notes').attr('class', 'col-12 order-xl-2 order-1')

            $('.render-notes').empty();
            $(`.current-lec-note-${lecture_id}`).empty();
        }

    }

    function removeNotes() {
        $('#left-notes').hide()
        $('#right-notes').attr('class', 'col-12 order-xl-2 order-1')
        $('.render-notes').empty();
    }
</script>
