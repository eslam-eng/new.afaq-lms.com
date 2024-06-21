
<style>
    .type_content ul {
        list-style: none;
    }
    .open-zoom{
        background: #88BD2F;
        color: #fff !important;
    }
</style>
<div class="col-12 row mb-5 align-middle p-0 mx-0 my-3">

    <a href="{{route('one-course-zoom',['locale' => app()->getLocale(),'meeting_number' => $lecture->zoom->meeting_id])}}">open</a>
    @if (($reserved || $lecture->zoom->accessing == 'public') && $lecture->zoom &&
        strtotime($lecture->zoom->start_time) < strtotime($now) &&
        strtotime($now) < strtotime($lecture->zoom->end_time))
        <div class="col-6 d-flex justify-content-end text-center">
            <div class="col-8 d-flex my-auto">
                <span class="">
                    <bdi>{{ date('H:i:s', strtotime($lecture->zoom->start_time)) }}</bdi>
                </span>
                <span class=""> - </span>
                <span class="">
                    <bdi>
                        {{ date('H:i:s', strtotime($lecture->zoom->end_time)) }}</bdi>
                    KSA</span>
            </div>
            <a class="btn open-zoom col-4" href="{{ route('one-course-zoom',['locale','meeting_number' => $lecture->zoom->meeting_id]) }}">{{ __('open') }}</a>
        </div>
    @elseif($lecture->zoom && strtotime($lecture->zoom->end_time) < strtotime($now))
        <div class="col-6 d-flex justify-content-end text-center align-middle">
            <span>{{ __('lms.Closed') }}</span>
        </div>
    @elseif($lecture->zoom && strtotime($lecture->zoom->start_time) > strtotime($now))
        <div class="col-md-6 p-0 align-middle" style="display: flex" id="zoom-container-{{ $lecture->zoom->id }}">

            <div class="p-0 col-12 type_content d-flex justify-content-end text-center zoom-timer-{{ $lecture->zoom->id }}">
                <ul class="mb-0 w-100 d-flex">
                    <li>
                        <div class="timer_number" id="zoom-days-{{ $lecture->zoom->id }}">
                            0
                        </div>
                        <span>{{ __('global.day') }}</span>
                    </li>
                    <li>
                        <div class="timer_number" id="zoom-hours-{{ $lecture->zoom->id }}">
                            0
                        </div>
                        <span>{{ __('global.hour') }}</span>
                    </li>
                    <li>
                        <div class="timer_number" id="zoom-minutes-{{ $lecture->zoom->id }}">
                            0
                        </div>
                        <span>{{ __('global.minute') }}</span>
                    </li>
                    <li>
                        <div class="timer_number" id="zoom-seconds-{{ $lecture->zoom->id }}">
                            0
                        </div>
                        <span>{{ __('global.second') }}</span>
                    </li>
                </ul>


            </div>
        </div>
        <div class="col-md-6 d-flex flex-wrap p-0">
            <div class="col-8 d-flex my-auto">
                <span class="">
                    <bdi>{{ date('H:i:s', strtotime($lecture->zoom->start_time)) }}</bdi>
                </span>
                <span class=""> - </span>
                <span class="">
                    <bdi>
                        {{ date('H:i:s', strtotime($lecture->zoom->end_time)) }}</bdi>
                    KSA</span>
            </div>
            @if ($reserved || $lecture->zoom->accessing == 'public')
                <a style="display: none;"
                    class="btn open-zoom open-zoom-{{ $lecture->zoom->id }}  col-4 waiting-button-zoom-{{ $lecture->zoom->id }}"
                    href="{{ route('one-course-zoom',['locale','meeting_number' => $lecture->zoom->meeting_id]) }}">{{ __('open') }}</a>
            @endif
        </div>
    @endif
</div>
    <!-- For Component View -->

