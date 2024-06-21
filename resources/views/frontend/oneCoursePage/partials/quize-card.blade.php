@php
    $content = $lecture->quize;
@endphp
@if($content)
<div class="row mx-0 border  border-right-0 border-left-0 border-top-0">
    <div class="type_title_parent col-md-6 d-flex p-0">
        <div class="type_title">
            <img src="{{ asset('frontend/icons/test.svg') }}" class="content-icon">
            <bdi>{{ $content->name }}</bdi>
            <small class="zoom-small">quize</small>
        </div>
    </div>
    @if (($reserved || $content->accessing == 'public') &&
        strtotime($content->start_at) < strtotime($now) &&
        strtotime($now) < strtotime($content->end_at) &&
        auth()->check() &&
        !$content->scores()->where('user_id', auth()->user()->id)->exists())
        <a class="open-zoom"
            href="{{ route('one-course-quize', ['locale' => app()->getLocale(), 'quize_id' => $content->id]) }}">{{ __('open') }}</a>
    {{-- @elseif(auth()->check() &&
        !$content->scores()->where('user_id', auth()->user()->id)->exists() &&
        strtotime($content->end_at) < strtotime($now))
        <div class="col-12 d-flex justify-content-end text-center">
            <span>{{ __('lms.Closed') }}</span>
        </div> --}}
    @elseif(strtotime($content->start_at) > strtotime($now))
        <div class="col-md-6 p-0" id="quize-container-{{ $content->id }}">
            <div class="type_content d-flex justify-content-end text-center quize-timer-{{ $content->id }}">
                <ul>
                    <li>
                        <div class="timer_number" id="quize-days-{{ $content->id }}">
                            0
                        </div>
                        <span>{{ __('global.day') }}</span>
                    </li>
                    <li>
                        <div class="timer_number" id="quize-hours-{{ $content->id }}">
                            0
                        </div>
                        <span>{{ __('global.hour') }}</span>
                    </li>
                    <li>
                        <div class="timer_number" id="quize-minutes-{{ $content->id }}">
                            0
                        </div>
                        <span>{{ __('global.minute') }}</span>
                    </li>
                    <li>
                        <div class="timer_number" id="quize-seconds-{{ $content->id }}">
                            0
                        </div>
                        <span>{{ __('global.second') }}</span>
                    </li>
                </ul>
                <span>{{ date('H:i:s', strtotime($content->start_at)) }}</span>
                <span>-</span> <span>
                    {{ date('H:i:s', strtotime($content->end_at)) }}
                    KSA</span>

            </div>
        </div>
        @if (($reserved || $content->accessing == 'public') &&
            auth()->check() &&
            !$content->scores()->where('user_id', auth()->user()->id)->exists())
            <a class="open-zoom" id="open-quize-{{ $content->id }}" style="display: none;"
                href="{{ route('one-course-quize', ['locale' => app()->getLocale(), 'quize_id' => $content->id]) }}">{{ __('open') }}</a>
        @endif
    @elseif(($reserved || $content->accessing == 'public') &&
        auth()->check() &&
        $content->scores()->where('user_id', auth()->user()->id)->exists())
        @php
            $quizes_score = $content
                ->scores()
                ->where('user_id', auth()->user()->id)
                ->first();
        @endphp
        <div class="col-6">

            <bdi> {{ $quizes_score->score_percentage }}
                % </bdi>
            <span class="px-2">

                {!! $quizes_score->success
                    ? '<i class="fas fa-check-circle text-success"></i>'
                    : '<i class="fas fa-times-circle text-danger"></i>' !!}
            </span>
        </div>
    @endif
</div>
@endif
