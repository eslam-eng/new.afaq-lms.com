@if ($current_specialty)
    @php
        $current_specialty_today = strtotime(now());
        $current_specialty_early_date = strtotime($oneCourse->early_register_date);
        $current_specialty_end_register_date = strtotime($oneCourse->end_register_date);
    @endphp
    <div class="applications_count d-flex flex-row">
        <div class="d-flex flex-column">
            <p class="early_late_applications">
                {{ __('global.early_applications') }}</p>
            <p class="student_as_text">
                {{ app()->getLocale() == 'en' && $current_specialty->specialty ? $current_specialty->specialty->name_en : $current_specialty->specialty->name_ar }}
            </p>
        </div>
        <div class="d-flex flex-column">
            <p class="current_price">
                {{ $current_specialty->early_price . ' ' . __('lms.SR') }}
            </p>
        </div>
    </div>
    <div class="offer_details">
        <span class="material-symbols-outlined">
            hourglass_bottom
        </span>
        <p>{{ __('global.offer_august_2') }}
            {{ date('j F', $current_specialty_early_date) }}</p>
    </div>


    <div class="applications_count d-flex flex-row mt-4">
        <div class="d-flex flex-column">
            <p class="early_late_applications">
                {{ __('global.late_applications') }}</p>
            <p class="student_as_text">
                {{ app()->getLocale() == 'en' && $current_specialty->specialty ? $current_specialty->specialty->name_en : $current_specialty->specialty->name_ar }}
            </p>
        </div>
        <div class="d-flex flex-column">

            {{-- <p class="old_price">
                    <del>٥٩٩ ر.س</del>
                </p> --}}
            <p class="current_price">
                {{ $current_specialty->late_price . ' ' . __('lms.SR') }}
            </p>
        </div>
    </div>
    <div class="offer_details">
        <span class="material-symbols-outlined">
            calendar_today
        </span>
        <p>{{ __('lms.to') }}
            {{ date('j F', $current_specialty_end_register_date) }}</p>
    </div>
@else
    <div class="offer_details">
        <span class="material-symbols-outlined">
            calendar_today
        </span>
        <p>{{ __('global.timeFrom') }}
            {{ date('j F', strtotime($oneCourse->start_register_date)) }}</p>
    </div>
@endif
