@section('scripts')
    @parent
    <script>
        function addToCart(actionType) {
            var cartUrl = null;
            @if ($login)
                var cartUrl = "{{ url('/' . app()->getLocale() . '/carts/' . $oneCourse->id) }}"
                window.location.href = cartUrl;
            @else
                window.location.href = "{{ url(app()->getLocale() . '/login') }}";
            @endif
        }
    </script>

    <script>
        function makeTimer(endDate) {
            //		var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");
            var endTime = new Date(endDate);
            endTime = (Date.parse(endTime) / 1000);
            var date = new Date();
            var now = date.toLocaleString('en-US', {
                timeZone: 'Asia/Riyadh',
            });

            now = (Date.parse(now) / 1000);

            var timeLeft = endTime - now;

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

            $("#days").html(days);
            $("#hours").html(hours);
            $("#minutes").html(minutes);
            $("#seconds").html(seconds);

        }

        @php
            $timer_today = strtotime(now());
            $timer_early_date = strtotime($oneCourse->early_register_date);
            $timer_end_register_date = strtotime($oneCourse->end_register_date);
            $timer_course_start = strtotime($oneCourse->start_register_date);
        @endphp

        @if ($timer_today < $timer_course_start)
            $('#timerText').text("{{ __('global.few_left_until_the_booking_date') }}");
            setInterval(function() {
                makeTimer("{{ date('Y-m-d', strtotime($oneCourse->start_register_date)) }}");
            }, 1000);
        @elseif ($timer_today < $timer_early_date)
            $('#timerText').text("{{ __('global.few_left_until_the_early_booking_date') }}");
            setInterval(function() {
                makeTimer("{{ date('Y-m-d', strtotime($oneCourse->early_register_date)) }}");
            }, 1000);
        @elseif (isset($timer_end_register_date) &&
            $timer_today < $timer_end_register_date &&
            $timer_today > $timer_early_date)
            $('#timerText').text("{{ __('global.little_to_no_registration_deadline') }}");
            setInterval(function() {
                makeTimer("{{ date('Y-m-d', strtotime($oneCourse->end_register_date)) }}");
            }, 1000);
        @else
            $('.reservation_time').hide();
        @endif
    </script>

    <script>
        @if ($oneCourse->banner)
            $('.right-statc-side-nd').css('background-image', "url('{{ $oneCourse->banner->url }}')")
        @endif
    </script>

    <script>
        function collaseTabs(current_id) {
            // if ($('.collapsed').length) {
            //     $('.collapsed').each(function(key, value) {
            //         console.log(key, value);
            //         value.classList.remove('collapsed');
            //         value.classList.add('collapse');
            //     });
            // }

            // if ($(`#${id}`).hasClass('collapse')) {
            //     $(`#${id}`).removeClass('collapse');
            //     $(`#${id}`).addClass('collapsed');
            // } else {
            //     $(`#${id}`).removeClass('collapsed');
            //     $(`#${id}`).addClass('collapse');
            // }

            // var current_id = $(`#${id}`).id
            var element = document.getElementById(current_id).previousElementSibling.firstElementChild.firstElementChild;


            $(`#${current_id}`).toggleClass('collapsed').toggleClass('collapse')
            element.firstElementChild.classList.toggle('hide_icon')
            element.childNodes[3].classList.toggle('hide_icon');
            // console.log(element.childNodes[3]);
        }
    </script>


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
            @foreach ($oneCourse->sections as $section)
                @foreach ($section->lectures as $lecture)
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
                    @endif
                @endforeach
            @endforeach
        @endif
    </script>
@endsection
