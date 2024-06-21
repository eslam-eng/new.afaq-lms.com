@php
    $content = $lecture->zoom;
@endphp
@if($content)
<div class="row mx-0 border  border-right-0 border-left-0 border-top-0">
    <div class="type_title_parent col-md-6 d-flex p-0">
        <div class="type_title">
            <img src="{{ asset('frontend/icons/zoom.svg') }}" class="content-icon">
            <bdi>{{ $content->topic }}</bdi>
            <small class="zoom-small">zoom</small>
        </div>
    </div>
    @if (($reserved || $content->accessing == 'public') &&
        strtotime($content->start_time) < strtotime($now) &&
        strtotime($now) < strtotime($content->end_time))
        <div class="col-12 d-flex justify-content-end text-center">
            <div class="col-8 d-flex my-auto">
                <span class="">
                    <bdi>{{ date('H:i:s', strtotime($content->start_time)) }}</bdi>
                </span>
                <span class=""> - </span>
                <span class="">
                    <bdi>
                        {{ date('H:i:s', strtotime($content->end_time)) }}</bdi>
                    KSA</span>
            </div>
            <a class="open-zoom col-4" href="{{ $content->join_url }}">{{ __('open') }}</a>
        </div>
    @elseif(strtotime($content->end_time) < strtotime($now))
        <div class="col-12 d-flex justify-content-end text-center">
            <span>{{ __('lms.Closed') }}</span>
        </div>
    @elseif(strtotime($content->start_time) > strtotime($now))
        <div class="col-md-2 p-0" style="display: flex" id="zoom-container-{{ $content->id }}">

            <div class="col-12 type_content d-flex justify-content-end text-center zoom-timer-{{ $content->id }}">
                <ul>
                    <li>
                        <div class="timer_number" id="zoom-days-{{ $content->id }}">
                            0
                        </div>
                        <span>{{ __('global.day') }}</span>
                    </li>
                    <li>
                        <div class="timer_number" id="zoom-hours-{{ $content->id }}">
                            0
                        </div>
                        <span>{{ __('global.hour') }}</span>
                    </li>
                    <li>
                        <div class="timer_number" id="zoom-minutes-{{ $content->id }}">
                            0
                        </div>
                        <span>{{ __('global.minute') }}</span>
                    </li>
                    <li>
                        <div class="timer_number" id="zoom-seconds-{{ $content->id }}">
                            0
                        </div>
                        <span>{{ __('global.second') }}</span>
                    </li>
                </ul>


            </div>
        </div>
        <div class="col-md-4 d-flex flex-wrap">
            <div class="col-8 d-flex my-auto">
                <span class="">
                    <bdi>{{ date('H:i:s', strtotime($content->start_time)) }}</bdi>
                </span>
                <span class=""> - </span>
                <span class="">
                    <bdi>
                        {{ date('H:i:s', strtotime($content->end_time)) }}</bdi>
                    KSA</span>
            </div>
            @if ($reserved || $content->accessing == 'public')
                <a style="display: none;"
                    class="open-zoom open-zoom-{{ $content->id }}  col-4 waiting-button-zoom-{{ $content->id }}"
                    href="{{ $content->join_url }}">{{ __('open') }}</a>
            @endif
        </div>
    @endif
</div>
@endif
