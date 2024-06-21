@if (count($related_courses))
    <div class="related_courses">
        <h4>
            {{ __('global.related_courses') }}
        </h4>
        <div class="Also-Brought-card  owl-carousel owl-theme">
            @foreach ($related_courses as $v1)
                <div class="Brought-card-details" >
                    @include('frontend.partials.course-card', [
                        'course' => $v1,
                    ])
                </div>
            @endforeach
        </div>
    </div>
@endif
