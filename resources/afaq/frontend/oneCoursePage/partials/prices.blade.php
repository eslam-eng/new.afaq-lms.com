@if ($current_specialty)
    @php
        $current_specialty_today = strtotime(now());
        $current_specialty_early_date = strtotime($oneCourse->early_register_date);
        $current_specialty_end_register_date = strtotime($oneCourse->end_register_date);
    @endphp

    <div class="physicians_ padding_lms">
        <span> {{ __('global.early_applications') }}</span>
        <div class="d-flex justify-content-between btn_physicians_">
            <span><em>
                    {{ app()->getLocale() == 'en' && $current_specialty->specialty ? $current_specialty->specialty->name_en : $current_specialty->specialty->name_ar }}
                </em> </span>
            <span class="cost_lamss">
                {{ $current_specialty->early_price . ' ' . __('lms.SR') }}

            </span>
        </div>
        <div class="time-offer">
            <img src="/afaq/imgs/info.png" alt="">
            <span>{{ __('global.offer_august_2') }}
                {{ date('j F', $current_specialty_early_date) }}</span>
        </div>
    </div>
    <div class="Late-Registration-price">
        <div class="padding_lms Late-Registration-time">
            <span> {{ __('global.late_applications') }}</span>
            <div class="d-flex justify-content-between btn_physicians_">
                <span><em>
                        {{ app()->getLocale() == 'en' && $current_specialty->specialty ? $current_specialty->specialty->name_en : $current_specialty->specialty->name_ar }}
                    </em> </span>
                <span class="cost_lamss">
                    {{ $current_specialty->late_price . ' ' . __('lms.SR') }}
                </span>
            </div>
            <div class="time-offer">
                <img src="/afaq/imgs/info.png" alt="">
                <span>{{ __('lms.to') }}
                    {{ date('j F', $current_specialty_end_register_date) }}</span>
            </div>
        </div>
    </div>
@else
    @if(auth()->check())
    <div class="row">
        <h5 class="text-danger">{{ __('afaq.this_course_not_available_for_your_specialty') }}</h5>
    </div>
    @endif
    <div class="physicians_">
        <div class="time-offer">
            <img src="/afaq/imgs/info.png" alt="">
            <span>{{ __('global.timeFrom') }}
                {{ date('j F', strtotime($oneCourse->start_register_date)) }}</span>
        </div>
    </div>
@endif
